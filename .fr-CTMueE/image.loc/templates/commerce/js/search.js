$(function(){
    // Init star rating
    $('.hover-star').rating({

        callback: function(value, link) {
            $.ajax({
                type: "POST",
                data: "pid=" + $(this).attr('data-id') + "&val=" + value,
                url:'/shop/ajax/rate'
            });
                     
            $('.chs' + $(this).attr('data-id')).rating('readOnly', true);
        }
    });
    
    $('#order_list a').click(function(){
        $('#h_order').val($(this).attr('href'));
        $('#seacrh_p_form').submit();
        return false;
    });
    $('#perpage_list a').click(function(){
        $('#h_user_per_page').val($(this).attr('href'));
        $('#seacrh_p_form').submit();
        return false;
    });    
    $('#subcategorys a').click(function(){
        $('#h_category').val($(this).attr('href'));
        $('#seacrh_p_form').submit();
        return false;
    });    
});