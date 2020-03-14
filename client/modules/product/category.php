<?php
    require_once("../../autoload/autoload.php");
    $id = intval($_GET['id']);

    $editCategory =  $db->fetchID("category", $id);

    $sql = "select * from products where category_id = $id";
    $product = $db->fetchsql($sql);
    $data = [];
    foreach($product as $item){
        $product_id = $item['id'];
        $sql2 = "select * from phone where product_id = $product_id";
        $phone = $db->fetchsql($sql2);
        $data[$item['name']] = $phone;
    }
    //_debug($data);
?>
<?php require_once("../../layouts/header.php"); ?>
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
                                <p><strike class="sale"><?php echo $item['sale'] == 0 ?'': formatPrice($item['price']) ?></strike> <b class="price"><?php echo formatPriceSale($item['price'], $item['sale'])?></b></p>
                            </div>
                            <div class="hidenitem">
                                <p><a href="detail.php?id=<?php echo $item['id']; ?>"><i class="fa fa-search"></i></a></p>
                                <p><a href=""><i class="fa fa-heart"></i></a></p>
                                <p><a href="addCart.php?id=<?php echo $item['id']; ?>"><i class="fa fa-shopping-basket"></i></a></p>
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