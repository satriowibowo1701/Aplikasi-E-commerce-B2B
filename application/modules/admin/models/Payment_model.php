<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function count_all_payments()
    {
        return $this->db->get_where('payments', array('payment_status' => '1'))->num_rows();
    }

    public function sum_success_payment()
    {
        return $this->db->select('SUM(total_price) as total_payment')->where('order_status', 4)->or_where('order_status', 3)->get('orders')->row()->total_payment;
    }

    public function payment_overview()
    {
        $data = $this->db->query("
            SELECT p.*, o.order_number, c.name, c.profile_picture, o.user_id
            FROM payments p
            JOIN orders o
	            ON o.id = p.order_id
            JOIN customers c
	            ON c.user_id = o.user_id
            WHERE p.payment_status = '1'
            LIMIT 5")->result();


        return $data;
    }

    public function set_payment_status($id, $status, $order, $noorder)
    {
        $newid = $this->db->query("SELECT id FROM notifikasi order by id desc limit 1")->row()->id;
        $newstatusnotif = $status == 2 ? 2 : 3;
        $orderstatus = $status == 3 ? 5 : 2;
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $this->db->where('id', $order)->update('orders', array('order_status' => $orderstatus));
        $this->db->where('no_order', $noorder)->update('notifikasi', array('status' => $newstatusnotif, 'id' => $newid + 1, 'is_read' => 0, 'tanggal' => $date));
        return $this->db->where('id', $id)->update('payments', array('payment_status' => $status));
    }

    public function get_all_payments($limit, $start)
    {
        $payments = $this->db->query("
            SELECT p.id, p.payment_date, p.order_id, p.payment_price, p.payment_status as status, o.order_number, c.name AS customer
            FROM payments p
            JOIN orders o
                ON o.id = p.order_id
            JOIN customers c
                ON c.user_id = o.user_id
                Where p.payment_status = '1' 
            ORDER BY p.payment_date ASC
            LIMIT $start, $limit
        ");

        return $payments->result();
    }

    public function is_payment_exist($id)
    {
        return ($this->db->where('id', $id)->get('payments')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function payment_data($id)
    {
        $payment = $this->db->query("
            SELECT p.*, o.order_number, c.name AS customer
            FROM payments p
            JOIN orders o
                ON o.id = p.order_id
            JOIN customers c
                ON c.user_id = o.user_id
            WHERE p.id = '$id'
        ");

        return $payment->row();
    }

    public function payment_by($id)
    {
        $payments = $this->db->query("
            SELECT p.id, p.payment_date, p.order_id, p.payment_price, p.payment_status as status, o.order_number, c.name AS customer, p.payment_status
            FROM payments p
            JOIN orders o
                ON o.id = p.order_id
            JOIN customers c
                ON c.user_id = o.user_id
            WHERE o.user_id = '$id'
        ");

        return $payments->result();
    }
    public function countnotif()
    {
        return $this->db->get_where('notifikasi_admin', array('is_read' => 0))->num_rows();
    }

    public function notifikasi()
    {
        $query = $this->db->query("
        SELECT * FROM notifikasi_admin ORDER BY id DESC");
        $notif = $query->result();
        return $notif;
    }
    public function linknotif()
    {
        $notifikasi = $this->notifikasi();
        $arr = [];
        foreach ($notifikasi as $val) {
            $query = $this->db->query("SELECT p.id FROM orders p JOIN notifikasi_admin o ON o.no_order = p.order_number WHERE o.id = '$val->id'");
            $res = $query->row();
            array_push($arr, $res);
        }
        return $arr;
    }
    public function readnotif($id)
    {
        $this->db->where('no_order', $id)->update('notifikasi_admin', array('is_read' => 1));
    }
    public function idpayment($noorder)
    {
        $query = "SELECT p.id FROM payments p JOIN orders o ON o.id = p.order_id WHERE o.order_number = '$noorder'";
        $id = $this->db->query($query)->row()->id;
        return $id;
    }
}
