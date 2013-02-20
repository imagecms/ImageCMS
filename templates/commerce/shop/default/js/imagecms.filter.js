$(document).ready(function(){

    /*    Filter Init    */
    jQuery('.check_form input, .formCost input').on('change', ajaxRecount);
    jQuery('.sliderCont').on('mouseup', ajaxRecount);
    jQuery.exists_nabir = function(nabir){return (nabir.length > 0);}
    jQuery.exists = function(selector) {return ($(selector).length > 0);}
    jQuery('.apply').live('click', function(){$(this).parents('form').submit(); return false; });

    function ajaxRecount(event) {
        var $this = $(this);
        var filterResponse = new String;
        $this.closest('form').ajaxSubmit({
            success: function(responseText, statusText, xhr, $form){
                console.log(responseText);
                filterResponse = $.parseJSON(responseText);
                for (x in filterResponse.brands) {
                    var brand = filterResponse.brands[x];
                    var selector = $('#brand_' + brand.id);
                    selector.parent().children().eq(2).text('(' + brand.count + ')');
                    if (brand.disabled == 'false') {
                        selector.removeClass('not_disabled');
                    } else if (brand.disabled == 'true'){
                        selector.addClass('not_disabled');
                    }
                }
                for (x in filterResponse.properties) {
                    var property = filterResponse.properties[x];
                    var selector = $('#prop_' + property.id);
                    selector.parent().children().eq(2).text('(' + property.count + ')');
                    if (property.disabled == 'false') {
                        //selector.removeClass('not_disabled');
                        selector.removeAttr('disabled');
                    } else if (property.disabled == 'true'){
                        //selector.addClass('not_disabled');
                        selector.attr('disabled', 'disabled');
                    }
                }
                var value1=jQuery(".price_block input#minCost").val();
                var value2=jQuery(".price_block input#maxCost").val();
                if(parseInt(value1) > parseInt(value2)){
                    value1 = value2;
                    jQuery(".price_block input#minCost").val(value1);
                }
                jQuery(".price_block #slider").slider("values",0,value1);
                $this.parent().parent().parent().children('.check_form').find('div').hide();

                if ($this.parent().attr('class') == 'active') {
                    $this.parent().removeClass('active');
                }
                else {
                    $this.parent().addClass('active');
                }
                left=$this.parent().width();

                if ($this.is('input') && $this.attr('id') != 'minCost' && $this.attr('id') != 'maxCost') {
                    if($.exists_nabir($this.parent(':not(.disabled)'))){
                        $this.parent().parents('form').find('.check_form').find('label.active').not($this.parent()).toggleClass('active').find('.apply').stop().hide(200);
                        $this.parent().addClass('active');
                        left=$this.parent().width();
                        if(!$.exists_nabir($this.parent().find('.apply'))){
                            win=$this.parent().append("<span class='apply'><span><span>"+ found_filter_lang + '<span> '+filterResponse.totalCount+'</span> ' +found_filter_PR + "</span><a href='#'>" + found_filter_SH + "</a></span></span>");
                            $this.parent().find('.apply').stop().show(200);
                        }
                        else{
                            $this.parent().find('.apply').stop().show(200);
                        }
                        win.find('.apply').css('left',left+7);
                    }
                }
            }
        });
    }
});