$(document).ready(function () {
    ga("ec:addProduct", {
        "id": "bc823",
        "name": "Fuelworks T-Shirt",
        "price": "92.00",
        "brand": "Fuelworks",
        "category": "T-Shirts",
        "variant": "green",
        "dimension1": "M",
        "quantity": 1
    });
    ga("ec:setAction", "add");
    ga("send", "event", "detail view", "click", "addToCart");
});