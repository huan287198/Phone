<?php
    $open = 'product';
    
    require_once("../../autoload/autoload.php");

    $category = $db->fetchAll('category');
    
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
            <h1>Add Product</h1>
            <div class="clearfix">
            </div>
            <?php require_once("../../../partials/notification.php") ?>
        </div>
        <!-- /.container-fluid -->
        
        <div class="row">
            <div class="col-md-12 bor">
                <form class="form-horizontal" method="POST" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail" class="col-sm-2 control-label">Thumbnail</label>
                        <div class="col-sm-12">
                        <img id="output"/>
                        <input type="file"  id="thumbnail" name="thumbnail" accept="image/*" required="true" onchange="loadFile(event)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category" class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-12">
                        <select class="form-control " name="category">
                            <?php
                                foreach($category as $row):
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-sm-2 control-label">Content</label>
                        <div class="col-sm-12">
                        <textarea class="form-control" id="content" name="content" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
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
        $target_file = 'D:/xampp/htdocs/myproject/Web2/public/uploads/products/'.$time.'-'.basename($_FILES["thumbnail"]["name"]);
        move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file);
        $thumbnail = $time.'-'.basename($_FILES["thumbnail"]["name"]);
    }
        
    $name = $db->escapePostParam("name");
    $slug = to_slug($name);
    $category_id = $_POST['category'];
    $content = $_POST['content'];
    
    $result = $db->addProduct($name, $slug, $thumbnail, $category_id, $content);
    if($result) {
        $_SESSION['success'] = "Them moi thanh cong";
        echo '<script type="text/javascript">location.href="index.php"</script>';
    } else {
        $_SESSION['error'] = "Them moi that bai";
    }
   }
    
?>
<?php require_once("../../layouts/footer.php")?>
        