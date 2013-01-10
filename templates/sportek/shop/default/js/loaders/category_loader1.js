$(document).ready(function(){

    var def_min = parseInt($('#minCost').attr('title'));
    var def_max = parseInt($('#maxCost').attr('title'));

    var cur_min = parseInt($('#minCost').val());
    var cur_max = parseInt($('#maxCost').val());

    $('.filter_form').find('select').bind('change', function(){
        $('.filter_form').submit();
    });

    //Cообщить о появлении
    $(".report").click(function(){
        $('#notifyProductVariantName').text($(this).data('proname'));
        $('#variantIds').val($(this).data('varid'));
        $('#fproductId').val($(this).data('prodid'));
    }).fancybox({
        'scrolling'		: 'no',
        'titleShow'		: false
    });

    $("#slider").slider({
        min: def_min,
        max: def_max,
        values: [cur_min, cur_max],
        range: true,
        stop: function(event, ui) {
            $("input#minCost").val(ui.values[0]);
            $("input#maxCost").val(ui.values[1]);

        },
        slide: function(event, ui){
            $("input#minCost").val(ui.values[0]);
            $("input#maxCost").val(ui.values[1]);
        }
    });

    $("input#minCost").change(function(){

        var value1=$("input#minCost").val();
        var value2=$("input#maxCost").val();

        if(parseInt(value1) > parseInt(value2)){
            value1 = value2;
            $("input#minCost").val(value1);
        }
        $("#slider").slider("values",0,value1);
    });


    $("input#maxCost").change(function(){

        var value1=$("input#minCost").val();
        var value2=$("input#maxCost").val();

        if (value2 > def_max) {
            value2 = def_max;
            $("input#maxCost").val(def_max)
        }

        if(parseInt(value1) > parseInt(value2)){
            value2 = value1;
            $("input#maxCost").val(value2);
        }
        $("#slider").slider("values",1,value2);
    });

       $('.sear_fil #simple').click(function(){
        //OLD, by Andiry $(this).parent().parent().parent().find('#extend').slideToggle('500');
        $('#extend').slideToggle('500');
        var LinkTest = $('#simple').text();
        if (LinkTest == 'Простой поиск')
        {
            $('#simple').text('Расширенный поиск');
        }
        else
        {
            $('#simple').text('Простой поиск');
        }

        //$(this).toggleClass('expanded').find('span').toggleClass('notjs');
        return false;
    });
    
    $(".b_filter").click(function(){
        $('.filter').slideToggle('500');
        var bt =  $(this).css('background-position');
        if (bt == '0px 26px')
        {
            $(this).css('background-position','0px 0px');
        }
        else
        {
            $(this).css('background-position','0px 26px');
        }
            
    })
    
    $('#hide_filt').click(function(){
        $('.filter').hide(500);
        $(".b_filter").css('background-position','0px 26px');
        return false;
        
    })

});