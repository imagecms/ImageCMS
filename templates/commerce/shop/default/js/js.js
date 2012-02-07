$(document).ready(function(){
    // Menu
    $("#navigation ul").superfish({
                delay:       1000,                            // one second delay on mouseout
                animation:   {opacity:'fast',height:'show'},  // fade-in and slide-down animation
                speed:       'slow',                          // faster animation speed
                autoArrows:  false,                           // disable generation of arrow mark-up
                dropShadows: false                            // disable drop shadows
            });
});

function getCategoryAttributes(cId)
{
    document.getElementById('catVariants').innerHTML = "<img src='/application/modules/imagebox/templates/js/lightbox/images/loading.gif' />"
    $("#catVariants").load('/shop/ajax/getCategoryAttributes/' + cId)
}