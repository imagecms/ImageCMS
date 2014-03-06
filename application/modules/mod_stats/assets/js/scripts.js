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

        $('#chartArea').find('form').submit();
    });

    /** Send form when change chart type **/
    $("select").on('change', function() {
        $('#chartArea').find('form').submit();
    });


    /**  Autocomplete for categories    */
    if ($('#autocomleteCategory').length) {
        $('#autocomleteCategory').autocomplete({
            source: base_url + 'admin/components/cp/mod_stats/adminAdd/autoCompleteCategories?limit=25',
            select: function(event, ui) {
                categoriesData = ui.item;
            },
            close: function() {
                $('#autocomleteCategoryId').val(categoriesData.id);
            }
        });
    }

    /** Order by for products **/
    $('.productListOrder').bind('click', function() {
        var column = $(this).attr('data-column');
        $('input[name=orderMethod]').attr('value', column);
        if ($('input[name=order]').attr('value') === '') {
            $('input[name=order]').attr('value', 'ASC');
        } else {
            if ($('input[name=order]').attr('value') === 'ASC') {
                $('input[name=order]').attr('value', 'DESC');
            } else {
                $('input[name=order]').attr('value', 'ASC');
            }
        }
        var query_string = $('#productFilterForm').serialize();
        window.location.href = '/admin/components/cp/mod_stats/products/productInfo?' + query_string;
    });

    /** Send form for filtering */
    $('#productFilterForm').on('submit', function(e) {
        e.preventDefault();
        var query_string = $('#productFilterForm').serialize();
        window.location.href = '/admin/components/cp/mod_stats/products/productInfo/0?' + query_string;
    });

    /** Order for order/users **/
    $('.orders_users_order').on('click', refreshOrdersUsers);
    $("#refreshIntervalsButtonOrdersUsers").on('click', refreshOrdersUsers);


    /** Show user attendance on page online */
    $(".online-users-table").on('click', 'tr.main_row td', function() {

        $("tr.additional_row").hide();
        var tr = $(this).parent();
        var userId = $(tr).data('user_id');
        var trSelector = 'tr.additional_row[data-user_id="' + userId + '"]';


        if ($(tr).hasClass('open_row')) {
            $('tr.main_row').removeClass('open_row');
            return;
        }

        if ($(trSelector).size() == 0) {
            $.post('/admin/components/cp/mod_stats/users/history', {userId: userId}, function(data) {
                $(tr).after("<tr data-user_id='" + userId + "' class='additional_row'><td colspan='5'>" + data + "</td></tr>");
                $(trSelector).show();
            });
        } else {
            $(trSelector).show();
        }
        $('tr.main_row').removeClass('open_row');
        $(tr).addClass('open_row');
    });

    $(".online-users-table").on('click', 'tr td a', function(obj, event) {
        event.preventDefault();
    });

    /** Save image button click **/
    $("#saveAsPng").click(function() {
        StatsSettingsAndParams.submitDownloadForm("png");
    });





    /** DRAW CHARTS **/

    /** Find and draw Pie Chart */
    var pieChartBlocks = $('.pieChartStats');
    if (pieChartBlocks.length) {
        pieChartBlocks.each(function(index, el) {
            var cData = ChartData.getData($(el).data('from'));
            if (cData != false) {
                $('#showNoChartData').hide();
                nv.addGraph(function() {
                    var width = 800,
                            height = 650 + (cData.length / 3 * 20);

                    var tooltip = function(key, x, y, e, graph) {
                        x = parseFloat(x.replace(' ', '').replace(',', ''));
                        return '<h3>' + key + '</h3>' +
                                '<p>' + x + '</p>';
                    }
                    var chart = nv.models.pieChart()
                            .tooltips(true)
                            .tooltipContent(tooltip)
                            .showLabels(true)
                            .x(function(d) {
                                return d.key
                            })
                            .y(function(d) {

                                return d.y
                            })
                            .color(d3.scale.category20().range())

                            .width(width)
                            .height(height);

                    d3.select(el)
                            .datum(cData)
                            .transition().duration(1200)
                            .attr('width', width)
                            .attr('height', height)
                            .call(chart);

                    chart.dispatch.on('stateChange', function(e) {
                        nv.log('New State:', JSON.stringify(e));
                    });

                    return chart;
                });
            } else {
                $('#saveAsPng').hide();
                $('#showNoChartData').show();
            }

        });
    }

    /** Find and draw Bar Chart */
    var barChartBlocks = $('.barChartStats');
    if (barChartBlocks.length) {
        barChartBlocks.each(function(index, el) {
            var cData = ChartData.getData($(el).data('from'));
            if (cData != false) {
                $('#showNoChartData').hide();
                nv.addGraph(function() {

                    var width = 800,
                            height = 700;
                    var chart = nv.models.discreteBarChart()
                            .margin({top: 30, right: 30, bottom: 250, left: 70})
                            .x(function(d) {

                                return d.label;
                            })
                            .y(function(d) {
                                return d.value;
                            })

                            .staggerLabels(true)
                            .tooltips(true);
//                            .showValues(true);

                    chart.yAxis
                            .tickFormat(d3.format('.0f'));

                    d3.select(el)
                            .datum(ChartData.convertDataForPieToBarChart(cData))
                            .transition().duration(500)
                            .attr('width', width)
                            .attr('height', height)
                            .call(chart);

                    nv.utils.windowResize(chart.update());
                    nv.utils.windowResize(rotateLabels());

                    return chart;

                });
                function rotateLabels() {
                    var labels;
                    labels = d3.selectAll('.barChartStats .nv-x.nv-axis > g text');
                    labels.attr('transform', function(d, i, j) {
                        height = $.trim(d).length;
                        return 'translate (-10, ' + (height + 80) + ') rotate(-90 0,0)'
                    });
                }
            } else {
                $('#saveAsPng').hide();
                $('#showNoChartData').show();
            }
        });
    }

    /** Find and draw Line Plus Bar Chart */
    var linePlusBarChartStats = $('.linePlusBarChartStats');
    if (linePlusBarChartStats.length) {
        linePlusBarChartStats.each(function(index, el) {

            cData = ChartData.getData($(el).data('from'));
            if (cData != false) {
                $('#showNoChartData').hide();
                nv.addGraph(function() {
                    var chart = nv.models.linePlusBarChart()
                            .margin({top: 30, right: 30, bottom: 50, left: 100})
                            .x(function(d, i) {
                                return i
                            })
                            .y(function(d) {
                                return d[1]
                            })
                            .color(d3.scale.category10().range());

                    chart.xAxis
                            .showMaxMin(false)
                            .tickFormat(function(d) {
                                var dx = cData[0].values[d] && cData[0].values[d][0] || 0;
                                if (dx !== 0)
                                    return d3.time.format('%d/%m/%Y')(new Date(dx))
                            });

                    chart.y1Axis
                            .tickFormat(function(d) {
                                return d3.format(',f')(d)
                            });

                    chart.y2Axis
                            .tickFormat(d3.format(',f'));

                    chart.bars.forceY([0]);

                    d3.select(el)
                            .datum(cData)
                            .transition().duration(500).call(chart);

                    nv.utils.windowResize(chart.update);

                    return chart;
                });
            } else {
                $('#saveAsPng').hide();
                $('#showNoChartData').show();
            }

        });
    }

    /** Find and draw  Line Chart */
    var lineChartStats = $('.cumulativeLineChartStats');
    if (lineChartStats.length) {
        lineChartStats.each(function(index, el) {
            var cData = ChartData.getData($(el).data('from'));
            if (cData != false) {
                $('#showNoChartData').hide();
                nv.addGraph(function() {
                    var chart = nv.models.lineChart().margin({
                        top: 30,
                        right: 40,
                        bottom: 50,
                        left: 45
                    }).showLegend(true).tooltipContent(function(key, y, e, graph) {
                        return '<h3>' + key + '</h3>' + '<p>' + e + ' at ' + y + '</p>'
                    });

                    chart.xAxis
                            .tickFormat(function(d) {
                                return d3.time.format('%d/%m/%Y')(new Date(d))
                            });

                    chart.yAxis
                            .tickFormat(d3.format('.0f'));

                    d3.select(el)
                            .datum(cData)
                            .transition().duration(500)
                            .call(chart);

                    nv.utils.windowResize(chart.update);

                    return chart;
                });
            } else {
                $('#saveAsPng').hide();
                $('#showNoChartData').show();
            }

        });
    }
    /** ************************************************ */
    
    $('[data-btn-select]').click(function(){
        var $this = $(this);
        $($this.data('rel')).val($this.data('val'));
        $this.closest('form').submit();
    })
});
