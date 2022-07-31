<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "\Email1.php");

class Snap extends Email1
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
		$params = array('server_key' => 'SB-Mid-server-SncqFmlAhQF1Or6Wd8rsoLuw', 'production' => false);
		$this->load->library('midtrans');

		$this->midtrans->config($params);
		$this->load->library('cart');
		$this->load->helper('url');
		$this->load->model(array(
			'product_model' => 'product',
			'customer_model' => 'customer'
		));
	}

	public function index()
	{
		get_template_part('midtrans/checkout_snap');
	}

	public function token()
	{

		$id = $this->input->post('orderid');
		$data = $this->input->post('data');
		$total =  $this->input->post('total');
		$data2 =  $this->customer->data();
		$data1 = $this->customer->cus();

		// Required
		$transaction_details = array(
			'order_id' => $id,
			'gross_amount' => $total, // no decimal allowed for creditcard
		);

		// Optional
		$total = array();
		foreach ($data as $key) {
			array_push(
				$total,
				array(
					'name' => $key['nama'],
					'price' => $key['price'],
					'quantity' => $key['qty'],
				)
			);
		}
		$item_details = array();
		$id = 1;
		foreach ($total as $key) {
			array_push(
				$item_details,
				array(
					'price' => $key['price'],
					'quantity' => $key['quantity'],
					'name' => $key['name'],
				)
			);
			$id++;
		}
		$ongkir  = array(
			'price' => $this->input->post('ongkir'),
			'quantity' => 1,
			'name' => 'Ongkir'
		);
		array_push($item_details, $ongkir);
		// Optional

		// Optional
		$billing_address = array(
			'first_name'    => $data2->name,
			'address'       => $data2->address,
			'phone'         => $data2->phone_number,
			'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
			'first_name'    => $data2->name,
			'address'       => $data2->address,
			'phone'         => $data2->phone_number,
			'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
			'first_name'    => $data2->name,
			'email'         => $data1->email,
			'phone'         => $data2->phone_number,
			'billing_address'  => $billing_address,
			'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'hour',
			'duration'  => 4
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function _create_order_number($quantity, $user_id, $coupon_id)
	{
		$this->load->helper('string');

		$alpha = strtoupper(random_string('alpha', 3));
		$num = random_string('numeric', 3);
		$count_qty = count($quantity);


		$number = $alpha . date('j') . date('n') . date('y') . $count_qty . $user_id . $coupon_id . $num;
		//Random 3 letter . Date . Month . Year . Quantity . User ID . Coupon Used . Numeric

		return $number;
	}


	public function finish()
	{

		$result = json_decode($this->input->post('result_data'), true);


		if ($result['status_code'] == 504) {
			redirect(site_url('shop/checkout'));
			die;
		}
		$bank = (($result['va_numbers'][0]['bank']) ? strtoupper($result['va_numbers'][0]['bank']) : (($result['payment_type'] == 'echannel' && $result['biller_code']) ? 'MANDIRI' : ((($result['payment_type'] == 'cstore' && $result['payment_code']) && (!$result['fraud_status'])) ? 'INDOMARET' : ((($result['payment_type'] == 'cstore' && $result['payment_code']) && $result['fraud_status']) ? 'ALFAMART' : 'PERMATA BANK'))));
		$va = ($result['bill_key'] or $result['permata_va_number']) ? ($result['bill_key'] ? $result['bill_key'] : $result['permata_va_number']) : ((($result['payment_code'] && $result['payment_type'] == 'cstore') && (!$result['fraud_status'])) ? $result['payment_code'] : ((($result['payment_type'] == 'cstore' && $result['payment_code']) && $result['fraud_status']) ? $result['payment_code'] : $result['va_numbers'][0]['va_number']));
		if ($this->session->userdata('_temp_quantity') || $this->session->userdata('_temp_coupon')) {
			$this->session->unset_userdata('_temp_coupon');
			$this->session->unset_userdata('_temp_quantity');
		}
		$payment = $this->input->post('payment');
		if ($payment == NULL && $payment != 3) {
			$this->session->set_flashdata('error', 'Pilih metode pembayaran!');
			redirect('shop/checkout');
			die;
		}
		$quantity = $this->session->userdata('order_quantity');

		$user_id = get_current_user_id();
		$coupon_id = $this->session->userdata('coupon_id');
		$order_number = $this->input->post('orderid');
		if ($order_number) {
			$order_number = $order_number;
		} else {
			$order_number = $this->_create_order_number($quantity, $user_id, $coupon_id);
		}
		date_default_timezone_set("Asia/Bangkok");
		$order_date = date('Y-m-d H:i:s');
		$total_price = $this->session->userdata('total_price');
		$total_items = count($quantity);
		$name = $this->input->post('name');
		$this->customer->save_notif($order_number, $order_date);
		$phone_number = $this->input->post('phone_number');
		$address = $this->input->post('address');
		$note = $this->input->post('note');
		$delivery_data = array(
			'customer' => array(
				'name' => $name,
				'phone_number' => $phone_number,
				'address' => $address
			),
			'tipe_payment' => strtoupper(preg_replace('/[^a-zA-Z]/', ' ', $result['payment_type'])),
			'waktu_transaksi' => $result['transaction_time'],
			'bank' => $bank,
			'va_number' => $va,
			'pdf_url' => $result['pdf_url'],
			'status_code' => $result['status_code'],
			'note' => $note,
		);
		$delivery_data = json_encode($delivery_data);
		if ($result['transaction_status'] == 'settlement') {
			$status = 2;
		} elseif ($result['transaction_status'] == 'pending') {
			$status = 1;
		} else {
			$status = 5;
		}
		$order = array(
			'user_id' => $user_id,
			'coupon_id' => $coupon_id,
			'order_number' => $order_number,
			'order_status' => $status,
			'order_date' => $order_date,
			'total_price' => $total_price,
			'total_items' => $total_items,
			'payment_method' => 3,
			'delivery_data' => $delivery_data

		);

		$order = $this->product->create_order($order);
		$this->email('Tagihan #' . $order_number, $order_number, $total_price, base_url() . 'customer/orders/view/' . $order, $delivery_data);
		$n = 0;
		foreach ($quantity as $id => $data) {
			$items[$n]['order_id'] = $order;
			$items[$n]['product_id'] = $id;
			$items[$n]['order_qty'] = $data['qty'];
			$items[$n]['order_price'] = $data['price'];

			$n++;
		}
		///register
		$data4 = array(
			'transfer_to' => $bank,
			'source' => array(
				'bank' => $bank,
				'name' => $name,
				'number' => $va,
			)
		);
		$data5 = json_encode($data4);
		$idw = $this->db->query("SELECT id FROM orders ORDER BY id DESC LIMIT 1")->row();
		$stat = ($result['status_code'] == 200) ? 2 : (($result['status_code'] == 201) ? 0 : 3);
		$payment = array(
			'order_id' => $idw->id,
			'payment_price' => $total_price,
			'payment_date' => date('Y-m-d H:i:s'),
			'picture_name' => NULL,
			'payment_status' => $stat,
			'payment_data' => $data5
		);
		$this->product->register_payment($payment);
		$this->product->create_order_items($items);
		$this->cart->destroy();
		$this->session->unset_userdata('order_quantity');
		$this->session->unset_userdata('total_price');
		$this->session->unset_userdata('coupon_id');

		$this->session->set_flashdata('order_flash', 'Order berhasil ditambahkan');

		redirect('customer/orders/view/' . $order);
	}
}
