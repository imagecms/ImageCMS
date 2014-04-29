$(document).ready(function() {
    /**
     * set begin discount date to now date
     */
    var today = new Date();
    $(".beginDateDiscount").datepicker({minDate: new Date(), dateFormat: "yy-mm-dd"});
    $(".endDateDiscount").datepicker({minDate: new Date(today.getTime() + (24 * 60 * 60 * 1000)), dateFormat: "yy-mm-dd"});

    /**
     * Change is discount active or not
     */
    $('.discounts_table').find('span.prod-on_off').add($('[data-page="tovar"]')).on('click', function() {
        var discountId = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            data: 'id=' + discountId,
            dataType: 'json',
            url: base_url + 'admin/components/init_window/mod_discount/ajaxChangeActive',
            success: function(response) {
                $('body').append(response.msg);
                if (response.status == 0) {
                    setTimeout(function() {
                        var switcher = $('span.prod-on_off[data-id="' + discountId + '"]');
                        if ($(switcher).hasClass('disable_tovar')) {
                            $(switcher).removeClass('disable_tovar').css('background-position', '-64px 0');
                        } else {
                            $(switcher).addClass('disable_tovar').css('background-position', '-92px 0');
                        }
                    }, 1000);

                }
            }
        });
    });

    /**
     * If check/unckech input for no limit count for discount
     */
    $('.spanForNoLimit').bind('click', function() {
        var isGift = $('#gift_checkbox').attr('checked') == 'checked';
        if (isGift & $(this).hasClass('spanForNoLimitCheckbox')) {
            return false;
        }
        var spanBlock = $(this);
        var checkBox = spanBlock.find('.noLimitCountCheck');
        var controlBlock = spanBlock.closest('.noLimitC');

        if (checkBox.prop('checked') == true) {
            controlBlock.find('input:text').removeAttr('disabled');
        } else {
            controlBlock.find('input:text').prop('disabled', 'disabled');
            controlBlock.find('input:text').val('');
        }
    })

    /**
     * Show/hide blocks for every type of discount
     */
    $('#selectDiscountType').bind('change', function() {
        var selectElement = $(this);
        discountType = selectElement.find("option:selected").val();

        $('.forHide').hide();
        $('#' + discountType + 'Block').show();
    })

    /**
     * Change discount value type (percent or fixed)
     */
    $('#selectTypeValue').bind('change', function() {
        var selectElement = $(this);
        valueType = selectElement.find("option:selected").val();

        $('#valueInput').val('');
        if (valueType == 1)
            $('#typeValue').text('%');
        else
            $('#typeValue').text(currencySymbolJS);
    })

    /**
     * Generate discount key and insert into input 
     */
    $('#generateDiscountKey').bind('click', function() {
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/components/init_window/mod_discount/generateDiscountKey',
            success: function(response) {
                if (response != null)
                    $('#discountKey').val(response);
            }
        });
    });

    /**
     *  Autocomplete users
     */
    if ($('#usersForDiscount').length) {
        $('#usersForDiscount').autocomplete({
            source: base_url + 'admin/components/init_window/mod_discount/autoCompliteUsers?limit=25',
            search: function(event, ui) {
                $('#usersForDiscount').css('border-color', 'coral')
            },
            select: function(event, ui) {
                userData = ui.item;
                $('#usersForDiscount').css('border-color', 'darkturquoise')
            },
            close: function(event, ui) {
                $('#discountUserId').val(userData.id);
                $('.hideAfterAutocomlite').hide();
            }
        });
    }

    /**
     * Autocomplete products
     */
    if ($('#productForDiscount').length) {
        $('#productForDiscount').autocomplete({
            source: base_url + 'admin/components/init_window/mod_discount/autoCompliteProducts?limit=25',
            search: function(event, ui) {
                $('#productForDiscount').css('border-color', 'coral')
            },
            select: function(event, ui) {
                productsData = ui.item;
                $('#productForDiscount').css('border-color', 'darkturquoise')
            },
            close: function() {
                $('#discountProductId').val(productsData.id);
                $('.hideAfterAutocomlite').hide();
            }
        });
    }


    /**
     * Make input only for numbers. If type of value == percent, then (1-100), if type of value == fixed, then type int. 
     */
    $('#valueInput').bind('keyup', function() {
        var typeOfValue = $('#selectTypeValue').val();
        var value = $(this).val();
        var regexp = /[^0-9]/gi;
        value = value.replace(regexp, '');

        // Can not begin from 0
        if (parseInt(value) == 0)
            value = '';
        $(this).val(value);

        // Percent
        if (typeOfValue == 1) {
            if (parseInt(value) > 100) {
                $(this).val(100);
            }
        }
    })

    /**
     * Make input only numbers (int)
     */
    $('.onlyNumbersInput').bind('keyup', function() {
        var value = $(this).val();
        var regexp = /[^0-9]/gi;
        value = value.replace(regexp, '');
        $(this).val(value);
    })

    /**
     * Remove discount from list
     */
    $('.removeDiscountLink').die().live('click', function() {
        var discountRow = $(this).closest('tr');
        var discountId = discountRow.data('id');
        $.ajax({
            async: false,
            type: 'POST',
            data: 'id=' + discountId,
            url: base_url + 'admin/components/init_window/mod_discount/ajaxDeleteDiscount',
            success: function(response) {
                if (response == true)
                    discountRow.hide();
                showMessage(lang('Discount deleted'), '', 'g')
            }
        })

    })

    /**
     * Filter list by discount type 
     */
    $('#selectFilterDiscountType').bind('change', function() {
        var option = $(this).val();
        if (option)
            window.location.replace(base_url + 'admin/components/init_window/mod_discount/index?filterBy=' + option);
        else
            window.location.replace(base_url + 'admin/components/init_window/mod_discount/index');
    })

    /**
     * If is selected use discount as gift
     */
    $('#giftSpanCheckbox').bind('click', function() {
        var countUsesBlock = $('.noLimitC')[0];
        if ($(this).find('input').prop('checked')) {
            $(countUsesBlock).find('#how-much').val('');
            $(countUsesBlock).find('#how-much').removeAttr('disabled');
            $(countUsesBlock).find('.spanForNoLimitCheckbox').show();
        } else {
            $(countUsesBlock).find('#how-much').val(1);
            $(countUsesBlock).find('#how-much').prop('disabled', 'disabled');
            $(countUsesBlock).find('.noLimitCountCheck').prop('checked', false);
            $(countUsesBlock).find('.spanForNoLimitCheckbox').hide();
            $(countUsesBlock).find('.spanForNoLimit').removeClass('active');
            $(countUsesBlock).find('.niceCheck').css('background-position', '-46px 0px');
        }
    });



    /** Change active or not category*/
    function changeEmtyActive() {

        $('.prod-on_off').live('click', function() {
            var $this = $(this);
            if (!$this.hasClass('disabled')) {
                if ($this.hasClass('disable_tovar')) {

                    $this.parent().attr('data-original-title', lang('No'))
                    $('.tooltip-inner').text(lang('No'));

                }
                else {

                    if ($this.parent().data('only-original-title') == undefined) {
                        $this.parent().attr('data-original-title', lang('Yes'))

                        $('.tooltip-inner').text(lang('Yes'));
                    }
                }

            }
        });
    }


});
