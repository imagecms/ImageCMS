function change_page_status(page_id) {
    $.ajax({
        type: 'POST',
        url: base_url + 'admin/pages/ajax_change_status/' + page_id,
        onComplete: function(response) {
        }
    });
}

// SHOP function
//function deleteProducts() {
//    var products = {};
//    products['ids'] = [];
//    var actionURL = '/admin/components/run/shop/products/ajaxDeleteProducts/';
//    var checkedProducts = $('.products_table > tbody').children('tr').children('td').find('input:checked');
//
//    checkedProducts.each(function() {
//        products['ids'].push($(this).attr('data-id'));
//    });
//
//    if (checkedProducts.size() < 1)
//        return false;
//
//    $.ajax({
//        type: 'post',
//        data: products,
//        url: actionURL,
//        success: function(result) {
//        }
//    });
//}

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
                    //alert("positions changed successfull");
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
        console.log($(this).val());
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
         //alert("positions changed successfull");
         }
         }
         });
         */
    });


    $('.products_table').find('span.prod-on_off').live('click', function() {
        var page_id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/run/shop/products/ajaxChangeActive/' + page_id,
            onComplete: function(response) {
            }
        });
    });

    $('.products_table').find('button.setHit').live('click', function() {
        var btn = $(this);

        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/run/shop/products/ajaxChangeHit/' + btn.attr('data-id'),
            onComplete: function(response) {
            }
        });

        btn.toggleClass('btn-primary active');
    });

    $('.products_table').find('button.setHot').live('click', function() {
        var btn = $(this);

        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/run/shop/products/ajaxChangeHot/' + btn.attr('data-id'),
            onComplete: function(response) {
            }
        });

        btn.toggleClass('btn-primary active');
    });

    $('.products_table').find('button.setAction').live('click', function() {
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
    $('button.refresh_price').die('click').live('click', function() {
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

//    $('a.delete_product').live('click', function(event) {
//        event.preventDefault();
//
//        var products = {};
//        products['idss'] = [];
//        //var actionURL = $(this).attr('href');
//        var actionURL = '/admin/components/run/shop/products/ajaxDeleteProducts/';
//        var checkedProducts = $('.products_table > tbody').children('tr').children('td').find('input:checked');
//
//        checkedProducts.each(function() {
//            products['idss'].push($(this).attr('data-id'));
//        });
//
//        if (checkedProducts.size() < 1)
//            return false;
//
//        $('.products_delete_dialog').modal('hide');
//
//        //$('.products_delete_dialog').modal();
//
//        /*
//         $("#pages_delete_dialog").dialog({
//         resizable: false,
//         height:180,
//         modal: true,
//         buttons: {
//         "Продолжить": function() {
//         $.ajax({
//         type: 'post',
//         data: productsArray,
//         url: actionURL,
//         success: function(result){
//         //window.location.href = '/admin/pages/GetPagesByCategory/'+pagesArray['new_cat'];
//         //window.location.href = window.location.href;
//         }
//         });
//         },
//         "Отмена": function() {
//         $( this ).dialog( "close" );
//         }
//         }
//         });
//         */
//    });
    $('.prodFilterSelect').live('change', function(event) {
        var query_string = $('#filter_form').serialize();
        $.pjax({
            url: '/admin/components/run/shop/search/index/?'+query_string,
            container: '#mainContent'
        });
    });


//    $('.prodFilterSelect').live('change', function(event){
//        var getString = '/admin/components/run/shop/search/index/?s';
//        
//        $('.products_table > thead').children('tr.head_body').children('td').find('select').each(function(){
//            if ($(this).attr('name') == '')
//                $(this).attr('name', $(this).children(':selected').attr('name'));
//            
//            if ($(this).val() > '')
//                getString = getString + '&' + $(this).attr('name')+'='+$(this).val();
//        });
//    
//        
//        $.pjax({
//            url:getString,
//            container:'#mainContent'
//        });
//    });

});