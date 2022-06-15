<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	protected $data;
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('array_helper');
		$this->load->library("session");
        $this->load->model("Products");
        $this->load->helper('fun_helper');
    }

	public function add_product()
	{
        $name = $this->input->post('name');
        $alias = vn_str_filter($name);
        $color = $this->input->post('color');
        $amount = $this->input->post('amount');
        $price = $this->input->post('price');
        $image = $this->input->post('image');
        $introduce = nl2br($this->input->post('introduce'));
        $description = nl2br($this->input->post('description'));
        $type_sale = (int)$this->input->post('type_sale');
        $sale = $this->input->post('sale');
        $hot = (int)$this->input->post('hot');
        $result = false;
        $message ="Thêm sản phẩm không thành công";
        if($name != "" && $color != "" && $amount != "" && $price != "" && $introduce != "" && $description != "" )  {  
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['upload_path'] = './assets/product_image/';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $fd = $this->upload->data();
                $fn = $fd['file_name']; 
                $data = [
                    'name' => $name,
                    'color' => $color,
                    'amount' => $amount,
                    'price' => $price,
                    'image' => $fn, 
                    'introduce' => $introduce,
                    'description' => $description,
                    'created_at' => time(),
                    'alias' => $alias,
                ];
                if ($hot != 0) {
                    $data['hot'] = 1;
                }
                if ($type_sale != 0 && $sale != '') {
                    $data['type_sale'] = $type_sale;
                    $data['sale'] = $sale;
                }
                $this->Products->insert($data);
                $result = true;
                $message ="Thêm sản phẩm thành công";
            }
        }
        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);
	}
    public function edit_product()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $color = $this->input->post('color');
        $amount = $this->input->post('amount');
        $price = $this->input->post('price');
        $image = $this->input->post('image');
        $introduce = nl2br($this->input->post('introduce'));
        $description = nl2br($this->input->post('description'));
        $type_sale = (int)$this->input->post('type_sale');
        $sale = $this->input->post('sale');
        $hot = (int)$this->input->post('hot');
        $result = false;
        $message ="Chỉnh sửa sản phẩm không thành công";
        $info_pro = $this->Products->select($id);
        $image = $info_pro['image'];
        if($image !== '') {
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['upload_path'] = './assets/product_image/';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $fd = $this->upload->data();
                $image = $fd['file_name']; 
            }
        } 
        $data = [
            'name' => $name,
            'color' => $color,
            'amount' => $amount,
            'image' => $image,
            'price' => $price,
            'introduce' => $introduce,
            'description' => $description,
            'updated_at' => time(),
        ];
        if ($hot != 0) {
            $data['hot'] = 1;
        } else {
            $data['hot'] = 0;
        }
        if ($type_sale != 0 && $sale != '') {
            $data['type_sale'] = $type_sale;
            $data['sale'] = $sale;
        } else {
            $data['type_sale'] = 0;
            $data['sale'] = 0;
        }
        if($name != "" && $color != "" && $amount != "" && $price != "" && $introduce != "" && $description != "" )  {  
            $this->Products->update($data,$id);
            $result = true;
            $message ="Chỉnh sửa sản phẩm thành công";
        }
        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);
    }
	
}
