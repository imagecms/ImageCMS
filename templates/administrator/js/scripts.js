$.exists = function(selector) {
    return ($(selector).length > 0);
}
$.exists_nabir = function(nabir){
    return (nabir.length > 0);
}
$(document).ready(function(){
    //  popover "info"
    $('.buy_prod').each(function(){
        var $this = $(this);
        $this.popover({
            'placement':'left',
            'content':$this.next().html()
        });
    });
    $('.popover_ref').each(function(){
        var $this = $(this);
        $this.popover({
            'content':$this.next().html(),
            'placement':'left'
        })
    })
    
    //  tabs
    $('.myTab a').live('click', function (e) {
        var hst = $(window).scrollTop()
        $this_href = $(this).attr('href');
        if (!$.exists_nabir($($this_href))){
            $('.tab-pane:last').load('set/'+$this_href.substring(1)+'.html').siblings().removeClass('active').end().addClass('active').attr('id', $this_href.substring(1));
            $('.tab-content').append('<div class="tab-pane"></div>')
        }
        $(this).tab('show');
        e.preventDefault();
        location.hash = $this_href;
        $(window).scrollTop(hst)
    });
    if (location.hash != '') $("[href="+location.hash+"]").click();
    else $('.myTab li.active a').click();
    
    //  drop search
    $('.typeahead').typeahead()
    
    //  tooltip
    $('[data-rel="tooltip"], [rel="tooltip"]').tooltip();
    $('.row-category').tooltip({
        'title':'перетащите категорию',
        'placement':'left'
    });
    //sortable
    if ($.exists('.sortable')) {
        $('.sortable tr').not(':has(tr)').tooltip({
            'placement':'left'
        });
        $( ".sortable").sortable({
            axis: 'y',
            cursor: 'move',
            scroll: false,
            cancel: '.head_body, .btn, .frame_label, td p, td span, td a, td input',
            helper: function(e, tr)
            {
                var $originals = tr.children();
                var $helper = tr.clone();
                $helper.children().each(function(index)
                {
                    $(this).width($originals.eq(index).width())
                });
                $helper.addClass('active');
                return $helper;
            },
            stop: function(){
                var chFn = $('.sortable').data('chfunction');
                console.log(typeof chFn);
                if (chFn)
                    return eval(chFn+'()');
                else
                    return false;
            }
        });
    }
    //data-picker
    if ($.exists('.datepicker')) {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            showOtherMonths: true,
            selectOtherMonths: true,
            prevText: '',
            nextText: ''
        });
    }
    $('.ui-datepicker').addClass('dropdown-menu'); 

    
    //my
    $('html').live('click', function(event) {
        if($(event.target).filter('.popover')[0]==undefined && $(event.target).parents('.popover')[0]==undefined && $(event.target).filter('.buy_prod')[0]==undefined && $(event.target).parents('.buy_prod')[0]==undefined && $(event.target).filter('.popover_ref')[0]==undefined && $(event.target).parents('.popover_ref')[0]==undefined){
            $(this).find('.popover').popover('hide');
            $(this).find('.buy_prod').popover('hide');
            $(this).find('.popover_ref').popover('hide');
        }
        event.stopPropagation();
    });
    
    $('.number input').each(function(){
        $(this).attr({
            'data-placement':'top', 
            'data-original-title': 'только цифры'
        });
    }).tooltip().on('keypress', function(event){
        var key, keyChar;
        if(!event) var event = window.event;

        if (event.keyCode) key = event.keyCode;
        else if(event.which) key = event.which;

        if(key==null || key==0 || key==8 || key==13 || key==9 || key==46 || key==37 || key==39 ) return true;
        keyChar=String.fromCharCode(key);

        if(!/\d/.test(keyChar)) {
            $(this).tooltip('show');
            return false
        }
        else $(this).tooltip('hide');
        
    });
    //not_standart_checks----------------------
    function dis_un_dis(){
        var label_act = $('.frame_label.active');
        if (label_act.length > 0){
            $('.action_on').removeClass('disabled');
        }
        else
        {
            $('.action_on').addClass('disabled');
        }
    }

    if ($.exists('.niceCheck')) {
        $(".niceCheck").each(function() {
            active_b_p = '-46px -17px';
            n_active_b_p = '-46px 0';
            changeCheckStart($(this));
        });
    }
    if ($.exists('.niceRadio')) {
        $(".niceRadio").each(function() {
            active_R_b_p = '-179px -17px';
            n_active_R_b_p = '-179px 0';
            changeRadioStart($(this));
        });
    }
    $(".frame_label:has(.niceCheck)").click(function() {
        var $this = $(this);
        if ($this.closest('thead')[0] != undefined){
            changeCheck($this.find('> span:eq(0)'))
            if ($this.hasClass('active')){
                $this.parents('table').find('.frame_label').each(function(){
                    changeCheckallchecks($(this).find('> span:eq(0)'));
                })
            }
            else
            {
                $(this).parents('table').find('.frame_label').each(function(){
                    changeCheckallreset($(this).find('> span:eq(0)'));
                })
            }
        }
        else if ($this.closest('.head')[0] != undefined){
            changeCheck($this.find('> span:eq(0)'))
            if ($this.hasClass('active')){
                $this.parents('#category').find('.frame_label').each(function(){
                    changeCheckallchecks($(this).find('> span:eq(0)'));
                })
            }
            else
            {
                $(this).parents('#category').find('.frame_label').each(function(){
                    changeCheckallreset($(this).find('> span:eq(0)'));
                })
            }
        }
        else if ($this.closest('.head')[0] != undefined){
            
        }
        else{
            changeCheck($this.find('> span:eq(0)'));
        }
        if (!$this.is('.no_connection')) dis_un_dis();
        return false;
    });

    $(".frame_label:has(.niceRadio)").click(function() {
        var $this = $(this);
        changeRadio($this.find('> span:eq(0)'));
        return false;
    });
    function textcomment_s_h(status, el){
        var status = status;
        var el = el;
        var textcomment = el.closest('tr').find('.text_comment');
        if ($.exists_nabir(textcomment)) {
            if (status == 's' && textcomment.css('display') != 'none')
            {
                var textcomment_h = textcomment.outerHeight();
                textcomment.hide().next().show().find('textarea').css('height', textcomment_h+13);
            }
            if (status == 's' && textcomment.css('display') == 'none') return true;
            else{
                textcomment.show().next().hide();
            }
        }
    }
    function check1(el, input){
        var el = el;
        var input = input;
        el.css("background-position", active_b_p);
        el.parent().addClass('active');
        input.attr("checked", true);

        if (el.closest('.sortable').children('tr').length > 0) el.closest('.sortable').children('tr').has(el).addClass('active');
        
        else if (el.closest('.simple_tr').length > 0) el.closest('.simple_tr').addClass('active');
        
        else{
            if (el.closest('.frame_level_3').length > 0) el.closest('.row-category').addClass('active');
        
            else
            {
                temp_nabir = el.closest('.row-category').parent().find('.row-category');
                temp_nabir.addClass('active');
                temp_nabir.find('.frame_label').each(function(){
                    changeCheckallchecks($(this).find('> span:eq(0)'));
                })
            }
        }
    }
    function check2(el, input){
        var el = el;
        var input = input;
        el.css("background-position", n_active_b_p);
        el.parent().removeClass('active');
        input.attr("checked", false);
        
        if (el.closest('.sortable').children('tr').length > 0) el.closest('.sortable').children('tr').has(el).removeClass('active')
        
        else if (el.closest('.simple_tr').length > 0) el.closest('.simple_tr').removeClass('active');
        
        else{
            if (el.closest('.frame_level_3').length > 0) el.closest('.row-category').removeClass('active');
        
            else
            {
                temp_nabir = el.closest('.row-category').parent().find('.row-category');
                temp_nabir.removeClass('active');
                temp_nabir.find('.frame_label').each(function(){
                    changeCheckallreset($(this).find('> span:eq(0)'));
                })
            }
        }
    }
    function check3(el, input){
        var el = el;
        var input = input;
        el.css("background-position", active_R_b_p);
        el.parent().addClass('active');
        input.attr("checked", true);
        el.parents('.row-category, tr').addClass('active');
        $('[name='+input.attr('name')+']').not(input).each(function(){
            check4($(this).parent(), $(this))
        })
    }
    function check4(el, input){
        var el = el;
        var input = input;
        el.css("background-position", n_active_R_b_p);
        el.parent().removeClass('active');
        el.parents('.row-category, tr').removeClass('active');
        input.attr("checked", false);
    }
    function changeCheck(el)
    {
        var el = el;
        var input = el.find("input");
        if(!input.attr("checked")) {
            check1(el, input);
            textcomment_s_h('s', el);
        }
        else{
            check2(el, input);
            textcomment_s_h('h', el);
        }
    }
    function changeRadio(el)
    {
        var el = el;
        var input = el.find("input");
        check3(el, input);
    }
    function changeCheckallchecks(el)
    {
        var el = el,
        input = el.find("input");
        el.css("background-position", active_b_p);
        el.parent().addClass('active');
        input.attr("checked", true);
        el.parents('.sortable').children('tr').addClass('active');
        el.closest('.simple_tr').addClass('active');
        
        textcomment_s_h('s', el);
    }
    function changeCheckallreset(el)
    {
        var el = el,
        input = el.find("input");
        el.css("background-position", n_active_b_p);	
        el.parent().removeClass('active');
        input.attr("checked", false);
        el.parents('.sortable').children('tr').removeClass('active');
        el.closest('.simple_tr').removeClass('active');
        
        textcomment_s_h('h', el);
    }
    function changeCheckStart(el)
    {
        var el = el,
        input = el.find("input");
        if(input.attr("checked")){
            check1(el, input);
        }
        else {
            check2(el, input);
        }
        el.removeClass('b_n');
    }
    function changeRadioStart(el)
    {
        var el = el,
        input = el.find("input");
        el.removeClass('b_n');
        if(input.attr("checked")){
            check3(el, input);
        }
        return false;
    }
    $('.all_select').on('click', function(){
        $(this).parents('table').find('.frame_label').each(function(){
            changeCheckallchecks($(this).find('> span:eq(0)'));
        })
    })
    $('.all_diselect').on('click', function(){
        $(this).parents('table').find('.frame_label').each(function(){
            changeCheckallreset($(this).find('> span:eq(0)'));
        })
    })

    show_tovar_text = 'показывать';
    hide_tovar_text = 'не показывать';
    $('.prod-on_off').live('click', function(){
        var $this = $(this);
        if ($this.hasClass('disable_tovar')){
            $this.animate({
                'left': '0'
            }, 200).removeClass('disable_tovar');
            $this.parent().attr('data-original-title', show_tovar_text)
            $('.tooltip-inner').text(show_tovar_text);
            $this.parents('td').next().children().removeClass('disabled');
        }
        else{
            $(this).animate({
                'left': '-28px'
            }, 200).addClass('disable_tovar');
            $(this).parent().attr('data-original-title', hide_tovar_text)
            $('.tooltip-inner').text(hide_tovar_text);
            $this.parents('td').next().children().addClass('disabled');
        }
    });
    function what_key(enter_key){
        var enter_key = enter_key; 
        var key;
        key = event.keyCode;
        if(key == enter_key) return true;
    }
    $('.js_price').on('click', function(){
        $(this).next().show();
    }).on('focus', function(){
        $(this).click();
    }).on('blur', function(){
        if ($(this).data('value') == $(this).val()){
            $(this).next().hide();
            $(this).tooltip('hide');
        }
    }).on('keypress', function(){
        if (what_key('13')){
            alert(what_key('13'))
        }
    });
    $('.share_alt').hover(function(){
        $(this).find('.go_to_site').css('visibility', 'visible');
    },function(){
        $(this).find('.go_to_site').css('visibility', 'hidden');
    });
    $('.variants').on('click',function(){
        var $this = $(this);
        var variants = $this.closest('tr').next();
        variants.toggle();
        return false;
    });
    
    function returnFalse(e){
        return false;
    }

    function cancelEvent(e){
        if(e.preventDefault)e.preventDefault();
        else e.returnValue=false;
    }

    function addHandler(e,event,action,param){
        if(document.addEventListener)e.addEventListener(event,action,param);
        else if(document.attachEvent)e.attachEvent('on'+event,action);
        else e['on'+event]=action;
    }

    function removeHandler(e,event,action,param){
        if(document.addEventListener)e.removeEventListener(event,action,param);
        else if(document.attachEvent)e.detachEvent('on'+event,action);
        else e['on'+event]=returnFalse;
    }

    addHandler(document,'mousedown',mouseDown,false);
    addHandler(document,'mouseup',mouseUp,false);

    function mouseDown(e){
        if(
            (e.target.nodeName!="TEXTAREA") &&
            (e.target.nodeName!="SELECT") &&
            (e.target.nodeName!="INPUT") &&
            (e.target.nodeName!="TR")&&
            (e.target.nodeName!="P")&&
            (e.target.nodeName!="SPAN")&&
            (!e.target.nodeName!="A")&&
            (e.target.nodeName!="DD")
            )
            {
            e=e||event;
            cancelEvent(e);
            addHandler(document,'selectstart',returnFalse,false);
        }
        if(($(e.target).hasClass('niceCheck')) || $(e.target).hasClass('frame_label') || ($(e.target).hasClass('niceRadio') || ($(e.target).hasClass('.row-category')) || ($(e.target).parent('.row-category').length > 0) )){
            e=e||event;
            cancelEvent(e);
            addHandler(document,'selectstart',returnFalse,false);
        }
    }

    function mouseUp(e){
        removeHandler(document,'selectstart',returnFalse,false);
    }
    
    $('#category .btn:has(.icon-plus)').on('click', function(){
        var $this = $(this);
        $this.closest('.row-category').next().show();
        $this.hide().prev().show();
    })
    $('#category .btn:has(.icon-minus)').on('click', function(){
        var $this = $(this);
        $this.closest('.row-category').next().hide();
        $this.hide().next().show();
    })
    
    $('td .patch_disabled').each(function(){
        $(this).css('height', $(this).parents('td').height())
    })
    
    $('[type="file"]').change(function(){
        var $this=$(this);
        $this.parent().prev().children().val($this.val());
    });
    $('.item_menu .row-category:even').addClass('even');
    
    window.setInterval('updateNotificationsTotal()', 5000);
    
    
    //list filter
    
    $('.listFilterForm').live('change', function(){
        $('.listFilterSubmitButton').removeAttr('disabled').removeClass('disabled');
        $('.listFilterSubmitButton').focus();
    })
    
    $('.listFilterSubmitButton').live('click', function(){
        if (!$(this).attr('disabled')  && !$(this).hasClass('disabled'))
        {
            $('.listFilterForm').ajaxSubmit({
                target: '#mainContent'
            });
        }
    });
    if ($.exists('#usersDatas')) $('#usersDatas').typeahead({
        source:usersDatas
    });
    
    
    
//    $('[data-provide="typeahead"]').on('focus', function(){
//        $(this).on('keyup', function(event){
//            var key, keyChar;
//            if(!event) var event = window.event;
//
//            if (event.keyCode) key = event.keyCode;
//            else if(event.which) key = event.which;
//            
//            var active_drop = $('.typeahead .active');
//            var first_drop = $('.typeahead li:first');
//            var last_drop = $('.typeahead li:last');
//            
//            if (key == 40) {
//                if (!last_drop.hasClass('active')) active_drop.removeClass('active').next().addClass('active');
//                else {
//                    first_drop.addClass('active');
//                    last_drop.removeClass('active');
//                }
//            }
//            if (key == 38) {
//                if (!first_drop.hasClass('active')) active_drop.removeClass('active').prev().addClass('active');
//                else {
//                    first_drop.removeClass('active');
//                    last_drop.addClass('active');
//                }
//            }
//        })
//    })
    
});
