<?php
    session_start();
    require_once("../../../libraries/Database.php");
    require_once("../../../libraries/Function.php");
    $db = new Database;
    //ds cate
    $category = $db->fetchAll("category");
    //ds sp moi
    $sqlNew = "SELECT * FROM phone WHERE 1 ORDER BY id DESC LIMIT 3";
    $productNew = $db->fetchsql($sqlNew);
?>