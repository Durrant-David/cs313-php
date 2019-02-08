function addToCart(id, quantity = 1) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("demo").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "<?php echo $localHost; ?>/controller/addToCart.php?id=" + id + "&quantity=" + quantity, true);
    xhttp.send();
}
