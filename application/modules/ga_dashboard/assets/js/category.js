$(document).ready(function () {
    for(var gaProductKey in gaProducts){
        ga("ec:addImpression", gaProducts[gaProductKey])
    }
    ga("send", "pageview");
});