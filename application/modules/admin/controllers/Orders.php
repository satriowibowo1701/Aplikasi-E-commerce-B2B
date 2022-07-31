<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->model(array(
            'order_model' => 'order',
            'payment_model' => 'payment'
        ));
    }

    public function index()
    {
        $status =  ($this->uri->segment(4) == 'status') ?  $this->uri->segment(5) : 'all';
        $paystat = $this->uri->segment(6);
        $params['title'] = 'Kelola Order';
        $params['total_notif'] = $this->payment->countnotif();
        $params['notif'] = $this->payment->notifikasi();
        $params['linkdata'] = $this->payment->linknotif();
        $paystat1 = $this->uri->segment(7);
        if ($status == 'all') {
            $config['base_url'] = site_url('admin/orders/index');
            $config['uri_segment'] = 4;
            $params['status'] = 'Semua Orderan';
        } else if ($this->uri->segment(4) == 'status' && $paystat != 'paystat') {
            $config['base_url'] = site_url('admin/orders/index/status/' . $status);
            $config['uri_segment'] = 6;
            $params['status'] = 'Dibatalkan';
        } else if ($this->uri->segment(4) == 'status' && $paystat == 'paystat') {
            if ($this->uri->segment(7)) {
                $config['base_url'] = site_url('admin/orders/index/status/' . $status . '/paystat/' . $this->uri->segment(7));
                $params['status'] = ($this->uri->segment(7) == '2') ? 'Perlu DiProses' : 'Menunggu Konfirmasi';
            }
            $config['uri_segment'] = 8;
        }

        $config['total_rows'] = $this->order->count_all_orderss($status, $paystat1);
        $config['per_page'] = 10;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);
        $config['first_link']       = '«';
        $config['last_link']        = '»';
        $config['next_link']        = '›';
        $config['prev_link']        = '‹';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->load->library('pagination', $config);
        if ($status == 'all') {
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        } else if ($this->uri->segment(4) == 'status' && $status != 'all') {
            $page = ($this->uri->segment(6) != 'paystat' and $this->uri->segment(6) != NULL) ? $this->uri->segment(6) : 0;
        } else if ($this->uri->segment(4) == 'status' && $paystat == 'paystat' && $status != 'all') {
            $page = ($this->uri->segment(8) != NULL) ? $this->uri->segment(8) : 0;
        }

        $orders['orders'] = $this->order->get_all_orders($config['per_page'], $page, $status, $paystat1);
        $orders['pagination'] = $this->pagination->create_links();

        $this->load->view('header', $params);
        $this->load->view('orders/orders', $orders);
        $this->load->view('footer');
    }

    public function view($id = 0)
    {
        if ($this->order->is_order_exist($id)) {
            $data = $this->order->order_data($id);
            if ($this->uri->segment(5) == 'read') {
                $this->payment->readnotif($data->order_number);
            }
            $items = $this->order->order_items($id);
            $banks = json_decode(get_settings('payment_banks'));
            $banks = (array) $banks;

            $params['title'] = 'Order #' . $data->order_number;
            $params['total_notif'] = $this->payment->countnotif();
            $params['notif'] = $this->payment->notifikasi();
            $params['linkdata'] = $this->payment->linknotif();
            $order['data'] = $data;
            $order['items'] = $items;
            $order['delivery_data'] = json_decode($data->delivery_data);
            $order['banks'] = $banks;
            $order['order_flash'] = $this->session->flashdata('order_flash');
            $order['payment_flash'] = $this->session->flashdata('payment_flash');

            $this->load->view('header', $params);
            $this->load->view('orders/view', $order);
            $this->load->view('footer');
        } else {
            show_404();
        }
    }

    public function status()
    {
        $status = $this->input->post('status');
        $order = $this->input->post('order');

        $this->order->set_status($status, $order);
        $this->session->set_flashdata('order_flash', 'Status berhasil diperbarui');

        redirect('admin/orders/view/' . $order);
    }
}
