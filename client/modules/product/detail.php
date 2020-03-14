<?php
    require_once("../../autoload/autoload.php");
    $id = intval($_GET['id']);
    $phone =  $db->fetchID("phone", $id);
    $productId = intval($phone['product_id']);
    
    $sql = "select * from phone where product_id = $productId order by id desc limit 4";
    $similarProduct = $db->fetchsql($sql);
?>
<?php
    require_once("../../layouts/header.php");
?>

<div class="col-md-9 bor">
    <section class="box-main1" >
        <div class="col-md-6 text-center">
            <img style="height:500px;width:400px;" src="<?php echo "http://localhost:81/myproject/Web2/public/uploads/products/".$phone['thumbnail'];?>" class="img-responsive bor" id="imgmain" width="100%" height="370" data-zoom-image="<?php echo "http://localhost:81/myproject/Web/public/uploads/products/".$product['thumbnail'];?>">
        </div>
        <div class="col-md-6 bor" style="margin-top: 20px;padding: 30px;">
            <ul id="right">
                <?php 
                    $sql= "select * from products where id = $productId";
                    $name = $db->db_single($sql);
                ?>
                <li><h2><?php echo $name['name'] ?></h2></li>
                <?php
                    if($phone["sale"] == 0){
                        $mess = "Khong co khuyen mai";
                    }else{
                        $mess = "Sale: ".$phone["sale"]." %";
                    }
                ?>
                <li><p> <?php echo $mess ?> </p></li>
                <li><p>Price: <strike class="sale"><?php echo $phone['sale'] == 0 ?'': formatPrice($phone['price']) ?></strike> <b class="price"><?php echo formatPriceSale($phone['price'], $phone['sale'])?></b></p></li>
                <?php 
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
                <li><p> Color: <?php echo $color["name"] ?> </p></li>
                <li><p> Rom: <?php echo $ram["name"] ?> </p></li>
                <li><p> Ram: <?php echo $rom["name"] ?> </p></li>
                <li><p> Chip: <?php echo $phone["chip"] ?> </p></li>
                <li><p> Bettery: <?php echo $phone["bettery"] ?> </p></li>
                <li><p> Camera: <?php echo $phone["camera"] ?> </p></li>
                <li><p> Display: <?php echo $phone["display"] ?> </p></li>
                <li><a href="" class="btn btn-default"> <i class="fa fa-shopping-basket"></i>Add To Cart</a></li>
            </ul>
        </div>
    </section>
    <div class="col-md-12" id="tabdetail">
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Mô tả sản phẩm </a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <h3>Nội dung</h3>
                    <br>
                    <?php
                        $sql= "select * from products where id = $productId";
                        $product = $db->db_single($sql);
                    ?>
                    <p class="img-content"><?php echo $product['content']; ?> </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Similar Products </a></li>
            </ul>
            <div class="showitem">
                <?php foreach($similarProduct as $item):?>
                    <div class="col-md-3  item-product bor">
                        <a href="detail.php?id=<?php echo $item['id']; ?>">
                            <img src="<?php echo "http://localhost:81/myproject/Web2/public/uploads/products/".$item['thumbnail'];?>" class="" width="100%" height="180">
                        </a>
                        <div class="info-item">
                            <?php 
                                $sql= "select * from products where id = $productId";
                                $name = $db->db_single($sql);
                            ?>
                            <a href="detail.php?id=<?php echo $item['id']; ?>"><?php echo $name['name']?></a>
                            <p><strike class="sale"><?php echo $item['sale'] == 0 ?'': formatPrice($item['price']) ?></strike> <b class="price"><?php echo formatPriceSale($item['price'], $item['sale'])?></b></p>
                        </div>
                        <div class="hidenitem">
                            <p><a href="detail.php?id=<?php echo $item['id']; ?>"><i class="fa fa-search"></i></a></p>
                            <p><a href=""><i class="fa fa-heart"></i></a></p>
                            <p><a href=""><i class="fa fa-shopping-basket"></i></a></p>
                        </div>
                    </div>
                    
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>

<?php
    require_once("../../layouts/footer.php");
?>   