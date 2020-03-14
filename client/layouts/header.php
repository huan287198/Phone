<!DOCTYPE html>
<html>
    <head>
        <title>Shop</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="http://localhost:81/myproject/Web/public/frontend/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="http://localhost:81/myproject/Web/public/frontend/css/bootstrap.min.css">
        
        <script  src="http://localhost:81/myproject/Web/public/frontend/js/jquery-3.2.1.min.js"></script>
        <script  src="http://localhost:81/myproject/Web/public/frontend/js/bootstrap.min.js"></script>
        <!---->
        <link rel="stylesheet" type="text/css" href="http://localhost:81/myproject/Web/public/frontend/css/slick.css"/>
        <link rel="stylesheet" type="text/css" href="http://localhost:81/myproject/Web/public/frontend/css/slick-theme.css"/>
        <!--slide-->
        <link rel="stylesheet" type="text/css" href="http://localhost:81/myproject/Web/public/frontend/css/style.css">
        
    </head>
    <body>
        <div id="wrapper">
            <!---->
            <!--HEADER-->
            <div id="header">
                <div id="header-top">
                    <div class="container">
                        <div class="row clearfix">
                            <div class="col-md-6" id="header-text">
                                <a>BAHShop</a><b>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </b>
                            </div>
                            <div class="col-md-6">
                                <nav id="header-nav-top">
                                    <ul class="list-inline pull-right" id="headermenu">
                                        <?php if(isset($_SESSION['id'])):?>
                                        <li>
                                            
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-user"></i> 
                                                    <?php echo $_SESSION['email']; ?>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a href="">Contact</a></li>
                                                        <li><a href="">Cart</a></li>
                                                        <li><a href="../auth/logout.php"><i class="fa fa-share-square-o"></i>Logout</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <?php else:?>
                                        <li>
                                            <a href="../auth/login.php"><i class="fa fa-unlock"></i> Login</a>
                                        </li>
                                        <li>
                                            <a href="../auth/register.php"><i class="fa fa-share-square-o"></i> Register</a>
                                        </li>
                                        <?php endif;?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row" id="header-main">
                        <div class="col-md-5">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label>
                                        <select name="category" class="form-control">
                                            <option> All Category</option>
                                            <option> Dell </option>
                                            <option> Hp </option>
                                            <option> Asus </option>
                                            <option> Apper </option>
                                        </select>
                                    </label>
                                    <input type="text" name="keywork" placeholder=" input keywork" class="form-control">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <a href="">
                                <img src="http://localhost:81/myproject/Web2/public/frontend/images/logo-default.png">
                            </a>
                        </div>
                        <div class="col-md-3" id="header-right">
                            <div class="pull-right">
                                <div class="pull-left">
                                    <i class="glyphicon glyphicon-phone-alt"></i>
                                </div>
                                <div class="pull-right">
                                    <p id="hotline">HOTLINE</p>
                                    <p>0986420994</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END HEADER-->


            <!--MENUNAV-->
            <div id="menunav">
                <div class="container">
                    <nav>
                        <div class="home pull-left">
                            <a href="../product/index.php">Trang chủ</a>
                        </div>
                        <!--menu main-->
                        <ul id="menu-main">
                            <li>
                                <a href="../product/index.php">Shop</a>
                            </li>
                            <li>
                                <a href="">Blog</a>
                            </li>
                            <li>
                                <a href="../cart/history.php">History</a>
                            </li>
                            <li>
                                <a href="">About us</a>
                            </li>
                        </ul>
                        <!-- end menu main-->

                        <!--Shopping-->
                        <ul class="pull-right" id="main-shopping">
                            <li>
                                <a href="../cart/cart.php"><i class="fa fa-shopping-basket"></i> My Cart </a>
                            </li>
                        </ul>
                        <!--end Shopping-->
                    </nav>
                </div>
            </div>
            <!--ENDMENUNAV-->
            
            <div id="maincontent">
                <div class="container">
                    <div class="col-md-3  fixside" >
                        <div class="box-left box-menu" >
                            <h3 class="box-title"><i class="fa fa-list"></i>  Danh mục </h3>
                            <ul>
                                <?php foreach($category as $row):?>
                                <li>
                                    <a href="http://localhost:81/myproject/Web2/client/modules/product/category.php?id=<?php echo $row['id'];?>"><?php echo $row['name']; ?></a>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </div>

                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm mới </h3>
                           <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul>
                                <?php foreach($productNew as $row):?>
                                 <li class="clearfix">
                                    <a href="#">
                                        <img src="<?php echo "http://localhost:81/myproject/Web2/public/uploads/products/".$row['thumbnail'];?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"><?php echo $row['name']; ?></p >
                                            <b class="price">Giảm giá: <?php echo $row['price'] - 1000000; ?></b><br>
                                            <b class="sale">Giá gốc: <?php echo $row['price']; ?></b><br>
                                            <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach;?>
                            </ul>
                            <!-- </marquee> -->
                        </div>
                    </div>