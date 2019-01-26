<!DOCTYPE html>
<html lang="en">

<head>
    <title>Check Out</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/products.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
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

    <div class="container">
        <h2>Personal Information</h2>
        <form class="form-horizontal" method="post" action="<?php echo $localHost; ?>/view/confirmation.php">
            <div class="form-group">
                <label class="control-label col-sm-2" for="fullname">Full Name:</label>
                <div class="col-sm-10">
                    <input type="name" class="form-control" id="fullname" name="fullname" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="address1">Address Line 1:</label>
                <div class="col-sm-10">
                    <input type="address" class="form-control" id="address1" placeholder="Street address, P.O. box, company name, c/o" name="address1" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="address2">Address Line 2:</label>
                <div class="col-sm-10">
                    <input type="address" class="form-control" id="address2" placeholder="Apartment, suite, unit, building, floor, etc." name="address2" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="city">City:</label>
                <div class="col-sm-10">
                    <input type="city" class="form-control" id="city" name="city" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="state">State: </label>
                <div class="col-sm-10">
                    <input type="state" class="form-control" id="state" name="state" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="zip">ZIP/Postal Code:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="zip" name="zip" required="true">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                    <a class="btn btn-default" href="<?php echo $localHost; ?>/view/shoppingCart.php">
                        Return to cart
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
