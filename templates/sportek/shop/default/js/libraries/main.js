jQuery.exists = function(selector) {
    return ($(selector).length > 0);
}
$.exists_nabir = function(nabir){
    return (nabir.length > 0);
}

jQuery(document).ready(function(){
    if ($.exists('.cycle')){
        $('.cycle ul').cycle({
            fx:         'fade',
            timeout:  2000,
            speed:    1000,
            pager:      '.pager',
            pagerAnchorBuilder: function(idx, slide) { 
                return '<a href="#"></a>'            ; 
            }
        });
    }
});