<?php
    session_start();
    include_once("config.php");
?>
<html>
<header>
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</header>
<body>
        <div class="shopping-cart">
        <a href="cart.php"><h2>Giỏ Hàng</h2></a>
        <?php
         $current_url = base64_encode($_SERVER['REQUEST_URI']);
            
            $sql = "SELECT * FROM product ORDER BY product_id ASC";
            $results = mysqli_query($connect, $sql);

        if(isset($_SESSION["products"]))
        {
            $total = 0;
            echo '<ol>';
            foreach ($_SESSION["products"] as $cart_itm)
            {
                echo '<li class="cart-itm">';
                echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["id"].'&return_url='.$current_url.'">&times;</a></span>';
                echo '<h3>'.$cart_itm["name"].'</h3>';
                echo '<div class="p-code">Mã sản phẩm : '.$cart_itm["id"].'</div>';
                echo '<div class="p-qty">Số lượng : '.$cart_itm["qty"].'</div>';
                echo '<div class="p-price">Giá :'.$cart_itm["price"].$currency.'</div>';
                echo '</li>';
                $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
                $total = ($total + $subtotal);
            }
            echo '</ol>';
            echo '<span class="check-out-txt"><strong class="tien">Tổng : '.$total.$currency.'</strong> <a href="view_cart.php" class="thanhtoan">Thanh toán!</a></span>';
            echo '<span class="empty-cart"><a class="xoa" href="cart_update.php?emptycart=1&return_url='.$current_url.'">Xóa tất cả</a></span>';
        }else{
            echo 'Giỏ hàng trống';
        }
        ?>
        </div>
    </div>
</body>
</html>