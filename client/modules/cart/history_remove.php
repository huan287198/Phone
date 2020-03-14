<?php
    require_once("../../autoload/autoload.php");
    
    if (isset(($_GET["id"]))) {
        $id = intval($_GET['id']);
        $sql = "select * from bill_export where id=$id ";
        $result =  $db->db_single($sql);
        //_debug($result);
        if($result['status'] == 1){
            echo '<script type="text/javascript">alert("Ban khong the xoa giao dich nay!");location.href="history.php";</script>';
        }else{
            $sql2 = "delete from detail_bill_export where bill_export_id = $id";
            $r =  $db->db_query($sql2);
            $sql = "delete from bill_export where id = $id";
            $r =  $db->db_query($sql);
            echo '<script type="text/javascript">alert("Xoa giao dich thanh cong!");location.href="history.php";</script>';
        }
    }
    
?>