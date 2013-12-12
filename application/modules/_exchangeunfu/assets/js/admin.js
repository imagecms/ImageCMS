$(document).ready(function() {
    $('.partnerRefresh').on('click', function() {
        var TR = $(this).closest('tr');
        var name = TR.find('div.name').text();
        var prefix = TR.find('div.prefix').text();
        var code = TR.find('div.code').text();
        var region = TR.find('div.region').text();
        TR.find('input.name').val(name);
        TR.find('input.prefix').val(prefix);
        TR.find('input.code').val(code);
        TR.find('input.region').val(region);

        TR.find('div.name').css('display', 'none');
        TR.find('div.prefix').css('display', 'none');
        TR.find('div.code').css('display', 'none');
        TR.find('div.region').css('display', 'none');

        TR.find('input.name').css('display', 'block');
        TR.find('input.prefix').css('display', 'block');
        TR.find('input.code').css('display', 'block');
        TR.find('input.region').css('display', 'block');

        $(this).css('display', 'none');
        $(this).next('.partnerUpdate').css('display', 'block');

    });

    $('.partnerUpdate').on('click', function() {
        var TR = $(this).closest('tr');
        var partner_id = TR.data('partnerid');
        var name = TR.find('input.name').val();
        var prefix = TR.find('input.prefix').val();
        var code = TR.find('input.code').val();
        var region = TR.find('input.region').val();

        $.ajax({
            type: 'POST',
            data: {
                name: name,
                prefix: prefix,
                code: code,
                region: region,
                partner_id: partner_id
            },
            url: '/exchangeunfu/admin/updatePartner',
            success: function(data) {
                showMessage(lang('Message'), lang('Partner updated'));
            }
        });

        TR.find('div.name').text(name);
        TR.find('div.prefix').text(prefix);
        TR.find('div.code').text(code);
        TR.find('div.region').text(region);

        TR.find('input.name').css('display', 'none');
        TR.find('input.prefix').css('display', 'none');
        TR.find('input.code').css('display', 'none');
        TR.find('input.region').css('display', 'none');

        TR.find('div.name').css('display', 'block');
        TR.find('div.prefix').css('display', 'block');
        TR.find('div.code').css('display', 'block');
        TR.find('div.region').css('display', 'block');

        $(this).css('display', 'none');
        $(this).prev('.partnerRefresh').css('display', 'block');

    });

    $('.deletePartner').on('click', function() {
        var TR = $(this).closest('tr');
        var partner_id = TR.data('partnerid');
        TR.remove();
        $.ajax({
            type: 'POST',
            data: {
                partner_id: partner_id
            },
            url: '/exchangeunfu/admin/deletePartner',
            success: function(result) {
                if(result){
                    showMessage(lang('Message'), lang('Partner successfully deleted'));
                }else{
                    showMessage(lang('Message'), lang('Partner not deleted'), 'r');
                }
            }
        });
    });

    $('.addPartnerBtn').on('click', function() {
        $('.newPartner').css('display', 'table-row');
    });
    
    $('.partnerAdd').on('click', function() {
        var TR = $(this).closest('tr');
        
        var count = TR.find('.countPartners').html();
        var name = TR.find('input.name').val();
        var prefix = TR.find('input.prefix').val();
        var code = TR.find('input.code').val();
        var region = TR.find('input.region').val();

        $.ajax({
            type: 'POST',
            data: {
                name: name,
                prefix: prefix,
                code: code,
                region: region,
                count: count
            },
            url: '/exchangeunfu/admin/addPartner',
            success: function(data) {
                if(data){
                    showMessage(lang('Message'), lang('Partner successfully added'));
                    $(data).insertBefore(TR);
                }else{
                    showMessage(lang('Error'), lang('Partner not added'), 'r');
                }          
            }
        });
        
        TR.css('display', 'none');
        TR.find('input.name').val('');
        TR.find('input.prefix').val('');
        TR.find('input.code').val('');
        TR.find('input.region').val('');

    });
});