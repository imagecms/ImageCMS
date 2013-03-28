$(document).ready(function(){
    $('.goEnter').click(function(){
        $('.enterButton').click();
        window.scrollTo(0,0);
    })
    $('.show_hidden_slide').click(function(){
        $('.hidden_slide').slideToggle();
    })
    $('.goWList').live("click", function(){
        redirect_to('/shop/wish_list');
    })
    $('.goCompare').live("click", function(){
        redirect_to('/shop/compare');
    })
    $('.goProile').live("click", function(){
        redirect_to('/shop/profile');
    })
    
    ///////////////////////////// validation //////////////////////////////////////////////
    //$('#login_form').validate();
    $('#order_form').validate();
    $('#notifMe_form').validate();
    
    
    /////////////////////////// notiffing if appear ///////////////////////////////////////
    $('#notifMe_form').live("submit", function(){
        var $this = $(this);
        $.ajax({
            type: 'post',
            url: '/shop/ajax/getNotifyingRequest',
            data: $this.serialize(),
            beforeSend: function(){
                $.fancybox.showActivity();
            },
            success: function(msg){
                $('#notifMe_form .popup_container').html(msg);
                $.fancybox.hideActivity();
            }
        });
        return false;
    })
    
    ///////////////////////////// feedback //////////////////////////////////////////////
    /*
    $('#feed_form').validate({
        submitHandler:function(){
            $.ajax({
                type: 'post',
                url: '/feedback',
                data: $('#feed_form').serialize(),
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    $('#feed_block').html(msg);
                    $.fancybox.hideActivity();
                }
            });
            return false;
        }
    })
     */
    
    //////////////////////////// authorization ////////////////////////////////////////////
    $('#enter_form').live('submit',function(){
        var $this = $(this);
        $this.validate();
        if ( $this.valid() ){
            $.ajax({
                type: 'post',
                url: '/auth/login',
                cache: false,
                data: $this.serialize(),            
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    try{
                        var obj = $.parseJSON(msg);
                    } catch(e){}
                
                    if (typeof obj == 'object'){
                        var obj = $.parseJSON(msg);
                        if (obj.reload){
                            $('#fancybox-close').click();
                            location.reload();
                        }
                    } else {
                        $this.find('.popup_container').html(msg);
                    }
                    $.fancybox.hideActivity();
                }
            });
        }
        return false;
        
    })
    
    
    //////////////////////////// registration //////////////////////////////////////////
    $('#register_form').live('submit',function(){
        var $this = $(this);
        $this.validate();
        if ( $this.valid() ){
            $.ajax({
                type: 'post',
                url: '/auth/register',
                cache: false,
                data: $('#register_form').serialize(),            
                beforeSend: function(){
                    $.fancybox.showActivity();              
                },
                success: function(msg){
                    $('#register_form .popup_container').html(msg);
                    $.fancybox.hideActivity();
                }
            });
        }
        return false;
    })
    
    /////////////////////////// callback  ///////////////////////////////////////////
    $('#callback_form').live('submit',function(){
        var $this = $(this);
        $this.validate();
        if ( $this.valid() ){
            $.ajax({
                type: 'post',
                url: '/shop/shop/callback',
                data:$('#callback_form').serialize(),
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    $('#callback_form .popup_container').html(msg);
                    $.fancybox.hideActivity();
                }
            });
        }
        return false;
    })

    /////////////////////////// forgot password ///////////////////////////////////////////
    $('#remember_form').live("submit", function(){
        var $this = $(this);
        $this.validate();
        if ( $this.valid() ){
            $.ajax({
                type: 'post',
                url: '/auth/forgot_password',
                data: $this.serialize(),
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    $this.find('.popup_container').html(msg);
                    $.fancybox.hideActivity();
                }
            });
        }
        return false;
    })
    
    //////////////////////////// comments ////////////////////////////////////////////////
    $('.comment_form').live('submit',function(){
        var $this = $(this);
        $this.validate();
        if ( $this.valid() ){
            $.ajax({
                type: 'post',
                url: '/comments/add',
                cache: false,
                data: $this.serialize(),           
                beforeSend: function(){
                    $.fancybox.showActivity();   
                },
                success: function(msg){
                    $($this).find('.drop_comm_container').html(msg);
                    $($this).find('input[type=text]').val('').end().find('textarea').val('').end().find('input[name=rate]').removeAttr('checked').end().find('input[name=ratec]').val(0).end().find('.productRate div').css('width','0px');
                    $.fancybox.hideActivity();
                }
            });
        }
        return false;
    })
    
    $('.like_this, .disslike_this').on("click", function(){
		var $this = $(this);
        com_id = $this.data('com_id'),
        event = $this.data('event');
		
		$.ajax({
			type: 'post',
			url: '/comments/mark_comment',
			data: 'item_id='+com_id+"&event="+event,
			beforeSend: function(){
				$.fancybox.showActivity();
			},
			success: function(res){
				$this.find('.result').text('('+res+')');
				$.fancybox.hideActivity();
			}
		});
		
        return false;
        //$('comm_'+com_id).html();
    })
    
    $('[data-rel="cloneCommentForm"]').cloneAddPaste({
        pasteAfter: 'parent.parent',
        pasteWhat: $('[data-rel="whoCloneAddPaste"]'),
        evPaste: 'click',
        effectIn: 'slideDown',
        effectOff: 'slideUp',
        duration: 300,
        wherePasteAdd: 'form',
        whatPasteAdd: '',
        before: function(el){
            el.find('.icon-replay-comment').toggleClass('icon-replay-comment2')
        },
        after: function(el, elInserted){
            $(elInserted).find('.datas input[name=comment_parent]').val( el.data('parent') );
        //$(elInserted).find('form').validate();
        }
    });
    ///////////////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////// profile ////////////////////////////////////////////////
    $("#newpass_form").live('submit',function(){
        var $this = $(this);
        $this.validate();
        if ( $this.valid() ){
            $.ajax({
                type: "post",
                data: $this.serialize(),
                url: "/shop/profile",
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    $this.find('.popup_container').html(msg);
                    $.fancybox.hideActivity();
                }
            });
        }
        return false;
    })    
    
    $("#profile_form").live('submit',function(){
        var $this = $(this);
        $this.validate();
        if ( $this.valid() ){
            $.ajax({
                type: "post",
                data: $this.serialize(),
                url: "/shop/profile",
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    $this.find('.popup_container').html(msg);
                    $.fancybox.hideActivity();
                }
            });
        }
        return false;
    })
    
    /////////////////// product spy /////////////////////////////////
    $('.toSpy').live("click",function(){
        var $this = $(this);
        vid = $(this).data('vid');
        pid = $(this).data('pid');
        pp = $(this).data('pp');
        uid = $(this).data('uid');
        $.ajax({
            data :'pid='+pid+'&vid='+vid+'&uid='+uid+'&pp='+pp,
            type :'post',
            url: '/shop/product_spy/spy',
            beforeSend: function(){
                $.fancybox.showActivity();
            },
            success: function(){
                $this.parent().find('.inSpy').removeClass('d_n');
                $this.addClass('d_n');
                $.fancybox.hideActivity();
            }
        })
        
        return false;
    })
    
    //// delete from spy //////
    $('.deleteFromSpy').live("click", function(){
        var uid = $(this).data('uid');
        var vid = $(this).data('vid');
        
        var $this = $(this);
        $.ajax({
            type: 'post',
            url: '/shop/product_spy/deletefromspy',
            data: 'uid='+uid+'&vid='+vid,
            beforeSend: function(){
                $.fancybox.showActivity();
            },
            success: function(msg){
                $('.spy_popup_container').html(msg);
                $.fancybox.hideActivity();
            }
        });
        return false;
    })
    ///////////////////////////////////////////////////////////////////////////////////////
    
    /////////////////////////// send wish to friend ///////////////////////////////////////
    $('#wish_form').live("submit", function(){
        var $this = $(this);
        $this.validate();
        if ( $this.valid() ){
            $.ajax({
                type: 'post',
                url: '/shop/wish_list/sendWishList',
                data: $this.serialize(),
                beforeSend: function(){
                    $.fancybox.showActivity();
                },
                success: function(msg){
                    $this.find('.popup_container').html(msg);
                    $.fancybox.hideActivity();
                }
            });
        }
        return false;
    })
    ///////////////////////////////////////////////////////////////////////////////////////
    
    ////////////////////// delete from compare list ///////////////////////////////////////
    $('.deleteFromCompare').live('click', function() {
        var $thisP = $(this).parents('[data-equalhorizcell]').last(),
        $thisPId = $thisP.attr('id'),
        count_products = $thisP.find(optionCompare.right),
        gen_count_products = count_products.add($thisP.siblings().find(optionCompare.right)).length,
        count_productsL = count_products.length;
                
        var id = $(this).data('pid');
        $this = $(this);
        $.ajax({
            type: "post",
            url: "/shop/compare/remove/" + id,
            beforeSend: function(){
                $.fancybox.showActivity();
            },
            success: function() {
                $("#compareBlock").load('/shop/ajax/getCompareDataHtml');
                $('.compare_product_' + id).remove();

                if (count_productsL === 1) {
                    var btn = $('[data-href="#'+$thisP.attr('id')+'"],[href="#'+$thisP.attr('id')+'"]').parent();
                    if ($.exists_nabir(btn.next())) btn.next().children().click();
                    else btn.prev().children().click();
                    
                    btn.remove();
                }
                if (gen_count_products === 1)
                    location.reload();
                $.fancybox.hideActivity();
				
                $('.frame-tabs-ref > div').equalHorizCell('refresh');
                if (optionCompare.onlyDif.parent().hasClass('active')) optionCompare.onlyDif.click();
                else optionCompare.allParams.click();
            }
        });
    });
    ///////////////////////////////////////////////////////////////////////////////////////
    
    $('.drop').drop({
        before: function(el, dropEl){
            if ($(dropEl).hasClass('drop-report')){
                var defaultForm = $('.reportFormData').html();
                var Insert = $(el).parents('.not-avail_wrap').find('.datas').html();
                $(dropEl).find('form').empty().append(defaultForm).find('.datas').html(Insert);
            }else if( $(dropEl).hasClass('drop-order-call') ){
                $(dropEl).find('form label.error').hide().end().find('form .error').removeClass('error');
            }
            if( $(el).data('event') == 'buy' ){
                vid = $(el).find('button').data('varid');
                pid = $(el).find('button').data('prodid');
                comm = $(el).find('button').data('comment');
                $(dropEl).find('.header-title').text( $(el).find('button').text() ).end().find('label[for="call_comment"]').hide();
                $(dropEl).find('.datas').empty().append('<input type="hidden" name="ProductId" value="'+pid+'" /><input type="hidden" name="VariantId" value="'+vid+'" /><input type="hidden" name="Comment" value="'+comm+'" /><input type="hidden" name="ThemeId" value="1" />');
            } else if( $(el).data('event') == 'call' ){
                $(dropEl).find('.header-title').text( $(el).find('.form_title').text() ).end().find('label[for="call_comment"]').show();
                $(dropEl).find('.datas').empty().append('<input type="hidden" name="ThemeId" value="2" />');
            }
        },
		after: function(el, dropEl){
			if (dropEl.hasClass('drop-forget')){
				$('[data-drop ="'+$('.drop-enter').data('elrun')+'"]').click();
			}
		}
    });
    $('.niceRadio').nStRadio({
        after:function(input){
            if( $.exists_nabir($(input).closest('.is_deliveries'))){
                setAllowablePaymentMethods( $(input).val() );
            //alert( $(input).val() );
            }
        }
    });
    
})
function setRatec(val){
    $('.datas_main input[name="ratec"]').val(val);
}
function tabComment(){
    $('[data-href="#third"]').click();
    off_top = $('[data-href="#third"]').offset().top;
    $(window).scrollTop(off_top);
}
function redirect_to(url){
    location.href = url;
}