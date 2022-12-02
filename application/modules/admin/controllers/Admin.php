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
        $overview['barang_laku'] = $this->order->barang_laku();
        $warna = ['red', 'yellow', 'green', 'blue', 'purple', 'orange', 'brown', 'pink', 'black', 'grey', 'white'];
        $newwarna = [];
        $id = 0;
        foreach ($overview['barang_laku'] as $key) {
            array_push($newwarna, $warna[$id]);
            $id++;
        }
        $overview['warna'] = $newwarna;
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


        if ($overview['status_overviews'] != NULL) {
            $overview['status_order'] = get_persen($overview['status_overviews'][1]->sale, $overview['status_overviews'][0]->sale);
        }
        if ($overview['status_income_overviews'] != NULL) {
            $overview['status_income'] = get_income($overview['status_income_overviews'][1]->income, $overview['status_income_overviews'][0]->income);
        }

        $this->load->view('header', $params);
        $this->load->view('overview', $overview);
        $this->load->view('footer');
    }

    public function change_bulan()
    {
        $bulan = $this->input->post('bulan');
        $data = $this->order->barang_laku($bulan);
        $warna = ['red', 'yellow', 'green', 'blue', 'purple', 'orange', 'brown', 'pink', 'black', 'grey', 'white'];
        $newwarna = [];
        $id = 0;
        $namabrg = [];
        $total = [];

        foreach ($data as $key) {
            array_push($namabrg, $key->nama_brg);
            array_push($total, $key->jumlah);
            array_push($newwarna, $warna[$id]);
            $id++;
        }


        $respons = array(
            'namabrg' => $namabrg,
            'total' => $total,
            'warna' => $newwarna
        );
        echo json_encode($respons);
    }

    public function change_kategori()
    {
        $bulan = $this->input->post('bulan');
        $data = $this->order->kategori_laku($bulan);
        $warna = ['red', 'yellow', 'green', 'blue', 'purple', 'orange', 'brown', 'pink', 'black', 'grey', 'white'];
        $newwarna = [];
        $id = 0;
        $namabrg = [];
        $total = [];

        foreach ($data as $key) {
            array_push($namabrg, $key->nama_ktgr);
            array_push($total, $key->jumlah);
            array_push($newwarna, $warna[$id]);
            $id++;
        }


        $respons = array(
            'namaktgr' => $namabrg,
            'total' => $total,
            'warna' => $newwarna
        );
        echo json_encode($respons);
    }
    public function tables()
    {
        $data['datatable'] = $this->order->startdate();
        $params['title'] = 'Admin ' . get_store_name();
        $params['total_notif'] = $this->payment->countnotif();
        $params['notif'] = $this->payment->notifikasi();
        $params['linkdata'] = $this->payment->linknotif();
        $this->load->view('header', $params);
        $this->load->view('tables', $data);
        $this->load->view('footer');
    }

    public function change_table()
    {
        $list = $this->order->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $id = 1;
        foreach ($list as $dataorder) {
            $no++;
            $row = array();
            $row[] = $id++;
            $row[] = $dataorder->ordernum;
            $row[] = $dataorder->pelanggan;
            $row[] = $dataorder->tanggal;
            $row[] = $dataorder->totalitem;
            $row[] = $dataorder->totalharga;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->order->count_all(),
            "recordsFiltered" => $this->order->count_filtered(),
            "data" => $data,
        );

        //output to json format
        echo json_encode($output);
    }
}
