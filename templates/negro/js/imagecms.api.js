/**
 * AuthApi ajax client
 * Makes simple request to api controllers and get return data in json
 * 
 * @author Avgustus
 * @copyright ImageCMS (c) 2013, Avgustus <avgustus@yandex.ru>
 * 
 * Get JSON object with fields list:
 *      'status'    -   true/false - if the operation was successful,
 *      'msg'       -   info message about result,
 *      'refresh'   -   true/false - if true refreshes the page,
 *      'redirect'  -   url - redirects to needed url
 *    
 * List of api methods:
 *      Auth.php:
 *          '/auth/authapi/login',
 *          '/auth/authapi/logout',
 *          '/auth/authapi/register',
 *          '/auth/authapi/forgot_password',
 *          '/auth/authapi/reset_password',
 *          '/auth/authapi/change_password',
 *          '/auth/authapi/cancel_account',
 *          '/auth/authapi/banned'
 * 
 **/
var ImageCMSApi = {
    defSet: imageCmsApiDefaults,
    debugMode: true,
    returnMsg: function(msg) {
        if (this.debugMode === true && window.console) {
            console.log(msg);
        }
    },
    formAction: function(url, selector, obj) {
        //collect data from form
        var DS = this.defSet;
        $.extend(DS, obj)
        if (selector !== '')
            var dataSend = this.collectFormData(selector);
        else
            var dataSend = '';

        //send api request to api controller
        $.ajax({
            type: "post",
            data: dataSend,
            url: url,
            dataType: "json",
            beforeSend: function() {
                ImageCMSApi.returnMsg("=== Sending api request to " + url + "... ===");
            },
            success: function(obj) {
                if (obj !== null) {
                    var form = $('#' + selector);
                    ImageCMSApi.returnMsg("[status]:" + obj.status);
                    ImageCMSApi.returnMsg("[message]: " + obj.msg);
                    if (obj.status == true) {
                        if (DS.hideForm)
                            form.hide();
                        if (DS.messagePlace == 'ahead')
                            $(message.success(obj.msg)).prependTo(form.parent());
                        if (DS.messagePlace == 'behind')
                            $(message.success(obj.msg)).appendTo(form.parent());
                        drawIcons(form.parent().find(genObj.msgF).find(selIcons));
                    }
                    if (obj.cap_image != 'undefined' && obj.cap_image != null) {
                        ImageCMSApi.addCaptcha(obj.cap_image);
                    }
                    if (obj.validations != 'undefined' && obj.validations != null) {
                        ImageCMSApi.sendValidations(obj.validations, selector);
                    }
                    if (obj.refresh == true)
                        location.reload();
                    if (obj.redirect !== null)
                        if (typeof obj.redirect !== 'undefined')
                            if (obj.redirect !== false) {
                                location.href = obj.redirect;
                            }
                    if (obj.refresh != true && obj.redirect !== 'undefined') {
                        if (typeof DS.callback == 'function')
                            DS.callback(obj.msg, obj.status, form, DS.hideForm, DS.durationHideForm);
                        
                        setTimeout((function() {
                            form.parent().find(genObj.msgF).fadeOut();
                            if (DS.hideForm)
                                form.show();
                        }), DS.durationHideForm);
                    }
                }
                return this;
            },
        }).done(function() {
            ImageCMSApi.returnMsg("=== Api request success!!! ===");
        }).fail(function() {
            ImageCMSApi.returnMsg("=== Api request breake with error!!! ===");
        });
        return;
    },
    //find form by data-id attr and create serialized string for send
    collectFormData: function(selector) {
        var findSelector = $('#' + selector);
        var queryString = findSelector.serialize();
        return queryString;
    },
    /**
     * for displaying validation messages 
     * add <div id="for_{input_name}" class="for_validations"></div>
     * in the form, which needs validation, for each validate input
     * 
     * */
    sendValidations: function(validations, selector) {
        var thisSelector = $('#' + selector);
        if (typeof validations === 'object') {
            for (var key in validations) {
                if (validations[key] != "") {
                    thisSelector.find('[name=' + key + ']').addClass(genObj.err);
                    thisSelector.find('label#for_' + key).addClass(genObj.err).html(validations[key]).show();
                    thisSelector.find(':input.' + genObj.err + ':first').focus();
                }
            }
        } else {
            return false;
        }
    },
    /**
     * add captcha block if needed
     * @param {type} captcha_image
     * @returns {undefined}
     */
    addCaptcha: function(captcha_image) {
        var html = '<span class="title">Код протекции</span>\n\
                        <span class="frame-form-field">\n\
                            <input type="text" name="captcha" value="Код протекции"/> \n\
                            <span class="help-block" id="for_captcha_image">' + captcha_image + '</span>\n\
                            <label id="for_captcha" class="for_validations"></label>\n\
                        </span>';
        $('#captcha_block').html(html);
        return false;
    }

}
/**
 * NotificationsApi ajax client
 * Makes simple request to api controllers and get return data in json
 * 
 * @author Avgustus
 * @copyright ImageCMS (c) 2013, Avgustus <avgustus@yandex.ru>
 * 
 * Get JSON object with fields list:
 *      'status'    -   true/false - if the operation was successful,
 *      'msg'       -   info message about result,
 *      'refresh'   -   true/false - if true refreshes the page,
 *      'redirect'  -   url - redirects to needed url
 *      'close'     -   closes modal window
 *    
 * List of api methods:
 *      ajax.php:
 *          '/shop/ajax/getApiNotifyingRequest',
 *          '/shop/callbackApi'
 * 
 **/

