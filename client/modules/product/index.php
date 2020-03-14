<?php
    require_once("../../autoload/autoload.php");
    $sqlHomeCate = "select name, id from category where home = 1 order by updated_at";
    $categoryHome = $db->fetchsql($sqlHomeCate);
    $data = [];
    foreach($categoryHome as $item){
        $cateId = $item['id'];
        $sql = "select * from products where category_id = $cateId";
        $productHome = $db->fetchsql($sql);
        foreach($categoryHome as $item2){
            $product_id = $item2['id'];
            $sql2 = "select * from phone where product_id = $product_id";
            $phoneHome = $db->fetchsql($sql2);
            $data[$item2['name']] = $phoneHome;
        }
    }
    
?>
<?php
    require_once("../../layouts/header.php");
?>
        <div class="col-md-9 bor">
            <section id="slide" class="text-center" >
                <img src="http://localhost:81/myproject/Web2/public/frontend/images/banner1.jpeg" class="img-thumbnail">
            </section>
            <section class="box-main1">
                <?php foreach($data as $key => $value):?>
                <h3 class="title-main"><a href=""><?php echo $key ?></a> </h3>
                <div class="showitem">
                    <?php foreach($value as $item): 
                        ?>
                        <div class="col-md-3  item-product bor">
                            <a href="detail.php?id=<?php echo $item['id']; ?>">
                                <img src="<?php echo "http://localhost:81/myproject/Web2/public/uploads/products/".$item['thumbnail'];?>" class="" width="100%" height="180">
                            </a>
                            <div class="info-item">
                                <?php 
                                    $product_id = $item['product_id'];
                                    $sql= "select * from products where id = $product_id";
                                    $name = $db->db_single($sql);
                                ?>
                                <a href="detail.php?id=<?php echo $item['id']; ?>"><?php echo $name['name']?></a>
                                <?php 
                                    $color_id = $item["color_id"];
                                    $sql= "select * from color where id = $color_id";
                                    $color = $db->db_single($sql);
                                ?>
                                <?php 
                                    $rom_id = $item["rom_id"];
                                    $sql= "select * from rom where id = $rom_id";
                                    $rom = $db->db_single($sql);
                                ?>
                                <?php 
                                    $ram_id = $item["ram_id"];
                                    $sql= "select * from ram where id = $ram_id";
                                    $ram = $db->db_single($sql);
                                ?>
                                <p><?php echo $color['name'].' - '.$ram['name'].' - '.$rom['name']?></p>
                                <p><strike class="sale"><?php echo $item['sale'] == 0 ?'': formatPrice($item['price']) ?></strike> <b class="price"><?php echo formatPriceSale($item['price'], $item['sale'])?></b></p>
                            </div>
                            <div class="hidenitem">
                                <p><a href="detail.php?id=<?php echo $item['id']; ?>"><i class="fa fa-search"></i></a></p>
                                <p><a href=""><i class="fa fa-heart"></i></a></p>
                                <p><a href="../cart/addCart.php?id=<?php echo $item['id']; ?>"><i class="fa fa-shopping-basket"></i></a></p>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
                <div class="clearfix"></div>
                <?php endforeach;?>
            </section>
        </div>
    
<?php
    require_once("../../layouts/footer.php");
?>     