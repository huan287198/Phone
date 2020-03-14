<?php
    $open = 'transaction';
    require_once("../../autoload/autoload.php");
    
    $id = intval($_GET['id']);
    $sql = "select * from bill_export where id=$id ";
    $editTransaction =  $db->db_single($sql);

    if(empty($editTransaction)){
        $_SESSION['error'] = "Du lieu khong ton tai";
        header("location:index.php");
    }

    if($editTransaction['status'] == 1){
        $_SESSION['error'] = "Don hang da dc xu ly !";
        header("location:index.php");
    }

    $status =  1 ;

    $update = $db->update("bill_export", array("status" => $status), array("id" => $id));
    if($update > 0){
        $_SESSION['success'] = "Cap nhat thanh cong";
        $sql = "select product_id, qty from detail_bill_export where bill_export_id = $id";
        $orders = $db->fetchsql($sql);
        foreach($orders as $item){
            $idProduct = intval($item['product_id']);
            $product = $db->fetchID("phone", $idProduct);
            $qty = $product['qty']- $item['qty'];
            $upProduct = $db->update("phone", array("qty"=>$qty,"pay"=>$product['pay']+$item['qty']), array("id"=>$idProduct));
        }

        header("location:index.php");
    }else{
        //$_SESSION['error'] = "Cap nhat that bai";
    }
        
?>