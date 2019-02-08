<?php defined('_CSEXEC') or die; 
?>
<style>
    .floatingBox {
        position: fixed;
        width: 180px;
        right: 0px;
        transition: right 2s;
    }
    
    .boxHidden {
        right: -140px;
    }

    i {
        font-size: 20px;
        padding: 10px
    }
</style>
<script>
    function hideBox() {
        document.getElementById("floatingBox").classList.toggle("boxHidden");
        
        var icon = document.getElementById("boxBtn").classList.contains("glyphicon-chevron-right");
        if(icon){
            document.getElementById("boxBtn").classList.add("glyphicon-chevron-left");
            document.getElementById("boxBtn").classList.remove("glyphicon-chevron-right");
        } else {
            document.getElementById("boxBtn").classList.add("glyphicon-chevron-right");
            document.getElementById("boxBtn").classList.remove("glyphicon-chevron-left");
        }
        
    }
</script>
<div id="floatingBox" class="floatingBox">
    <table>
        <tr>
            <td>
                <i id="boxBtn" onclick="hideBox()"class="glyphicon glyphicon-chevron-right"></i>
            </td>
            <td class="">
                <?php include_once $GLOBALS['root'] . '/Views/lookup/filters.php'; ?>
            </td>
        </tr>
    </table>
</div>
<?php include_once $GLOBALS['root'] . '/Views/lookup/list.php'; ?>
