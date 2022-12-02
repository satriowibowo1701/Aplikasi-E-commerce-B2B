<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Review_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function count_all_reviews()
    {
        return $this->db->get('reviews')->num_rows();
    }

    public function get_all_reviews()
    {
        $reviews = $this->db->query("
            SELECT r.*, o.order_number, c.*
            FROM reviews r
            JOIN orders o
                ON o.id = r.order_id
            JOIN customers c
                ON c.user_id = r.user_id
        ");

        return $reviews->result();
    }

    public function get_all_reviewss($id)
    {
        $reviews = $this->db->query("
            SELECT r.*, c.*
            FROM reviews r
            JOIN customers c
                ON c.user_id = r.user_id
                Join order_items oi
                ON r.order_id = oi.order_id
                Join products p
                ON oi.product_id = p.id
                WHERE p.id = '$id'
                
        ");

        return $reviews->result();
    }


    public function is_review_exist($id)
    {
        return ($this->db->where('id', $id)->get('reviews')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function review_data($id)
    {
        $review = $this->db->query("
            SELECT r.*, o.order_number
            FROM reviews r
            JOIN orders o
                ON o.id = r.order_id
            WHERE r.id = '$id'
        ");

        return $review->row();
    }
    public function notifikasi(array $data)
    {
        $this->db->insert('', $data);
    }
}
