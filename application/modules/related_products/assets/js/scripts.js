
$(document).ready(function () {
    if ($('#related_products_search_product').length) {

        var listProduct = $('#related_products_products_select');
        $('#related_products_search_product').off('keyup').on('keyup', function () {
            var productId = $(this).data('productid');
            listProduct.empty().show();
            $.ajax({
                url: '/admin/components/cp/related_products/ajaxGetProductList/?term=' + $(this).val() + '&product_id=' + productId,
                type: "post",
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        for (var i in data) {
                            if (!$('#related_products_products_list').find('option[value="' + data[i].id + '"]').length) {
                                $('<option>', {
                                    data: data[i],
                                    'data-product-name': data[i].name,
                                    'data-hreffront': data[i].fronturl,
                                    'data-hrefadmin': data[i].adminurl,
                                    value: data[i].id,
                                    text: data[i].label
                                }).appendTo(listProduct);
                            }
                        }
                    } else {
                        listProduct.empty()
                        $('<option>', {
                            text: langs.notFound,
                            disabled: 'disabled'
                        }).appendTo(listProduct);
                    }
                }
            });
        });
    }

    $('#related_products_products_select').dblclick(function () {
        var selected = $(this).find('option:selected');
        var toRecord = $(selected).clone();
        var toShow = $(selected).clone();
        var productId = $(toShow).val();

        $.ajax({
            url: '/admin/components/cp/related_products/ajaxGetProduct',
            type: "post",
            data: {
                productId: productId
            },
            success: function (data) {
                if (data) {
                    $('.related-table-body').append(data);
                    $('div.related-table').show();
                }
            }
        });


        $(toRecord).attr('selected', 'selected');
        $(toRecord).appendTo('#related_products_products_input');
        $(toShow).removeAttr('selected');
        $(toShow).appendTo('#related_products_products_list');
        $(selected).remove();

        if (!$(this).html()) {
            $(this).hide();
        }
    });

    $('.deleteRelatedProduct').die().live('click', function () {
        var selectedValue = $(this).data('productid');
        $('#related_products_products_input').find('option').each(function () {
            if ($(this).val() == selectedValue) {
                $(this).remove();
            }
        });
        $(this).closest('div.item-related').remove();

        var products = $('div.related-table').find('div.item-related');
        if (!products.length) {
            $('div.related-table').hide();
        }
    });
    $('#related_products_products_list').on('change', function () {
        $('.relatedProductsLinks').show();

        var hrefadmin = $('#related_products_products_list option:selected').data('hrefadmin');
        var hreffront = $('#related_products_products_list option:selected').data('hreffront');

        $($('.relatedProductsLinks a')[1]).attr('href', hreffront);
        $($('.relatedProductsLinks a')[0]).attr('href', hrefadmin);

    });

});