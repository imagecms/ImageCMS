var ChartData = new Object();
/** 
 * Get pie data by link
 * @param {string} link
 * @returns {array|Object.getPieData.returnResult}
 */
ChartData.getPieData = function(link) {
    var returnResult = false;
    $.ajax({
        async: false,
        type: 'get',
        url: base_url + 'admin/components/cp/mod_stats/' + link,
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


