$(document).ready(function() {

    /** Get params for prepare data **/
    function getParamsForPrepareData(link) {

        if (link == undefined) {
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

    /***
     * Data for 2 types of chart
     */
    /*...*/
    function prepareData(param1, param2) {
        var returnResult;

        if (param1 != false && param2 != false) {
            $.ajax({
                async: false,
                type: 'get',
                data: 'notLoadMain=' + 'true',
                url: base_url + 'admin/components/init_window/mod_stats/dataPie',
//                url: base_url + 'admin/components/init_window/mod_stats/getDiagramData/' + param1 + '/' + param2,
                success: function(response) {

                    if (response) {
                        try {
                            returnResult = $.parseJSON(response);
                        } catch (e) {
                            return 'error parsing jsone'; 
                        }
                    }
                }
            })
        }
        return returnResult;

    }

    /******* *******/

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
     * 
     */
    $('.linkChart').unbind('click').bind('click', function() {
        var thisEl = $(this);

        /** Get link for ajax from data attribute **/
        var dataHref = $(this).data('href');

        /** Get params for preparing data**/
        var params = getParamsForPrepareData(dataHref);

        if (params != false) {
//            var chartData = prepareData(params[0], params[1]);
            var chartData = prepareData(true, true);
        }
        
        if (params != false) {

            var chartData2 = prepareData(true, true);
        }
        
        console.log(chartData2.data);
//        console.log(testDataOrders());
        $.ajax({
            async: false,
            type: 'get',
            data: 'notLoadMain=' + 'true',
            url: base_url + dataHref,
            success: function(response) {
                if (response != null) {
                    $('#chartContainer').html(response);

                    $('.linkChart').removeClass('active');
                    thisEl.addClass('active');
                    
                    if (chartData2.type == 'line'){
                        drawLineWithFocusChart(chartData2.data);
                    }
                    if (chartData2.type == 'pie'){
                        drawPieChart(chartData.data);
                    }
//                    drawLineWithFocusChart(testDataOrders());
                    
                }

            }
        })

    })







    /**Draw lineWithFocusChart
     * @param {object} data
     * @returns chart
     **/
    function drawLineWithFocusChart(data) {
        var chartData = data;
        nv.addGraph(function() {
            var chart = nv.models.lineWithFocusChart();
            var data = new Date();
            var day;
            var month;
            var year;

            chart.xAxis.tickFormat(function(d) {
                data = new Date(d);
                day = data.getDate();
                month = data.getMonth() + 1;
                year = data.getFullYear();

                return day + '/' + month + '/' + year;
            });

            chart.x2Axis.tickFormat(function(d) {
                data = new Date(d);
                day = data.getDate();
                month = data.getMonth() + 1;
                year = data.getFullYear();

                return day + '/' + month + '/' + year;
            });

            chart.yAxis
                    .tickFormat(d3.format(',.2f'));
            chart.y2Axis
                    .tickFormat(d3.format(',.2f'));

            chart.transitionDuration(500);

//        console.log(testDataOrders());
            d3.select('#chartLineWithFocus svg')
                    .datum(chartData)
                    .call(chart);

            nv.utils.windowResize(chart.update);

            return chart;
        });
    }
    /*** ***/

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
                return d.key
            })
                    .y(function(d) {
                return d.y
            })
                    .color(d3.scale.category10().range())
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
//    function testPieData() {
//        var testdata = [{key: "One", y: 5}, {key: "Two", y: 2}, {key: "Three", y: 9}, {key: "Four", y: 7}, {key: "Five", y: 4}, {key: "Six", y: 3}, {key: "Seven", y: .5}];
//
//        return testdata;
//    }

//    function testDataOrders() {
//        var data = [];
//        var dataOrdersAll = {};
//        var dataOrdersPaid = {};
//
//
//        dataOrdersAll['key'] = 'Все закази';
//        dataOrdersAll['values'] = [{x: 1362040000000, y: 2}, {x: 1362100000000, y: 7}];
////            {x: new Date(2013, 2, 10), y: 4},
////            {x: new Date(2013, 2, 25), y: 15},
////            {x: new Date(2013, 3, 28), y: 8},
////            {x: new Date(2013, 4, 28), y: 3},
////            {x: new Date(2013, 5, 28), y: 11}
//
////        dataOrdersPaid['key'] = 'Оплачение';
////        dataOrdersPaid['values'] = [{x: new Date(2013, 1, 28), y: 2}, {x: new Date(2013, 1, 30), y: 6},
////            {x: new Date(2013, 2, 10), y: 4}, {x: new Date(2013, 2, 25), y: 11},
////            {x: new Date(2013, 3, 28), y: 7}, {x: new Date(2013, 4, 28), y: 3}, {x: new Date(2013, 5, 28), y: 10}];
//
//
//        data.push(dataOrdersAll);
//
//        return data;
//    }

    
    
    
})