<?php
   session_start();
   unset($_SESSION["username"]);
   
   echo 'Bạn đã đăng xuất thành công!';
   header('Refresh: 2; URL = login.php');
?>