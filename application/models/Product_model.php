<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_products()
    {
        return $this->db->order_by('id', 'DESC')->get('products', 8)->result();
    }

    public function best_deal_product()
    {
        $data = $this->db->where('is_available', 1)
            ->order_by('current_discount', 'DESC')
            ->limit(1)
            ->get('products')
            ->row();

        return $data;
    }

    public function is_product_exist($id, $sku)
    {
        return ($this->db->where(array('id' => $id, 'sku' => $sku))->get('products')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function product_data($id)
    {
        $data = $this->db->query("
            SELECT p.*, pc.name as category_name
            FROM products p
            JOIN product_category pc
                ON pc.id = p.category_id
            WHERE p.id = '$id'
        ")->row();

        return $data;
    }

    public function related_products($current, $category)
    {
        return $this->db->where(array('id !=' => $current, 'category_id' => $category))->limit(4)->get('products')->result();
    }

    public function create_order(array $data)
    {
        $this->db->insert('orders', $data);

        return $this->db->insert_id();
    }

    public function create_order_items($data)
    {
        return $this->db->insert_batch('order_items', $data);
    }
    public function register_payment(array $data)
    {
        $this->db->insert('payments', $data);
    }
    public function product_recomended()
    {
        $query = "select p.* From orders o join order_items oi on o.id = oi.order_id join products p on oi.product_id = p.id WHERE o.order_status=4 AND (o.payment_method=1 OR o.payment_method=3) OR o.payment_method = 2 AND o.order_status = 3 group by p.name order by count(oi.order_qty) Desc LIMIT 8";
        return $this->db->query($query)->result();
    }
    public function get_kategori()
    {
        return $this->db->get('product_category')->result();
    }
    public function get_produk_by_kategori($id)
    {
        return $this->db->where('category_id', $id)->get('products')->result();
    }
    public function search_product($keyword, $id)
    {
        if ($id != 'all') {
            if ($keyword != '') {
                return $this->db->where('category_id', $id)->like('name', $keyword)
                    ->get('products')->result();
            } else {
                return $this->db->where('category_id', $id)->get('products')->result();
            }
        } else {
            return $this->db->like('name', $keyword)
                ->or_like('description', $keyword)
                ->or_like('sku', $keyword)
                ->or_like('price', $keyword)
                ->or_like('current_discount', $keyword)
                ->get('products')->result();
        }
    }
    public function get_alll_products()
    {
        return $this->db->order_by('id', 'DESC')->get('products')->result();
    }
    public function get_data_slider()
    {
        $data = $this->db->get_where('settings', array('key' => 'slider'))->row()->content;
        return json_decode($data, true);
    }
    public function check_kupon($id)
    {
        return $this->db->query("SELECT count(o.coupon_id) as jumlah FROM users u JOIN orders o on u.id=o.user_id WHERE u.id='$id' ")->row()->jumlah;
    }
}
