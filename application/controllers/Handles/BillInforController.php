<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BillInforController extends CI_Controller
{

    protected $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array_helper');
        $this->load->library('session');
        $this->load->model('Pay_models');
        $this->load->model('Vouchers');
        $this->load->model('District');
        $this->load->model('Users');
		$this->load->model('Products');
    }
    function pay()
    {
        $user_name = $this->input->post('user_name');
        $user_phone = $this->input->post('user_phone');
        $city = $this->input->post('city');
        $district = $this->input->post('district');
        $user_address = $this->input->post('user_address');
        $user_card = $this->input->post('user_card');
        $user_note = $this->input->post('user_note');
        $voucher = $this->input->post('voucher');
        $voucher = $this->input->post('voucher');
        $trans_fee = $this->input->post('trans_fee');
        // $voucher_fee = $this->input->post('voucher_fee');
        // $total_fee = $this->input->post('total_fee');
        $id_user = $this->session->userdata('user')['id'];
        $list_product_get = json_decode($this->input->post('list_product'));
        $id_user = isset($id_user) ? $id_user : '';
        $arr_check = array($user_name, $user_phone, $city, $district, $user_address);
        // var_dump($voucher);
		$total_price=0;
		$total_fee=0;
		foreach($list_product_get as $product){
			$product_inf=$this->Products->select($product->id);
			if($product_inf['type_sale']==1){
				$price=$product_inf['price']-($product_inf['price']*($product_inf['sale']/100));
			}
			else{
				$price=$product_inf['price']-$product_inf['sale'];
			}
			$total_price+=$price;
		}
		$voucher_fee=0;
		if ($voucher!= '') {
			$vou = $this->Vouchers->select($voucher);
			if($vou['vou_condition']==2){
				$voucher_fee=($vou['discount']/100)*$total_price;
				$total_fee=$total_price-$voucher_fee;
			}
			if($vou['vou_condition']==1){
				$voucher_fee=$vou['discount'];
				$total_fee=$total_price-$voucher_fee;
			}
			$remain = $vou['remaining_tickets'] - 1;
			$data = [
				'remaining_tickets' => $remain,
			];
			$this->Vouchers->update($data, $voucher);
		}
        if (check_item_arr($arr_check) == true) {
            $data = [
                'user_id' => $id_user,
                'bill_name' => $user_name,
                'phone' => $user_phone,
                'city_id' => $city,
                'district_id' => $district,
                'address' => $user_address,
                'card_name' => $user_card,
                'note' => $user_note,
                'total_trans' => $trans_fee,
                'voucher' => $voucher,
                'total_voucher' => $voucher_fee,
                'total_price' => $total_fee,
                'status' => 0,
                'created_at' => time(),
            ];
            $insert_bill = $this->Pay_models->addBill($data);
			foreach($list_product_get as $product){
				$product_inf=$this->Products->select($product->id);
				if($product_inf['type_sale']==1){
					$price=$product_inf['price']-($product_inf['price']*($product_inf['sale']/100));
				}
				else{
					$price=$product_inf['price']-$product_inf['sale'];
				}
				$data=[
					'bill_id'=>$insert_bill,
					'product_id'=>$product->id,
					'bill_price'=>$price,
					'amount'=>$product->amount
				];
				$this->Pay_models->addBillDetails($data);
			}
            $this->session->unset_userdata('cart');
            success('Đặt hàng thành công');
        } else {
            error_msg('Đặt hàng thất bại');
        }
    }
    public function check_coupon()
    {
        $get_coupon =  $this->input->post('coupon');
        $check_coupon = $this->Vouchers->check_coupon($get_coupon);
        $result = false;
        $message = "Voucher này không tồn tại";
        if ($check_coupon != '') {
            $result = false;
            $message = 'Voucher này đã hết lượt sử dụng';
            if ($check_coupon['remaining_tickets'] > 0) {
                $session = $this->session->set_userdata('coupon', $check_coupon);
                $coupon = $this->session->userdata('coupon');
                $result = true;
                $message = 'Mã đúng';
                if ($coupon != '') {
                    $voucher = [];
                    // check giới tính 
                    $session = $this->session->userdata('user');
                    $id = $session['id'];
                    $select = $this->Users->select($id);
                    // quy đổi giờ
                    $start_time = $coupon['start_time'];
                    $time_end = $coupon['time_end'];
                    $ngay = date('d');
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $gio = date('H:i');
                    date_default_timezone_set('Europe/Berlin');
                    $gio = strtotime($gio);
                    //ngày
                    $start_day = $coupon['start_day'];
                    $end_date = $coupon['end_date'];
                    $date1 = date('Y-m-d');
                    $date = strtotime($date1);
                    // $a = getdate()['weekday'];
                    // thứ, ngày, tháng select
                    $month_select = explode(',', $coupon['month_select']);
                    $day_select = explode(',', $coupon['day_select']);
                    $thu_select = explode(',', $coupon['thu_select']);
                    // thứ, ngày, thángg hiện tại 
                    $month = getdate()['mon'];
                    $day = getdate()['mday'];
                    $thu = getdate()['wday'];

                    $result = true;
                    $message = 'Voucher được áp dụng 404';
                    // CÓ ĐĂNG KÝ GIỚI TÍNH
                    // TH1: Chỉ áp dụng giới tính
                    if ($coupon['gender'] != 4 && $coupon['vou_day'] == 0 && $coupon['birthday'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' &&  $coupon['start_time'] == 0 && $coupon['time_end'] == 0 && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        if ($coupon['gender'] == 0) {
                            if ($select['gender'] == $coupon['gender']) {
                                $result = true;
                                $message = "Voucher này có thể áp dụng";
                                $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                $voucher = $this->session->userdata('voucher');
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nam';
                            }
                        } else if ($coupon['gender'] == 1) {
                            if ($select['gender'] == $coupon['gender']) {
                                $result = true;
                                $message = "Voucher này có thể áp dụng";
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nữ';
                            }
                        }
                    }
                    // TH2: Áp dụng là sinh nhật
                    else if ($coupon['gender'] == 4 && $coupon['birthday'] == 1 && $coupon['vou_day'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' &&  $coupon['start_time'] == 0 && $coupon['time_end'] == 0 && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        // converse ngày sinh
                        $date_birth = $select['date_birth'];
                        $birth_day = date('m-d', $date_birth);
                        // lấy ngày hiện tại
                        $today = date('m-d');
                        if ($birth_day == $today) {
                            $this->session->set_userdata('voucher', $_SESSION['coupon']);
                            $voucher = $this->session->userdata('voucher');
                            $result = true;
                            $message = 'Voucher này có thể áp dụng';
                        } else {
                            $result = false;
                            $message = "Voucher này chỉ áp dụng vào ngày sinh nhật";
                        }
                    }
                    //TH3: Chỉ áp dụng ngày chẵn
                    else if ($coupon['gender'] == 4 && $coupon['birthday'] == 0 && $coupon['vou_day'] == 2 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' &&  $coupon['start_time'] == 0 && $coupon['time_end'] == 0 && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        if ($ngay % 2 != 0) {
                            $this->session->set_userdata('voucher', $_SESSION['coupon']);
                            $voucher = $this->session->userdata('voucher');
                            $result = true;
                            $message = "Voucher này có thể áp dụng";
                        } else {
                            $result = false;
                            $message = "Voucher này chỉ áp dụng ngày chẵn";
                        }
                    }
                    //TH4: Chỉ áp dụng ngày lẻ
                    else if ($coupon['gender'] == 4 && $coupon['birthday'] == 0 && $coupon['vou_day'] == 1 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' &&  $coupon['start_time'] == 0 && $coupon['time_end'] == 0 && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        if ($ngay % 2 != 0) {
                            $this->session->set_userdata('voucher', $_SESSION['coupon']);
                            $voucher = $this->session->userdata('voucher');
                            $result = true;
                            $message = "Voucher này có thể áp dụng ";
                        } else {
                            $result = false;
                            $message = "Voucher này chỉ áp dụng ngày lẻ";
                        }
                    }
                    //TH5: Chỉ áp dụng thứ
                    else if ($coupon['gender'] == 4 && $coupon['birthday'] == 0 && $coupon['vou_day'] == 0 && $coupon['thu_select'] != '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' &&  $coupon['start_time'] == 0 && $coupon['time_end'] == 0 && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {

                        if ($thu_select[0] == $thu || $thu_select[1] == $thu || $thu_select[2] == $thu || $thu_select[3] == $thu || $thu_select[4] == $thu || $thu_select[5] == $thu || $thu_select[6] == $thu) {
                            $this->session->set_userdata('voucher', $_SESSION['coupon']);
                            $voucher = $this->session->userdata('voucher');
                            $result = true;
                            $message = "Voucher này có thể áp dụng ";
                        } else {
                            $result = false;
                            $message = "Voucher này không áp dụng vào hôm nay";
                        }
                    }
                    //TH6: Chỉ áp dụng ngày
                    else if ($coupon['gender'] == 4 && $coupon['birthday'] == 0 && $coupon['vou_day'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] != '' && $coupon['month_select'] == '' &&  $coupon['start_time'] == 0 && $coupon['time_end'] == 0 && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        if ($day_select[0] == $day || $day_select[1] == $day || $day_select[2] == $day || $day_select[3] == $day || $day_select[4] == $day || $day_select[5] == $day || $day_select[6] == $day || $day_select[7] == $day || $day_select[8] == $day || $day_select[9] == $day || $day_select[10] == $day || $day_select[11] == $day || $day_select[12] == $day || $day_select[13] == $day || $day_select[14] == $day || $day_select[15] == $day || $day_select[16] == $day || $day_select[17] == $day || $day_select[18] == $day || $day_select[19] == $day || $day_select[20] == $day || $day_select[21] == $day || $day_select[22] == $day || $day_select[23] == $day || $day_select[24] == $day || $day_select[25] == $day || $day_select[26] == $day || $day_select[27] == $day || $day_select[28] == $day || $day_select[29] == $day || $day_select[30] == $day || $day_select[31] == $day) {
                            $this->session->set_userdata('voucher', $_SESSION['coupon']);
                            $voucher = $this->session->userdata('voucher');
                            $result = true;
                            $message = "Voucher này có thể áp dụng ";
                        } else {
                            $result = false;
                            $message = "Voucher này không áp dụng trong hôm nay";
                        }
                    }
                    //TH7: Chỉ áp dụng tháng
                    else if ($coupon['gender'] == 4 && $coupon['birthday'] == 0 && $coupon['vou_day'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] != '' &&  $coupon['start_time'] == 0 && $coupon['time_end'] == 0 && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        if ($month_select[0] == $month || $month_select[1] == $month || $month_select[2] == $month || $month_select[3] == $month || $month_select[4] == $month || $month_select[5] == $month || $month_select[6] == $month || $month_select[7] == $month || $month_select[8] == $month || $month_select[9] == $month || $month_select[10] == $month || $month_select[11] == $month) {
                            $this->session->set_userdata('voucher', $_SESSION['coupon']);
                            $voucher = $this->session->userdata('voucher');
                            $result = true;
                            $message = "Voucher này có thể áp dụng ";
                        } else {
                            $result = false;
                            $message = "Voucher này không áp dụng vào tháng này";
                        }
                    }

                    //TH8: Chỉ áp dụng giờ
                    else if ($coupon['gender'] == 4 && $coupon['birthday'] == 0 && $coupon['vou_day'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' &&  $coupon['start_time'] != 0 && $coupon['time_end'] != 0 && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        if ($start_time < $gio) {
                            if ($gio < $time_end) {
                                $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                $voucher = $this->session->userdata('voucher');
                                $result = true;
                                $message = "Voucher này có thể áp dụng";
                            } else if ($gio > $time_end) {
                                $result = false;
                                $message = "Voucher này đã hết hạn";
                            }
                        } else {
                            $result = false;
                            $message = "Voucher này chưa đến giờ sử dụng";
                        }
                    }
                    //TH9: Chỉ áp dụng ngày tháng
                    else if ($coupon['gender'] == 4 && $coupon['birthday'] == 0 && $coupon['vou_day'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' &&  $coupon['start_time'] == 0 && $coupon['time_end'] == 0 && $coupon['start_day'] != 0 && $coupon['end_date'] != 0) {
                        if ($start_day < $ngay) {
                            if ($ngay < $end_date) {
                                $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                $voucher = $this->session->userdata('voucher');
                                $result = true;
                                $message = "Voucher này có thể áp dụng";
                            } else {
                                $result = false;
                                $message = "Voucher này đã hết hạn";
                            }
                        } else {
                            $result = false;
                            $message = "Voucher này chưa đến giờ sử dụng";
                        }
                    }

                    // Giới Tính + Giờ
                    // TH1: Áp dụng cho giới tính nam hoặc nữ ngày lẻ 
                    else if ($coupon['gender'] != 4 && $coupon['vou_day'] == 1 && $coupon['birthday'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' && $coupon['start_time'] == 0 && $coupon['time_end'] == 0  && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        // áp dụng là nam ngày lẻ
                        if ($coupon['gender'] == 0) {
                            if ($select['gender'] == $coupon['gender']) {
                                if ($ngay % 2 != 0) {
                                    $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                    $voucher = $this->session->userdata('voucher');
                                    $result = true;
                                    $message = "Voucher này có thể áp dụng";
                                } else {
                                    $result = false;
                                    $message = "Voucher này chỉ áp dụng ngày lẻ";
                                }
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nam';
                            }
                        }
                        // áp dụng nữ ngày lẻ
                        else if ($coupon['gender'] == 1) {
                            if ($select['gender'] == $coupon['gender']) {
                                if ($ngay % 2 != 0) {
                                    $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                    $voucher = $this->session->userdata('voucher');
                                    $result = true;
                                    $message = "Voucher này có thể áp dụng";
                                } else {
                                    $result = false;
                                    $message = "Voucher này chỉ áp dụng ngày lẻ";
                                }
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nữ';
                            }
                        }
                    }
                    // TH2: Áp dụng cho giới tính nam hoặc nữ ngày chẵn
                    else if ($coupon['gender'] != 4 && $coupon['vou_day'] == 2 && $coupon['birthday'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' && $coupon['start_time'] == 0 && $coupon['time_end'] == 0 && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        // áp dụng nam ngày chẵn
                        if ($coupon['gender'] == 0) {
                            if ($select['gender'] == $coupon['gender']) {
                                if ($ngay % 2 == 0) {
                                    $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                    $voucher = $this->session->userdata('voucher');
                                    $result = true;
                                    $message = "Voucher này có thể áp dụng";
                                } else {
                                    $result = false;
                                    $message = "Voucher này chỉ áp dụng ngày chẵn";
                                }
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nam';
                            }
                        }

                        // áp dụng nữ ngày chẵn
                        else if ($coupon['gender'] == 1) {
                            if ($select['gender'] == $coupon['gender']) {
                                if ($ngay % 2 == 0) {
                                    $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                    $voucher = $this->session->userdata('voucher');
                                    $result = true;
                                    $message = "Voucher này có thể áp dụng";
                                } else {
                                    $result = false;
                                    $message = "Voucher này chỉ áp dụng ngày chẵn";
                                }
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nữ';
                            }
                        }
                    }
                    // Giới Tính + Chẵn lẻ + Giờ
                    // TH1: Áp dụng cho nam hoặc nữ, ngày lẻ, giờ
                    else if ($coupon['gender'] != 4 && $coupon['vou_day'] == 1 && $coupon['start_time'] != 0 && $coupon['time_end'] != 0 && $coupon['birthday'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        // áp dụng là nam ngày lẻ, giờ
                        if ($coupon['gender'] == 0) {
                            if ($select['gender'] == $coupon['gender']) {
                                if ($ngay % 2 != 0) {
                                    if ($start_time <= $gio && $gio <= $time_end) {
                                        $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                        $voucher = $this->session->userdata('voucher');
                                        $result = true;
                                        $message = "Voucher này có thể áp dụng";
                                    } else {
                                        $result = false;
                                        $message = "Voucher này đã hết hạn";
                                    }
                                } else {
                                    $result = false;
                                    $message = "Voucher này chỉ áp dụng ngày lẻ";
                                }
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nam';
                            }
                        }
                        // áp dụng nữ ngày lẻ, giờ
                        else if ($coupon['gender'] == 1) {
                            if ($select['gender'] == $coupon['gender']) {
                                if ($ngay % 2 != 0) {
                                    if ($start_time <= $gio && $gio <= $time_end) {
                                        $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                        $voucher = $this->session->userdata('voucher');
                                        $result = true;
                                        $message = "Voucher này có thể áp dụng";
                                    } else {
                                        $result = false;
                                        $message = "Voucher này đã hết hạn";
                                    }
                                } else {
                                    $result = false;
                                    $message = "Voucher này chỉ áp dụng ngày lẻ";
                                }
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nữ';
                            }
                        }
                    }
                    // TH2: Áp dụng cho giới tính nam hoặc nữ ngày chẵn, giờ
                    else if ($coupon['gender'] != 4 && $coupon['vou_day'] == 2 && $coupon['start_time'] != 0 && $coupon['time_end'] != 0 && $coupon['birthday'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        // áp dụng nam ngày chẵn, giờ 
                        if ($coupon['gender'] == 0) {
                            if ($select['gender'] == $coupon['gender']) {
                                if ($ngay % 2 == 0) {
                                    if ($start_time <= $gio && $gio <= $time_end) {
                                        $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                        $voucher = $this->session->userdata('voucher');
                                        $result = true;
                                        $message = "Voucher này có thể áp dụng ";
                                    } else {
                                        $result = false;
                                        $message = "Voucher này đã hết hạn";
                                    }
                                } else {
                                    $result = false;
                                    $message = "Voucher này chỉ áp dụng ngày chẵn";
                                }
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nam';
                            }
                        }

                        // áp dụng nữ ngày chẵn,giờ
                        else if ($coupon['gender'] == 1) {
                            if ($select['gender'] == $coupon['gender']) {
                                if ($ngay % 2 == 0) {
                                    if ($start_time <= $gio && $gio <= $time_end) {
                                        $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                        $voucher = $this->session->userdata('voucher');
                                        $result = true;
                                        $message = "Voucher này có thể áp dụng";
                                    } else {
                                        $result = false;
                                        $message = "Voucher này đã hết hạn";
                                    }
                                } else {
                                    $result = false;
                                    $message = "Voucher này chỉ áp dụng ngày chẵn";
                                }
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nữ';
                            }
                        }
                    }
                    // GIỚI TÍNH + NGAY CL + GIO + NGAY 
                    else if ($coupon['gender'] != 4 && $coupon['vou_day'] == 1 && $coupon['start_time'] != 0 && $coupon['time_end'] != 0 && $coupon['birthday'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' && $coupon['start_day'] != 0 && $coupon['end_date'] != 0) {
                        // áp dụng là nam ngày lẻ, giờ, ngày
                        if ($coupon['gender'] == 0) {
                            if ($select['gender'] == $coupon['gender']) {
                                if ($ngay % 2 != 0) {
                                    if ($start_day <= $date && $date <= $end_date) {
                                        if ($start_time <= $gio && $gio <= $time_end) {
                                            $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                            $voucher = $this->session->userdata('voucher');
                                            $result = true;
                                            $message = "Voucher này có thể áp dụng";
                                        } else {
                                            $result = false;
                                            $message = "Voucher này đã hết hạn";
                                        }
                                    } else {
                                        $result = false;
                                        $message = "Voucher này đã hết hạn";
                                    }
                                } else {
                                    $result = false;
                                    $message = "Voucher này chỉ áp dụng ngày lẻ";
                                }
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nam';
                            }
                        }
                        // áp dụng nữ ngày lẻ
                        else if ($coupon['gender'] == 1) {
                            if ($select['gender'] == $coupon['gender']) {
                                if ($ngay % 2 != 0) {
                                    if ($start_day <= $date && $date <= $end_date) {
                                        if ($start_time <= $gio && $gio <= $time_end) {
                                            $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                            $voucher = $this->session->userdata('voucher');
                                            $result = true;
                                            $message = "Voucher này có thể áp dụng";
                                        } else {
                                            $result = false;
                                            $message = "Voucher này đã hết hạn";
                                        }
                                    } else {
                                        $result = false;
                                        $message = "Voucher này đã hết hạn";
                                    }
                                } else {
                                    $result = false;
                                    $message = "Voucher này chỉ áp dụng ngày lẻ";
                                }
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nữ';
                            }
                        }
                    }
                    // TH2: Áp dụng cho giới tính nam hoặc nữ ngày chẵn, giờ, ngày
                    else if ($coupon['gender'] != 4 && $coupon['vou_day'] == 2 && $coupon['start_time'] != 0 && $coupon['time_end'] != 0 && $coupon['birthday'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' && $coupon['start_day'] != 0 && $coupon['end_date'] != 0) {
                        // áp dụng nam ngày chẵn, giờ, ngày
                        if ($coupon['gender'] == 0) {
                            if ($select['gender'] == $coupon['gender']) {
                                if ($ngay % 2 == 0) {
                                    if ($start_day <= $date && $date <= $end_date) {
                                        if ($start_time <= $gio && $gio <= $time_end) {
                                            $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                            $voucher = $this->session->userdata('voucher');
                                            $result = true;
                                            $message = "Voucher này có thể áp dụng";
                                        } else {
                                            $result = false;
                                            $message = "Voucher này đã hết hạn";
                                        }
                                    } else {
                                        $result = false;
                                        $message = "Voucher này đã hết hạn";
                                    }
                                } else {
                                    $result = false;
                                    $message = "Voucher này chỉ áp dụng ngày chẵn";
                                }
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nam';
                            }
                        }

                        // áp dụng nữ ngày chẵn,giờ, ngày
                        else if ($coupon['gender'] == 1) {
                            if ($select['gender'] == $coupon['gender']) {
                                if ($ngay % 2 == 0) {
                                    if ($start_day <= $date && $date <= $end_date) {
                                        if ($start_time <= $gio && $gio <= $time_end) {
                                            $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                            $voucher = $this->session->userdata('voucher');
                                            $result = true;
                                            $message = "Voucher này có thể áp dụng";
                                        } else {
                                            $result = false;
                                            $message = "Voucher này đã hết hạn";
                                        }
                                    } else {
                                        $result = false;
                                        $message = "Voucher này đã hết hạn";
                                    }
                                } else {
                                    $result = false;
                                    $message = "Voucher này chỉ áp dụng ngày chẵn";
                                }
                            } else {
                                $result = false;
                                $message = 'Voucher này chỉ áp dụng cho nữ';
                            }
                        }
                    }
                    // TH: THỨ + NGÀY
                    else if ($coupon['gender'] == 4 && $coupon['vou_day'] == 0 && $coupon['start_time'] == 0 && $coupon['time_end'] == 0 && $coupon['birthday'] == 0 && $coupon['thu_select'] != '' && $coupon['day_select'] != '' && $coupon['month_select'] == '' && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        if ($day_select[0] == $day || $day_select[1] == $day || $day_select[2] == $day || $day_select[3] == $day || $day_select[4] == $day || $day_select[5] == $day || $day_select[6] == $day || $day_select[7] == $day || $day_select[8] == $day || $day_select[9] == $day || $day_select[10] == $day || $day_select[11] == $day || $day_select[12] == $day || $day_select[13] == $day || $day_select[14] == $day || $day_select[15] == $day || $day_select[16] == $day || $day_select[17] == $day || $day_select[18] == $day || $day_select[19] == $day || $day_select[20] == $day || $day_select[21] == $day || $day_select[22] == $day || $day_select[23] == $day || $day_select[24] == $day || $day_select[25] == $day || $day_select[26] == $day || $day_select[27] == $day || $day_select[28] == $day || $day_select[29] == $day || $day_select[30] == $day || $day_select[31] == $day) {
                            if ($thu_select[0] == $thu || $thu_select[1] == $thu || $thu_select[2] == $thu || $thu_select[3] == $thu || $thu_select[4] == $thu || $thu_select[5] == $thu || $thu_select[6] == $thu) {
                                $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                $voucher = $this->session->userdata('voucher');
                                $result = true;
                                $message = "Voucher này có thể áp dụng ";
                            } else {
                                $result = false;
                                $message = "Voucher này không áp dụng ";
                            }
                        } else {
                            $result = false;
                            $message = "Voucher này không áp dụng";
                        }
                    }
                    // TH: THỨ + THÁNG
                    else if ($coupon['gender'] == 4 && $coupon['vou_day'] == 0 && $coupon['start_time'] == 0 && $coupon['time_end'] == 0 && $coupon['birthday'] == 0 && $coupon['thu_select'] != '' && $coupon['day_select'] == '' && $coupon['month_select'] != '' && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        if ($month_select[0] == $month || $month_select[1] == $month || $month_select[2] == $month || $month_select[3] == $month || $month_select[4] == $month || $month_select[5] == $month || $month_select[6] == $month || $month_select[7] == $month || $month_select[8] == $month || $month_select[9] == $month || $month_select[10] == $month || $month_select[11] == $month) {
                            if ($thu_select[0] == $thu || $thu_select[1] == $thu || $thu_select[2] == $thu || $thu_select[3] == $thu || $thu_select[4] == $thu || $thu_select[5] == $thu || $thu_select[6] == $thu) {
                                $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                $voucher = $this->session->userdata('voucher');
                                $result = true;
                                $message = "Voucher này có thể áp dụng ";
                            } else {
                                $result = false;
                                $message = "Voucher này không áp dụng ";
                            }
                        } else {
                            $result = false;
                            $message = "Voucher này không áp dụng vào tháng này";
                        }
                    }
                    // TH: THỨ + GIỜ
                    else if ($coupon['gender'] == 4 && $coupon['vou_day'] == 0 && $coupon['start_time'] != 0 && $coupon['time_end'] != 0 && $coupon['birthday'] == 0 && $coupon['thu_select'] != '' && $coupon['day_select'] == '' && $coupon['month_select'] == '' && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        if ($thu_select[0] == $thu || $thu_select[1] == $thu || $thu_select[2] == $thu || $thu_select[3] == $thu || $thu_select[4] == $thu || $thu_select[5] == $thu || $thu_select[6] == $thu) {
                            if ($start_time <= $gio && $gio <= $time_end) {
                                $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                $voucher = $this->session->userdata('voucher');
                                $result = true;
                                $message = "Voucher này có thể áp dụng";
                            } else {
                                $result = false;
                                $message = "Voucher này đã hết hạn";
                            }
                        } else {
                            $result = false;
                            $message = "Voucher này không áp dụng ";
                        }
                    }
                    // TH: NGÀY + GIỜ
                    else if ($coupon['gender'] == 4 && $coupon['vou_day'] == 0 && $coupon['start_time'] != 0 && $coupon['time_end'] != 0 && $coupon['birthday'] == 0 && $coupon['thu_select'] == '' && $coupon['day_select'] != '' && $coupon['month_select'] == '' && $coupon['start_day'] == 0 && $coupon['end_date'] == 0) {
                        if ($start_day <= $date && $date <= $end_date) {
                            if ($start_time <= $gio && $gio <= $time_end) {
                                $this->session->set_userdata('voucher', $_SESSION['coupon']);
                                $voucher = $this->session->userdata('voucher');
                                $result = true;
                                $message = "Voucher này có thể áp dụng";
                            } else {
                                $result = false;
                                $message = "Voucher này đã hết hạn";
                            }
                        } else {
                            $result = false;
                            $message = "Voucher này đã hết hạn";
                        }
                    }
                    // không áp dụng
                    else {
                        $result = false;
                        $message = "Voucher này không được áp dụng";
                    }
                    // áp dụng giới tính theo giờ 
                }
            }
        }
        if (!empty($voucher)) {
            echo json_encode([
                'result' => $result,
                'message' => $message,
                'data' => $voucher,
            ]);
        } else {
            echo json_encode([
                'result' => $result,
                'message' => $message,
            ]);
        }
    }
    public function district()
    {
        $cit = $this->input->post('city');
        $result = false;
        if ($cit != '') {
            $dis = $this->District->selectDis($cit);
            $data = $dis;
            $result = true;
        }
        echo json_encode([
            'result' => $result,
            'data' => $data,
        ]);
    }
}
