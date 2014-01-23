/** Object for work with chart data **/
var ChartData = new Object();

/** 
 * Get pie data by link
 * @param {string} link
 * @returns {array|Object.getPieData.returnResult}
 */
ChartData.getData = function(link) {
    var returnResult = false;
    var getString = window.location.search;
    $.ajax({
        async: false,
        type: 'get',
        url: base_url + 'admin/components/cp/mod_stats/' + link + getString,
        success: function(response) {
            if (response) {
                try {
                    returnResult = $.parseJSON(response);
                } catch (e) {
                    return 'error parsing jsone';
                }
            }
        }
    });
    return returnResult;
};






/** Object for work with settings, filter and order params **/
var StatsSettingsAndParams = new Object();

/**
 * 
 * @param {string} name
 * @param {string} value
 * @returns {undefined} Show message with result
 */
StatsSettingsAndParams.setModStatsSetting = function(name, value) {
    $.ajax({
        async: false,
        type: 'get',
        data: 'setting=' + name + '&value=' + value,
        url: base_url + 'admin/components/cp/mod_stats/adminAdd/ajaxUpdateSettingValue',
        success: function(response) {
            if (response !== 'false') {
                showMessage('Message', 'Setting updated!');
            } else {
                showMessage('Message', 'Setting not updated!', 'r');
            }
        }
    });
};


