/* 
 * Loads with the main template 
 */




/* User Information */
$(document).ready(function() {
    $('#diagramField').live('change', function() {
        var field = $(this).find("option:selected").val();
        var CookieDate = new Date();
        CookieDate.setFullYear(CookieDate.getFullYear( ) + 1);
        document.cookie = "user_info_dfield=" + field + " ;expires=" + CookieDate.toGMTString() + ";path=/";
        $('#diagramField').find("[value=" + field + "]").attr('selected', 'selected');
        $('#refreshIntervalsButton').trigger('click');
        return true;
    });
});

