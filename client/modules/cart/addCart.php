<?php
    require_once("../../autoload/autoload.php");
    if(!isset($_SESSION["email"])){
        echo '<script type="text/javascript">alert("Ban chua dang nhap");location.href="../product/index.php";</script>';
    }
    $id = intval($_GET['id']);
    //$product =  $db->fetchID("phone", $id);
    $sql = "select a.*, b.name as name from phone a join products b on a.product_id = b.id where a.id = $id";
    $product = $db->db_single($sql);
    //_debug($product);
    if(!isset($_SESSION["cart"][$id])){
        $_SESSION["cart"][$id]["name"] = $product['name'];
        $_SESSION["cart"][$id]["thumbnail"] = $product['thumbnail'];
        $_SESSION["cart"][$id]["price"] = $product['price'];
        $_SESSION["cart"][$id]["qty"] = 1;
        $_SESSION["cart"][$id]["product_id"] = $product['product_id'];

        if($product['sale']>0){
            $_SESSION["cart"][$id]["price"] = ((100 -$product['sale'])*$product['price'])/100;
        }else{
            $_SESSION["cart"][$id]["price"] = $product['price'];
        }
    }else{
        $_SESSION["cart"][$id]["qty"] += 1;
    }
    echo '<script type="text/javascript">alert("Them vao gio hang thanh cong!");location.href="../product/index.php";</script>';
?>