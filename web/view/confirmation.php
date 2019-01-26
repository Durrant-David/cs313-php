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
        <h2>Order was successful</h2>
        <div>
            <?php if(isset($_POST['fullname'])) {
                    echo htmlspecialchars($_POST['fullname']);
                }
            ?>
        </div>
        <div>
            <?php if(isset($_POST['address1'])) {
                    echo htmlspecialchars($_POST['address1']);
                }
            
             if(isset($_POST['address2'])) {
                    echo htmlspecialchars(" " . $_POST['address2']);
                }
            ?>
        </div>
        <div>
            <?php if(isset($_POST['city'])) {
                    echo htmlspecialchars($_POST['city']);
                }
            
             if(isset($_POST['state'])) {
                    echo htmlspecialchars(" " . $_POST['state']);
                }
            
             if(isset($_POST['zip'])) {
                    echo htmlspecialchars(" " . $_POST['zip']);
                }
            ?>
        </div>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach($products as $product) {
                    if (isset($_SESSION["product-" . $product["id"]])) {
                        $quantity = htmlspecialchars((int)$_SESSION["product-" . $product["id"]]);
                        if ($quantity > 0) {
                            $cond = array("id" => $product['id']);
                            $data = array("quantity" => $product['quantity'] - $quantity);
                            updateProduct($data, $cond);
                            $total += $product['price'] * $quantity;
                        ?>
                <tr>
                    <td><?php echo $product['product']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $quantity; ?></td>
                </tr>
                <?php 
                        }
                    }
                }
                //clear cart of purchased items
                session_destroy(); 
                ?>
                <tr>
                    <td></td>
                    <td><b>Total: </b><?php echo $total; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>