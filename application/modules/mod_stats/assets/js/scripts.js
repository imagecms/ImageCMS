$(document).ready(function() {

    /** Menu hide/show blocks **/
    $('section.mod_stats').on('click', 'a.firstLevelMenu', function() {
        var submenuBlock = $(this).closest('li').next('.submenu');
        if (!$(submenuBlock).is(":visible")) {
            $('.submenu').slideUp();
            submenuBlock.slideDown();
        }
    });

    /** Save search results setting value */
    $('section.mod_stats .shortSettingsSpan').bind('click', function() {
        var spanBlock = $(this);
        var checkBox = spanBlock.find('.shortSettingsCheckbox');
        var shortSettingsName = checkBox.data('sname');
        var newValue; // new value for saving to database

        // Get new property
        if (checkBox.prop('checked') === true) {
            newValue = 0;
        } else {
            newValue = 1;
        }
        StatsSettingsAndParams.setModStatsSetting(shortSettingsName, newValue);
    });

    /** Set time interval for day, week, month, year */
    $('section.mod_stats').on('click', '.intervalButton', function() {
        var interval = $(this).data('group');
        var nowDate = new Date();
        var startDate = new Date();
        var endDate = new Date();
        var startDateForInput = '';
        var endDateForInput = '';

        // Prepare times interval for day, week, month, year**/
        switch (interval) {
            case 'day':
                startDate = new Date(nowDate.getFullYear(), nowDate.getMonth(), (nowDate.getDate() - 1));
                endDate = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate());
                break;
            case 'month':
                startDate = new Date(nowDate.getFullYear(), (nowDate.getMonth() - 1), nowDate.getDate());
                endDate = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate());
                break;
            case 'year':
                startDate = new Date((nowDate.getFullYear() - 1), nowDate.getMonth(), nowDate.getDate());
                endDate = new Date((nowDate.getFullYear()), nowDate.getMonth(), nowDate.getDate());
                break;
        }

        // Prepare values for start and end date inputs **/
        startDateForInput = startDate.getFullYear() + '-' + ('0' + (startDate.getMonth() + 1)).slice(-2) + '-' + ('0' + (startDate.getDate())).slice(-2);
        endDateForInput = endDate.getFullYear() + '-' + ('0' + (endDate.getMonth() + 1)).slice(-2) + '-' + ('0' + (endDate.getDate())).slice(-2);

        // Set values for start and end date inputs **/
        $('.date_start').val(startDateForInput);
        $('.date_end').val(endDateForInput);
    });





    /** DRAW CHARTS **/

    /** Find and draw Pie Chart */
    var pieChartBlocks = $('.pieChartStats');
    if (pieChartBlocks.length) {
        pieChartBlocks.each(function(index, el) {
            nv.addGraph(function() {
                var width = 800,
                        height = 700;

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

                d3.select(el)
                        .datum(ChartData.getData($(el).data('from')))
                        .transition().duration(1200)
                        .attr('width', width)
                        .attr('height', height)
                        .call(chart);

                chart.dispatch.on('stateChange', function(e) {
                    nv.log('New State:', JSON.stringify(e));
                });

                return chart;
            });
        });
    }

    /** Find and draw Bar Chart */
    var barChartBlocks = $('.barChartStats');
    if (barChartBlocks.length) {
        barChartBlocks.each(function(index, el) {
            nv.addGraph(function() {
                var width = 800,
                        height = 600;
                var chart = nv.models.discreteBarChart()
                        .x(function(d) {
                            return d.label
                        })
                        .y(function(d) {
                            return d.value
                        })
                        .staggerLabels(true)
                        .tooltips(false)
                        .showValues(true)

                d3.select(el)
                        .datum(convertDataForPieToBarChart(ChartData.getData($(el).data('from'))))
                        .transition().duration(500)
                        .attr('width', width)
                        .attr('height', height)
                        .call(chart);

                nv.utils.windowResize(chart.update);

                return chart;
            });
        });
    }

    /** Find and draw Line With Focus Chart */
    var lineWithFocusChartBlocks = $('.lineWithFocusChartStats');
    if (lineWithFocusChartBlocks.length) {
        lineWithFocusChartBlocks.each(function(index, el) {
            nv.addGraph(function() {
                var chart = nv.models.cumulativeLineChart()
                        .x(function(d) {
                            return d[0]
                        })
                        .y(function(d) {
                            return d[1] / 100
                        }) //adjusting, 100% is 1.00, not 100 as it is in the data
                        .color(d3.scale.category10().range());

                chart.xAxis
                        .tickFormat(function(d) {
                            return d3.time.format('%x')(new Date(d))
                        });

                chart.yAxis
                        .tickFormat(d3.format(',.1%'));

                d3.select(el)
                        .datum(ChartData.getData($(el).data('from')))
                        .transition().duration(500)
                        .call(chart);

                nv.utils.windowResize(chart.update);

                return chart;
            });
        });
    }
    /** ************************************************ */













    /*** REMOVE!!!!!!!!!!!!!! **/
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

//    function testData() {
//        return stream_layers(3, 128, .1).map(function(data, i) {
//            return {
//                key: 'Stream' + i,
//                values: data
//            };
//        });
//    }
//    /* Inspired by Lee Byron's test data generator. */
//    function stream_layers(n, m, o) {
//        if (arguments.length < 3)
//            o = 0;
//        function bump(a) {
//            var x = 1 / (.1 + Math.random()),
//                    y = 2 * Math.random() - .5,
//                    z = 10 / (.1 + Math.random());
//            for (var i = 0; i < m; i++) {
//                var w = (i / m - y) * z;
//                a[i] += x * Math.exp(-w * w);
//            }
//        }
//        return d3.range(n).map(function() {
//            var a = [], i;
//            for (i = 0; i < m; i++)
//                a[i] = o + o * Math.random();
//            for (i = 0; i < 5; i++)
//                bump(a);
//            return a.map(stream_index);
//        });
//    }
//
//    /* Another layer generator using gamma distributions. */
//    function stream_waves(n, m) {
//        return d3.range(n).map(function(i) {
//            return d3.range(m).map(function(j) {
//                var x = 20 * j / m - i / 3;
//                return 2 * x * Math.exp(-.5 * x);
//            }).map(stream_index);
//        });
//    }
//
//    function stream_index(d, i) {
//        return {x: i, y: Math.max(0, d)};
//    }

    /***********************/





});




