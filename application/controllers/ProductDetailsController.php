<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductDetailsController extends CI_Controller
{

	protected $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->helper('url');
		$this->load->helper('array_helper');
		$this->load->library("session");
		$this->load->library('user_agent');
		$this->load->model("Products");
		$this->load->model("Evaluates");
		$this->load->helper('fun_helper');
	}

	public function involveProduct()
	{
		$id = (int)$this->input->post('id');
		$color = (int)$this->input->post('color');
		$data = [];
		$result = false;
		$products = $this->Products->infoInvolve($id, $color);
		if ($products) {
			foreach ($products as $key => $value) {
				if ($key < 4) {
					$price_product = price_product($value['price'], $value['type_sale'], $value['sale']);
					$data[$key] = [
						'id' => $value['id'],
						'name' => $value['name'],
						'price' => number_format($value['price']),
						'type_sale' => $value['type_sale'],
						'amount' => $value['amount'],
						'image' => $value['image'],
						'hot' => $value['hot'],
						'price_product' => $price_product,
						'star' => $this->Evaluates->avg($value['id']),

					];
					$result = true;
				}
			}
		}
		echo json_encode([
			'result' => $result,
			'data' => $data
		]);
	}

	public function addProductToCart()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$image = $this->input->post('image');
		$amount = $this->input->post('amount');
		$price = $this->input->post('price');
		$check = $this->input->post('check');
		if ($id != '' && $name != '' && $image != '' && $amount != '') {
			if ($this->session->has_userdata('cart')) {
				$cart = $this->session->userdata('cart');
				$array_cart = [];
				foreach ($cart as $key => $value) {
					$val_amount = $value['amount'];
					if ($value['id'] == $id) {
						if ($check == true) {
							$amount = (string)($val_amount + $amount);
						}
					} else {
						$info_cart = [
							'id' => $value['id'],
							'name' => $value['name'],
							'image' => $value['image'],
							'amount' => $val_amount,
							'price' => $value['price'],
						];
						array_push($array_cart, $info_cart);
					}
				}
				$info_cart = [
					'id' => $id,
					'name' => $name,
					'image' => $image,
					'amount' => $amount,
					'price' => $price,
				];
				array_unshift($array_cart, $info_cart);
				$this->session->set_userdata('cart', $array_cart);
			} else {
				$cart[] = [
					'id' => $id,
					'name' => $name,
					'image' => $image,
					'amount' => $amount,
					'price' => $price,
				];
				$this->session->set_userdata('cart', $cart);
			}
		}
	}
	public function buyProduct()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$image = $this->input->post('image');
		$amount = $this->input->post('amount');
		$price = $this->input->post('price');
		$check = $this->input->post('check');
		if ($id != '' && $name != '' && $image != '' && $amount != '') {
			if ($this->session->has_userdata('cart')) {
				$cart = $this->session->userdata('cart');
				$array_cart = [];
				foreach ($cart as $key => $value) {
					$val_amount = $value['amount'];
					if ($value['id'] == $id) {
						if ($check == true) {
							$amount = (string)($val_amount + $amount);
						}
					} else {
						$info_cart = [
							'id' => $value['id'],
							'name' => $value['name'],
							'image' => $value['image'],
							'amount' => $val_amount,
							'price' => $value['price'],
						];
						array_push($array_cart, $info_cart);
					}
				}
				$info_cart = [
					'id' => $id,
					'name' => $name,
					'image' => $image,
					'amount' => $amount,
					'price' => $price,
				];
				array_unshift($array_cart, $info_cart);
				$this->session->set_userdata('cart', $array_cart);
			} else {
				$cart[] = [
					'id' => $id,
					'name' => $name,
					'image' => $image,
					'amount' => $amount,
					'price' => $price,
				];
				$this->session->set_userdata('cart', $cart);
			}
		}
	}

	public function deleteProductInCart()
	{
		$id = $this->input->post('id');
		if ($id != '') {
			if ($this->session->has_userdata('cart')) {
				$cart = $this->session->userdata('cart');
				$array_cart = [];
				foreach ($cart as $key => $value) {
					if ($value['id'] != $id) {
						$info_cart = [
							'id' => $value['id'],
							'name' => $value['name'],
							'image' => $value['image'],
							'amount' => $value['amount'],
							'price' => $value['price'],
						];
						array_push($array_cart, $info_cart);
					}
				}
				$this->session->set_userdata('cart', $array_cart);
			}
		}
	}

	public function infoProductInCart()
	{
		$result = false;
		$cart = [];
		if ($this->session->has_userdata('cart')) {
			$cart = $this->session->userdata('cart');
			$result = true;
		}
		echo json_encode([
			'result' => $result,
			'data' => $cart
		]);
	}
	public function create_evaluate()
	{
		$id = $this->input->post('id');
		$user_id = $this->session->userdata('user')['id'];
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$star = $this->input->post('star');
		$content = nl2br($this->input->post('evaluate'));
		$result = false;
		$message = 'Đánh giá không thành công';
		$arr_filename = [];
		if ($email != '' && $name != '' && $star != '' && $content != '' && $id != '') {
			if (isset($_FILES['uploadimg']) && $_FILES['uploadimg']['name'][0] != '') {
				$countfiles = count($_FILES['uploadimg']['name']);
				for ($i = 0; $i < $countfiles; $i++) {
					if (!empty($_FILES['uploadimg']['name'][$i])) {
						$_FILES['file']['name'] = $_FILES['uploadimg']['name'][$i];
						$_FILES['file']['type'] = $_FILES['uploadimg']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['uploadimg']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['uploadimg']['error'][$i];
						$_FILES['file']['size'] = $_FILES['uploadimg']['size'][$i];

						$config['allowed_types'] = 'png|jpg|jpeg';
						$config['upload_path'] = './assets/images/evaluate/';
						$config['file_name'] = $_FILES['uploadimg']['name'][$i];
						$config['encrypt_name'] = TRUE;

						$this->load->library('upload', $config);
						if ($this->upload->do_upload('file')) {
							$uploadData = $this->upload->data();
							$filename = $uploadData['file_name'];
							array_push($arr_filename, $filename);
						}
					}
				}
				$data = [
					'product_id' => $id,
					'email' => $email,
					'name_eva' => $name,
					'star' => $star,
					'content' => $content,
					'image' => implode(',', $arr_filename),
					'user_id' => $user_id,
					'created_at' => time(),
				];
				$this->Evaluates->insert($data);
				$result = true;
				$message = 'Cảm ơn bạn đá đánh giá sản phẩm của chúng tôi';
			} else {
				$data['image'] = '';
			}
		}
		echo json_encode([
			'result' => $result,
			'message' => $message,
		]);
	}
	public function pagination()
	{
		$result = false;
		$message = 'Không có dữ liệu';
		$id = $this->input->post('id');
		$select = $this->Evaluates->select($id);
		$countData = count($select);
		if ($countData > 0) {
			$data = $select;
			$result = true;
			$message = 'Có dữ liệu';
		}

		echo json_encode([
			'result' => $result,
			'message' => $message,
			'data' => $data,
		]);
	}

	public function get_list_evaluate(){
		$product_id = $this->input->post('product_id');
		$list_eva=$this->data['eva'] = $this->Evaluates->select($product_id);
		die(json_encode($list_eva));
	}
}
