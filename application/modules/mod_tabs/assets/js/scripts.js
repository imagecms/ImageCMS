$(document).ready(function() {
    $('#saveShopNewsCategories').die().live('click',function(){
        var data   = $('#ajaxSaveShopCategories').val();
        var contentId = $('#contentId').val();
        $.ajax({
            type: "POST",
            data:  'data='+data +'&contentId='+contentId,
            url: '/shop_news/ajaxSaveShopCategories',
            success: function(res) {
                    $('.notifications').append(res);
                }
        })
    })
})