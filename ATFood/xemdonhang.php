<?php
include "connect.php";
$manguoidung = $_POST['manguoidung'];

$query = 'SELECT * FROM `donhang` WHERE `manguoidung` = '.$manguoidung;
$data = mysqli_query($conn, $query);
$result = array();
while($row = mysqli_fetch_assoc($data)){
	
	$truyvan = 'SELECT * FROM `chitietdonhang` INNER JOIN sanpham ON chitietdonhang.masanpham = sanpham.masanpham WHERE chitietdonhang.machitietdonhang = '.$row['madonhang'] ;

	$data1 = mysqli_query($conn, $truyvan);

	$item = array();

	while($row1 = mysqli_fetch_assoc($data1)){
		$item[] = $row1;
	}

	$row['item'] = $item;
	$result[] = ($row);
}

if(!empty($result)){

	$arr = [
		'success' => true,
		'message' => "thanh cong",
		'result' => $result
	];
}else{
	$arr = [
		'success' => false,
		'message' => "khong thanh cong",
		'result' => $result
	];
 }
print_r(json_encode($arr));

?>