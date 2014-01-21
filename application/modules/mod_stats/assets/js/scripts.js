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
    $('section.mod_stats #saveSearchResultsSpan').bind('click', function() {
        var spanBlock = $(this);
        var checkBox = spanBlock.find('#saveSearchResultsCheckbox');
        var newValue; // new value for saving to database

        // Get new property
        if (checkBox.prop('checked') === true) {
            newValue = 0;
        } else {
            newValue = 1;
        }
        StatsSettingsAndParams.setModStatsSetting('save_search_results', newValue);
    });


    /** Set time interval for day, week, month, year */
    $('section.mod_stats').on('click', '.intervalButton', function() {
        var CookieDate = new Date;
        var interval = $(this).data('group');
        var nowDate = new Date();
        var startDate = new Date();
        var endDate = new Date();
        var startDateForInput = '';
        var endDateForInput = '';


        /** Prepare times interval for day, week, month, year**/
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

        /** Prepare values for start and end date inputs **/
        startDateForInput = startDate.getFullYear() + '-' + ('0' + (startDate.getMonth() + 1)).slice(-2) + '-' + ('0' + (startDate.getDate())).slice(-2);
        endDateForInput = endDate.getFullYear() + '-' + ('0' + (endDate.getMonth() + 1)).slice(-2) + '-' + ('0' + (endDate.getDate())).slice(-2);

        /** Set values for start and end date inputs **/
        $('.date_start').val(startDateForInput);
        $('.date_end').val(endDateForInput);
    });

















    /**
     * Find and draw Pie Chart
     */
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
                        .datum(ChartData.getPieData($(el).data('from')))
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

    /**
     * Find and draw Bar Chart
     */
    var barChartBlocks = $('.barChartStats');
    if (barChartBlocks.length) {
        barChartBlocks.each(function(index, el) {
            nv.addGraph(function() {
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
                        .datum(convertDataForPieToBarChart(ChartData.getPieData($(el).data('from'))))
                        .transition().duration(500)
                        .call(chart);

                nv.utils.windowResize(chart.update);

                return chart;
            });
        });
    }








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
    /***********************/





});




