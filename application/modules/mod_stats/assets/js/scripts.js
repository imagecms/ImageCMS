$(document).ready(function() {
    /** Menu hide/show blocks **/
    $('section.mod_stats').on('click', 'a.firstLevelMenu', function() {
        var submenuBlock = $(this).closest('li').next('.submenu');
        if (!$(submenuBlock).is(":visible")) {
            $('.submenu').slideUp();
            submenuBlock.slideDown();
        }
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
        })
    }





});




