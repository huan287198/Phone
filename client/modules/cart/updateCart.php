<?php
    require_once("../../autoload/autoload.php");
    $key = intval($_GET['key']);//id product
    $qty = intval($_GET['qty']);
    $_SESSION['cart'][$key]['qty'] = $qty;
    echo 1;
    //lich su mua hang
    //chi tiet don hang
    //da xu ly thi ko the xoa
?>