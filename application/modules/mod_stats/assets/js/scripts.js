$(document).ready(function() {

    /** Get params for prepare data 
     * @param {string} link description
     * @returns {array} params
     * **/
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
            return false;
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
                url: base_url + 'admin/components/init_window/mod_stats/getDiagramData/' + className + '/' + method,
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


    /**
     * Menu hide/show blocks
     */
    $('.firstLevelMenu').unbind('click').bind('click', function() {
        var submenuBlock = $(this).closest('li').next('.submenu');
        if (!$(submenuBlock).is(":visible")) {
            $('.submenu').slideUp();
            submenuBlock.slideDown();
        }
    })

    /**
     * Click on menu item. Show the appropriate template with chart.
     */
    $('.linkChart').unbind('click').bind('click', function() {
        var thisEl = $(this);
        /** Get link for ajax from data attribute **/
        var dataHref = $(this).data('href');
        /** Get params for preparing data **/
        var params = getParamsForPrepareData(dataHref);
        /** Prepare chart data **/
        if (params !== 'false') {
            var chartData = prepareData(params[0], params[1]);
        }

        $.ajax({
            async: false,
            type: 'get',
            data: 'notLoadMain=' + 'true',
            url: base_url + dataHref,
            success: function(response) {
                if (response != false) {
                    $('#chartContainer').html(response);
                    $('.linkChart').removeClass('active');
                    thisEl.addClass('active');
                    if (chartData === undefined) {
                        console.log('Error getting data !');
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
    });
    /**
     * Choose chart type 
     */
    $('#selectChartType').bind('change', function() {
        var selectElement = $(this);
        var chartType = selectElement.find("option:selected").val();
        $('.hideChart').hide();
        $('#' + chartType).fadeIn();

        barChartUpdate();

    })
    /**
     * Update bar chart
     * @returns 
     */
    function barChartUpdate() {
        var chart = nv.models.discreteBarChart()
                .x(function(d) {
            return d.label;
        })
                .y(function(d) {
            return d.value;
        });
        d3.select('#barChart svg')
                .call(chart);
        chart.update;
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












//    function testDataOrders() {
//        var data = [];
//        var dataOrdersAll = {};
//        var dataOrdersPaid = {};
//        dataOrdersAll['key'] = 'Все закази';
//        dataOrdersAll['values'] = [{x: "1296950400", y: 107.18}, {x: "1297036800", y: 68.80},
//            {x: "1299196800", y: 1178.99}, {x: "1299456000", y: 35.00}
//            ,
////        {x: new Date(2013, 3, 28), y: 8},
////        {x: new Date(2013, 4, 28), y: 3},
////        {x: new Date(2013, 5, 28), y: 11}
//        ];
//        dataOrdersPaid['key'] = 'Оплачение';
//        dataOrdersPaid['values'] = [{x: new Date(2013, 1, 28), y: 2}, {x: new Date(2013, 1, 30), y: 6},
//            {x: new Date(2013, 2, 10), y: 4}, {x: new Date(2013, 2, 25), y: 11},
//            {x: new Date(2013, 3, 28), y: 7}, {x: new Date(2013, 4, 28), y: 3}, {x: new Date(2013, 5, 28), y: 10}];
//        data.push(dataOrdersAll);
//        return data;
//    }
});