<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">CS 313</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <?php 
                //get root directory
                $root = $_SERVER['DOCUMENT_ROOT'];
                //include main menu
                include_once($root . "/Models/menu.php"); 
                $items = getMenuItems();
                $itemCount = count($items);
                //var_dump($dbResults);
                foreach ($items as $item) {
                    if($item["parent"] == 0){
                        $noSubItem = true;
                        foreach ($items as $subitem) {
                            if($subitem["parent"] == $item["id"]){
                                if($noSubItem == true) {
                                ?>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $item["link"]; ?>">
                                        <?php echo $item["title"]; ?><span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <?php
                                            $noSubItem = false;
                                }
                                echo '<li><a href="' . $subitem["link"] .'">' . $subitem["title"] . '</a></li>';
                            }
                        }
                        if($noSubItem == true){
                            echo '<li><a href="' . $item["link"] .'">' . $item["title"] . '</a></li>';
                        } else {
                            echo '</ul></li>';
                        }
                    }
                }
                ?>
            </ul>
            <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                include_once($root . "/Models/products.php"); 
                $product1s = getProducts();
                $total1 = 0;
                foreach($product1s as $product) {
                    if (isset($_SESSION["product-" . $product["id"]])) {
                        $quantity1 = (int)$_SESSION["product-" . $product["id"]];
                        if ($quantity1 > 0) {
                            $total1 += $quantity1;
                        }
                    }
                }
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/view/shoppingCart.php"><span class="badge"><?php echo $total1; ?></span><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
            </ul>
        </div>
    </div>
</nav>
