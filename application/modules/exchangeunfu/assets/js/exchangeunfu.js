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

    $('.partnersSelected').live('change', function() {
        var current = $(this);
        var partners = new Array();
        $('.regionName').each(function() {
            if ($(this).html() && $(this).html() != '--Не выбрано--') {
                partners.push($(this).html());
            }

        });

        current.removeClass('partnersSelected');
        $('.partnersSelected option:selected').each(function() {
            if ($(this).text() && $(this).text() != '--Не выбрано--') {
                partners.push($(this).text());
            }
        });
        current.addClass('partnersSelected');

        var inArr = $.inArray(current.find('option:selected').text(), partners);
        if (inArr >= 0) {
            current.val('false')
            showMessage('Ошыбка', 'Не возможно создать цены дважды для партнера');
        }



    })

    $('.partnerRefresh').on('click', function() {
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

    $('.updatePartnerPrice').on('click', function() {
        console.log()
        if ($(this).closest('tr').find('input.pricePartner').css('display') == 'none') {
            showMessage('Ошыбка', "Для редактирования кликните по Цене или Количестве.", 'r');
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
                showMessage('Сообщение', "Обновление успешное.");
            }
        });

    });

    $('.deletePartnerPrice').die().live('click', function() {
        var product_external_id = $(this).closest('tr').data('productid')
        var partner = $(this).closest('tr').data('partner');
        $(this).closest('tr').remove();
        if (!$('.partnerData').length) {
            $('.PartnersTable').css('display', 'none');
            $('.alert-info').css('display', 'block');
        }

        $.ajax({
            type: 'POST',
            data: {
                product_external_id: product_external_id,
                partner: partner
            },
            url: '/exchangeunfu/deletePartner',
            success: function(data) {
                showMessage('Сообщение', "Удаление успешное.");
            }
        });

    });

    $('.setHitPartner').on('click', function() {
        var product_external_id = $(this).closest('tr').data('productid')
        var partner = $(this).closest('tr').data('partner');
        var hit = 0;
        if (!$(this).hasClass('btn-primary')) {
            hit = 1;
            $(this).addClass('btn-primary');
        }
        $.ajax({
            type: 'POST',
            data: {
                product_external_id: product_external_id,
                partner: partner,
                hit: hit
            },
            url: '/exchangeunfu/setHit',
            success: function(data) {
                showMessage('Сообщение', "Значение изменено.");
            }
        });
    });

    $('.setHotPartner').on('click', function() {
        var product_external_id = $(this).closest('tr').data('productid')
        var partner = $(this).closest('tr').data('partner');
        var hot = 0;
        if (!$(this).hasClass('btn-primary')) {
            hot = 1;
            $(this).addClass('btn-primary');
        }
        $.ajax({
            type: 'POST',
            data: {
                product_external_id: product_external_id,
                partner: partner,
                hot: hot
            },
            url: '/exchangeunfu/setHot',
            success: function(data) {
                showMessage('Сообщение', "Значение изменено.");
            }
        });
    });

    $('.setActionPartner').on('click', function() {
        var product_external_id = $(this).closest('tr').data('productid')
        var partner = $(this).closest('tr').data('partner');
        var action = 0;
        if (!$(this).hasClass('btn-primary')) {
            action = 1;
            $(this).addClass('btn-primary');
        }
        $.ajax({
            type: 'POST',
            data: {
                product_external_id: product_external_id,
                partner: partner,
                action: action
            },
            url: '/exchangeunfu/setAction',
            success: function(data) {
                showMessage('Сообщение', "Значение изменено.");
            }
        });
    });

});