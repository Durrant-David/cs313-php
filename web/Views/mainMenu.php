<?php
defined('_CSEXEC') or die;
    class MainMenuView
    {

        private $model;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->model = $model;
        }

        public function navbar()
        {
            ?><nav class="navbar navbar-default">
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
                                <?php $this->controller->menuItems(); ?>
                            </ul>
<!--
                            <?php
            if ($i == 1) {
                ?>
                alert("test");
                <?php
            }
//                                if (session_status() == PHP_SESSION_NONE) {
//                                    session_start();
//                                }
//                                include_once($root . "/Models/products.php"); 
//                                $product1s = getProducts();
//                                $total1 = 0;
//                                foreach($product1s as $product) {
//                                    if (isset($_SESSION["product-" . $product["id"]])) {
//                                        $quantity1 = (int)$_SESSION["product-" . $product["id"]];
//                                        if ($quantity1 > 0) {
//                                            $total1 += $quantity1;
//                                        }
//                                    }
//                                }
                            ?>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="/view/shoppingCart.php"><span class="badge"><?php /*echo $total1;*/ ?></span><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                            </ul>
-->
                        </div>
                    </div>
                </nav>
            <?php
            
        }

    }
?>