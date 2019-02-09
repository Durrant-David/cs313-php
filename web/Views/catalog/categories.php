<?php defined('_CSEXEC') or die; ?>
<style>
    img {
        width: 300px;
    }
    
    .product {
        margin: 30px;
    }
</style>
<div class="container">
    <?php 
    $category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '';
    if ($category == ''){
        echo $this->controller->displayCategories(); 
    } else {
        echo $this->controller->displayCategory($category); 
    }
    ?>
</div>