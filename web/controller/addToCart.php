<?php
	@session_start();
    if(isset($_GET["id"]) && isset($_GET["quantity"])){
       $id = $_GET["id"];
	   $_SESSION["product-$id"]=$_GET["quantity"];
    }

    //check if localhost
    if ( $_SERVER["SERVER_ADDR"] == '127.0.0.1' ||
         $_SERVER["SERVER_ADDR"] == '::1') {
        $localHost = "/web";
    } else {
        $localHost = "";
    }
?>
<script>
    function addToCart(id, quantity = 1) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("demo").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "<?php echo $localHost; ?>/controller/addToCart.php?id=" + id + "&quantity=" + quantity, true);
        xhttp.send();
    }
</script>
