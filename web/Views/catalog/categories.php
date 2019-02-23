<?php defined('_CSEXEC') or die; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?php echo ucfirst($GLOBALS['requestedController']); ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>

        i {
            font-size: 20px;
            padding: 10px
        }

        .tinyimage {
            width: 80px;
        }
        
        .categories {
            width: 210px;
            height: 220px;
            margin: 10px;
        }
        
        img {
            width: 300px;
        }

        .product {
            margin: 30px;
        }
    </style>
</head>

<body>
    <div id="updateStatus"></div>
    <?php
        require_once $GLOBALS['root'] .'/Models/mainMenu.php';
        require_once $GLOBALS['root'] .'/Controllers/mainMenu.php';
        require_once $GLOBALS['root'] .'/Views/mainMenu.php';
        
        $menuController = new MainMenuController( new MainMenuModel );
        $menuObj = new MainMenuView( $menuController, new MainMenuModel);
        
        print $menuObj->navbar();
    ?>
    
    <div class="container">
        <?php 
    $category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '';
    if ($category == ''){
        $this->controller->btnNewCategory();
        $this->controller->btnNewItem();
        echo "<div class='container'>";
        $this->controller->displayCategories(); 
        echo "</div><div class='container'>";
        $this->controller->displayCategory(); 
        echo "</div>";
    } else {
        $this->controller->btnUpOneLevel($category);
        $this->controller->btnNewCategory($category);
        $this->controller->btnNewItem($category);
        echo "<div class='container'>";
        $this->controller->displayCategories($category); 
        echo "</div><div class='container'>";
        $this->controller->displayCategory($category); 
        echo "</div>";
        
    }
    ?>
    </div>
</body>

</html>
