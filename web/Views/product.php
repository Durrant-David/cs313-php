<div class="container">
    <?php
    //get root directory
    $root = $_SERVER['DOCUMENT_ROOT'];
    
    include_once($root . "/Models/products.php"); 
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
                    <img src="<?php echo $product['img']; ?>">
                    <p><?php echo $product["description"]; ?></p>
                    <div>Price: <?php echo $product["price"]; ?></div>
                    <div>In Stock: <?php echo $product["quantity"]; ?></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="
                            <?php //if item in cart and greater then 1, don't add to cart
                                  if(isset($_SESSION["product-" . $product["id"]])) { 
                                    if ((int)$_SESSION["product-" . $product["id"]] > 1 ) {
                                        
                                    } else {
                                    ?>
                                     addToCart(
                                     <?php echo $product["id"]; ?>, 1); 
                                     location.reload()
                                     <?php
                                    }
                                  } else {
                                  ?>
                                     addToCart(
                                     <?php echo $product["id"]; ?>, 1); 
                                     location.reload()
                            <?php } ?>
                            ">Add to cart</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <?php } ?>
</div>
