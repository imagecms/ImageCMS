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
    debugMode: true,
    returnMsg: function(msg) {
        if (this.debugMode === true) {
            console.log(msg);
        }
    },
    formAction: function(url, selector) {
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
                ImageCMSApi.returnMsg("=== Sending api request to " + url + "... ===");
            },
            success: function(obj) {
                if (obj !== null) {
                    ImageCMSApi.returnMsg("[status]:" + obj.status);
                    ImageCMSApi.returnMsg("[message]: " + obj.msg);
                    if (obj.validations !== 'undefined') {
                        ImageCMSApi.sendValidations(obj.validations, selector);
                    }
                    if (obj.refresh == true)
                        location.reload();
                    if (obj.redirect !== null)
                        if (typeof obj.redirect !== 'undefined')
                            if (obj.redirect !== false) {
                                location.href = obj.redirect;
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
        if (typeof validations === 'object') {
            for (var key in validations) {
                //console.log($('#' + selector).find('#for_' + key));
                $('#' + selector).find('div#for_' + key).show(1500);
                $('#' + selector).find('div#for_' + key).html(validations[key]);
                $('#' + selector).find('div#for_' + key).css('color', 'red');
            }
            setTimeout((function() {
                $('div .for_validations').hide(1500);
            }), 6000);
        } else {
            return false;
        }
    },
}


