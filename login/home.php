<?php
	session_start();
	//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
	//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
	if (!isset($_SESSION['username'])) {
		 header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Trang chủ</title>
</head>
<body>
	<a href = "logout.php" tite = "Logout">Logout</a>
	Chúc mừng bạn có username là <?php echo $_SESSION['username'];  ?> đã đăng nhập thành công !
	<?php include("header.php");?>
</body>
</html>