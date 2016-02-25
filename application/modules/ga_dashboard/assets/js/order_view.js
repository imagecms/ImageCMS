$(document).ready(function () {

    for (var gaOrderProductsKey in gaOrderProductsObject) {
        ga("ec:addProduct", gaOrderProductsObject[gaOrderProductsKey])
    }
    ga("ec:setAction", "purchase", gaOrderObject);
    ga("send", "pageview");
});