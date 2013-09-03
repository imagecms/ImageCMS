$(document).ready(function() {
    nv.addGraph(function() {
    var chart = nv.models.lineWithFocusChart();
          console.log(testData());
   // chart.transitionDuration(500);
    chart.xAxis
        .tickFormat(d3.format(',f'));
    chart.x2Axis
        .tickFormat(d3.format(',f'));

    chart.yAxis
        .tickFormat(d3.format(',.2f'));
    chart.y2Axis
        .tickFormat(d3.format(',.2f'));
    
    console.log(testData());
    console.log(testDataOrders());
    
    d3.select('#chartLineWithFocus svg')
        .datum(testDataOrders())
        .call(chart);

    nv.utils.windowResize(chart.update);

    return chart;
  });

    function testDataOrders(){
        var data = [];
        var dataOrdersAll = {};
        var dataOrdersPaid = {};

        dataOrdersAll['key'] = 'All'; 
        dataOrdersAll['values'] = [{x:0,y:2},{x:2,y:5}];
        
        
        data.push(dataOrdersAll);
        
        return data;
    }


  function testData() {
    return stream_layers(1,128,0).map(function(data, i) {
      return { 
        key: 'Stream' + i,
        values: data
      };
    });
  }


})