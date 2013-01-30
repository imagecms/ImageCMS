/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var ImageCMSApi = {
    sendRequest: function(url, data) {
        $.ajax({
            type: "post",
            data: "apikey=" + this.getApiKey() + data,
            url: url,
            dataType: "json",
            beforeSend: function() {
                console.log("Sending api request to " + url + "...");
            },
            success: function(obj) {
                return obj;
                //console.log(obj);
            }
        }).done(function() {
            console.log("Api request success");
        })
                .fail(function() {
            console.log("Api request breake with error");
        })
                .always(function() {
            console.log("Api request complete");
        });
        return;
    },
    getApiKey: function() {
        return "apiRequest";
    }
}


