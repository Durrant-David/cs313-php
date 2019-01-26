<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/products.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <?php 
    //check if localhost
    if ( $_SERVER["SERVER_ADDR"] == '127.0.0.1' ||
         $_SERVER["SERVER_ADDR"] == '::1') {
        $localHost = "/web";
    } else {
        $localHost = "";
    }
    //get root directory
    $root = $_SERVER['DOCUMENT_ROOT'] . $localHost;
    //include main menu
    include_once($root . "/view/menu.php"); 
    //include products from database
    include_once($root . "/model/products.php"); 
    $products = getProducts();
    $productCount = count($products);
    //var_dump($products);
    ?>
    <section class="block">
        <div id="productCarousel" class="carousel slide">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#productCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#productCarousel" data-slide-to="1"></li>
                <li data-target="#productCarousel" data-slide-to="2"></li>
                <li data-target="#productCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="active item">
                    <img src="<?php echo $localHost; ?>/media/images/products/Banner_LOTR_logo.jpg" alt="Lord of the Rings" style="width:100%;">
                </div>
                <div class="item">
                    <img src="<?php echo $localHost; ?>/media/images/products/lesmisbanner.jpg" alt="Les Miserables" style="width:100%;">
                </div>
                <div class="item">
                    <img src="<?php echo $localHost; ?>/media/images/products/narnia-banner_orig.jpg" alt="Narnia" style="width:100%;">
                </div>
                <div class="item">
                    <img src="<?php echo $localHost; ?>/media/images/products/way-of-kings-banner.jpg" alt="Narnia" style="width:100%;">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#productCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#productCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <div class="container products">
        <?php 
        $i = 0;
        foreach($products as $product) { 
            if($i%2 == 0) { ?>
            <div class="row row-centered" >
            <?php } ?>
                <div class="col-sm-6 col-img">
                    <img id="product-<?php echo $product["id"]; ?>" class="img-product" src="<?php echo $localHost . $product['img']; ?>">
                    <div class="img-cart">
                        <button class="btn-cart" onclick="addToCart(<?php echo $product["id"]; ?>, 1)">Add to cart</button>
                    </div>
                    <div class="img-info">
                        <button class="btn-info" data-toggle="modal" data-target="#productInfo-<?php echo $product["id"]; ?>">More info</button>
                    </div>
                </div>
            <?php if($i%2 == 1) { ?>
            </div>
            <?php } 
            $i++;
        } ?>
    </div>
    <script src="<?php echo $root; ?>/controller/addProduct.js"></script>
    <?php include_once("product.php"); ?>
</body>

</html>
