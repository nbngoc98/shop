<?php 
	$server = 'localhost'; 
	$username = 'root';
	$password = ''; 
	$database = 'php05';

	$connect = mysqli_connect($server, $username, $password, $database);
	if (mysqli_connect_errno()){
		echo "Khong thanh cong!". mysqli_connect_error();
	}
	mysqli_set_charset($connect,"utf8");
?>