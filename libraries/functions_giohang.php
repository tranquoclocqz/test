<?php
function thongtinsanpham($id){
	global $lang;
	$result = _fetch_array("SELECT a.ten_$lang as ten,a.tenkhongdau as tenkhongdau,a.id as id,a.giaban as giaban,a.photo as photo,a.giacu as giacu,type,sp_khuyenmai FROM table_product as a WHERE a.id='".$id."' and a.hienthi = 1");
	return $result;
}

function phuong_thuc_thanh_toan($id){
	$thanhvien = _fetch_array("SELECT ten FROM table_option WHERE id='".$id."'");
	return $thanhvien['ten'];
}

function ten_thanhvien($id){
	$thanhvien = _fetch_array("SELECT ten FROM table_member WHERE id='".$id."'");
	return $thanhvien['ten'];
}

function get_tinh($id){
	$sql = _fetch_array("select ten_vi as ten from #_tinh where id='".$id."'");
	return $sql['ten'];
}

function get_huyen($id){
	global $d, $row,$lang;
	$sql = _fetch_array("select ten_$lang as ten from #_quan where id='".$id."'");
	return $sql['ten'];
}

function get_phuongx($id){
	global $d, $row,$lang;
	$sql = _fetch_array("select ten_$lang as ten from #_phuong where id='".$id."'");
	return $sql['ten'];
}


function get_product_name($pid){
	global $d, $row,$lang;
	$sql = "select ten_$lang as ten from #_product where id='".$pid."'";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row['ten'];
}

function get_price($pid){
	$row = _fetch_array("select giaban from table_product where id='".$pid."'");
	return (int)$row['giaban'];
}

function get_size($id){
	return _fetch_array("select label_vi as label,value_vi as value from table_product_attributes where id='".$id."'");
}

function get_color($id){
	$sql = _fetch_array("select ten_vi from table_mausac where id='".$id."'");
	return $sql['ten_vi'];
}

function get_thumb($pid){
	global $d, $row;
	$sql = "select photo from table_product where id='".$pid."' ";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row['photo'];
}

function get_type($id){
	global $d, $row;
	$c = _fetch_array("SELECT type FROM table_product WHERE id=".$id);
	return $c['type'];
}

function count_cart(){
	$c = 0;
	foreach ($_SESSION['cart'] as $key => $value) {
		$c += $value['qty'];
	}
	return $c;
}

function get_slug($id){
	global $d, $row;
	$slug = _fetch_array("SELECT tenkhongdau FROM table_product WHERE id=".$id);
	return $slug['tenkhongdau'];
}

function remove_product($pid,$size='',$mausac=''){
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		if($pid==$_SESSION['cart'][$i]['id']){
			unset($_SESSION['cart'][$i]);
			break;
		}
	}
	$_SESSION['cart']=array_values($_SESSION['cart']);
}
function remove_pro_thanh($pid){
	$pid=intval($pid);
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		if($pid==$_SESSION['cart'][$i]['productid']){
			unset($_SESSION['cart'][$i]);
			break;
		}
	}
	$_SESSION['cart']=array_values($_SESSION['cart']);
	redirect('thanh-toan.html');
}
function get_order_total(){
	$max=count($_SESSION['cart']);
	$sum=0;
	for($i=0;$i<$max;$i++){
		$pid=$_SESSION['cart'][$i]['productid'];
		$q=$_SESSION['cart'][$i]['qty'];
		$price=get_price($pid);
		if ($_SESSION['cart'][$i]['size'] == 0) {
			$price=get_price($pid);
		} else {
			$size = get_size($_SESSION['cart'][$i]['size']);
			$price = $size['value'];
		}
		
		$sum+=$price*$q;
	}
	return $sum;
}
function addtocart($pid,$q,$size='',$mausac=''){
	global $d,$lang;
	if($pid<1 || $q<1) return;	
	if(is_array($_SESSION['cart'])){
		if(product_exists($pid,$q,$size,$mausac)) return 0;
		$max=count($_SESSION['cart']);
		$_SESSION['cart'][$max]['id']=uniqid();
		$_SESSION['cart'][$max]['productid']=$pid;
		$_SESSION['cart'][$max]['qty']=(int)$q;
		$_SESSION['cart'][$max]['size']=$size;
		$_SESSION['cart'][$max]['mausac']=$mausac;
		return $_SESSION['cart'][$max]['id'];
	}
	else{
		$_SESSION['cart']=array();
		$_SESSION['cart'][0]['id']=uniqid();
		$_SESSION['cart'][0]['productid']=$pid;
		$_SESSION['cart'][0]['qty']=(int)$q;
		$_SESSION['cart'][0]['size']=$size;
		$_SESSION['cart'][0]['mausac']=$mausac;
		return $_SESSION['cart'][0]['id'];
	}
}
function product_exists($pid,$q,$size,$mausac){
	$pid=intval($pid);
	$max=count($_SESSION['cart']);
	$flag=0;
	for($i=0;$i<$max;$i++){
		if($pid==$_SESSION['cart'][$i]['productid'] && $size==$_SESSION['cart'][$i]['size'] && $mausac==$_SESSION['cart'][$i]['mausac']){
			$_SESSION['cart'][$i]['qty'] = $_SESSION['cart'][$i]['qty'] + $q;
			$flag=1;
			break;
		}
	}
	return $flag;
}