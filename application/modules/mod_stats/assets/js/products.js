var testdata = [
    {
        key: "One",
        y: 5
    },
    {
        key: "Two",
        y: 2
    }
];


nv.addGraph(function() {
    var width = 500;
    var height = 500;

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

    d3.select("#diagram-container svg")
            .datum(testdata)
            .transition().duration(1200)
            .attr('width', width)
            .attr('height', height)
            .call(chart);

    return chart;
});