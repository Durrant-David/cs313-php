<?php defined('_CSEXEC') or die; 
?>
<style>
    .floatingBox {
        position: fixed;
        width: 150px;
        right: 0px;
    }

</style>

<div class="floatingBox">
    <?php include_once $GLOBALS['root'] . '/Views/lookup/filters.php'; ?>
</div>
<?php include_once $GLOBALS['root'] . '/Views/lookup/list.php'; ?>
