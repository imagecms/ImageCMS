/**
 * Makes simple request to api controllers and get return data in json
 * @author Avgustus
 * @copyright ImageCMS (c) 2013, Avgustus <avgustus@yandex.ru>
 * 
 * Returns JSON object with fields:
 *      'status'    -   true/false - if the operation was successful,
 *      'msg'       -   info message about result,
 *      'refresh'   -   true/false - if true refreshes the page,
 *      'redirect'  -   url - redirects to needed url
 *    
 * List of api methods:
 *      Auth.php:
 *          '/auth/login',
 *          '/auth/logout',
 *          '/auth/register',
 *          '/auth/forgot_password',
 *          '/auth/reset_password',
 *          '/auth/change_password',
 *          '/auth/cancel_account',
 *          '/auth/banned'
 * 
 **/

var ImageCMSApi = {
    getApiKey: function() {
        return "apiRequest";
    },
    formAction: function(url, selector) {
        $.fancybox.showActivity();
        //collect data from form
        if (selector !== '')
            var dataSend = this.collectFormData(selector);
        else
            var dataSend = '';

        //send api request to api controller
        $.ajax({
            type: "post",
            data: "apikey=" + this.getApiKey() + "&" + dataSend,
            url: url,
            dataType: "json",
            beforeSend: function() {
                console.log("=== Sending api request to " + url + "... ===");
            },
            success: function(obj) {
                if (obj !== null) {
                    console.log("[status]:" + obj.status);
                    console.log("[message]: " + obj.msg);
                    if (obj.refresh == 'true') {
                        location.reload();
                    }
                    if (obj.redirect !== undefined && obj.redirect !== false) {
                        location.href = obj.redirect;
                    }
                }
                return this;
            },
        }).done(function() {
            console.log("=== Api request success!!! ===");
        })
                .fail(function() {
            console.log("=== Api request breake with error!!! ===");
        })
                .always(function() {
            $.fancybox.hideActivity();
        });
        return;
    },
    //find form by data-id attr and create serialized string for send
    collectFormData: function(selector) {
        var findSelector = $('form:[data-id="' + selector + '"]');
        var queryString = findSelector.formSerialize();
        return queryString;
    }

}


