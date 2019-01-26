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
                include_once($root . "/model/menu.php"); 
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
                                echo '<li><a href="' . $localHost . $subitem["link"] .'">' . $subitem["title"] . '</a></li>';
                            }
                        }
                        if($noSubItem == true){
                            echo '<li><a href="' . $GLOBALS['localHost'] . $item["link"] .'">' . $item["title"] . '</a></li>';
                        } else {
                            echo '</ul></li>';
                        }
                    }
                }
                ?>
            </ul>                       
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
            </ul>
        </div>
    </div>
</nav>
