<div class="container">
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
    
    include_once($root . "/model/products.php"); 
    $products = getProducts();
    
    foreach($products as $product) {
    ?>
    <!-- Modal -->
    <div class="modal fade" id="productInfo-<?php echo $product["id"]; ?>" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <?php echo $product["product"]; ?>
                    </h4>
                </div>
                <div class="modal-body">
                    <img src="<?php echo $localHost . $product['img']; ?>">
                    <p><?php echo $product["description"]; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default">Add to cart</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <?php } ?>
</div>
