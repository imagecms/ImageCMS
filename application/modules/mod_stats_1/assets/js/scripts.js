/* 
 * Loads once with the main template 
 */
/* User Information */
$(document).ready(function() {
    $('section.mod_stats').on('change', '#diagramField', function() {
        var field = $(this).find("option:selected").val();
        var CookieDate = new Date();
        CookieDate.setFullYear(CookieDate.getFullYear() + 1);
        document.cookie = "user_info_dfield=" + field + " ;expires=" + CookieDate.toGMTString() + ";path=/";
        $('#diagramField').find("[value=" + field + "]").attr('selected', 'selected');
        $('#refreshIntervalsButton').trigger('click');
        return true;
    });
    /**
     * Menu hide/show blocks
     */
    $('section.mod_stats').on('click', 'a.firstLevelMenu', function() {
        var submenuBlock = $(this).closest('li').next('.submenu');
        if (!$(submenuBlock).is(":visible")) {
            $('.submenu').slideUp();
            submenuBlock.slideDown();
        }
    });
    /**
     * Click on menu item. Show the appropriate template with chart.
     */
    $('section.mod_stats').on('click', '.linkChart', function() {
        var thisEl = $(this);
        /** Get link for ajax from data attribute **/
        var dataHref = thisEl.data('href');
        /** Get params for preparing data **/
        var params = getParamsForPrepareData(dataHref);
        $('.linkChart').removeClass('active');
        thisEl.addClass('active');
        drawChartsAndRefresh(params[0], params[1]);
    });


    /**
     * Choose chart type 
     */
    $('section.mod_stats').on('change', '#selectChartType', function() {
        var selectElement = $(this);
        var chartType = selectElement.find("option:selected").val();
//        drawChartsAndRefresh('products', 'brands');
        $('.hideChart').hide();
        $('#' + chartType).fadeIn();
        $('#selectChartType').find("[value=" + chartType + "]").attr('selected', 'selected')
    });

    // --------------------------------------------------------

    /**
     * Set time interval for day, week, month, year
     */

    $('section.mod_stats').on('click', '.intervalButton', function() {
        var CookieDate = new Date;
        var interval = $(this).data('group');
        var nowDate = new Date();
        var startDate = new Date();
        var endDate = new Date();
        var startDateForInput = '';
        var endDateForInput = '';

        if ($(".linkChart.active").data('href') === undefined) {
            return;
        }

        /** Date for saving cookies(one year) **/
        CookieDate.setFullYear(CookieDate.getFullYear( ) + 1);

        /** Prepare times interval for day, week, month, year**/
        switch (interval) {
            case 'day':
                startDate = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate());
                endDate = new Date(nowDate.getFullYear(), nowDate.getMonth(), (nowDate.getDate() + 1));
                break;

            case 'month':
                startDate = new Date(nowDate.getFullYear(), nowDate.getMonth());
                endDate = new Date(nowDate.getFullYear(), (nowDate.getMonth() + 1));
                break;
            case 'year':
                startDate = new Date(nowDate.getFullYear(), 0);
                endDate = new Date((nowDate.getFullYear() + 1), 0);
                break;
        }

        /** Prepare values for start and end date inputs **/
        startDateForInput = startDate.getFullYear() + '-' + ('0' + (startDate.getMonth() + 1)).slice(-2) + '-' + ('0' + (startDate.getDate())).slice(-2);
        endDateForInput = endDate.getFullYear() + '-' + ('0' + (endDate.getMonth() + 1)).slice(-2) + '-' + ('0' + (endDate.getDate())).slice(-2);

        /** Set values for start and end date inputs **/
        $('.date_start').val(startDateForInput);
        $('.date_end').val(endDateForInput);

        var CookieDate = new Date();
        CookieDate.setFullYear(CookieDate.getFullYear( ) + 1);

        /**Save cookies **/
        document.cookie = "start_date_input=" + startDateForInput + ";expires=" + CookieDate.toGMTString() + ";path=/";
        document.cookie = "end_date_input=" + endDateForInput + ";expires=" + CookieDate.toGMTString() + ";path=/";

        /** Refresh page **/
        $('#refreshIntervalsButton').trigger('click');

    });

    /** Select and save to cookies group by type **/
    $('section.mod_stats').on('change', '#selectGroupBy', function() {
        var CookieDate = new Date();
        var selectElement = $(this);
        var groupBy = selectElement.find("option:selected").val();

        /** Date for saving cookies(one year) **/
        CookieDate.setFullYear(CookieDate.getFullYear( ) + 1);
        document.cookie = "group_by=" + groupBy + ";expires=" + CookieDate.toGMTString() + ";path=/";

        /** Refresh page **/
        $('#refreshIntervalsButton').trigger('click');

    });

    /**
     * Refresh interval button click
     */
    $('section.mod_stats').on('click', '#refreshIntervalsButton', function() {
        var thisEl = $(".linkChart.active");
        /** Get link for ajax from data attribute **/
        var dataHref = thisEl.data('href');

        if (dataHref === undefined) {
            return;
        }

        /** Get params for preparing data **/
        var params = getParamsForPrepareData(dataHref);

        var CookieDate = new Date;
        CookieDate.setFullYear(CookieDate.getFullYear( ) + 1);

        var startDateForInput = $('.date_start').val();
        var endDateForInput = $('.date_end').val();
        document.cookie = "start_date_input=" + startDateForInput + ";expires=" + CookieDate.toGMTString() + ";path=/";
        document.cookie = "end_date_input=" + endDateForInput + ";expires=" + CookieDate.toGMTString() + ";path=/";

        drawChartsAndRefresh(params[0], params[1]);
    });

    /**
     * Save search results setting value
     */
    $('section.mod_stats').on('click', '#saveSearchResultsSpan', function() {
        var spanBlock = $(this);
        var checkBox = spanBlock.find('#saveSearchResultsCheckbox');
        var newValue; // new value for saving to database

        /** Get new property **/
        if (checkBox.prop('checked') === true) {
            newValue = 0;
        } else {
            newValue = 1;
        }

        setModStatsSetting('save_search_results', newValue);

    });


    /**
     * Save page url setting value
     */
    $('section.mod_stats').on('click', '#saveUrlData', function() {
        var spanBlock = $(this);
        var checkBox = spanBlock.find('#saveUrlDataCheckbox');
        var newValue; // new value for saving to database

        /** Get new property **/
        if (checkBox.prop('checked') === true) {
            newValue = 0;
        } else {
            newValue = 1;
        }

        setModStatsSetting('save_page_urls', newValue);
    });


    function setModStatsSetting(name, value) {
        $.ajax({
            async: false,
            type: 'get',
            data: 'notLoadMain=true&setting=' + name + '&value=' + value,
            url: base_url + 'admin/components/cp/mod_stats/ajaxUpdateSettingValue',
            success: function(response) {
                if (response !== 'false') {
                    showMessage('Message', 'Setting updated!');
                } else {
                    showMessage('Message', 'Setting not updated!', 'r');
                }
            }
        });
    }

    /**
     * Autocomplete products
     */
    if ($('#productForStats').length) {
        $('#productForStats').autocomplete({
            source: base_url + 'admin/components/cp/mod_stats/autoCompliteProducts?limit=25&notLoadMain=true',
            select: function(event, ui) {
                productsData = ui.item;
            },
            close: function() {
                $('#statsProductId').val(productsData.id);
            }
        });
    }

    /**
     * Show info about product
     */
    $('section.mod_stats').on('click', '#productInfoButtonShow', function() {
        var productId = $('#statsProductId').val();
        var responseArray;
        if (productId === '' || productId === undefined) {
            return;
        }

        $.ajax({
            async: false,
            type: 'get',
            data: 'notLoadMain=true',
            url: base_url + 'admin/components/cp/mod_stats/ajaxGetProductInfoById/' + productId,
            success: function(response) {
                if (response !== 'false') {
                    try {
                        responseArray = $.parseJSON(response);
                    } catch (e) {
                        return 'error parsing jsone';
                    }
                    $('#productInfoTableContainer').show();
                    $.each(responseArray, function(index, value) {
                        $('#productInfoTableValue' + index).html(value);
                    });
                }
            }
        });
    });

    /** 
     * Select category change
     */
    $('section.mod_stats').on('change', '#selectCategoryId', function() {
        var selectElement = $(this);
        var categoryId = selectElement.find("option:selected").val();
        var CookieDate = new Date();

        /** Date for saving cookies **/
        CookieDate.setFullYear(CookieDate.getFullYear( ) + 1);
        document.cookie = "cat_id_for_stats=" + categoryId + " ;expires=" + CookieDate.toGMTString() + ";path=/";
        $('#refreshIntervalsButton').trigger('click');

    });

    /** 
     * Show/Hide select with categories list
     */
    $('section.mod_stats').on('click', '#selectCategoryHideShow', function() {
        $('#categoriesMultiSelectBlock').toggle();
    });

    /**
     * Re draw chart with new selected categorie's ids
     */
    $('section.mod_stats').on('click', '#withSelectedCategoriesDrawChartButton', function() {
        var catIds = [];
        var CookieDate = new Date();
        var jsonCategoriesIds;
        CookieDate.setFullYear(CookieDate.getFullYear( ) + 1);

        $('#selectCategoriesIds option:selected').each(function(i, selected) {
            catIds[i] = $(selected).val();
        });

        try {
            jsonCategoriesIds = JSON.stringify(catIds);
        } catch (e) {
            console.log(e.name);
        }
        document.cookie = "selected_cat_ids_prod_stat=" + jsonCategoriesIds + " ;expires=" + CookieDate.toGMTString() + ";path=/";

        $('#refreshIntervalsButton').trigger('click');
    });

    /** 
     * Start analisis brands in search results
     */
    $('section.mod_stats').on('click', '#startBrandsAnalisInSearch', function() {
        var wordsQuantity = $('#quantityOfWordsStatsSearch').val();
        var resultsQuantity = $('#resultsStatsSearch').val();
        var useLocale = $('#useLocaleCheckbox').prop('checked');
        var CookieDate = new Date();
        CookieDate.setFullYear(CookieDate.getFullYear( ) + 1);

        document.cookie = "words_quantity_search_stats=" + wordsQuantity + " ;expires=" + CookieDate.toGMTString() + ";path=/";
        document.cookie = "results_quantity_search_stats=" + resultsQuantity + " ;expires=" + CookieDate.toGMTString() + ";path=/";
        document.cookie = "use_locale_search_stats=" + useLocale + " ;expires=" + CookieDate.toGMTString() + ";path=/";

        $('#refreshIntervalsButton').trigger('click');
        $('.chartBlock').show();

    });


});





