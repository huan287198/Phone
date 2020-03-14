<?php
    require_once("../../autoload/autoload.php");
    if(!isset($_SESSION["email"])){
        echo '<script type="text/javascript">alert("Ban chua dang nhap");location.href="../product/index.php";</script>';
    }else{
        $id = intval($_GET['id']);
        $sql = "select d.qty as qty, d.price as price, p.thumbnail as thumbnail,p.product_id as product_id from detail_bill_export d inner join phone p on p.id = d.product_id  
        where d.bill_export_id = $id 
        order by d.created_at desc";
        $arr = $db->fetchsql($sql);
    }
     //_debug($arr);
?>
<?php
    require_once("../../layouts/header.php");
?>
<div class="col-md-9 bor">
    <section class="box-main1" >
        <h3 class="title-main"><a href="#">My History</a> </h3>
        <div class="clearfix"></div>
        <?php
            require_once("../../../partials/notification.php");
        ?>
            <table class="table table-hover" id="cartTable">
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
                <tbody id="tbody">
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
            <div class="col-sm-9 col-sm-offset-3">
                <a  class="btn btn-success pull-right" href="history.php">Back home</a>
            </div> 
    </section>
</div>

<?php
    require_once("../../layouts/footer.php");
?>  
