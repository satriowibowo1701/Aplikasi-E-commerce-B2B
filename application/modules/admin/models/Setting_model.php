<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->user_id = get_current_user_id();
    }

    public function get_profile()
    {
        $id = $this->user_id;
        $user = $this->db->where('id', $id)->get('users');

        return $user->row();
    }

    public function update_profile($data)
    {
        $id = $this->user_id;

        return $this->db->where('id', $id)->update('users', $data);
    }
    public function add_ongkir($data)
    {
        return $this->db->insert('ongkir', $data);
    }
    public function get_ongkir()
    {
        return $this->db->get('ongkir')->result();
    }
    public function update_ongkir($value)
    {
        $this->db->where('key', 'flat_ongkir')->update('settings', array('content' => $value));
        return $this->db->get_where('settings', array('key' => 'flat_ongkir'))->row()->content;
    }

    public function get_settings_logo()
    {
        return $this->db->get_where('settings', array('key' => 'store_logo'))->row()->content;
    }
    public function get_settings_slide()
    {
        return $this->db->get_where('settings', array('key' => 'slider'))->row()->content;
    }

    public function get_data_slider()
    {
        $data = $this->db->get_where('settings', array('key' => 'slider'))->row()->content;
        return json_decode($data, true);
    }
}
