$(document).ready(function() {
    /** Menu hide/show blocks **/
    $('section.mod_stats').on('click', 'a.firstLevelMenu', function() {
        var submenuBlock = $(this).closest('li').next('.submenu');
        if (!$(submenuBlock).is(":visible")) {
            $('.submenu').slideUp();
            submenuBlock.slideDown();
        }
    });





    /** Remove!!!!! **/
    function myData() {
        var series1 = [];
        for (var i = 1; i < 100; i++) {
            series1.push({
                x: i, y: 100 / i
            });
        }

        return [
            {
                key: "Series #1",
                values: series1,
                color: "#0000ff"
            }
        ];
    }

    nv.addGraph(function() {
        var chart = nv.models.lineChart();

        chart.xAxis
                .axisLabel("X-axis Label");

        chart.yAxis
                .axisLabel("Y-axis Label")
                .tickFormat(d3.format("d"))
                ;

        d3.select("svg")
                .datum(myData())
                .transition().duration(500).call(chart);

        nv.utils.windowResize(
                function() {
                    chart.update();
                }
        );

        return chart;
    });
    /** ***/




});




