<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function data()
    {
        $id = get_current_user_id();

        $data = $this->db->where('user_id', $id)->get('customers')->row();
        return $data;
    }
    public function cus($id)
    {
        $data = $this->db->where('id', $id)->get('users')->row();
        return $data;
    }
    public function cus2()
    {
        $id = get_current_user_id();
        $data = $this->db->where('id', $id)->get('users')->row();
        return $data;
    }

    public function change_status_gateway($id, $stat, $statnotif = null)
    {
        if ($stat == 0) {
            $status = 1;
        } elseif ($stat == 2) {
            $status = 2;
        } else {
            $status = 5;
        }
        $tol = $this->db->query("SELECT p.*, o.order_id, o.id AS payment_id , o.payment_data
        FROM orders p
        JOIN payments o
            ON o.order_id = p.id
        WHERE p.order_number = '$id'")->result();
        $tol = (array) $tol[0];
        date_default_timezone_set('Asia/Jakarta');
        $adminstatus = ($statnotif != null && $statnotif == 2) ? 2 : 3;
        $newid = $this->db->query("SELECT id FROM notifikasi order by id desc limit 1")->row()->id;
        if ($statnotif != null) {
            $this->db->where('no_order', $id)->update('notifikasi', array('status' => $statnotif, 'id' => $newid + 1, 'is_read' => 0, 'tanggal' => date('Y-m-d H:i:s')));
        }
        if ($statnotif == 2 && $statnotif != null) {
            $this->db->insert('notifikasi_admin', [
                'user_id' => $tol['user_id'],
                'no_order' => $id,
                'tanggal' => date('Y-m-d H:i:s'),
                'status' => $adminstatus,
                'is_read' => 0,
            ]);
        }
        $this->db->where('order_id', $tol['order_id'])->update('payments', array('payment_status' => $stat));
        $this->db->where('id', $tol['order_id'])->update('orders', array('order_status' => $status));
        return $tol;
    }

    public function is_coupon_exist($code)
    {
        return ($this->db->where('code', $code)->get('coupons')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function is_coupon_active($code)
    {
        return ($this->db->where('code', $code)->get('coupons')->row()->is_active == 1) ? TRUE : FALSE;
    }

    public function is_coupon_expired($code)
    {
        $data = $this->db->where('code', $code)->get('coupons')->row();
        $expired_at = $data->expired_date;

        return (strtotime($expired_at) > time()) ? FALSE : TRUE;
    }

    public function get_coupon_credit($code)
    {
        $data = $this->db->where('code', $code)->get('coupons')->row();
        $credit = $data->credit;

        return $credit;
    }

    public function get_coupon_id($code)
    {
        $data = $this->db->where('code', $code)->get('coupons')->row();

        return $data->id;
    }

    public function save_notif($no_order, $tanggal)
    {
        $id = get_current_user_id();
        $data = array(
            'no_order' => $no_order,
            'user_id' => $id,
            'tanggal' => $tanggal,
            'status' => 1,
            'is_read' => 0
        );
        $this->db->insert('notifikasi', $data);
    }
    public function get_ongkir()
    {
        return $this->db->get('ongkir')->result();
    }
    public function get_emailcus($userid)
    {
        return $this->db->where('id', $userid)->get('users')->row()->email;
    }
}
