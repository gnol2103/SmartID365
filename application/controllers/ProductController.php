<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductController extends CI_Controller
{

	protected $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('array_helper');
		$this->load->library("session");
		$this->load->model("Products");
		$this->load->model("Evaluates");
		$this->load->helper('fun_helper');
	}

	public function infoProduct()
	{
		$data = [];
		$result = false;
		$page=$this->input->get('page');
		$row_per_page=6;		
		$products = $this->Products->info_limit($row_per_page,$row_per_page*($page-1));
		$product_all=$this->Products->info();
		$end=false;
		if($page*$row_per_page>=count($product_all)){
			$end=true;
		}
		if ($products) {
			foreach ($products as $key => $value) {
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
					'url' => rewrire_product($value['alias'], $value['id']),
					'star' => $this->Evaluates->avg($value['id']),
				];
				$result = true;
			}
		}
		echo json_encode([
			'result' => $result,
			'data' => $data,
			'end'=>$end
		]);

	}
}
