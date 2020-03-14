<?php
    require_once("../../autoload/autoload.php");
    if(!isset($_SESSION["email"])){
        echo '<script type="text/javascript">alert("Ban chua dang nhap");location.href="../product/index.php";</script>';
    }
    if(empty($_SESSION['cart'])){
        $_SESSION['success'] = "Khong co san pham nao trong gio hang !";
        echo '<script type="text/javascript">location.href="notification.php";</script>';
        //echo '<script type="text/javascript">alert("Ban chua co san pham nao");location.href="../product/index.php";</script>';
    }
?>
<?php
    require_once("../../layouts/header.php");
?>

<div class="col-md-9 bor">
    <section class="box-main1" >
        <h3 class="title-main"><a href="#">My Cart</a> </h3>
        <div class="clearfix"></div>
        <?php
            require_once("../../../partials/notification.php");
        ?>
            <table class="table table-hover" id="cartTable">
                <thead>
                    <tr role="row">
                        <th style="width: 40px;">STT</th>
                        <th style="width: 100px;">Name</th>
                        <th style="width: 100px;">Thumbnail</th>
                        <th style="width: 150px;">Price</th>
                        <th style="width: 40px;">Quanlity</th>
                        <th style="width: 150px;">Sum</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                        if(!empty($_SESSION['cart'])):
                        $sum = 0;
                        $stt = 1; foreach($_SESSION["cart"] as $key => $value):
                        //_debug($value);
                    ?>
                    <tr role="row" class="odd">
                        <td><?php echo $stt ?></td>
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
                        <td><?php echo $value['name'].' - '.$color['name'].' - '.$rom['name'].' - '.$ram['name']?></td>
                        <td>
                            <img src="<?php echo "http://localhost:81/myproject/Web2/public/uploads/products/".$value['thumbnail'];?>"
                            style="width:100px; height:100px; border-radius:10px;" >
                        </td>
                        <td><?php echo formatPrice($value["price"]); ?></td>
                        <td><input style="width:80px;" min="0" class="form-control qty" id="qty" type="number" name="qty" value="<?php echo $value["qty"]; ?>"/></td>
                        <td><?php echo formatPrice($value["qty"]*$value["price"]); ?></td>
                        <td>
                            <a class="btn btn-sm btn-info updatecart" data-key=<?php echo $key;?> href="#" >
                                <i class="fa fa-refresh"></i>
                                Update
                            </a>
                            <a class="btn btn-sm btn-danger" href="remove.php?key=<?php echo $key;?>" onClick = "return confirm('Are you sure?')">
                                <i class="fa fa-times"></i>
                                Remove
                            </a>
                        </td>
                    </tr>
                    <?php $sum += $value["qty"]*$value["price"]; $_SESSION["sum"] = $sum;?>
                    <?php  $stt++; endforeach; endif; ?>
                </tbody>
            </table>
            <div class="clearfix"></div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-default" href="remove.php?key=0" onClick = "return confirm('Are you sure?')">
                    <i class="fa fa-times"></i>
                    Remove All
                </a>
            </div>
            <br>
            <?php if(!empty($_SESSION["sum"])):?>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-5 pull-right">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h3>Thong tin don hang</h3>
                    </li>
                    <li class="list-group-item">
                        <span class="badge"><?php echo formatPrice($_SESSION['sum']); ?>
                        </span>So tien
                    </li>
                    <li class="list-group-item">
                        <span class="badge">10%
                        </span>Thue VAT
                    </li>
                    <li class="list-group-item">
                        <span class="badge"><?php $_SESSION['total']=(($_SESSION['sum'])*110)/100;
                            echo formatPrice($_SESSION['total']); ?>
                        </span>Tong tien
                    </li>
                    <li class="list-group-item pull-right">
                        <a href="../product/index.php" class="btn btn-success">Continue</a>
                        <a href="pay.php" class="btn btn-success">Pay</a>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
    </section>
</div>

<?php
    require_once("../../layouts/footer.php");
?>   