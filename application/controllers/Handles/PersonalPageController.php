<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PersonalPageController extends CI_Controller
{

    protected $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array_helper');
        $this->load->helper('fun_helper');
        $this->load->library("session");
        $this->load->model('Users');
        $this->load->model('User_details');
        $this->load->model('CartLink');
        $this->load->model('Contact');
    }
    public function edit_personal_page()
    {
        //lấy dữ liệu
        $session = $this->session->userdata('user');
        $id = $session['id'];
        $fullname = $this->input->post('full_name');
        $dateBirth = $this->input->post('date_birth');
        $dateBirth = ($dateBirth != "") ? strtotime($dateBirth) : 0;
        $today = time();
        $company = $this->input->post('company');
        $position = $this->input->post('position');
        $descrip = nl2br($this->input->post('descrip'));
        $result = false;
        $message = "Chỉnh sửa thông tin thất bại";
        $data = [
            'full_name' => $fullname,
            'date_birth' => $dateBirth,
            'company' => $company,
            'position' => $position,
            'descrip' => $descrip,
            'updated_at' => time(),
        ];
        if ($dateBirth < $today) {
            // if ($fullname != '' && $dateBirth != '' && $company != '' && $position != '') {
            $this->Users->update($data, $id);
            $result = true;
            $message = "Chỉnh sửa thông tin thành công";
            // }
        }

        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);
    }
    public function edit_user_name()
    {
        $username = $this->input->post('user_name');
        $session = $this->session->userdata('user');
        $id = $session['id'];
        $result = false;
        $message = "Chỉnh sửa thông tin thất bại";
        $data = [
            'user_name' => $username,
        ];
        if (!empty($username)) {
            $this->Users->update($data, $id);
            $result = true;
            $message = "Chỉnh sửa thông tin thành công";
        }

        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);
    }
    public function upload_avata()
    {
        $avata = $this->input->post('avata');
        $avata = $_FILES['avata'];
        $session = $this->session->userdata('user');
        $id = $session['id'];
        $result = false;
        $message = "Cập nhật avatar thất bại";

        if ($avata != '') {
            if (isset($_FILES['avata']) && $_FILES['avata']['name'][0] != '') {
                $config['upload_path'] = './assets/avata_user/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = $_FILES['avata']['name'];
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('avata')) {
                    $uploadData = $this->upload->data();
                    $avata = $uploadData['file_name'];
                    $data = [
                        'avatar' => $avata,
                        'updated_at' => time(),
                    ];
                    $this->Users->updateAvata($data, $id);
                    $result = true;
                    $message = "Cập nhật avatar thành công";
                } else {
                    $data['avata'] = '';
                }
            } else {
                $data['avata'] = '';
            }
            echo json_encode([
                'result' => $result,
                'message' => $message
            ]);
        }
    }
    public function upload_cover()
    {
        $cover = $this->input->post('cover');
        $cover = $_FILES['cover'];
        $session = $this->session->userdata('user');
        $id = $session['id'];
        $result = false;
        $message = "Cập nhật ảnh bìa thất bại";

        if ($cover != '') {
            if (isset($_FILES['cover']) && $_FILES['cover']['name'][0] != '') {
                $config['upload_path'] = './assets/cover_user/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = $_FILES['cover']['name'];
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('cover')) {
                    $uploadData = $this->upload->data();
                    $cover = $uploadData['file_name'];
                    $data = [
                        'cover' => $cover,
                        'updated_at' => time(),
                    ];
                    $this->Users->updateCover($data, $id);
                    $result = true;
                    $message = "Cập nhật ảnh bìa thành công";
                } else {
                    $data['cover'] = '';
                }
            } else {
                $data['cover'] = '';
            }
            echo json_encode([
                'result' => $result,
                'message' => $message
            ]);
        }
    }
    public function create_user_details()
    {
        $user_detail=$this->input->post('user_detail');
		$user_detail=json_decode($user_detail);
        $session = $this->session->userdata('user');
        $id = $session['id'];
        $result = false;
        $message = "Thêm thông tin thất bại";
        if (!empty($user_detail)) {
            foreach ($user_detail as $detail) {
                $data = [
                    'user_id' => $id,
                    'title' => $detail->title,
                    'content' => $detail->content,
                    'created_at' => time(),
                    'updated_at' => time()
                ];
                $this->User_details->insert($data);
            }
            $result = true;
            $message = "Thêm thông tin thành công";
        }
        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);
    }
    public function update_user_details()
    {
		$user_detail=$this->input->post('user_detail');
		$user_detail=json_decode($user_detail);
        $result = false;
        $message = "Chỉnh sửa thông tin thất bại";
		if(!empty($user_detail)){
			foreach($user_detail as $detail){
				$data = [
                    'title' => $detail->title,
                    'content' => $detail->content,
                    'updated_at' => time(),
                ];
				$this->User_details->update($data, $detail->id);
			}
			$result = true;
            $message = "Chỉnh sửa thông tin thành công";
		}
        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);
    }
    public function delete_user_details()
    {
        $id = $this->input->post('id');
        $result = false;
        $message = "Xoá thông tin thất bại";
        if ($id != '') {
            foreach($id as $key){
                $this->User_details->delete($key);
                $result = true;
                $message = "Xoá thông tin thành công";
            }
        }
        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);
    }
    public function the()
    {
        $the = $this->input->post('the');
        $id = $this->session->userdata('user')['id'];
        $result = false;
        $message = 'Thêm thẻ thất bại';
        if ($the != '') {
            $data = [
                'user_id' => $id,
                'code' => $the,
                'created_at' => time(),
            ];
            $this->CartLink->insert($data);
            $result = true;
            $message = 'Thêm thẻ thành công';
        }
        echo json_encode([
            'result' => $result,
            'message' => $message,
        ]);
    }
    public function create_contact()
    {
        $addCont = $this->input->post('addCont');
		$obj_cont=json_decode($addCont);
        $session = $this->session->userdata('user');
        $id = $session['id'];

        if ($addCont != '') {
            foreach ($obj_cont as $contact) {
                $data = [
                    'user_id' => $id,
                    'type' => $contact[0],
                    'subtitle' => $contact[1],
                    'content' => $contact[2],
					'contact_order'=>$contact[3],
                    'created_at' => time(),
                    'updated_at' => time(),
                ];
                $this->Contact->insert($data);
            }
        }
		var_dump($obj_cont);
        $result = true;
        $message = "Thêm thông tin thành công";
        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);
    }

    public function update_contact()
    {
        $upCont = $this->input->post('upCont');
        $upBank = $this->input->post('upBank');
        $obj_cont = json_decode($upCont);
        // $obj_cont = explode(',',$obj_cont);
        $obj_bank = json_decode($upBank);
        // $obj_bank = explode(',',$obj_bank);

        $result = false;
        $message = "Chỉnh sửa thông tin thất bại";
        if ($obj_cont != '') {
            foreach ($obj_cont as $key => $value) {
                $data = [
                    'subtitle' => $obj_cont[$key][2],
                    'content' => $obj_cont[$key][3],
                    'created_at' => time(),
                    'updated_at' => time(),
                ];
                $this->Contact->update($data, $obj_cont[$key][0]);
                $result = true;
                $message = "Chỉnh sửa thông tin thành công";
            }
        }
        if ($obj_bank != '') {

            foreach ($obj_bank as $key => $value) {
                $data = [
                    'subtitle' => $obj_bank[$key][2],
                    'content' => $obj_bank[$key][3],
                    'created_at' => time(),
                    'updated_at' => time(),
                ];
                $this->Contact->update($data, $obj_bank[$key][0]);
                $result = true;
                $message = "Chỉnh sửa thông tin thành công";
            }
        }


        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);
    }
    public function delete_contact()
    {
        $id = $this->input->post('id');
        $result = false;
        $message = "Xoá thông tin thất bại";
        if ($id != '') {
            foreach($id as $key){
                $this->Contact->delete($key);
                $result = true;
                $message = "Xoá thông tin thành công";
            }
        }
        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);
    }
    public function index_contact()
    {
        $id = $this->input->post('id');
        $cont = $this->Contact->selectCont($id);
        echo json_encode($cont);
    }
    public function index_contact2()
    {
        $id2 = $this->input->post('id');
        $cont2 = $this->Contact->selectCont($id2);
        echo json_encode($cont2);
    }
    public function view_edit()
    {
        $id = $this->input->post('id');
        $cont = $this->Contact->selectCont($id);
        echo json_encode($cont);
    }

	public function get_list_user_detail(){
		$id=$_SESSION['user']['id'];
		$user_detail=$this->User_details->select($id);
		die(json_encode($user_detail));
	}
	public function get_list_contact(){
		$id=$_SESSION['user']['id'];
		$contact=$this->Contact->select($id);
		die(json_encode($contact));
	}

	public function sort_contact(){
		$arr_id=$this->input->post('arr_id');
		$arr_id=json_decode(($arr_id));
		foreach($arr_id as $contact){
			$this->Contact->update(['contact_order'=>$contact[1]],$contact[0]);
		}
	}

}
