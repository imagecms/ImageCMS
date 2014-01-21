$(document).ready(function() {
    /** Menu hide/show blocks **/
    $('section.mod_stats').on('click', 'a.firstLevelMenu', function() {
        var submenuBlock = $(this).closest('li').next('.submenu');
        if (!$(submenuBlock).is(":visible")) {
            $('.submenu').slideUp();
            submenuBlock.slideDown();
        }
    });

    // open first menu section
    $("ul.left-menu-ul li:first-child a").trigger('click');

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




