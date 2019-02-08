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
    <table>
        <tr>
            <td>
                <i class="glyphicon glyphicon-chevron-right"></i>
            </td>
            <td>
                <?php include_once $GLOBALS['root'] . '/Views/lookup/filters.php'; ?>
            </td>
        </tr>
    </table>
</div>
<?php include_once $GLOBALS['root'] . '/Views/lookup/list.php'; ?>
