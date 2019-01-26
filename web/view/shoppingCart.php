<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shopping Cart</title>
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
        <h2>Shopping Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                include_once($root . "/controller/addToCart.php");
                foreach($products as $product) {
                    if (isset($_SESSION["product-" . $product["id"]])) {
                        $quantity = (int)$_SESSION["product-" . $product["id"]];
                        if ($quantity > 0) {
                            $total += $product['price'] * $quantity;
                        ?>
                <tr>
                    <style>
                        /*Make sure session data loads properly*/
                        window.onload = function() {
                            if(!window.location.hash) {
                                window.location = window.location + '#loaded';
                                window.location.reload();
                            }
                        }
                    </style>
                    <td><?php echo $product['product']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><input type="number" oninput="addToCart(<?php echo $product["id"]; ?>, this.value); location.reload()" value="<?php echo $quantity; ?>"></td>
                    <td><button type="button" class="btn btn-default btn-sm" onclick="addToCart(<?php echo $product["id"]; ?>, 0); location.reload()"><span class="glyphicon glyphicon-trash" ></span></button></td>
                </tr>
                <?php 
                        }
                    }
                }
                ?>
                <tr>
                    <td></td>
                    <td><b>Total: </b><?php echo $total; ?></td>
                    <td>
                        <a href="<?php echo $localHost; ?>/view/products.php">
                            <button>Keep Shopping</button>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo $localHost; ?>/view/checkout.php">
                            <button>
                                Check Out
                            </button>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
