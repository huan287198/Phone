<?php
    require_once("../../autoload/autoload.php");
    if(!isset($_SESSION["email"])){
        echo '<script type="text/javascript">alert("Ban chua dang nhap");location.href="../product/index.php";</script>';
    }
?>
<?php
    require_once("../../layouts/header.php");
?>

<div class="col-md-9 ">
    <section class="box-main1" >
        <h3 class="title-main"><a href="#">Notification</a> </h3>
            <br>
            <div class="clearfix"></div>
            <?php
                require_once("../../../partials/notification.php");
            ?>
            <h3 class="text-center alert alert-success">Không có sản phẩm nào trong giỏ hàng!</h3>
            <div class="col-sm-9 col-sm-offset-3">
                <a  class="btn btn-success pull-right" href="../product/index.php">Back home</a>
            </div> 
    </section>
</div>
<?php
    require_once("../../layouts/footer.php");
?>   