var Notification = {
    debugMode: true,
    formClass: ".drop-content",
    returnMsg: function(msg) {
        if (this.debugMode === true) {
        }
    },
    formAction: function(url, selector, hideEl) {
        //collect data from form
        if (selector !== '')
            var dataSend = this.collectFormData(selector);
        else
            var dataSend = '';

        //send api request to api controller
        $.ajax({
            type: "post",
            data: dataSend,
            url: url,
            dataType: "json",
            beforeSend: function() {
                Notification.returnMsg("=== Sending api request to " + url + "... ===");
            },
            success: function(obj) {
                if (obj !== null) {
                    Notification.returnMsg("[status]:" + obj.status);
                    Notification.returnMsg("[message]: " + obj.msg);
                    if (obj.validations !== 'undefined') {
                        Notification.sendValidations(obj.validations, selector);
                    }
                    var drop = $(Notification.formClass);
                    var form = drop.find('form#' + selector);
                    if (obj.status === true) {
                        form.add($(Notification.formClass).find(hideEl)).hide();
                        form.before(message.success(obj.msg));
                        drawIcons($(genObj.msgF).find(selIcons));

                        if (obj.close === true) {
                            setTimeout((function() {
                                drop.drop('triggerBtnClick', function() {
                                    drop.find(genObj.msgF).fadeOut(function() {
                                        $(this).remove();
                                        form.show();
                                    })
                                });
                            }), 3000);
                        }
                    }
                }
                return this;
            },
        }).done(function() {
            Notification.returnMsg("=== Api request success!!! ===");
        }).fail(function() {
            Notification.returnMsg("=== Api request breake with error!!! ===");
        });
        return;
    },
    //find form by data-id attr and create serialized string for send
    collectFormData: function(selector) {
        var findSelector = $('#' + selector);
        var queryString = findSelector.serialize();
        return queryString;
    },
    /**
     * for displaying validation messages 
     * add <div id="for_{input_name}" class="for_validations"></div>
     * in the form, which needs validation, for each validate input
     * 
     * */
    sendValidations: function(validations, selector) {
        var thisSelector = $('#' + selector);
        if (typeof validations === 'object') {
            for (var key in validations) {
                if (validations[key] != "") {
                    thisSelector.find('[name=' + key + ']').addClass(genObj.err);
                    thisSelector.find('label#for_' + key).addClass(genObj.err).html(validations[key]).show();
                    thisSelector.find(':input.' + genObj.err + ':first').focus();
                }
            }
        } else {
            return false;
        }
    },
};


$(document).ready(function() {
    $('form input, textarea').live('input', function() {
        if ($.exists($('label#for_' + $(this).attr('name')))) {
            $('label#for_' + $(this).removeClass(genObj.err + ' ' + genObj.scs).attr('name')).hide();
        }
    });
});

