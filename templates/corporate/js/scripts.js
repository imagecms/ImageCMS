if (!$.isFunction($.fancybox)) {
    var loadingTimer, loadingFrame = 1;
    body.append(loading = $('<div id="fancybox-loading"><div></div></div>'));
    _animate_loading = function() {
        if (!loading.is(':visible')) {
            clearInterval(loadingTimer);
            return;
        }

        $('div', loading).css('top', (loadingFrame * -40) + 'px');
        loadingFrame = (loadingFrame + 1) % 12;
    };
    $.fancybox = function() {
    };
    $.fancybox.showActivity = function() {
        clearInterval(loadingTimer);
        loading.show();
        loadingTimer = setInterval(_animate_loading, 66);
    };
    $.fancybox.hideActivity = function() {
        loading.hide();
    };
}
var imageCmsApiDefaults = {
     msgF: '.msg',
    err: 'error', //клас
    scs: 'success', //клас
    hideForm: true,
    messagePlace: 'ahead', // behind
    durationHideForm: 3000,
    cMsgPlace: 'after', //place error
    captcha: function(ci) {
        return '<div class="frame-label"><span class="title">' + captchaText + '</span>\n\
                        <span class="frame-form-field">\n\
                            <input type="text" name="captcha" value="' + captchaText + '"/> \n\
                            <span class="help-block" id="for_captcha_image">' + ci + '</span>\n\
                        </span></div>'
    },
    captchaBlock: '#captcha_block',
    cMsg: function(name, text, classN, form) {
        form.find('[for="' + name + '"]').remove();
        return '<label for="' + name + '" class="for_validations ' + classN + '">' + text + '</label>';
    }
// callback (callback accept (msg, status, form, DS)) where DS - imageCmsApiDefaults and "any other" ex. report_appereance has drop:".drop-report" if callback return true form hide 
// any other
};
var genObj = {
    msgF: '.msg',
    err: 'error', //клас
    scs: 'success', //клас
    info: 'info' //клас
}
var message = {
    success: function(text) {
        return '<div class = "msg"><div class = "' + genObj.scs + '"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>'
    },
    error: function(text) {
        return '<div class = "msg"><div class = "' + genObj.err + '"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>'
    },
    info: function(text) {
        return '<div class = "msg"><div class = "' + genObj.info + '"><span class = "icon_info"></span><div class="text-el">' + text + '</div></div></div>'
    }
};
var optionsDrop = {
    overlayColor: '#000',
    overlayOpacity: '0.6',
    place: 'center', //noinherit(default) || inherit(ex. for ViewedProducts)
    effon: 'fadeIn',
    effoff: 'fadeOut',
    duration: 500,
    moreoneNC: false
};
function hideDrop(drop, form, durationHideForm) {
    var drop = $(drop);
    setTimeout(function() {
        drop.drop('closeDrop', drop);
    }, durationHideForm - 500/*time fadeout drop see on site*/)
    setTimeout(function() {
        drop.find(genObj.msgF).hide().remove();
        form.show();
    }, durationHideForm)
}
$(document).ready(function() {
    if (ltie7) {
        ieInput()
    }
    if (ltie8) {

    }
    try {
        var cycle = $('.cycle ul');
        cycle.cycle({
            fx: 'fade',
            timeout: 3500,
            next: '#next_slide',
            prev: '#prev_slide',
            pager: '.pager',
            pagerAnchorBuilder: function(idx, slide) {
                return '<a href="#"></a>';
            }
        });
        if (cycle.children().length > 1)
            $('#prev_slide, #next_slide').fadeIn();
    } catch (e) {
    }
    $('.menu-main').menuCorporate({
        item: $('.menu-main').find('td'),
        duration: 300,
        drop: '.frame-item-menu > ul',
        dropWidth: 500
    });
    $('[data-drop]').drop(optionsDrop);
    $(document).on('drop.click showActivity', function(e) {
        $.fancybox.showActivity();
    })
    $(document).on('drop.show drop.hide hideActivity', function(e) {
        $.fancybox.hideActivity();
    })
})