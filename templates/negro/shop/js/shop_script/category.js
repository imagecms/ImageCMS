$(document).ready(function(){
    $('.cleare_filter').click(function(){
        nm = $(this).data('name');
        //alert(nm);
        $('#'+nm+' input').attr('checked',false);
        $('#catalog_form').submit();
        return false;
    })
    $('.cleare_price').click(function(){
        $('#minCost').val(def_min);
        $('#maxCost').val(def_max);
        $('#catalog_form').submit();
        return false;
    })
 
    $('.sort_current li').live('click',function(){
        sort_current(this);
    })
})    

function set_per_page(elem){
    val = $(elem).val();
    $.ajax({
        type: 'post',
        data: 'count_items='+val,
        url: '/shop/shop/per_page_cookie',
        success: function(){
            window.location.reload();
        }
    })
}

function sort_current(elem){
    val = $(elem).find('button').val();
    //alert(val);
    $('input[name=order]').val(val);
    if ($.exists('#catalog_form')){
        $('#catalog_form').submit();
    }else if ($.exists('#seacrh_p_form')){
        $('#seacrh_p_form').submit();
    }
}


function change_variant(elem, pid){
    var_id = $(elem).val();
    $('.prod_'+pid).removeClass('d_i-b').addClass('d_n');
    $('.var_'+var_id).removeClass('d_n').addClass('d_i-b');
    if ($.exists('.items-catalog')){
        $('.prod_price_'+pid).removeClass('d_i-b').addClass('d_n');
        $('.var_price_'+var_id).removeClass('d_n').addClass('d_i-b');
    }
    if ($.exists('.prod_photo_block')){
        $('.prod_photo_block').removeClass('d_b').addClass('d_n').removeAttr('rel');
        $('.var_photo_'+var_id).removeClass('d_n').addClass('d_b').attr('rel','group').fancybox({
            'padding' : 0,
            'margin' : 0,
            'overlayOpacity' : 0.7,
            'overlayColor' : '#000',
            'showNavArrows' : true,
            'scrolling' : 'no'
        });
    }
    if ($.exists('.addphoto_price_container')){   
        addPhotoContent(var_id);
    }
}

function addPhotoContent(var_id){
    var insert = $('#main_pic_'+var_id+' .mainphoto_price_container .t-a_c').clone();
    $('.addphoto_price_container').empty().append(insert);
    var insert = $('#main_pic_'+var_id+' .fencyProductInfoMain').html();
    $('.fencyProductInfoAdd').empty().append(insert);
}