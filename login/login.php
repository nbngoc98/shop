
<?php
error_reporting(0);
session_start();

include 'connect.php';
if(isset($_POST["Submit"])){
		//Validate form

		$user_name = $_POST['username'];
		$errUsername ="";	
		$pass = $_POST['password'];
		$errPass ="";
		$check = true;
		if($user_name == ""){
			$check = false;
			$errUsername = "Bạn chưa nhập Username!";
		} else {
			$errUsername ="";
		}
		if($pass == ""){
			$check = false;
			$errPass = "Bạn chưa nhập Password!";
		} else {
			$errPass ="";
		}
        if ($check) {
        		$pass1 = md5($pass);
				$sql = "SELECT * FROM login WHERE username LIKE '".$user_name."' AND password LIKE '".$pass1."'";
				$result = $connect->query($sql);

				if ($result->num_rows == 0) {
					echo '<script type="text/javascript">alert("Đăng nhập không thành công - Mời kiểm tra lại!")</script>';
					} else {
		     				?>
								<script language="javascript">
								window.alert("Chúc mừng bạn đã đăng nhập thành công!");
								window.location="home.php"
								</script>
							<?php
								$_SESSION['username']= $user_name;
								$_SESSION['password']= $pass1;
								exit();
							}
				$connect->close();
			}
	}
?>  
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="login.css">
	
</head>
<body>
	<div class="container">
		<div class="content">
			<form method="POST" action="login.php">
				<div class="form">
					<h2>Login Now</h2>
					<div class="form1">
						<div class="use_name">
							<h4>Username:</h4>
							<p><input type="text" name="username" placeholder="Username" value="<?php echo $user_name;?>"></p>
							<span style="color: aqua"><?php echo $errUsername; ?></span>
						</div>
						<div class="pass">
							<h4>Password:</h4>
							<p><input type="password" name="password" placeholder="Password" value="<?php echo $pass;?>"></p>
							<span style="color: aqua"><?php echo $errPass; ?></span>
						</div>
						<div>
							<p class="register">Register User? <a href="register.php">Click here</a></p>
						</div>
					</div>	
					<div class="form2">
						<input type="submit" name="Submit" value="Login">
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>