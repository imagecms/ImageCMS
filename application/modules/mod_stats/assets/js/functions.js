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



/** Translit **/
String.prototype.translit = (function() {
    var L = {
        'А': 'A', 'а': 'a', 'Б': 'B', 'б': 'b', 'В': 'V', 'в': 'v', 'Г': 'G', 'г': 'g',
        'Д': 'D', 'д': 'd', 'Е': 'E', 'е': 'e', 'Ё': 'Yo', 'ё': 'yo', 'Ж': 'Zh', 'ж': 'zh',
        'З': 'Z', 'з': 'z', 'И': 'I', 'и': 'i', 'Й': 'Y', 'й': 'y', 'К': 'K', 'к': 'k',
        'Л': 'L', 'л': 'l', 'М': 'M', 'м': 'm', 'Н': 'N', 'н': 'n', 'О': 'O', 'о': 'o',
        'П': 'P', 'п': 'p', 'Р': 'R', 'р': 'r', 'С': 'S', 'с': 's', 'Т': 'T', 'т': 't',
        'У': 'U', 'у': 'u', 'Ф': 'F', 'ф': 'f', 'Х': 'Kh', 'х': 'kh', 'Ц': 'Ts', 'ц': 'ts',
        'Ч': 'Ch', 'ч': 'ch', 'Ш': 'Sh', 'ш': 'sh', 'Щ': 'Sch', 'щ': 'sch', 'Ъ': '"', 'ъ': '"',
        'Ы': 'Y', 'ы': 'y', 'Ь': "'", 'ь': "'", 'Э': 'E', 'э': 'e', 'Ю': 'Yu', 'ю': 'yu',
        'Я': 'Ya', 'я': 'ya'
    },
    r = '',
            k;
    for (k in L)
        r += k;
    r = new RegExp('[' + r + ']', 'g');
    k = function(a) {
        return a in L ? L[a] : '';
    };
    return function() {
        return this.replace(r, k);
    };
})();

