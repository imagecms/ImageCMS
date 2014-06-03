function change_page_status(page_id) {
//    $.ajax({
//        type: 'POST',
//        url: base_url + 'admin/pages/ajax_change_status/' + page_id,
//        onComplete: function(response) {
//            console.log(response);
//            $('.notifications').append(response);
//        }
//    });

    $.post(base_url + 'admin/pages/ajax_change_status/' + page_id, {}, function(data) {
        $('.notifications').append(data);
    })
}


$(document).ready(function() {
    $(".pages-table").live("sortstop", function(event, ui) {
        var positionsArray = {};

        $('.pages-table > tbody').children('tr').each(function() {
            positionsArray['pages_pos[' + $(this).index() + ']'] = 'page' + $(this).attr('data-id') + '_' + $(this).index();
        });

        $.ajax({
            type: 'post',
            data: positionsArray,
            url: '/admin/pages/save_positions/',
            success: function(obj) {
                if (obj.result) {
                }
            }
        });
    });

    $('a.ajax_load').click(function(event) {
        event.preventDefault();
        $('#mainContent').load($(this).attr('href'));
        /*
         $.ajax({
         type: 'get',
         url: $(this).attr('href'),
         success: function(result){
         $('#mainContent').html(result);
         }
         });
         */
    });

    $('#categorySelect').live('change', function() {
        //$('#mainContent').load($(this).attr('url')+$(this).val());
        $.pjax({url: $(this).attr('url') + $(this).val(), container: '#mainContent'});
        //
        //window.location.href = $(this).attr('url')+$(this).val();
    });

    //$( "#pages_action_dialog" ).dialog("destroy");

    $('button.pages_action').click(function(event) {

    });

    // SHOP SCRIPTS

    $(".products_table").live("sortstop", function(event, ui) {
        var positionsArray = {};

        $('.products_table > tbody').children('tr').each(function() {
            positionsArray['pages_pos[' + $(this).index() + ']'] = 'page' + $(this).attr('data-id') + '_' + $(this).index();
        });
        /*
         $.ajax({
         type: 'post',
         data: positionsArray,
         url: '/admin/pages/save_positions/',
         success: function(obj){
         if(obj.result){
         }
         }
         });
         */
    });

    $('button.setHit').live('click', function() {
        var btn = $(this);

        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/run/shop/products/ajaxChangeHit/' + btn.attr('data-id'),
            onComplete: function(response) {
            }
        });

        btn.toggleClass('btn-primary active');
    });

    $('button.setHot').live('click', function() {
        var btn = $(this);

        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/run/shop/products/ajaxChangeHot/' + btn.attr('data-id'),
            onComplete: function(response) {
            }
        });

        btn.toggleClass('btn-primary active');
    });

    $('button.setAction').live('click', function() {
        var btn = $(this);

        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/run/shop/products/ajaxChangeAction/' + btn.attr('data-id'),
            onComplete: function(response) {
            }
        });

        btn.toggleClass('btn-primary active');
    });

    //$('.products_table').find('button.refresh_price').live('click', function() {
    $('button.refresh_price').live('click', function() {
        var btn = $(this);
        var variant = btn.attr('variant-id');
        var variantId = {};
        var price = btn.parent().find('input').val();

        variantId['price'] = price;

//        console.log(variant);

        if (typeof variant !== 'undefined' && variant !== false)
            variantId['variant'] = variant;

        $.ajax({
            type: 'POST',
            data: variantId,
            url: base_url + 'admin/components/run/shop/products/ajaxUpdatePrice/' + btn.attr('data-id'),
            success: function(data) {
                $('.notifications').append(data);
            }
        });

        //btn.toggleClass('btn-primary active');
    });

    $('body').off('change').on('change', '.prodFilterSelect', function(event) {
        var query_string = $('#filter_form').serialize();
        $.pjax({
            url: '/admin/components/run/shop/search/index/?' + query_string,
            container: '#mainContent'
        });
    });

});