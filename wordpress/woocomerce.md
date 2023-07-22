# sample code for wordpress woocomerce
Change price to contact button when zero
```
add_filter('woocommerce_get_price_html', function ( $price ) {	
    return $price ? $price : '<a href="/contact" class="price-contact">Contact</a>';
} );
```
Simple checkout page fields
```
add_filter( 'woocommerce_checkout_fields' , function ( $fields ) {
	$fields['billing']['billing_address_1']['class']=['notes'];
	$fields['billing']['billing_address_1']['label']='Địa chỉ';
	$fields['billing']['billing_address_1']['placeholder']='Số nhà/ngõ(ngách)/đường/phường(xã)/quận(huyện)';
	$fields['billing']['billing_phone']['label']='SĐT/Zalo để gửi thông báo xác nhận đơn hàng';
	$fields['billing']['billing_first_name']['label']='Họ và tên';
	$fields['shipping']['shipping_state']['label']="Tỉnh/Thành phố";
	$fields['billing']['billing_email']['required']=0;
	
	$fields['billing']['billing_state']['label']="Tỉnh/Thành phố";
	$fields['billing']['billing_state']['required']=1;
	
	$fields['billing']['billing_first_name']['priority'] = 1;
	$fields['billing']['billing_phone']['priority'] = 2;
	$fields['billing']['billing_state']['priority'] = 3;
	$fields['billing']['billing_address_1']['priority'] = 4;
	$fields['billing']['billing_email']['priority'] = 5;
	
	
	
	unset($fields['shipping']['shipping_last_name']);
	unset($fields['shipping']['shipping_company']);
	unset($fields['shipping']['shipping_country']);
	unset($fields['shipping']['shipping_address_2']);
	unset($fields['shipping']['shipping_city']);	
	unset($fields['shipping']['shipping_postcode']);
	$fields['shipping']['shipping_address_1']['type']='textarea';
	$fields['shipping']['shipping_address_1']['required']=0;
	$fields['shipping']['shipping_first_name']['required']=0;
	$fields['shipping']['shipping_last_name']['required']=0;	
	
	
	$fields["billing"] = [
		'billing_first_name' => $fields["billing"]['billing_first_name'],
		'billing_phone' => $fields["billing"]['billing_phone'],
		'billing_state' => $fields["billing"]['billing_state'],
		'billing_address_1' => $fields["billing"]['billing_address_1'],
		'billing_email' => $fields["billing"]['billing_email'],
	];
	//$fields["billing"] = $orderFields;
	//echo '<pre>';print_r($fields);
	return $fields;
});
add_filter( 'woocommerce_states', function ($states ) {
  $states['VN'] = array(
    'HANOI' => 'Hà Nội' ,
    'HOCHIMINH' => 'Hồ Chí Minh' ,
    'CANTHO' => 'Cần Thơ' ,
    'HAIPHONG' => 'Hải Phòng' ,
    'DANANG' => 'Đà Nẵng' ,
    'ANGIANG' => 'An Giang' ,
    'BARIAVUNGTAU' => 'Bà Rịa - Vũng Tàu' ,
    'BACLIEU' => 'Bạc Liêu' ,
    'BACKAN' => 'Bắc Kạn' ,
    'BACNINH' => 'Bắc Ninh' ,
    'BACGIANG' => 'Bắc Giang' ,
    'BENTRE' => 'Bến Tre' ,
    'BINHDUONG' => 'Bình Dương' ,
    'BINHDINH' => 'Bình Định' ,
    'BINHPHUOC' => 'Bình Phước' ,
    'BINHTHUAN' => 'Bình Thuận',
    'CAMAU' => 'Cà Mau',
    'DAKLAK' => 'Đak Lak',
    'DAKNONG' => 'Đak Nông',
    'DIENBIEN' => 'Điện Biên',
    'DONGNAI' => 'Đồng Nai',
    'GIALAI' => 'Gia Lai',
    'HAGIANG' => 'Hà Giang',
    'HANAM' => 'Hà Nam',
    'HATINH' => 'Hà Tĩnh',
    'HAIDUONG' => 'Hải Dương',
    'HAUGIANG' => 'Hậu Giang',
    'HOABINH' => 'Hòa Bình',
    'HUNGYEN' => 'Hưng Yên',
    'KHANHHOA' => 'Khánh Hòa',
    'KIENGIANG' => 'Kiên Giang',
    'KOMTUM' => 'Kom Tum',
    'LAICHAU' => 'Lai Châu',
    'LAMDONG' => 'Lâm Đồng',
    'LANGSON' => 'Lạng Sơn',
    'LAOCAI' => 'Lào Cai',
    'LONGAN' => 'Long An',
    'NAMDINH' => 'Nam Định',
    'NGHEAN' => 'Nghệ An',
    'NINHBINH' => 'Ninh Bình',
    'NINHTHUAN' => 'Ninh Thuận',
    'PHUTHO' => 'Phú Thọ',
    'PHUYEN' => 'Phú Yên',
    'QUANGBINH' => 'Quảng Bình',
    'QUANGNAM' => 'Quảng Nam',
    'QUANGNGAI' => 'Quảng Ngãi',
    'QUANGNINH' => 'Quảng Ninh',
    'QUANGTRI' => 'Quảng Trị',
    'SOCTRANG' => 'Sóc Trăng',
    'SONLA' => 'Sơn La',
    'TAYNINH' => 'Tây Ninh',
    'THAIBINH' => 'Thái Bình',
    'THAINGUYEN' => 'Thái Nguyên',
    'THANHHOA' => 'Thanh Hóa',
    'THUATHIENHUE' => 'Thừa Thiên - Huế',
    'TIENGIANG' => 'Tiền Giang',
    'TRAVINH' => 'Trà Vinh',
    'TUYENQUANG' => 'Tuyên Quang',
    'VINHLONG' => 'Vĩnh Long',
    'VINHPHUC' => 'Vĩnh Phúc',
    'YENBAI' => 'Yên Bái',
  ); 
  return $states;
});
```
