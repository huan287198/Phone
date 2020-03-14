<?php
    require_once("../../autoload/autoload.php");
    if(!isset($_SESSION["email"])){
        echo '<script type="text/javascript">alert("Ban chua dang nhap");location.href="../product/index.php";</script>';
    }
    $user = $db->fetchID("account", intval($_SESSION['id']));
?>
<?php
    require_once("../../layouts/header.php");
?>

<div class="col-md-9 ">
    <section class="box-main1" >
        <h3 class="title-main"><a href="#">Pay</a> </h3>
            <br>
            <form class="form-horizontal" method="POST" enctype='multipart/form-data'>
            <div class="form-group">
                <label for="username" class="col-md-3 control-label">User Name</label>
                <div class="col-md-9">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Name" value="<?php echo $user['name']; ?>" readonly="">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email@gmail.com" value="<?php echo $user['email']; ?>" readonly="">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-md-3 control-label">Phone</label>
                <div class="col-md-9">
                    <input type="number" name="phone" id="phone" class="form-control" placeholder="1234567890" value="<?php echo $user['phone']; ?>" readonly="">
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-md-3 control-label">Address</label>
                <div class="col-md-9">
                    <input type="text" name="address" id="address" class="form-control" placeholder="Ha Noi" value="<?php echo $user['address']; ?>" readonly="">
                </div>
            </div>
            <div class="form-group">
                <label for="total" class="col-md-3 control-label">total</label>
                <div class="col-md-9">
                    <input type="text" name="total" id="total" class="form-control"value="<?php echo $_SESSION['total']; ?>" readonly="">
                </div>
            </div>
            <div class="form-group">
                <label for="note" class="col-md-3 control-label">Note</label>
                <div class="col-md-9">
                    <input type="text" name="note" id="note" class="form-control" placeholder="note" >
                </div>
            </div>
            <div class="form-group ">
                <div class="col-sm-9 col-sm-offset-3">
                    <button type="submit" class="btn btn-primary pull-right" name="submit">Pay</button>
                </div> 
            </div>
        </form>
    </section>
</div>
<?php
    if(isset($_POST["submit"])){
        $amount = $_SESSION['total'];
        $user_id = $_SESSION['id'];
        $address = $db->escapePostParam("address");
        $note = $db->escapePostParam("note");
        $tran_id = $db->addBillExport($amount, $user_id, $address, $note);
        if($tran_id) {
            foreach($_SESSION['cart'] as $key => $value){
                $transaction_id = $tran_id;
                $product_id = $key;
                $qty = $value['qty'];
                $price = $value['price'];
                $result = $db->addDetailBillExport($transaction_id, $product_id, $qty, $price);
            }
            unset($_SESSION['sum']);
            unset($_SESSION['total']);
            unset($_SESSION['cart']);
            $_SESSION['success'] = "Luu don hang thanh cong. Chung toi se lien he voi ban som nhat!";
            echo "<script>location.href='notification.php';</script>";
            
        } else {
            
        }

    }

?>

<?php
    require_once("../../layouts/footer.php");
?>   