$(document).ready(function() {

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
                .datum(testDataOrders())
                .call(chart);

        nv.utils.windowResize(chart.update);

        return chart;
    });

    function testDataOrders() {
        var data = [];
        var dataOrdersAll = {};
        var dataOrdersPaid = {};


        dataOrdersAll['key'] = 'Все закази';
        dataOrdersAll['values'] = [{x: new Date(2013, 1, 28), y: 2}, {x: new Date(2013, 1, 30), y: 7},
            {x: new Date(2013, 2, 10), y: 4}, {x: new Date(2013, 2, 25), y: 15},
            {x: new Date(2013, 3, 28), y: 8}, {x: new Date(2013, 4, 28), y: 3}, {x: new Date(2013, 5, 28), y: 11}];

        dataOrdersPaid['key'] = 'Оплачение';
        dataOrdersPaid['values'] = [{x: new Date(2013, 1, 28), y: 2}, {x: new Date(2013, 1, 30), y: 6},
            {x: new Date(2013, 2, 10), y: 4}, {x: new Date(2013, 2, 25), y: 11},
            {x: new Date(2013, 3, 28), y: 7}, {x: new Date(2013, 4, 28), y: 3}, {x: new Date(2013, 5, 28), y: 10}];


        data.push(dataOrdersAll, dataOrdersPaid);

        return data;
    }

    /**
     * Menu hide/show blocks
     */
    $('.firstLevelMenu').bind('click', function() {
        var submenuBlock = $(this).closest('li').next('.submenu');

        $('.submenu').hide();
        submenuBlock.slideDown();
    })

    /**
     * 
     */
    $('.linkChart').unbind('click').bind('click', function() {
        console.log($(this).data('href'));
        var dataHref = $(this).data('href');
        $.ajax({
            async: false,
            type: 'get',
            data: 'notLoadMain=' + 'true',
            url: base_url + dataHref,
            success: function(response) {
                if (response != null){
                     $('#chartContainer').html(response); 
                }
                  
            }
        })

    })


})