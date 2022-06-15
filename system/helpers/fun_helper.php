<?php
	// function checkHot($id) {
	// 	switch ($id) {
	// 		case '0'=>
	// 			return 'Không';
	// 			break;
	// 		case '1'=>
	// 			return 'Hot';
	// 			break;
	// 	}
	// }
	function bank(){
		$bank = ['Agribank', 'BIDV', 'Vietcombank', 'Vietinbank', 'OCB', 'ACB', 'TP Bank', 'Maritime Bank', 'Sacombank', 'DongA Bank', 'Eximbank', 'Nam A Bank', 'Saigon Bank', 'VP Bank', 'Techcombank', 'MB Bank', 'Bac A Bank', 'VIB', 'SeA Bank'];
		return $bank;
	}
	function contact(){
		$contact = [
			[
				"image" =>  "/assets/images/sdt.png",
				"title"=> "Số điện thoại",
				"title1"=> "Thêm số điện thoại",
				"title2"=> "Số điện thoại"
			],[
				"image"=> "/assets/images/email.png",
				"title"=> "Email",
				"title1"=> "Thêm tài khoản Email",
				"title2"=> "Email"
			],[
				"image"=> "/assets/images/dc.png",
				"title"=> "Địa chỉ",
				"title1"=> "Thêm địa chỉ",
				"title2"=> "Link địa chỉ"
			],[
				"image" => "/assets/images/skype.png",
				"title"=> "Skype",
				"title1"=> "Thêm tài khoản Skype",
				"title2"=> "Link Skype"
			],[
				"image"=> "/assets/images/fb.png",
				"title"=> "Facebook",
				"title1"=> "Thêm tài khoản Facebook",
				"title2"=> "Link Facebook cá nhân"
			],[
				"image"=> "/assets/images/insta.png",
				"title"=> "Instagram",
				"title1"=> "Thêm tài khoản Instagram",
				"title2"=> "Link Instagram"
			],[
				"image"=> "/assets/images/twitter.png",
				"title"=> "Twitter",
				"title1"=> "Thêm tài khoản Twitter",
				"title2"=> "Link Twitter"
			],[
				"image"=> "/assets/images/tiktok.png",
				"title"=> "Tiktok",
				"title1"=> "Thêm tài khoản Tiktok",
				"title2"=> "Link Tiktok"
			],[
				"image"=> "/assets/images/zalo.png",
				"title"=> "Zalo",
				"title1"=> "Thêm tài khoản Zalo",
				"title2"=> "Nhập số điện thoại đăng ký Zalo"
			],[
				"image"=> "/assets/images/ytb.png",
				"title"=> "Youtube",
				"title1"=> "Thêm tài khoản Youtube",
				"title2"=> "Link Youtube"
			],[
				"image"=> "/assets/images/snap.png",
				"title"=> "Snapchat",
				"title1"=> "Thêm tài khoản Snapchat",
				"title2"=> "Link Snapchat"
			],[
				"image"=> "/assets/images/in.png",
				"title"=> "LinkedIn",
				"title1"=> "Thêm tài khoản LinkedIn",
				"title2"=> "Link LinkedIn"
			],[
				"image"=> "/assets/images/pin.png",
				"title"=> "Pinterest",
				"title1"=> "Thêm tài khoản Pinterest",
				"title2"=> "Link Pinterest"
			],[
				"image"=> "/assets/images/be.png",
				"title"=> "Behance",
				"title1"=> "Thêm tài khoản Behance",
				"title2"=> "Link Behance"
			],[
				"image"=> "/assets/images/momo.png",
				"title"=> "Ví momo",
				"title1"=> "Thêm tài khoản Ví momo",
				"title2"=> "Nhập số điện thoại đăng ký Momo"
			],[
				"image"=> "/assets/images/pay.png",
				"title"=> "Paypal",
				"title1"=> "Thêm tài khoản Paypal",
				"title2"=> "Link Paypal"
			],[
				"image"=> "/assets/images/tknh.png",
				"title"=> "Tài khoản ngân hàng",
				"title1"=> "Thêm tài khoản ngân hàng"
			],[
				"image"=> "/assets/images/dd.png",
				"title"=> "Đường dẫn",
				"title1"=> "Thêm đường dẫn",
				"title2"=> "Link đường dẫn"
			]
		];
		return $contact;
	}
	function arrayHot() {
		$array = ['Không','Hot'];
		return $array;
	}
	function arrayColor() {
		$array = ['Đen','Trắng'];
		return $array;
	}

	function arrayTypeSale() {
		$array = ['Chọn loại giảm giá','Giảm theo %','Giảm theo số tiền'];
		return $array;
	}

	function formatDate($date) {
		return date("d-m-Y",$date);
	}

	function price_product($price,$type_sale,$sale) {
		if($type_sale != 0){
			if($type_sale == 1) {
				$price = round(($price/100)*(100-$sale));
			} else {
				$price = $price - $sale;
			}
		}
		return number_format($price);
	}

	//Hàm string alias
	function rewrire_product($alias,$id){
		$url = '/'.$alias.'-c'.$id.'.html';
		return $url;
	}

	function vn_str_filter($title)
	{
		$title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');
		$title = remove_accent($title);
		$title = str_replace('/', '', $title);
		$title = preg_replace('/[^\00-\255]+/u', '', $title);

		if (preg_match("/[\p{Han}]/simu", $title)) {
			$title = str_replace(' ', '-', $title);
		} else {
			$arr_str = array("&lt;", "&gt;", "/", " / ", "\\", "&apos;", "&quot;", "&amp;", "lt;", "gt;", "apos;", "quot;", "amp;", "&lt", "&gt", "&apos", "&quot", "&amp", "&#34;", "&#39;", "&#38;", "&#60;", "&#62;");

			$title = str_replace($arr_str, " ", $title);
			$title = preg_replace('/\p{P}|\p{S}/u', ' ', $title);
			$title = preg_replace('/[^0-9a-zA-Z\s]+/', ' ', $title);

			//Remove double space
			$array = array(
				'  ' => ' ',
				'   ' => ' ',
				'    ' => ' ',
			);
			$title = trim(strtr($title, $array));
			$title = str_replace(" ", "-", $title);
			$title = urlencode($title);
			// remove cac ky tu dac biet sau khi urlencode
			$array_apter = array("%0D%0A", "%", "&");
			$title = str_replace($array_apter, "-", $title);
			$title = strtolower($title);
		}
		return $title;
	}
	function remove_accent($mystring)
	{
		$marTViet = array(
			"à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ",
			"è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
			"ì", "í", "ị", "ỉ", "ĩ",
			"ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ",
			"ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
			"ỳ", "ý", "ỵ", "ỷ", "ỹ",
			"đ",
			"À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
			"È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
			"Ì", "Í", "Ị", "Ỉ", "Ĩ",
			"Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
			"Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
			"Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
			"Đ",
			"'"
		);

		$marKoDau = array(
			"a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
			"e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
			"i", "i", "i", "i", "i",
			"o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
			"u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
			"y", "y", "y", "y", "y",
			"d",
			"A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A",
			"E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
			"I", "I", "I", "I", "I",
			"O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O",
			"U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
			"Y", "Y", "Y", "Y", "Y",
			"D",
			""
		);
		return str_replace($marTViet, $marKoDau, $mystring);
	}

	function SendMail123($title,$name,$email,$body){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => '',
		CURLOPT_POST => 1,
			CURLOPT_SSL_VERIFYPEER => false, 
			CURLOPT_POSTFIELDS => array(
			'email' => $email,
			'body'  => $body,
			'title' => $title,
			'name' => $name,
			)
		));
		$resp = curl_exec($curl);
		$responsive = json_decode($resp);
		curl_close($curl);
		return $responsive;
	}
	
	
?>
