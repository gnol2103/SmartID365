<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'ManagerController/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE; 


$route['dang-ky.html'] = 'ManagerController/registration';
$route['dang-nhap.html'] = 'ManagerController/login';
$route['huong-dan.html'] = 'ManagerController/tutorial';
$route['quen-mat-khau.html'] = 'ManagerController/forgotPassword'; 
$route['dat-lai-mat-khau.html'] = 'ManagerController/resetPassword'; 
$route['xac-thuc-tai-khoan.html'] = 'ManagerController/mailSend'; 
$route['xac-thuc-email.html'] = 'ManagerController/mailForgotPasswordSend'; 
$route['doi-mat-khau.html'] = 'ManagerController/changePass'; 
$route['san-pham.html'] = 'ManagerController/product'; 
$route['(:any)-c(:num).html'] = 'ManagerController/productDetails/$1/$2'; 
$route['gio-hang.html'] = 'ManagerController/cart'; 
$route['gio-hang.html?payment=(:num)'] = 'ManagerController/cart'; 
$route['thong-tin-thanh-toan.html'] = 'ManagerController/billInfor'; 
$route['trang-ca-nhan-tk(:num).html'] = 'ManagerController/personalPage/$1'; 

$route['admin'] = 'Admin/Views/Admin/index';
$route['admin/login'] = 'Admin/Views/Admin/login';
// thống kê
$route['admin/statistical'] = 'Admin/Views/Admin/statistical';

// đánh giá sản phẩm
$route['admin/evaluate'] = 'Admin/Views/Admin/evaluate';
$route['admin/evaluate_details'] = 'Admin/Views/Admin/evaluate_details/$1';
$route['admin/evaluate_details?id=(:num)'] = 'Admin/Views/Admin/evaluate_details/$1';
// quản lý người dùng
$route['admin/users'] = 'Admin/Views/Admin/users';
$route['admin/user_details'] = 'Admin/Views/Admin/user_details';
$route['admin/user_details?id=(:num)'] = 'Admin/Views/Admin/user_details/$1';
// sản phẩm
$route['admin/product'] = 'Admin/Views/Admin/product';
$route['admin/add_product'] = 'Admin/Views/Admin/add_product';
$route['admin/edit_product'] = 'Admin/Views/Admin/edit_product';
$route['admin/edit_product?id=(:num)'] = 'Admin/Views/Admin/edit_product/$1';
//voucher
$route['admin/voucher'] = 'Admin/Views/Admin/voucher';
$route['admin/add_voucher'] = 'Admin/Views/Admin/add_voucher';
$route['admin/edit_voucher'] = 'Admin/Views/Admin/edit_voucher';
$route['admin/edit_voucher?id=(:num)'] = 'Admin/Views/Admin/edit_voucher/$1';
// hoá đơn
$route['admin/unapproved_invoice'] = 'Admin/Views/Admin/unapproved_invoice';
$route['admin/approved_invoice'] = 'Admin/Views/Admin/approved_invoice';
$route['admin/unapproved_details'] = 'Admin/Views/Admin/unapproved_details';
$route['admin/unapproved_details?id=(:num)'] = 'Admin/Views/Admin/unapproved_details/$1';
$route['admin/approved_details'] = 'Admin/Views/Admin/approved_details';
$route['admin/approved_details?id=(:num)'] = 'Admin/Views/Admin/approved_details/$1';






