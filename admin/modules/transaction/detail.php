<?php
    $open = 'transaction';
    require_once("../../autoload/autoload.php");
    $id = intval($_GET['id']);
    $sql = "select d.qty as qty, d.price as price, p.thumbnail as thumbnail,p.product_id as product_id from detail_bill_export d inner join phone p on p.id = d.product_id  
    where d.bill_export_id = $id 
    order by d.created_at desc";
    $arr = $db->fetchsql($sql);
    //_debug($arr);
?>
<?php require_once("../../layouts/header.php") ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../../index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Transaction</li>
            </ol>
            <div class="clearfix"></div>
            <?php require_once("../../../partials/notification.php") ?>
            <!-- Page Content -->
            <h1>Transaction</h1>
            <div class="col-md-12 d-flex justify-content-end">
                <a class="btn btn-success" href="index.php">Back home</a>
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
                                                <th style="width: 200px;">Info</th>
                                                <th style="width: 80px;">Qty</th>
                                                <th style="width: 200px;">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                if(!empty($arr)):
                                                $stt = 1; foreach($arr as $key => $value):
                                            ?>
                                            <tr role="row" class="odd">
                                                <td><?php echo $stt ?></td>
                                                <?php
                                                    $product_id = $value['product_id'];
                                                    $sql= "select * from products where id = $product_id";
                                                    $name = $db->db_single($sql);
                                                ?>
                                                <td><?php echo $name['name']?></td>
                                                <td>
                                                    <img src="<?php echo "http://localhost:81/myproject/Web2/public/uploads/products/".$value['thumbnail'];?>"
                                                    style="width:100px; height:100px; border-radius:10px;" >
                                                </td>
                                                <?php 
                                                    $product_id = $value["product_id"];
                                                    $sql= "select * from phone where id = $product_id";
                                                    $phone = $db->db_single($sql);

                                                    $color_id = $phone["color_id"];
                                                    $sql= "select * from color where id = $color_id";
                                                    $color = $db->db_single($sql);
                                                ?>
                                                <?php 
                                                    $rom_id = $phone["rom_id"];
                                                    $sql= "select * from rom where id = $rom_id";
                                                    $rom = $db->db_single($sql);
                                                ?>
                                                <?php 
                                                    $ram_id = $phone["ram_id"];
                                                    $sql= "select * from ram where id = $ram_id";
                                                    $ram = $db->db_single($sql);
                                                ?>
                                                <td>
                                                    <ul>
                                                        <li>Color: <?php echo $color['name']?></li>
                                                        <li>Ram: <?php echo $ram['name']?></li>
                                                        <li>Rom: <?php echo $rom['name']?></li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <?php echo $value['qty']?>
                                                </td>
                                                <td><?php echo formatPrice($value["price"]*1.1); ?></td>
                                            </tr>
                                            <?php $stt++; endforeach; endif; ?>
                                        </tbody>
                                    </table>
                                    
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
        