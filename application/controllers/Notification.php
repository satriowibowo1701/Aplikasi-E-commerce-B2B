<?php defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "\Email3.php");
class Notification extends Email3
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => get_settings('server_key'), 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
		$this->load->model('customer_model');
	}

	public function index()
	{
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result, true);

		if ($result['status_code'] = 200) {
			$data = $this->customer_model->change_status_gateway($result['order_id'], 2, 2);
			$source = json_decode($data['payment_data']);
			$email = $this->customer_model->get_emailcus($data['user_id']);
			$this->sendmail('Pembayaran Berhasil #' . $result['order_id'], $result['order_id'], $source->source->name, 2, $data['payment_id'], $email);
		} elseif ($result['status_code'] = 201) {
			$this->customer_model->change_status_gateway($result['order_id'], 0);
		} elseif ($result['status_code'] = 202) {
			$data = $this->customer_model->change_status_gateway($result['order_id'], 3, 3);
			$source = json_decode($data['payment_data']);
			$email = $this->customer_model->get_emailcus($data['user_id']);
			$this->sendmail('Orderan Dibatalkan #' . $result['order_id'], $result['order_id'], $source->source->name, 3, $data['payment_id'], $email);
		}


		//notification handler sample

		/*
		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      } 
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  } 
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  } 
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}*/
	}
}
