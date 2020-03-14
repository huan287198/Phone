<?php
    $open = 'product';
    
    require_once("../../autoload/autoload.php");

    $products = $db->fetchAll('products');
    $color = $db->fetchAll('color');
    $rom = $db->fetchAll('rom');
    $ram = $db->fetchAll('ram');
?>
<?php require_once("../../layouts/header.php")?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../../index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.php">Product</a>
                </li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
            <!-- Page Content -->
            <h1>Add Phone</h1>
            <br>
            <div class="clearfix">
            </div>
            <?php require_once("../../../partials/notification.php") ?>
        </div>
        <!-- /.container-fluid -->
        <div class="row">
            <div class="col-md-12 bor">
                <form class="form-horizontal" method="POST" enctype='multipart/form-data'>
                    <!-- <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">.col-md-6</div>
                        <div class="col-md-6">.col-md-6</div>
                    </div>
                    <div> -->
                    <div class="form-group">
                    <div class="row">
                        <label for="product" class="col-md-2 control-label d-flex justify-content-end">Product</label>
                        <div class="col-md-9">
                        <select class="form-control" name="product">
                            <?php
                                foreach($products as $row):
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                        </div>
                    </div>  
                    </div>
                    <div class="form-group">
                    <div class="row">
                    <label for="imei" class="col-sm-2 control-label d-flex justify-content-end">Imei</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" max="9999999999999999" name="imei" placeholder="888888888888888" required="true">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label for="color" class="col-sm-2 control-label d-flex justify-content-end">Color</label>
                        <div class="col-sm-9">
                        <select class="form-control " name="color">
                            <?php
                                foreach($color as $row):
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label for="ram" class="col-sm-2 control-label d-flex justify-content-end">Ram</label>
                        <div class="col-sm-9">
                        <select class="form-control " name="ram">
                            <?php
                                foreach($ram as $row):
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label for="rom" class="col-sm-2 control-label d-flex justify-content-end">Rom</label>
                        <div class="col-sm-9">
                        <select class="form-control " name="rom">
                            <?php
                                foreach($rom as $row):
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label for="chip" class="col-sm-2 control-label d-flex justify-content-end">Chip</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="chip" name="chip" placeholder="A13" >
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label for="bettery" class="col-sm-2 control-label d-flex justify-content-end">Bettery</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="bettery" name="bettery" placeholder="4000 mAh" >
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label for="camera" class="col-sm-2 control-label d-flex justify-content-end">Camera</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="camera" name="camera" placeholder="12 mpx" >
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label for="display" class="col-sm-2 control-label d-flex justify-content-end">Display</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="display" placeholder="6.1 inch" >
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label for="price" class="col-sm-2 control-label d-flex justify-content-end">Price</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" id="price" name="price" placeholder="9.000.000" required="true">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label for="qty" class="col-sm-2 control-label d-flex justify-content-end">Quantity</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" id="qty" name="qty" placeholder="100" required="true" min="0">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label for="sale" class="col-sm-2 control-label d-flex justify-content-end">Sale</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" id="sale" name="sale" placeholder="10 %" value="0">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label for="thumbnail" class="col-sm-2 control-label d-flex justify-content-end">Thumbnail</label>
                        <div class="col-sm-9">
                        <img id="output"/>
                        <input type="file"  id="thumbnail" name="thumbnail" accept="image/*"  onchange="loadFile(event)">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-11 d-flex justify-content-end">
                        <button type="submit" name="submit" class="btn btn-success">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Your Website 2019</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->
<script src = "<?php echo ("http://localhost:81/myproject/Web2/public/ckeditor/ckeditor.js"); ?>"></script>
<script>
    var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
        };
    reader.readAsDataURL(event.target.files[0]);
    };

    CKEDITOR.replace('content', {
        height: 200,
        filebrowserUploadUrl: "<?php echo ("http://localhost:81/myproject/Web2/public/ckeditor/ck_upload.php"); ?>",
        filebrowserUploadMethod: "form"
    });

</script>

<?php
  if(isset($_POST['submit'])){
    $thumbnail = null;
    // Thực hiện upload ảnh vào folder Uploads
    if(!empty($_FILES["thumbnail"]["name"])){
        $time = time();
        $target_file = 'D:/xampp/htdocs/myproject/web2/public/uploads/products/'.$time.'-'.basename($_FILES["thumbnail"]["name"]);
        move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file);
        $thumbnail = $time.'-'.basename($_FILES["thumbnail"]["name"]);
    }
    $product_id = $_POST['product'];
    $imei =  $db->escapePostParam("imei");
    $color_id = $_POST['color'];
    $rom_id = $_POST['rom'];
    $ram_id = $_POST['ram'];
    $chip =  $db->escapePostParam("chip");
    $bettery = $db->escapePostParam("bettery");
    $camera = $db->escapePostParam("camera");
    $display = $db->escapePostParam("display");
    $price =  $db->escapePostParam("price");
    $qty = $db->escapePostParam("qty");
    $sale = $db->escapePostParam("sale");

    $count = 0;
    $phone = $db->db_query("select * from phone where product_id = $product_id");
    foreach($phone as $row){
        if($row['color_id'] == $color_id && $row['rom_id'] == $rom_id && $row['ram_id'] == $ram_id){
            $count++;
        }
        if($imei == $row['imei']){
            $count++;
        }
    }
    //_debug($count);
    if($count > 0){
        $_SESSION['error'] = "Da co san pham nay roi!";
        echo '<script type="text/javascript">location.href="addPhone.php"</script>';
    }else{
        $result = $db->addPhone($product_id, $imei, $color_id, $rom_id, $ram_id, $chip, $bettery, $camera, $display, $price, $qty, $sale, $thumbnail);
        if($result) {
            $_SESSION['success'] = "Them moi thanh cong";
            echo '<script type="text/javascript">location.href="index.php"</script>';
        } else {
            $_SESSION['error'] = "Them moi that bai";
        }
    }
}
    
?>
<?php require_once("../../layouts/footer.php")?>
        