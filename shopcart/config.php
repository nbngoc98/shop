<?php
	$currency = ' VNĐ'; // đơn vị tiền tệ
	$server = 'localhost'; 
	$username = 'root';
	$password = ''; 
	$database = 'cnweb';

	$connect = mysqli_connect($server, $username, $password, $database);
	if (mysqli_connect_errno()){
		echo "Khong thanh cong!". mysqli_connect_error();
	}
	mysqli_set_charset($connect,"utf8");
?>
