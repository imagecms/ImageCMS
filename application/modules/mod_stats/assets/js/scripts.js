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
            })
        }
        return returnResult;
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

        console.log(chartData);
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

                    if (chartData === undefined) {
                        console.log('Error geting data !');
                        return false;
                    }

                    if (chartData.type === 'line') {
                        drawLineWithFocusChart(chartData.data);
                    }
                    if (chartData.type === 'pie') {
                        drawPieChart(chartData.data);
                    }
                }
            }
        });
    });

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
});