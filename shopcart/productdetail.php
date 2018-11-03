<?php
    session_start();
    include_once("config.php");
?>
<html>
<header>
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/portfolio-item.css" rel="stylesheet">
</header>
<body>
        <h1 id="h1">Shop Giày Đà Nẵng</h1>
        <a id="car" href="cart.php"><img id="cart" src="images/cart.png"></a>
    <div id="products-wrapper">
        <div class="products">
        <?php
        //URL hiện tại của trang. cart_update.php sẽ chuyển lại trang này.
        $current_url = base64_encode($_SERVER['REQUEST_URI']);
            
             $sql = "SELECT * FROM product WHERE product_id = $id ORDER BY product_id ASC";
            $results = mysqli_query($connect, $sql);

            if ($results) {
                while($obj = $results->fetch_object())
                {
                    echo '<div class="container">';
                      echo '<form method="post" action="cart_update.phpid=<?php echo $id?>">';
                      echo '<h1 class="my-4">'.$obj->name.'</h1>';
                      echo '<div class="row">';
                      echo '<div class="col-md-8">';
                      echo '<img src="images/'.$obj->image.'" width="80%" style="margin-bottom: 55px;">';
                      echo '</div>';
                      echo '<div class="col-md-4">';
                      echo '<h3 class="my-3">Description</h3>';
                      echo ' <p>'.$obj->productdesciption.'</p>';
                      echo '<h3 class="my-3">Price</h3>';
                      echo '<p style="color: red">'.$obj->price.$currency.'</p>';
                      echo '<button style="margin-left: 5px;padding: 2px;"  class="btn btn-primary btn-sl">Thêm vào giỏ hàng</button>';
                      echo '</ul>';
                      echo '</div>';
                      echo '</div>';
                      echo '<input type="hidden" name="product_id" value="'.$obj->product_id.'" />';
            echo '<input type="hidden" name="type" value="add" />';
            echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
                      echo '</div>';


                    
                }
            
        }
        ?>
        </div>

        
    </div>

</body>
</html>