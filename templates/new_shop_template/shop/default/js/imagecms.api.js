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
                this.returnMsg("=== Sending api request to " + url + "... ===");
            },
            success: function(obj) {
                if (obj !== null) {
                    this.returnMsg("[status]:" + obj.status);
                    this.returnMsg("[message]: " + obj.msg);
                    if (obj.refresh === 'true')
                        location.reload();
                    if (obj.redirect !== null)
                        if (obj.redirect !== 'false') {
                            location.href = obj.redirect;
                        }
                }
                return this;
            },
        }).done(function() {
            this.returnMsg("=== Api request success!!! ===");
        }).fail(function() {
            this.returnMsg("=== Api request breake with error!!! ===");
        });
        return;
    },
    //find form by data-id attr and create serialized string for send
    collectFormData: function(selector) {
        var findSelector = $('#' + selector);
        var queryString = findSelector.formSerialize();
        return queryString;
    },
    returnMsg: function(msg) {
        if (this.debugMode === true) {
            console.log(msg);
        }
    },
}


