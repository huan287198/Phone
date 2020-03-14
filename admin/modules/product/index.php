<?php
    $open = 'product';
    require_once("../../autoload/autoload.php");
    $sql = "SELECT a.*, b.name as name, b.category_id as category_id 
    FROM phone a JOIN products b on a.product_id = b.id
    order by a.updated_at desc";
    
    $product = $db->fetchsql($sql);
?>
<?php require_once("../../layouts/header.php") ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../../index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Product</li>
            </ol>
            <div class="clearfix"></div>
            <?php require_once("../../../partials/notification.php") ?>
            <!-- Page Content -->
            <h1>Product</h1>
            <div class="col-md-12 d-flex justify-content-end">
                
                <a class="btn btn-success " href="addPhone.php">Add Phone</a>
            </div>
        </div>
        <!-- /.container-fluid -->
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th style="width: 40px;">STT</th>
                                                <th style="width: 100px;">Name</th>
                                                <th style="width: 200px;">Thumbnail</th>
                                                <th style="width: 150px;">Info</th>
                                                <th style="width: 100px;">Created</th>
                                                <th style="width: 100px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $stt = 1;
                                                foreach($product as $row):
                                            ?>
                                            <tr role="row" class="odd">
                                                <td><?php echo $stt ?></td>
                                                <td><?php echo $row['name']?></td>
                                                <td>
                                                    <img src="<?php echo "http://localhost:81/myproject/Web2/public/uploads/products/".$row['thumbnail'];?>"
                                                    style="width:100px; height:100px; border-radius:10px;" >
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>Price: <?php echo $row['price'] ?></li>
                                                        <li>Number: <?php echo $row['qty'] ?></li>
                                                        <?php 
                                                            $category = $db->fetchID("category",$row["category_id"]);
                                                            $color = $db->fetchID("color",$row["color_id"]);
                                                            $rom = $db->fetchID("rom",$row["rom_id"]);
                                                            $ram = $db->fetchID("ram",$row["ram_id"]);
                                                        ?>
                                                        <li>Color: <?php echo $color['name'] ?></li>
                                                        <li>Ram: <?php echo $ram['name'] ?></li>
                                                        <li>Rom: <?php echo $rom['name'] ?></li>
                                                        <li>Category: <?php echo $category['name'] ?></li>
                                                    </ul>
                                                </td>
                                                <td><?php echo date_format(date_create($row['updated_at']), 'd-m-Y'); ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-info" href="edit.php?id=<?php echo $row['id'];?>">
                                                        <i class="fa fa-edit"></i>
                                                        Edit
                                                    </a>
                                                    <a class="btn btn-sm btn-danger" href="delete.php?id=<?php echo $row['id'];?> " onClick = "return confirm('Are you sure?')">
                                                        <i class="fa fa-times"></i>
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $stt++; endforeach;?>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end"> 
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<?php require_once("../../layouts/footer.php")?>
        