function getParamsForPrepareData(link) {

    if (link === undefined) {
        return false;
    }

    var splitedArray = link.split('/');
    /** Create array with params which we need**/
    var params = [];
    params[0] = splitedArray[splitedArray.length - 2];
    params[1] = splitedArray[splitedArray.length - 1];
    if (params instanceof Array) {
        return params;
    } else {
        return 'false';
    }
}

/**
 * Prepare data for drawing chart. Return chart type and data 
 * @param {string} className - php class name
 * @param {string} method - php method name
 * @returns {object}
 */

function prepareData(className, method) {
    var returnResult;
    /** Send ajax request by className and method**/
    if (className != false && method != false) {
        $.ajax({
            async: false,
            type: 'get',
            data: 'notLoadMain=' + 'true',
            url: base_url + 'admin/components/init_window/mod_stats/getStatsData/' + className + '/' + method,
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
    }

    if (returnResult !== undefined && returnResult.type === 'line') {
        returnResult = convertValuesForLineChart(returnResult);
    }

    return returnResult;
}

/**
 * Convert values to Float
 * @param {object} data
 * @returns {_L1.convertValuesForLineChart.data}
 */
function convertValuesForLineChart(data) {
    var forProcessing = data.data;
    $.each(forProcessing, function(indexF) {
        newForProcessing = forProcessing[indexF];
        $.each(newForProcessing.values, function(indexS) {
            forProcessing[indexF].values[indexS].y = parseFloat(newForProcessing.values[indexS].y);
        });
    });
    data.data = forProcessing;
    return data;
}

/**
 * Convert data for pie to bar chart
 * @param {object} data
 * @returns {String}
 */
function convertDataForPieToBarChart(data) {
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

/**Draw lineWithFocusChart
 * @param {object} data
 * @returns chart
 **/
function drawLineWithFocusChart(data) {
    var chartData = data;
    nv.addGraph(function() {
        var chart = nv.models.lineWithFocusChart();
        var orderDate = new Date();
        var day;
        var month;
        var year;
        chart.xAxis.tickFormat(function(d) {
            orderDate = new Date(d * 1000);
            day = orderDate.getDate();
            month = orderDate.getMonth() + 1;
            year = orderDate.getFullYear();
            return day + '/' + month + '/' + year;
        });
        chart.x2Axis.tickFormat(function(d) {
            orderDate = new Date(d * 1000);
            day = orderDate.getDate();
            month = orderDate.getMonth() + 1;
            year = orderDate.getFullYear();
            return day + '/' + month + '/' + year;
        });
        chart.yAxis
                .tickFormat(d3.format(',.2f'));
        chart.y2Axis
                .tickFormat(d3.format(',.2f'));
        chart.transitionDuration(500);
        d3.select('#chartLineWithFocus svg')
                .datum(chartData)
                .call(chart);
        nv.utils.windowResize(chart.update);
        return chart;
    });
}

/**
 * Draw PieChart
 * @param {object} data
 * @returns chart
 */
function drawPieChart(data) {
    var chartData = data;
    nv.addGraph(function() {
        var width = 500,
                height = 500;
        var chart = nv.models.pieChart()
                .x(function(d) {
            return d.key;
        })
                .y(function(d) {
            return d.y;
        })
                .color(d3.scale.category20().range())
                .width(width)
                .height(height);
        d3.select("#pieChart svg")
                .datum(chartData)
                .transition().duration(1200)
                .attr('width', width)
                .attr('height', height)
                .call(chart);
        chart.dispatch.on('stateChange', function(e) {
            nv.log('New State:', JSON.stringify(e));
        });
        return chart;
    });
}

/**
 * Draw Bar chart
 * @param {object} data
 * @returns chart
 */
function drawBarChart(data) {
    var chartData = data;
    chartData = convertDataForPieToBarChart(chartData);
    nv.addGraph(function() {
        var chart = nv.models.discreteBarChart()
                .x(function(d) {
            return d.label;
        })
                .y(function(d) {
            return d.value;
        })
                .staggerLabels(true)
                .tooltips(true)
                .showValues(true)
                .transitionDuration(250)
                ;
        d3.select('#barChart svg')
                .datum(chartData)
                .call(chart);
        nv.utils.windowResize(chart.update);
        return chart;
    });
}

function drawChartsAndRefresh(className, methodName) {

    /** Prepare chart data **/
    if (className !== 'false' && methodName !== 'false') {
        var chartData = prepareData(className, methodName);
    } else {
        return false;
    }

    $.ajax({
        async: false,
        type: 'get',
        data: 'notLoadMain=true',
        url: base_url + 'admin/components/cp/mod_stats/getStatsTemplate/' + className + '/' + methodName,
        success: function(response) {
            if (response != false) {
                $('#chartContainer').html(response);
                if (chartData === undefined) {
                    console.log('No chart data!');
                    return false;
                }

                if (chartData.type === 'line') {
                    drawLineWithFocusChart(chartData.data);
                }
                if (chartData.type === 'pie') {
                    drawPieChart(chartData.data);
                    drawBarChart(chartData.data);
                }
            }
        }
    });
}