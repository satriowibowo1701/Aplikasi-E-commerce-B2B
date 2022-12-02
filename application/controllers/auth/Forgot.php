<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/ResetEmail.php");

class Forgot extends ResetEmail

{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'customer_model' => 'customer',
        ));
    }


    public function index()
    {
        $this->load->view('auth/forgot');
    }

    public function kirim()
    {
        $email = $this->input->post('email');
        $token = rand();
        $existuser = $this->customer->checkuser($email);
        if ($existuser > 0) {
            $data = array(
                'email' => $email,
                'token' => $token,
            );
            $this->customer->reset_insert($data);
            $this->send($email, $token);
            $this->session->set_flashdata('success', 'Silahkan cek email anda');
            redirect('auth/forgot');
        } else {
            $this->session->set_flashdata('error', 'Email tidak terdaftar');
            redirect('auth/forgot');
        }
    }

    public function reset($token = null)
    {
        if ($token != null) {
            $check = $this->customer->checktoken($token);
            if ($check > 0) {
                $data['token'] = $token;
                $data['email'] = $this->customer->take_email($token);
                $this->load->view('auth/reset', $data);
            } else {
                show_404();
                die;
            }
        } else {
            show_404();
            die;
        }
    }

    public function do_update()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $rpassword = $this->input->post('rpassword');
        $token = $this->input->post('token');


        if ($password != $rpassword) {
            $this->session->set_flashdata('error', 'Password tidak sama');
            redirect('auth/forgot');
            die;
        }
        $newpassword = password_hash($password, PASSWORD_BCRYPT);
        $res = $this->customer->update_reset($email, $newpassword, $token);
        if ($res) {
            $this->session->set_flashdata('success1', 'Password berhasil diubah Silahkan Login');
            redirect('auth/login');
        }
    }
}
