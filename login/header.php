<!DOCTYPE html>
<html>
<head>
	<title>Header</title>
</head>
<body>
  	<?php
			$server = 'localhost'; 
			$username = 'root';
			$password = ''; 
			$database = 'php05';
			$connect = mysqli_connect($server, $username, $password, $database);
			if(isset($_SESSION['username']))
			{
				$user_name = $_SESSION['username'];
				$sql = "SELECT * from login where username LIKE '".$user_name."' AND quyen LIKE '1'";
				$result = $connect->query($sql);
			}

	?>
<table width="980" border="0">
  <tr>
    <td width="122" height="21"><div align="center"><a href="index.php"><strong>Trang chủ</strong></a></div></td>
	<?php
	if(!$_SESSION['username'])
	{
	?>
    <td width="122"><div align="center"><a href="index.php?action=1"><strong>Đăng nhập</strong></a></div></td>
	<td width="122"><div align="center"><a href="index.php?action=2"> <strong>Đăng ký</strong> </a></div></td>
    <?php
	}
	else
	{
	?>
	<td width="122"><div align="center"><a href="logout.php?action=8"><strong>Thoát</strong></a></div></td>
	<td width="122"><div align="center"><a href="index.php?action=4"><strong>Giỏ hàng</strong> </a></div></td>
	<?php 
	}
	?>
    <td width="122"><div align="center"><a href="index.php?action=5"> <strong>Tìm kiếm</strong></a></div></td>
    <td width="122"><div align="center"><a href="index.php?action=6"> <strong>Tính toán</strong> </a></div></td>
	<?php
	if(@$result->num_rows==1)
	{
	?>
	<td width="122"><div align="center"><a href="index.php?action=3"> <strong>Cập nhật</strong> </a></div></td>
	<td width="122"><div align="center"><a href="index.php?action=10"> <strong>Sửa xóa</strong> </a></div></td>
  <?php
  } ?>
  </tr>
</table>	
</body>
</html>