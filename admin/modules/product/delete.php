<?php
    $open = 'product';
    
    require_once("../../autoload/autoload.php");
    
    if (isset(($_GET["id"]))) {
        $id = intval($_GET['id']);
        $sql = "delete from phone where id=$id ";
        $result =  $db->db_query($sql);
        header("location:index.php");
    }else{
        header("location:index.php");
    }
    
?>