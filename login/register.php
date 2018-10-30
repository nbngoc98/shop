<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
	<?php 
		$server = 'localhost'; //$server = '127.0.0.1';
		$username = 'root';
		$password = ''; //$password = '';
		$database = 'php05';
		$connect = mysqli_connect($server, $username, $password, $database);
		$sql = "SELECT * FROM login";
		$result = mysqli_query($connect, $sql);
		// Add User
		$username = "";
		$password ="";
		$fullname = "";
		$birthday = "";
		$email = "";
		$errUsername ="";
		$errPass ="";
		$errFullName = "";
		$errBirthday = "";
		$errEmail = "";
		$check = true;
		if(isset($_POST['Submit'])){
			$username = $_POST['username'];
			if($username == ""){
				$check = false;
				$errUsername = "* Bạn chưa nhập Username!";
			} else {
				$errUsername ="";
			}
			$password = $_POST['password'];
			if($password == ""){
				$check = false;
				$errPass = "* Bạn chưa nhập Email!";
			} else {
				$errPass ="";
			}
			$fullname = $_POST['fullname'];
			if($fullname == ""){
				$check = false;
				$errFullName = "* Bạn chưa nhập họ tên đầy đủ!";
			} else {
				$errFullName ="";
			}
			$birthday = $_POST['birthday'];
			if($birthday == ""){
				$check = false;
				$errBirthday = "* Bạn chưa nhập ngày sinh!";
			} else {
				$errBirthday ="";
			}
			$email = $_POST['email'];
			if($email == ""){
				$check = false;
				$errEmail = "* Bạn chưa nhập Email!";
			} else {
				$errEmail ="";
			}
			if ($check) {
				$pass = md5($password);
				$sql = "INSERT INTO login (username, password, fullname, birthday, email)
				VALUES ('$username', '$pass', '$fullname', '$birthday', '$email')";
				mysqli_query($connect, $sql);		
				header("Location:login.php");
			}
		}
	?>
	<div class="container">
		<div class="content">
			<h2>Register New Account</h2>
			<form method="post" action="#" name="">
				<p class="txt">Username: <span class="color"><?php echo $errUsername;?></span></p>
				<span><input type="text" name="username" value="<?php echo $username;?>"></span>
				<p class="txt">Password: <span class="color"><?php echo $errPass; ?></span></p>
				<span><input type="text" name="password" value="<?php echo $password;?>"></span>
				<p class="txt">Họ và tên: <span class="color"><?php echo $errFullName; ?></span></p>
				<span><input type="text" name="fullname" value="<?php echo $fullname;?>"></span>
				<p class="txt">Ngày sinh: <span class="color"><?php echo $errBirthday; ?></span></p>
				<span><input type="text" name="birthday" value="<?php echo $birthday;?>"></span>
				<p class="txt">Email: <span class="color"><?php echo $errEmail; ?></span></p>
				<span><input type="text" name="email" value="<?php echo $email;?>"></span>
				<p><input type="submit" name="Submit" value="Register"></p>
			</form>
		</div>
	</div>
</body>
</html>