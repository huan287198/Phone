<?php
    $open = 'transaction';
    require_once("../../autoload/autoload.php");
    $transaction = $db->getTransaction();
    // _debug($transaction);
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
                                                <th style="width: 100px;">Phone</th>
                                                <th style="width: 100px;">Amount</th>
                                                <th style="width: 50px;">Status</th>
                                                <th style="width: 100px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $stt = 1;
                                                foreach($transaction as $row):
                                                    //_debug($row);
                                            ?>
                                            <tr role="row" class="odd">
                                                <td><?php echo $stt ?></td>
                                                <td><?php echo $row['name1']?></td>
                                                <td><?php echo $row['phone']?></td>
                                                <td><?php echo $row['amount']?></td>
                                                <td>
                                                    <a href="status.php?id=<?php echo $row['id']; ?>" class="btn btn-sm <?php echo $row['status'] == 0 ?'btn-danger':'btn-info'?>">
                                                        <?php echo $row['status'] == 0 ? 'Chua xu ly':'Da xu ly' ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info" href="detail.php?id=<?php echo $row['id'];?>">
                                                        <i class="fa fa-edit"></i>
                                                        Detail
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
        