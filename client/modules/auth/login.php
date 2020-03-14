<?php
    require_once("../../autoload/autoload.php");
?>
<?php
    require_once("../../layouts/header.php");
?>

<div class="col-md-9 bor">
    <section class="box-main1" >
        <h3 class="title-main"><a href="#">Login</a> </h3>
        <br>
        <div class="clearfix"></div>
        <?php require_once("../../../partials/notification.php") ?>
        <form action="" method="POST" class="form-horizontal" role="form" enctype='multipart/form-data'>
            <div class="form-group">
                <label for="username" class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                    <input type="email" name="username" id="username" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Password</label>
                <div class="col-md-9">
                    <input type="password" name="password" id="password" class="form-control" placeholder="*******">
                </div>
            </div>
            <div class="form-group ">
                <div class="col-sm-9 col-sm-offset-3">
                    <button type="submit" class="btn btn-primary pull-right" name="submit">Dang Nhap</button>
                </div> 
            </div>
        </form>
    </section>
</div>
<?php
  if(isset($_POST['submit'])){
    $email = $db->escapePostParam("username");
    $password =  md5($db->escapePostParam("password"));
    $is_check = $db->fetchOne("account", "email = '".$email."' and password = '".$password."'");
    if($is_check != null){
        $_SESSION["id"] = $is_check['id'];
        $_SESSION["email"] = $is_check['email'];
        echo "<script>alert(\"Dang nhap thanh cong\");location.href=\"../product/index.php\"</script>";
    }else{
        $_SESSION['error'] = "Dang nhap that bai";
    }
}
    
?>
<?php
    require_once("../../layouts/footer.php");
?>   