<?php
    require_once("../../autoload/autoload.php");
    if(!isset($_SESSION["email"])){
        echo '<script type="text/javascript">alert("Ban chua dang nhap");location.href="../product/index.php";</script>';
    }else{
        $user_id = $_SESSION['id'];
        $sql = "select b.*, a.name as name from bill_export b inner join account a on b.user_id = a.id  
        where a.id = $user_id 
        order by status, b.id desc";
        $arr = $db->fetchsql($sql);
    }
     //_debug($arr);
?>
<?php
    require_once("../../layouts/header.php");
?>
<div class="col-md-9 bor">
    <section class="box-main1" >
        <h3 class="title-main"><a href="#">My History</a> </h3>
        <div class="clearfix"></div>
        <?php
            require_once("../../../partials/notification.php");
        ?>
            <table class="table table-hover" id="cartTable">
                <thead>
                    <tr role="row">
                        <th style="width: 40px;">STT</th>
                        <th style="width: 100px;">Name</th>
                        <th style="width: 200px;">Created</th>
                        <th style="width: 200px;">Amount</th>
                        <th style="width: 80px;">Status</th>
                        <th style="width: 150px;">Action</th>
                        
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                        if(!empty($arr)):
                        $stt = 1; foreach($arr as $key => $value):
                    ?>
                    <tr role="row" class="odd">
                        <td><?php echo $stt ?></td>
                        <td><?php echo $value['name']?></td>
                        <td>
                            <?php echo $value['created_at']?>
                        </td>
                        <td><?php echo formatPrice($value["amount"]); ?></td>
                        <td>
                            <?php echo $value["status"]==1?"Đã giao hàng":"<span style='color:red;'>Chờ giao hàng</span>" ?>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-info"  href="history_detail.php?id=<?php echo $value['id']; ?>" >
                                <i class="fa fa-refresh"></i>
                                Detail
                            </a>
                            <a class="btn btn-sm btn-danger" href="history_remove.php?id=<?php echo $value['id']; ?>" onClick = "return confirm('Are you sure?')">
                                <i class="fa fa-times"></i>
                                Remove
                            </a>
                        </td>
                    </tr>
                    <?php  $stt++; endforeach; endif; ?>
                </tbody>
            </table>
    </section>
</div>

<?php
    require_once("../../layouts/footer.php");
?>  
