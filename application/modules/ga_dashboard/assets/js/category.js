/* global arr */

$(document).ready(function () {
    $.each(arr, function (key, value) {
        ga("ec:addImpression", {
            "id": "'" + value.id + "'",
            "name": "'" + value.name + "'",
            "price": "'" + value.price + "'",
            "brand": "'" + value.brand + "'",
            "category": "'" + value.category + "'",
            "position": "'" + value.position + "'",
            "list": "'" + value.list + "'"
        });
    });
    ga("send", "pageview");
});