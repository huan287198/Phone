<?php
    require_once("../../autoload/autoload.php");
    $key = intval($_GET['key']);
    if($key == 0){
        unset($_SESSION['cart']);
    }else{
        unset($_SESSION['cart'][$key]);
    }
    $_SESSION['success'] = "Xoa san pham trong gio thanh cong !";
    header("location:cart.php");
?>