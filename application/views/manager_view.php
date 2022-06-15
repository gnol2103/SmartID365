<?php
defined('BASEPATH') or exit('No direct script access allowed');
if ($this->session->has_userdata('user')) {
	$infoUser = $this->session->userdata('user');
	$id = $infoUser['id'];
	$user_name = $infoUser['user_name'];
	$prof = $this->Users->profile($this->session->userdata('user')['id']);

}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
	<meta name="robots" content="noindex,follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/select2.min.css">
	<link rel="stylesheet" href="/assets/css/jquery_ui.css">
	<link rel="stylesheet" href="/assets/css/main.css">
	<link rel="stylesheet" href="/assets/css/footer.css">
	<? if (isset($css)) {
		foreach ($css as $link) { ?>
			<link rel="stylesheet" href="/assets/css/<?= $link ?>">
	<? }
	} ?>
</head>

<body>
	<div class="header">
		<div class="ctn_hd d-flex align-items-center">
			<div class="dropdown drop_user drop_sidebar">
				<img src="/assets/images/menu.svg" class="icon_sidebar" alt="Ảnh người dùng" class="dropdown-toggle" data-toggle="dropdown">
				<div class="dropdown-menu">
					<a class="dropdown-item item_tcn" href="/">Trang chủ</a>
					<a class="dropdown-item item_tcn" href="/san-pham.html">Sản phẩm</a>
					<a class="dropdown-item item_tcn" href="https://timviec365.vn/blog/c240/kpi-nang-luc">Tin tức</a>
					<a class="dropdown-item item_tcn" href="/huong-dan.html">Hướng dẫn</a>
					<? if (isset($id)) { ?>
						<a class="dropdown-item item_tcn color_x" href="/trang-ca-nhan-tk<?= $id ?>.html">Trở lại trang cá nhân</a>
						<a class="dropdown-item item_logout color_d" href="/ManagerController/logout">Đăng xuất</a>
					<? } else { ?>
						<a class="dropdown-item item_tcn color_x" href="/dang-nhap.html">Đăng nhập</a>
						<a class="dropdown-item item_tcn color_x" href="/dang-ky.html">Đăng ký</a>
					<? } ?>
				</div>
			</div>
			<a href="/" class="mr-auto d-flex"><img src="/assets/images/logo.svg" alt="smartID 365" class="logo_site"></a>
			<a class="hd_r hd_home" href="/">Trang chủ</a>
			<a class="hd_r hd_sp" href="/san-pham.html">Sản phẩm</a>
			<a class="hd_r" href="https://timviec365.vn/blog/c240/kpi-nang-luc">Tin tức</a>
			<a class="hd_r hd_hd" href="/huong-dan.html">Hướng dẫn</a>
			<div class="hd_cart d-flex">
				<img src="/assets/images/cart.svg" alt="giỏ hàng" class="icon_cart">
				<p class="sum_sp">0</p>
				<div class="cart_top">
					<div class="cart_title d-flex justify-content-between">
						<p class="bn_t3">Giỏ hàng</p>
						<button class="btn_t"><img src="/assets/images/x.svg" alt="bỏ" class="icon_dlt"></button>
					</div>
					<div class="block_cart"></div>
					<i class="no_pro mb-2">Không có sản phẩm nào trong giỏ hàng</i>
				</div>
			</div>
			<? if (isset($id)) { ?>
				<div class="dropdown drop_user">
					<!-- <?= ($prof->avatar != '') ? $prof->avatar : "user.png" ?> -->
					<img src="/assets/avata_user/<?= ($prof->avatar != null) ? '' . $prof->avatar . '' : "user.png" ?>" alt="Ảnh người dùng" class="dropdown-toggle img_user" data-toggle="dropdown">
					<div class="dropdown-menu">
						<a class="dropdown-item item_tcn" href="/trang-ca-nhan-tk<?= $id ?>.html">Trở lại trang cá nhân</a>
						<a class="dropdown-item item_logout color_d">Đăng xuất</a>
					</div>
				</div>
			<? } else { ?>
				<div class="hd_btn btn_x font-weight-bold">
					<a class="btn_signin" href="/dang-ky.html">Đăng ký </a>/
					<a class="btn_login" href="/dang-nhap.html">Đăng nhập</a>
				</div>
			<? } ?>
		</div>
	</div>

	<div class="ctn_body">
		<?
		if (isset($content)) {
			$this->load->view($content); 
		}
		?>
	</div>

	<?php
	require_once APPPATH . '/views/footer.php';
	?>

</body>
<script src="/assets/bootstrap/jquery-3.6.0.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/js/select2.min.js"></script>
<script src="/assets/js/jquery_ui.js"></script>
<script src="/assets/js/main.js"></script>
<!-- <script>var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();(function(){var s1=document.createElement('script'),s0=document.getElementsByTagName('script')[0];s1.async=true;s1.src='https://embed.tawk.to/597813875dfc8255d623ef26/default';s1.charset='UTF-8';s1.setAttribute('crossorigin','*');s0.parentNode.insertBefore(s1,s0);})();</script> -->
<?
if (isset($js)) {
	foreach ($js as $src) {
?>
		<script src="/assets/js/<?= $src ?>"></script>
<?
	}
}
?>

</html>
