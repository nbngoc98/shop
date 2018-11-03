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
    <center><h1>Shop Giày Đà Nẵng</h1></center><hr>
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
                    echo '<div class="col-sm-5" id="product-info">Giá :'.$obj->price.$currency.'<span style="margin-left:30px">Số lượng : <input style="width:35px" type="number" size="5" name="product_qty" value="1"></span><button style="margin-left: 20px;padding: 2px;"  class="btn btn-primary btn-sm">Detail Product</button><button style="margin-left: 20px;padding: 2px;"  class="btn btn-primary btn-sm">Thêm vào giỏ hàng</button></div>';
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

        <div class="shopping-cart">
        <a href="cart.php"><h2>Giỏ Hàng</h2></a>
        <?php
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