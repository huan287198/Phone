<?php
    require_once("../../autoload/autoload.php");
?>
<?php
    require_once("../../layouts/header.php");
?>

<div class="col-md-9 bor">
    <section class="box-main1" >
        <h3 class="title-main"><a href="#">Register</a> </h3>
        <br>
        <div class="clearfix"></div>
        <?php require_once("../../../partials/notification.php") ?>
        <form class="form-horizontal" method="POST" enctype='multipart/form-data'>
            <div class="form-group">
                <label for="username" class="col-md-3 control-label">Name</label>
                <div class="col-md-9">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Name" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email@gmail.com" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Password</label>
                <div class="col-md-9">
                    <input type="password" name="password" id="password" class="form-control" placeholder="*******" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-md-3 control-label">Phone</label>
                <div class="col-md-9">
                    <input type="number" name="phone" id="phone" class="form-control" placeholder="1234567890" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-md-3 control-label">Address</label>
                <div class="col-md-9">
                    <input type="text" name="address" id="address" class="form-control" placeholder="Ha Noi" required="true">
                </div>
            </div>
            <div class="form-group">
                <label for="avatar" class="col-md-3 control-label">Avatar</label>
                <div class="col-md-9">
                    <img id="output"/>
                    <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*" required="true" onchange="loadFile(event)">
                </div>
            </div>
            <div class="form-group ">
                <div class="col-sm-9 col-sm-offset-3">
                    <button type="submit" class="btn btn-primary pull-right" name="submit">Submit</button>
                </div> 
            </div>
        </form>
    </section>
</div>
<script>
    var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
        };
    reader.readAsDataURL(event.target.files[0]);
    };
</script>
<?php
  if(isset($_POST['submit'])){
    $avatar = null;
    // Thực hiện upload ảnh vào folder Uploads
    if(!empty($_FILES["avatar"]["name"])){
        $time = time();
        $target_file = 'D:/xampp/htdocs/myproject/Web/public/uploads/accounts/'.$time.'-'.basename($_FILES["avatar"]["name"]);
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
        $avatar = $time.'-'.basename($_FILES["avatar"]["name"]);
    }
    $name = $db->escapePostParam("username");
    $password =  md5($db->escapePostParam("password"));
    $email = $db->escapePostParam("email");
    $is_check = $db->fetchOne("account", "email = '".$email."'");
    $phone = $db->escapePostParam("phone");
    $address = $db->escapePostParam("address");
    
    if($is_check != null){
        $_SESSION['error'] = "Email name da ton tai !";
    }else{
        $result = $db->addUser($name, $password, $email, $phone, $address, $avatar);
        if($result) {
            echo '<script type="text/javascript">location.href="login.php"</script>';
        } else {
            die("Error !");
        }
    }
    
}
    
?>
<?php
    require_once("../../layouts/footer.php");
?>   