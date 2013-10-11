$(document).ready(function() {
    $('.addPartnerBtn').die().live('click', function() {
        $('.PartnersTable').css('display', 'table');
        $('.alert-info').css('display', 'none');

        var clonedTr = {};
        if ($('.addPartnerPrice').length > 1) {
            clonedTr = $('.addPartnerPrice')[0].clone();
            var counter = $('.addPartnerPrice')[0].find('.counterPartners').html();
            $('.addPartnerPrice')[0].find('.counterPartners').html(parseInt(counter) + 1);
        } else {
            clonedTr = $('.addPartnerPrice').clone();
            var counter = $('.addPartnerPrice').find('.counterPartners').html();
            $('.addPartnerPrice').find('.counterPartners').html(parseInt(counter) + 1);
        }

        clonedTr.removeClass('addPartnerPrice');
        clonedTr.find('.partnersSelect').addClass('partnersSelected');
        clonedTr.appendTo('.PartnersTable');
        clonedTr.css('display', 'table-row');
    });

    $('.partnersSelected').die().live('change', function() {
        var current = $(this);
        var partners = new Array();
        $('.regionName').each(function() {
            if ($(this).html() && $(this).html() != '--' + lang('Not choose') + '--') {
                partners.push($(this).data('partnercode'));
            }

        });

        current.removeClass('partnersSelected');
        $('.partnersSelected option:selected').each(function() {
            if ($(this).text() && $(this).text() != '--' + lang('Not choose') + '--') {
                partners.push($(this).val());
            }
        });
        current.addClass('partnersSelected');

        var inArr = $.inArray(current.find('option:selected').val(), partners);
        if (inArr >= 0) {
            current.val('false')
            showMessage(lang('Error'), lang('Can not create a price twice for partner'));
        }



    })

    $('.partnerRefresh').die().live('click', function() {
        var TR = $(this).closest('tr');
        var price = TR.find('div.pricePartner').text();
        var quantity = TR.find('div.quantityPartner').text();
        TR.find('div').css('display', 'none');
        TR.find('input').css('display', 'block');
        TR.find('input.pricePartner').val(price);
        TR.find('input.quantityPartner').val(quantity);
        $(this).next().css('display', 'block');
        $(this).css('display', 'none');
    });

    $('.updatePartnerPrice').die().live('click', function() {
        console.log()
        if ($(this).closest('tr').find('input.pricePartner').css('display') == 'none') {
            
            return false;
        }

        var price = $(this).closest('tr').find('input.pricePartner').val();
        var quantity = $(this).closest('tr').find('input.quantityPartner').val();
        var product_external_id = $(this).closest('tr').data('productid');
        var partner = $(this).closest('tr').data('partner');
        thisTr = $(this).closest('tr');

        thisTr.find('div.pricePartner').text(price);
        thisTr.find('div.quantityPartner').text(quantity);
        thisTr.find('input.pricePartner').css('display', 'none');
        thisTr.find('input.quantityPartner').css('display', 'none');
        $(this).closest('tr').find('div.quantityPartner').css('display', 'block');
        $(this).closest('tr').find('div.pricePartner').css('display', 'block');

        $(this).prev().css('display', 'block');
        $(this).css('display', 'none');

        $.ajax({
            type: 'POST',
            data: {
                price: price,
                quantity: quantity,
                product_external_id: product_external_id,
                partner: partner
            },
            url: '/exchangeunfu/updatePrice',
            success: function(data) {
                showMessage(lang('Message'), lang('Upgrade successful.'));
            }
        });

    });

    $('.deletePartnerPrice').die().live('click', function() {
        var product_external_id = $(this).closest('tr').data('productid')
        var partnercode = $(this).closest('tr').data('partnercode');
        $(this).closest('tr').remove();
        if (!$('.partnerData').length) {
            $('.PartnersTable').css('display', 'none');
            $('.alert-info').css('display', 'block');
        }

        $.ajax({
            type: 'POST',
            data: {
                product_external_id: product_external_id,
                partnercode: partnercode
            },
            url: '/exchangeunfu/deletePartner',
            success: function(data) {
                showMessage(lang('Message'), lang('Successful deleting.'));
            }
        });

    });

    $('.setHitPartner').die().live('click', function() {
        var product_external_id = $(this).closest('tr').data('productid')
        var partnercode = $(this).closest('tr').data('partnercode');
        var hit = 0;
        if (!$(this).hasClass('btn-primary')) {
            hit = 1;
            $(this).addClass('btn-primary');
        } else
            $(this).removeClass('btn-primary');
        $.ajax({
            type: 'POST',
            data: {
                product_external_id: product_external_id,
                partnercode: partnercode,
                hit: hit
            },
            url: '/exchangeunfu/setHit',
            success: function(data) {
                showMessage(lang('Message'), lang('Value is changed.'));
            }
        });
    });

    $('.setHotPartner').die().live('click', function() {
        var product_external_id = $(this).closest('tr').data('productid')
        var partnercode = $(this).closest('tr').data('partnercode');
        var hot = 0;
        if (!$(this).hasClass('btn-primary')) {
            hot = 1;
            $(this).addClass('btn-primary');
        } else
            $(this).removeClass('btn-primary');
        $.ajax({
            type: 'POST',
            data: {
                product_external_id: product_external_id,
                partnercode: partnercode,
                hot: hot
            },
            url: '/exchangeunfu/setHot',
            success: function(data) {
                showMessage(lang('Message'), lang('Value is changed.'));
            }
        });
    });

    $('.setActionPartner').die().live('click', function() {
        var product_external_id = $(this).closest('tr').data('productid')
        var partnercode = $(this).closest('tr').data('partnercode');
        var action = 0;
        if (!$(this).hasClass('btn-primary')) {
            action = 1;
            $(this).addClass('btn-primary');
        } else
            $(this).removeClass('btn-primary');
        $.ajax({
            type: 'POST',
            data: {
                product_external_id: product_external_id,
                partnercode: partnercode,
                action: action
            },
            url: '/exchangeunfu/setAction',
            success: function(data) {
                showMessage(lang('Message'), lang('Value is changed.'));
            }
        });
    });

});