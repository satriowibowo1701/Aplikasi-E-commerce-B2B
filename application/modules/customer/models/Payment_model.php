<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->user_id = get_current_user_id();
    }

    public function count_all_payments()
    {
        $id = $this->user_id;

        return $this->db->join('orders', 'orders.id = payments.order_id')->where('orders.user_id', $id)->get('payments')->num_rows();
    }

    public function get_all_payments($limit, $start)
    {
        $id = $this->user_id;

        $payments = $this->db->query("
            SELECT p.*, o.order_number
            FROM payments p
            JOIN orders o
                ON o.id = p.order_id
            WHERE o.user_id = '$id'
            ORDER BY p.payment_date DESC
            LIMIT $start, $limit
        ");

        return $payments->result();
    }

    public function register_payment($id, array $data)
    {
        $this->db->where('id', $id)->update('orders', array('order_status' => 2));
        $this->db->insert('payments', $data);
        return $this->db->insert_id();
    }

    public function payment_list()
    {
        $id = $this->user_id;

        $payments = $this->db->query("
            SELECT p.*, o.order_number
            FROM payments p
            JOIN orders o
	            ON o.id = p.order_id
            WHERE o.user_id = '$id'
            ORDER BY p.payment_date DESC
            LIMIT 5 ");

        return $payments->result();
    }

    public function is_payment_exist($id)
    {
        return ($this->db->where('id', $id)->get('payments')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function payment_data($id)
    {
        $data = $this->db->select('p.*, o.order_number')->join('orders o', 'o.id = p.order_id')->where('p.id', $id)->get('payments p')->row();

        return $data;
    }
    public function countnotif()
    {
        $id = $this->user_id;
        return $this->db->get_where('notifikasi', array('user_id' => $id, 'status' => 1, 'is_read' => 0))->num_rows();
    }

    public function notifikasi()
    {
        $id = $this->user_id;
        $query = $this->db->query("
        SELECT * FROM notifikasi WHERE user_id='$id' ORDER BY id DESC");
        $notif = $query->result();
        return $notif;
    }
    public function linknotif()
    {
        $notifikasi = $this->notifikasi();
        $arr = [];
        foreach ($notifikasi as $val) {
            $query = $this->db->query("SELECT p.id FROM orders p JOIN notifikasi o ON o.no_order = p.order_number WHERE o.id = '$val->id'");
            $res = $query->row();
            array_push($arr, $res);
        }
        return $arr;
    }
    public function readnotif($id)
    {
        $this->db->where('no_order', $id)->update('notifikasi', array('is_read' => 1));
    }
    public function add_admin_notif($data)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data1 = array(
            'user_id' => $this->user_id,
            'no_order' => $data,
            'tanggal' => date('Y-m-d H:i:s'),
            'status' => 1,
            'is_read' => 0,
        );
        $this->db->insert('notifikasi_admin', $data1);
    }
}
