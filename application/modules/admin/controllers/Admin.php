<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->model(array(
            'product_model' => 'product',
            'customer_model' => 'customer',
            'order_model' => 'order',
            'payment_model' => 'payment'
        ));
    }

    public function index()
    {
        $params['title'] = 'Admin ' . get_store_name();
        $params['total_notif'] = $this->payment->countnotif();
        $params['notif'] = $this->payment->notifikasi();
        $params['linkdata'] = $this->payment->linknotif();
        $overview['total_products'] = $this->product->count_all_products();
        $overview['total_customers'] = $this->customer->count_all_customers();
        $overview['total_order'] = $this->order->count_all_orders();

        $overview['total_income'] = $this->payment->sum_success_payment();

        if ($overview['total_order'] == null) {
            array_push($overview['total_order'], (object)['day' => date('d', time() - 86400), 'total_order' => '0', 'status' => '2hari']);
            array_push($overview['total_order'], (object)['day' => date('d'), 'total_order' => '0', 'status' => '1hari']);
        }
        if ($overview['total_income'] == null) {
            array_push($overview['total_income'], (object)['day' => date('d', time() - 86400), 'total_payment' => '0', 'status' => '2hari']);
            array_push($overview['total_income'], (object)['day' => date('d'), 'total_payment' => '0', 'status' => '1hari']);
        }
        if (count($overview['total_income']) == 1) {
            foreach ($overview['total_income'] as $income) {
                if (!in_array($income->day, array(date('d', time() - 86400)))) {
                    array_push($overview['total_income'], (object)array('day' => date('d', time() - 86400), 'total_payment' => 0, 'status' => '2hari'));
                }
                if (!in_array($income->day, array(date('d')))) {
                    array_push($overview['total_income'], (object)array('day' => date('d'), 'total_payment' => 0, 'status' => '1hari'));
                }
            }
        }
        if (count($overview['total_order']) == 1) {
            foreach ($overview['total_order'] as $income) {
                if (!in_array($income->day, array(date('d', time() - 86400)))) {
                    array_push($overview['total_order'], (object)array('day' => date('d', time() - 86400), 'total_order' => 0, 'status' => '2hari'));
                }
                if (!in_array($income->day, array(date('d')))) {
                    array_push($overview['total_order'], (object)array('day' => date('d'), 'total_order' => 0, 'status' => '1hari'));
                }
            }
        }






        $overview['products'] = $this->product->latest();
        $overview['categories'] = $this->product->latest_categories();
        $overview['payments'] = $this->payment->payment_overview();
        $overview['orders'] = $this->order->latest_orders();
        $overview['customers'] = $this->customer->latest_customers();

        $overview['order_overviews'] = $this->order->order_overview();
        $overview['status_overviews'] = $this->order->status_order_overview();;
        $overview['income_overviews'] = $this->order->income_overview();
        $overview['status_income_overviews'] = $this->order->status_income_overview();

        $i = 1;
        while (count($overview['status_overviews']) < 2 || count($overview['status_income_overviews']) < 2) {
            if ($i == 14) {
                break;
            }
            $i++;
            $overview['status_overviews'] = $this->order->status_order_overview($i);
            $overview['status_income_overviews'] = $this->order->status_income_overview($i);
        }



        $overview['status_order'] = get_persen($overview['status_overviews'][1]->sale, $overview['status_overviews'][0]->sale);
        $overview['status_income'] = get_income($overview['status_income_overviews'][1]->income, $overview['status_income_overviews'][0]->income);

        $this->load->view('header', $params);
        $this->load->view('overview', $overview);
        $this->load->view('footer');
    }

    public function tulis()
    {
        echo "oke";
    }
    public function tables()
    {
        $params['title'] = 'Admin ' . get_store_name();
        $params['total_notif'] = $this->payment->countnotif();
        $params['notif'] = $this->payment->notifikasi();
        $params['linkdata'] = $this->payment->linknotif();
        $this->load->view('header', $params);
        $this->load->view('tables');
        $this->load->view('footer');
    }
}
