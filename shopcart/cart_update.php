<?php
session_start();
include_once("config.php");
 
//Xóa giỏ hàng bằng cách hủy SESSION
if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1)
{
    $return_url = base64_decode($_GET["return_url"]); //return url
    session_destroy();
    header('Location:'.$return_url);
}
 
//Thêm sản phẩm vào giỏ hàng
if(isset($_POST["type"]) && $_POST["type"]=='add')
{
    $product_id   = filter_var($_POST["product_id"], FILTER_SANITIZE_STRING); //product id
    $product_qty  = filter_var($_POST["product_qty"], FILTER_SANITIZE_NUMBER_INT); //số lượng
    $return_url   = base64_decode($_POST["return_url"]); // url trả về
    
    //Giới hạn sản phẩm
    if($product_qty > 10){
        die('<div align="center">Ví dụ này không quá 10 sản phẩm</div>');
    }
 
    //Lấy thông tin chi tiết sản phẩm bằng product_id
    $sql="SELECT name, price FROM product WHERE product_id='$product_id' LIMIT 1";
    $results = mysqli_query($connect, $sql);
    $obj = $results->fetch_object();
    
    if ($results) { //Kiểm tra có dữ liệu hay không
        
        //Chuẩn bị array(mảng) để lưu thông tin sản phẩm 
        $new_product = array(array('name'=>$obj->name, 'id'=>$product_id, 'qty'=>$product_qty, 'price'=>$obj->price));
        
        if(isset($_SESSION["products"])) //Hàm kiểm tra nếu có sản phẩm trong giỏ hàng rồi thì cập nhật lại
        {
            $found = false; //Thiết lập mặc định ban đầu biến kiểm tra sản phẩm tồn tại thành false
            
            foreach ($_SESSION["products"] as $cart_itm) //vòng lặp mảng SESSION 
            {
                if($cart_itm["id"] == $product_id){ //sản phẩm đã tồn tại trong mảng
 
                    $product[] = array('name'=>$cart_itm["name"], 'id'=>$cart_itm["id"], 'qty'=>$product_qty, 'price'=>$cart_itm["price"]);
                    $found = true; // Thiết lập biến kiểm tra sản phẩm tồn tại thành true
                }else{
                    //item doesn't exist in the list, just retrive old info and prepare array for session var
                    $product[] = array('name'=>$cart_itm["name"], 'id'=>$cart_itm["id"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
                }
            }
            
            if($found == false) //Không tìm thấy sản phẩm trong giỏ hàng
            {
                //Thêm mới sản phẩm vào mảng
                $_SESSION["products"] = array_merge($product, $new_product);
            }else{
                //Tìm thấy sản phẩm đã có trong mảng SESSION nên chỉ cập nhật lại số lượng(QTY)
                $_SESSION["products"] = $product;
            }
            
        }else{
            //Tạo biến SESSION mới hoàn toàn nếu không có sản phẩm nào trong giỏ hàng
            $_SESSION["products"] = $new_product;
        }
        
    }
    
    //Trở về lại trang cũ
    header('Location:'.$return_url);
}
 
//Xóa sản phẩm trong giỏ hàng
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["products"]))
{
    $product_id   = $_GET["removep"]; //Lấy product_id để xóa
    $return_url     = base64_decode($_GET["return_url"]); //lấy url hiện tại
 
    
    foreach ($_SESSION["products"] as $cart_itm) //Vòng lặp biến SESSION
    {
        if($cart_itm["id"]!=$product_id){ //Lọc lại giỏ hàng, sản phẩm nào trùng product_id muốn xóa sẽ bị loại bỏ
            $product[] = array('name'=>$cart_itm["name"], 'id'=>$cart_itm["id"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
        }
        
        //Tạo mới biến SESSION lưu giỏ hàng
        $_SESSION["products"] = $product;
    }
    
    //Trở về lại trang cũ
    header('Location:'.$return_url);
}