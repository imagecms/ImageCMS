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
/** 
 * Uses for converting data from Pie to Bar Chart
 * @param {obj} data
 * @returns {Array|ChartData.convertDataForPieToBarChart.chartDataForReturn|Object.convertDataForPieToBarChart.chartDataForReturn|String}
 */
ChartData.convertDataForPieToBarChart = function(data) {
    var inputData = data;
    var chartDataForReturn = [];
    var tmpData = {};
    tmpData.values = [];
    if (inputData === undefined) {
        return 'false';
    }

    $.each(inputData, function(index, value) {
        var stepObj = {};
        stepObj.label = value.key;
        stepObj.value = value.y;
        tmpData.values.push(stepObj);
    });
    tmpData.key = 'Bar data';
    chartDataForReturn.push(tmpData);
    return chartDataForReturn;
}






/** Object for work with settings, filter and order params **/
var StatsSettingsAndParams = new Object();

/**
 * Set mod stats settings
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


/**
 * Send form for download image
 * @param {string} output_format
 * @returns {undefined}
 */
StatsSettingsAndParams.submitDownloadForm = function(output_format)
{
    // Get the d3js SVG element
    var tmp = document.getElementById("chartArea");
    var svg = tmp.getElementsByTagName("svg")[0];
    // Extract the data as SVG text string
    var svg_xml = (new XMLSerializer).serializeToString(svg);

    // Submit the <FORM> to the server.
    // The result will be an attachment file to download.
    var form = document.getElementById("svgform");
    form['output_format'].value = output_format;
    form['data'].value = svg_xml.translit();
    form.submit();
}



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

