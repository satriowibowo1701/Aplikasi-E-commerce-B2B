<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function count_all_orderss($status, $statpay)
    {
        if ($status == 'all' && $statpay == NULL) {
            return $this->db->get('orders')->num_rows();
        } else if ($status != 'all' && $statpay != NULL) {
            return $this->db->query("SELECT * FROM orders o inner join payments p ON p.order_id = o.id WHERE o.order_status = $status and p.payment_status = $statpay ")->num_rows();
        } else if ($status != 'all' && $statpay == NULL) {
            return $this->db->query("SELECT * FROM orders o inner join payments p ON p.order_id = o.id WHERE o.order_status = $status ")->num_rows();
        }
    }
    public function count_all_orders()
    {
        return $this->db->select('count(order_number) total_order, DAY(order_date) day')
            ->where(array('order_status' => 4))
            ->where('order_date >= DATE_SUB(CAST(NOW() AS Date ), INTERVAL 1 DAY)', "", false)
            ->or_where('payment_method', 2)
            ->where('order_status', 3)
            ->where('order_date >= DATE_SUB(CAST(NOW() AS Date ), INTERVAL 1 DAY)  GROUP BY DAY(order_date)', "", false)
            ->get('orders')->result();
    }

    public function get_all_orders($limit, $start, $status, $paystat)
    {
        if ($status == 'all') {
            $orders = $this->db->query("
            SELECT o.id, o.order_number, o.order_date, o.order_status, o.payment_method, o.total_price, o.total_items, c.name AS coupon, cu.name AS customer
            FROM orders o
            LEFT JOIN coupons c
            ON c.id = o.coupon_id
            JOIN customers cu
            ON cu.user_id = o.user_id
            ORDER BY o.order_date DESC
            LIMIT $start, $limit
            ");
        } else {
            if ($status == '2' && $paystat != null) {

                $orders = $this->db->query("
                        SELECT o.id, o.order_number, o.order_date, o.order_status, o.payment_method, o.total_price, o.total_items, c.name AS coupon, cu.name AS customer
                        FROM orders o
                        LEFT JOIN coupons c
                        ON c.id = o.coupon_id
                        JOIN customers cu
                        ON cu.user_id = o.user_id
                    INNER JOIN payments p
                    ON p.order_id = o.id
                        WHERE o.order_status = '$status' AND p.payment_status = '$paystat'
                        ORDER BY o.order_date DESC
                        LIMIT $start, $limit
                        ");
            } else {
                $orders = $this->db->query("
                SELECT o.id, o.order_number, o.order_date, o.order_status, o.payment_method, o.total_price, o.total_items, c.name AS coupon, cu.name AS customer
                FROM orders o
                LEFT JOIN coupons c
                ON c.id = o.coupon_id
                JOIN customers cu
                ON cu.user_id = o.user_id
                WHERE o.order_status = '$status'
                ORDER BY o.order_date DESC
                LIMIT $start, $limit
                ");
            }
        }
        return $orders->result();
    }

    public function latest_orders()
    {
        $orders = $this->db->query("
            SELECT o.id, o.order_number, o.order_date, o.order_status, o.payment_method, o.total_price, o.total_items, c.name AS coupon, cu.name AS customer
            FROM orders o
            LEFT JOIN coupons c
                ON c.id = o.coupon_id
            JOIN customers cu
                ON cu.user_id = o.user_id
            ORDER BY o.order_date DESC
            LIMIT 5
        ");

        return $orders->result();
    }

    public function is_order_exist($id)
    {
        return ($this->db->where('id', $id)->get('orders')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function order_data($id)
    {
        $data = $this->db->query("
            SELECT o.*, c.name, c.code, p.id as payment_id, p.payment_price, p.payment_date, p.picture_name, p.payment_status, p.confirmed_date, p.payment_data
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

    public function set_status($status, $order)
    {
        return $this->db->where('id', $order)->update('orders', array('order_status' => $status));
    }

    public function product_ordered($id)
    {
        $orders = $this->db->query("
            SELECT oi.*, o.id as order_id, o.order_number, o.order_date, c.name, p.product_unit AS unit
            FROM order_items oi
            JOIN orders o
	            ON o.id = oi.order_id
            JOIN customers c
                ON c.user_id = o.user_id
            JOIN products p
	            ON p.id = oi.product_id
            WHERE oi.product_id = '1'");

        return $orders->result();
    }

    public function order_by($id)
    {
        return $this->db->where('user_id', $id)->order_by('order_date', 'DESC')->get('orders')->result();
    }

    public function order_overview()
    {
        $overview = $this->db->query("
            SELECT MONTH(order_date) month, COUNT(order_date) sale 
            FROM orders
            WHERE  order_date >= NOW() - INTERVAL 1 YEAR  AND order_status = 4 OR  order_status = 3 AND payment_method = '2'
            GROUP BY MONTH(order_date)");

        return $overview->result();
    }
    public function status_order_overview($interval = 1)
    {
        $overview = $this->db->query("
            SELECT MONTH(order_date) month, COUNT(order_date) sale 
            FROM orders
            WHERE  MONTH(order_date) <= MONTH(NOW() -INTERVAL $interval  MONTH) AND order_status = 4 OR  order_status = 3 AND payment_method = '2' AND MONTH(order_date) <= MONTH(NOW() - INTERVAL $interval  MONTH)
            GROUP BY MONTH(order_date) ORDER BY MONTH(order_date) DESC  LIMIT 2 ");

        return $overview->result();
    }

    public function income_overview()
    {
        $data = $this->db->query("
            SELECT  MONTH(order_date) AS month, SUM(total_price) AS income
            FROM orders WHERE order_status = 4  OR order_status = 3 AND payment_method = 2
            GROUP BY MONTH(order_date)");

        return $data->result();
    }
    public function status_income_overview($interval = 1)
    {
        $data = $this->db->query("
            SELECT  MONTH(order_date) AS month, SUM(total_price) AS income
            FROM orders WHERE  MONTH(order_date) <= MONTH(NOW() - INTERVAL $interval  MONTH) AND order_status = 4  OR order_status = 3 AND payment_method = 2 AND MONTH(order_date) <= MONTH(NOW() - INTERVAL $interval  MONTH)
            GROUP BY MONTH(order_date) ORDER BY MONTH(order_date) DESC  LIMIT 2");

        return $data->result();
    }
}
