$(document).ready(function () {
    ga("ec:addProduct", {
        "id": "'" + id + "'",
        "name": "'" + name + "'",
        "price": "'" + price + "'",
        "brand": "'" + brand + "'",
        "category": "'" + category + "'"
    });
    ga("ec:setAction", "detail");
    ga("send", "pageview");
});