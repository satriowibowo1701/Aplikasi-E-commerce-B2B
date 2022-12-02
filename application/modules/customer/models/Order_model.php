<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->user_id = get_current_user_id();
    }

    public function count_all_orders()
    {
        $id = $this->user_id;

        return $this->db->where('user_id', $id)->get('orders')->num_rows();
    }

    public function count_process_order()
    {
        $id = $this->user_id;

        return $this->db->where(array('user_id' => $id, 'order_status' => 2))->get('orders')->num_rows();
    }

    public function get_all_orders($limit, $start)
    {
        $id = $this->user_id;

        $orders = $this->db->query("
            SELECT o.id, o.order_number, o.order_date, o.order_status, o.payment_method, o.total_price, o.total_items, c.name AS coupon, cu.name AS customer
            FROM orders o
            LEFT JOIN coupons c
                ON c.id = o.coupon_id
            JOIN customers cu
                ON cu.user_id = o.user_id
            WHERE o.user_id = '$id'
            ORDER BY o.order_date DESC
            LIMIT $start, $limit
        ");

        return $orders->result();
    }
    public function order_with_bank_payments($id)
    {
        return $this->db->where(array('user_id' => $this->user_id, 'payment_method' => $id, 'order_status' => 1))->order_by('order_date', 'DESC')->get('orders')->result();
    }
    public function is_order_exist($id)
    {
        $user_id = $this->user_id;

        return ($this->db->where(array('id' => $id, 'user_id' => $user_id))->get('orders')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function datausr($id)
    {
        $data = $this->db->query("SELECT delivery_data FROM orders WHERE id = '$id'");
        return $data->row();
    }

    public function order_data($id)
    {
        $data = $this->db->query("
            SELECT o.*, c.name, c.code, p.payment_price, p.payment_date, p.picture_name, p.payment_status, p.confirmed_date, p.payment_data
            FROM orders o
            LEFT JOIN coupons c
                ON c.id = o.coupon_id
            LEFT JOIN payments p
                ON p.order_id = o.id
            WHERE o.id = '$id'
        ");

        return $data->row();
    }

    public function order_items($id)
    {
        $items = $this->db->query("
            SELECT oi.product_id, oi.order_qty, oi.order_price, p.name, p.picture_name
            FROM order_items oi
            JOIN products p
	            ON p.id = oi.product_id
            WHERE order_id = '$id'");

        return $items->result();
    }

    public function cancel_order($id)
    {
        $data = $this->order_data($id);
        $payment_method = $data->payment_method;

        $status =  ($payment_method == 1 or $payment_method == 3) ? 5 : 4;

        $this->db->where('id', $id)->update('orders', array('order_status' => $status));
        $this->db->where('order_id', $id)->update('payments', array('payment_status' => 3));
    }

    public function delete_order($id, $order_num)
    {
        if (($this->db->where('order_id', $id)->get('order_items')->num_rows() > 0))
            $this->db->where('order_id', $id)->delete('order_items');

        if (($this->db->where('order_id', $id)->get('payments')->num_rows() > 0))
            $this->db->where('order_id', $id)->delete('payments');
        if (($this->db->where('no_order', $order_num)->get('notifikasi')->num_rows() > 0))
            $this->db->where('no_order', $order_num)->delete('notifikasi');

        $this->db->where('id', $id)->delete('orders');
    }

    public function all_orders()
    {
        $query = "SELECT o.* FROM orders o LEFT JOIN reviews r ON o.id=r.order_id WHERE r.order_id IS NULL AND o.user_id = '$this->user_id'  AND (o.payment_method = 1 OR o.payment_method = 3) AND o.order_status = 4 OR r.order_id IS NULL AND o.user_id = '$this->user_id' AND o.payment_method = 2 AND o.order_status = 3 ORDER BY o.order_date ASC";
        $orders = $this->db->query($query);
        return $orders->result();
    }
    public function updatenotifcancel($no_order)
    {
        $this->db->where('no_order', $no_order)->update('notifikasi', array('status' => 3));
    }
    public function search_orders($query, $limit, $start)
    {
        $products = $this->db->like('order_number', $query)->or_like('order_date', $query)->get('orders', $limit, $start)->result();

        return $products;
    }

    public function count_search($query)
    {
        $count = $this->db->like('order_number', $query)->or_like('order_date', $query)->get('orders')->num_rows();

        return $count;
    }
}
