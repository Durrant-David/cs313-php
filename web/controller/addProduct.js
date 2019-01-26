function addToCart(id, quantity) {
    sessionStorage.setItem("product-" + id, quantity);
}