<?php
    session_start();
    if (!isset($_SESSION['username'])) {
         header('Location: login.php');
    }
    include_once("config.php");
?>
<html>
<header>
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</header>
<body>
        <h1 id="h1">Shop Giày Đà Nẵng</h1>
        <a style="" href="login.php">Login</a>
        <a id="car" href="cart.php"><img id="cart" src="images/cart.png"></a>
        <a href = "logout.php" tite = "Logout">Logout</a>
    Chúc mừng bạn có username là <?php echo $_SESSION['username'];  ?> đã đăng nhập thành công !
    <div id="products-wrapper">
        <div class="products">
        <?php
        //URL hiện tại của trang. cart_update.php sẽ chuyển lại trang này.
        $current_url = base64_encode($_SERVER['REQUEST_URI']);
            $sql = "SELECT * FROM product ORDER BY product_id ASC";
            $results = mysqli_query($connect, $sql);
            if ($results) {
                while($obj = $results->fetch_object())
                {
                    
                    echo '<div class="product">';
                    echo '<form method="post" action="cart_update.php">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-4" id="product-thumb"><img src="images/'.$obj->image.'" width="100px"></div>';
                    echo '<div class="col-sm-3" id="product-content"><h3>'.$obj->name.'</h3></div>';
                    echo '<div class="col-sm-5" id="product-info">Giá :'.$obj->price.$currency.'<span style="margin-left:30px">Số lượng : <input style="width:35px" type="number" size="5" name="product_qty" value="1"></span><a href = "productdetail.php"><button style="margin-left: 20px;padding: 2px;"  class="btn btn-primary btn-sm">Detail Product</button></a><button style="margin-left: 20px;padding: 2px;"  class="btn btn-primary btn-sm">Thêm vào giỏ hàng</button></div>';
                    echo '</div>';
                    echo '<input type="hidden" name="product_id" value="'.$obj->product_id.'" />';
                    echo '<input type="hidden" name="type" value="add" />';
                    echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
                    echo '</form>';
                    echo '</div>';
                }
            
        }
        ?>
        </div>

        
    </div>
</body>
</html>