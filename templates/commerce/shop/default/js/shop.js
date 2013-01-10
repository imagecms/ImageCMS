$(document).ready(function() {

    /** Show/Hide  category description **/
    $('#cat_desc').hide();
    $('#show').click(function() {
        if (jQuery.browser.msie && parseInt(jQuery.browser.version) == 6) {
            if ($('#cat_desc').css("display") == "block") {
                $('#cat_desc').css("display", "none");
            }
            else {
                $('#cat_desc').css("display", "block");
            }
        } else {
            $('#cat_desc').toggle("slow");
        }

        if ($('#show').text() == 'Описание катагории>>') {
            $('#show').text('Скрыть');
        } else {
            $('#show').text('Описание катагории>>');
        }
    });

    /**
     * Add product to cart functionality
     * @event ckick
     * @return event
     * @description
     *      Adds product, specified by ID in "data"-parameter to cart
     * @usage
     *      Add the following structure to yor code:
     *      "<a href="#" data-prodid="12" data-varid="21" class="goBuy">Buy product</a>"
     *      Where 'data-prodid' - product ID and 'data-varid' - variant ID
     */
    /*
     $("a.grouped_elements").fancybox({
     showNavArrows: true,
     cyclic: true
     });
     */
    var fancyOptions = {
        helpers: {
            title: {
                type: 'inside'
            }
        },
        beforeLoad: function() {
            var el, id = $(this.element).data('title-id');
            if (id) {
                el = $('#' + id);
                if (el.length) {
                    this.title = el.html();
                }
            }
        }
    };
    if ($('.fancybox-thumb').last().hasClass('withThumbs'))
        fancyOptions.helpers.thumbs = {
            width: 50,
            height: 50
        };
    if ($('.fancybox-thumb').last().hasClass('withButtons'))
        fancyOptions.helpers.buttons = {};
    //console.log(fancyOptions);

    $('.fancybox-thumb').fancybox(fancyOptions);
    $('span.clickrate').on('click', function() {
        var val = $(this).attr('title');
        $.ajax({
            type: "POST",
            data: "pid=" + currentProductId + "&val=" + val,
            dataType: "json",
            url: '/shop/ajax/rate',
            success: function(obj) {
                if (obj.classrate != null)
                    $('#' + 'star_rating_' + currentProductId).removeClass().addClass('rating ' + obj.classrate + ' star_rait');
            }
        });
    });
    $('span.clicktemprate').on('click', function() {
        var rate = $(this).attr('title');
        var ratec;
        if (rate == 1)
            ratec = "onestar";
        if (rate == 2)
            ratec = "twostar";
        if (rate == 3)
            ratec = "threestar";
        if (rate == 4)
            ratec = "fourstar";
        if (rate == 5)
            ratec = "fivestar";
        $('#comment_block').removeClass().addClass('rating ' + ratec + ' star_rait');
        $('#ratec').attr('value', rate);
    });
    $('.usefullyes').on('click', function() {
        var comid = $(this).attr('data-comid');
        $.ajax({
            type: "POST",
            data: "comid=" + comid,
            dataType: "json",
            url: '/comments/setyes',
            success: function(obj) {
                $('#yesholder' + comid).html("(" + obj.y_count + ")");
            }
        });
    });
    $('.usefullno').on('click', function() {
        var comid = $(this).attr('data-comid');
        $.ajax({
            type: "POST",
            data: "comid=" + comid,
            dataType: "json",
            url: '/comments/setno',
            success: function(obj) {
                $('#noholder' + comid).html("(" + obj.n_count + ")");
            }
        });
    });
    $('.add_cart_kid ').live('click', function() {
        var id = $(this).attr('data-id');
        var $this = $(this);
        $.fancybox.showActivity();
        $.ajax({
            type: 'post',
            data: "quantity=" + 1 + "&kitId=" + id,
            url: '/shop/cart/add/ShopKit',
            beforeSend: function() {
                $('#kitBuy').show();
            },
            success: function(msg) {
                $('.bask_block').load('/shop/ajax/getCartDataHtml');
                $this.removeClass().addClass("goToCart").html('Оформить</br> заказ');
                $this.parents(".buttons").removeClass("button_gs").addClass("button_middle_blue");
                console.log($this.parents('.buttons'));
                //                        .attr('href', '/shop/cart')
                //                        .unbind('click');
                showResponse(msg);
                $.fancybox.hideActivity();
                //$this.hide();
            }
        })
        return false;
    });
    $('.buy .goBuy').live('click', function() {
        $.fancybox.showActivity();
        var id_var = $(this).attr('data-varid');
        var id = $(this).attr('data-prodid');
        var $this = $(this);
        $.ajax({
            type: 'post',
            data: "quantity=" + 1 + "&productId=" + id + "&variantId=" + id_var,
            url: '/shop/cart/add',
            success: function(msg) {
                $('.cart_data_holder').load('/shop/ajax/getCartDataHtml');
                if ($this.parent().hasClass('button_big_green'))
                {
                    $('.in_cart').html('Уже в корзине');
                    $this.parent().removeClass('button_big_green').addClass('button_big_blue')
                    $this.html('Оформить заказ');
                    $('.pfancy').removeClass().addClass('buttons button_big_blue pfancy');
                    $('.bfancy').removeClass().addClass('fancybuy goToCart bfancy').html('Оформить заказ');
                }
                else
                {
                    $this
                            .removeClass('goBuy')
                            .addClass('goToCart')
                            .html('Оформить <br/> заказ')
                            .parent('div')
                            .removeClass('button_gs')
                            .addClass('button_middle_blue');
                }
                // $('.in_cart').html('Уже в корзине');
                $this.unbind('click');
                showResponse(msg);
                $.fancybox.hideActivity();
            }
        });
        return false;
    });
    /*   End of Event   */

    $('.loginAjax').on('click', function() {
        $.fancybox.showActivity();
        $.ajax({
            type: 'post',
            url: b_url + 'auth/login',
            success: function(msg) {
                showResponse(msg);
                bindLoginForm();
                bindRegisterLink();
                $.fancybox.hideActivity();
                if ($('#cartForm input[name="userInfo[email]"]').length)
                {
                    $('#enter input[name="username"]').val($('#cartForm input[name="userInfo[email]"]').val());
                }
                $('#orderSubmit').data('logged', 1);
            }
        });
        return false;
    });
    $('.center').delegate('.is_avail a.goCartData', 'click', function() {
        $.fancybox.showActivity();
        $.ajax({
            type: 'post',
            url: '/shop/cart/add',
            success: function(msg) {
                showResponse(msg);
                $.fancybox.hideActivity();
            }
        });
        return false;
    });
    /**
     * Add to user wishlist
     */
    $('.addToWList').on('click', function() {
        var $this = $(this);
        var $thisNext = $(this).next();
        var variantId = $(this).attr('data-varid');
        var productId = $(this).attr('data-prodid');
        var logged_in = $(this).attr('data-logged_in');
        $.fancybox.showActivity();
        if (logged_in == 'true') {
            $.ajax({
                type: "POST",
                data: 'productId = ' + productId + '&variantId = ' + variantId,
                url: "/shop/wish_list/add",
                success: function() {
                    $this.remove();
                    $thisNext.show();
                    $this.unbind('click');
                    $("#wishListHolder").load('/shop/ajax/getWishListDataHtml').addClass('is_avail');
                    $.fancybox.hideActivity();
                }
            });
        } else {
            $('.loginAjax').trigger('click');
        }
        return false;
        //setTimeout(function() { $("#wishListNotify").css('display', 'none') }, 2000);
    });
    $('#towishlist').on('click', function() {
        var logged_in = $(this).attr('data-logged_in');
        if (logged_in != 'true') {
            $('.loginAjax').trigger('click');
        }
    });
    /**
     * Add product for compare
     */
    $('.toCompare').on('click', function() {
        var productId = $(this).attr('data-prodid');
        var $this = $(this);
        $.fancybox.showActivity();
        $.ajax({
            url: "/shop/compare/add/" + productId,
            success: function() {
                $("#compareHolder").load('/shop/ajax/getCompareDataHtml').addClass('is_avail');
                $.fancybox.hideActivity();
                $this
                        .removeClass('js')
                        .removeClass('toCompare')
                        .removeClass('gray')
                        .addClass('is_avail')
                        .unbind('click')
                        .find('span')
                        .remove().end().find('a').show();
            }
        });
        return false;
        //setTimeout(function() { $("#wishListNotify").css('display', 'none') }, 2000);
    });
    $('.gotoComp').live('click', function() {
        $(location).attr('href', '/shop/compare');
    });
    $('.goNotifMe').on('click', function() {
        $.fancybox.showActivity();
        var id_var = $(this).attr('data-varid');
        var id = $(this).attr('data-prodid');
        var $this = $(this);
        $.ajax({
            type: 'post',
            data: "ProductId=" + id,
            url: '/shop/ajax/getNotifyingRequest',
            success: function(msg) {
                showResponse(msg);
                bindNotifMeForm();
                $.fancybox.hideActivity();
            }
        }
        );
        return false;
    })
    function bindgoNotifMe() {
        $('.goNotifMe').bind('click', function() {
            $.fancybox.showActivity();
            var id_var = $(this).attr('data-varid');
            var id = $(this).attr('data-prodid');
            var $this = $(this);
            $.ajax({
                type: 'post',
                data: "ProductId=" + id,
                url: '/shop/ajax/getNotifyingRequest',
                success: function(msg) {
                    showResponse(msg);
                    bindNotifMeForm();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        });
    }
    /* End of Event */
    $('.lineForm input[type=hidden]').on('change', function() {
        $('[name="order"]').val($('#sort').val());
        $('[name="user_per_page"]').val($('#count').val());
        $('[name="brandsfilter"]').submit();
    });
    $('.plus_minus button').live('click', function() {
        $this = $(this);
        $target = $(this).parent().parent().find('input');
        $val = $target.val();
        $form = $(this).parents('form');
        if ($(this).hasClass('count_up')) {
            $target.val($val * 1 + 1);
        }
        else {
            if ($val != '1')
                $target.val($val * 1 - 1);
        }
        $.fancybox.showActivity();
        $form.find('input[name=makeOrder]').val(0);
        $.ajax({
            type: 'post',
            data: $form.serialize() + '&recount=1',
            url: '/shop/cart',
            success: function(msg) {
                $('.cart_data_holder').load('/shop/ajax/getCartDataHtml');
                if ($this.hasClass('inCartProducts'))
                    $('.forCartProducts').html(msg);
                else
                    showResponse(msg);
                $form.find('input[name=makeOrder]').val(1);
                $('#price1').text($('#allpriceholder').data('summary'));
                $('#price3').text(parseFloat($('#allpriceholder').data('summary')) + parseFloat($('#price2').text()));
                $.fancybox.hideActivity();
            }
        });
        return false;
    });
    $('.changeCurrency').on('change', function() {
        $(this).parents('form').submit();
    })

    $('.delete_text').live('click', function() {
        $.fancybox.showActivity();
        $data = null
        $target = $(this).attr('href');
        $this = $(this);
        if ($this.hasClass('inCartProducts'))
            $data = '&forCart=true'
        $.ajax({
            type: 'post',
            data: $data,
            url: $target,
            success: function(msg) {
                $('.cart_data_holder').load('/shop/ajax/getCartDataHtml');
                if ($this.hasClass('inCartProducts'))
                    $('.forCartProducts').html(msg);
                else
                    showResponse(msg);
                $('#price1').text($('#allpriceholder').data('summary'));
                $('#price2').text($('#dpholder').data('dp'));
                $('#price3').text(parseFloat($('#allpriceholder').data('summary')) + parseFloat($('#price2').text()));
                $.fancybox.hideActivity();
            }
        });
        return false;
    });



    $('.met_del').bind('click', function() {
        var nid = $(this);
        $('#deliveryMethodId').val(nid.val());
        $.ajax({
            url: "/shop/cart/getPaymentsMethods/" + nid.val(),
            success: function(msg) {
                $("#paymentMethods").html(msg);
                $('#paymentMethodId').val($('.met_buy:eq(0)').val());
                $('#price1').text($('#allpriceholder').data('summary'));
                $('#price2').text($('#dpholder').data('dp'));
                $('#price3').text(parseFloat($('#allpriceholder').data('summary')) + parseFloat($('#price2').text()));
            }
        });
    });
    $('.met_buy').live('click', function() {
        $('#paymentMethodId').val($(this).val());
    });
    $('.showCallbackBottom').on('click', function() {

        $.fancybox.showActivity();
        $.ajax({
            type: 'post',
            url: '/shop/shop/callbackBottom',
            success: function(msg) {
                showResponse(msg);
                bindCallbackForm1();
                $.fancybox.hideActivity();
            }
        });
        return false;
    })

    $('.showCallback').on('click', function() {

        $.fancybox.showActivity();
        $.ajax({
            type: 'post',
            url: b_url + '/shop/shop/callback',
            success: function(msg) {
                showResponse(msg);
                bindCallbackForm();
                $.fancybox.hideActivity();
            }
        });
        return false;
    })


    //$("#cartForm").validate();
    $('.met_del:checked').trigger('click');
    $("input.met_del").click(function() {
        recount();
    });
    $('.met_del:checked').each(function() {
        recount();
    });
    function recount() {
        $.fancybox.showActivity();
        $("#cartForm").find('input[name=makeOrder]').val(0);
        $.ajax({
            type: 'post',
            data: $("#cartForm").serialize() + '&recount=1',
            url: '/shop/cart',
            success: function(msg) {
                $('.cart_data_holder').load('/shop/ajax/getCartDataHtml');
                if ($('.plus_minus button').hasClass('inCartProducts'))
                    $('.forCartProducts').html(msg);
                else
                    showResponse(msg);
                $("#cartForm").find('input[name=makeOrder]').val(1);
                $.fancybox.hideActivity();
            }
        });
    }

    function bindNotifMeForm() {
        $('.order_call #notifMe').bind('submit', function() {
            $this = $(this);
            $.ajax({
                type: 'post',
                url: '/shop/ajax/getNotifyingRequest',
                data: $this.serialize(),
                beforeSend: function() {
                    $.fancybox.showActivity();
                },
                success: function(msg) {
                    showResponse(msg);
                    bindNotifMeForm();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })

    }

    function bindGoBuy()
    {
        $('.buy .goBuy').bind('click', function() {
            $.fancybox.showActivity();
            var id_var = $(this).attr('data-varid');
            var id = $(this).attr('data-prodid');
            var $this = $(this);
            $.ajax({
                type: 'post',
                data: "quantity=" + 1 + "&productId=" + id + "&variantId=" + id_var,
                url: '/shop/cart/add',
                success: function(msg) {
                    $('.cart_data_holder').load('/shop/ajax/getCartDataHtml');
                    if ($this.parent().hasClass('button_big_green'))
                    {
                        $('.in_cart').html('Уже в корзине');
                        $this.parent().removeClass('button_big_green').addClass('button_big_blue')
                        $this.html('Оформить заказ');
                    }
                    else
                    {
                        $this
                                .removeClass('goBuy')
                                .addClass('goToCart')
                                .html('Оформить <br/> заказ')
                                .parent('div')
                                .removeClass('button_gs')
                                .addClass('button_middle_blue');
                    }
                    // $('.in_cart').html('Уже в корзине');
                    $this
                            //.attr('href', '/shop/cart')
                            .unbind('click');
                    showResponse(msg);
                    $.fancybox.hideActivity();
                }
            });
            return false;
        });
    }

    $('.goToCart').live('click', function() {
        $(location).attr('href', '/shop/cart');
    });
    function bindLoginForm() {
        $('.enter_form form').bind('submit', function() {
            $this = $(this);
            $.ajax({
                type: 'post',
                url: '/auth/login',
                data: $this.serialize(),
                beforeSend: function() {
                    $.fancybox.showActivity();
                },
                success: function(msg) {
                    showResponse(msg);
                    bindLoginForm();
                    bindRegisterLink();
                    var obj = $.parseJSON(msg);
                    if (typeof obj != 'undefined') {
                        if (obj != null) {
                            $('.auth_data').html(obj.header);
                            $('.addToWList').bind('click');
                            $('.addToWList').attr('data-logged_in', 'true');
                            //$.fancybox.resize();
                        }
                    }
                    $('.reg_me').bind('click', bindRegisterForm());
                    $('.forgot_password').bind('click', bindForgotPasswordForm());
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }

    function bindRegisterForm() {
        $('.enter_form form').bind('submit', function() {
            $this = $(this);
            $.ajax({
                type: 'post',
                url: b_url + '/auth/register',
                data: $this.serialize(),
                beforeSend: function() {
                    $.fancybox.showActivity();
                },
                success: function(msg) {
                    showResponse(msg);
                    bindRegisterForm();
                    bindLoginLink();
                    bindForgotPasswordLink();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }
    function bindRegisterLink() {
        $('.reg_me').bind('click', function() {
            $this = $(this);
            $.ajax({
                type: 'post',
                url: b_url + '/auth/register',
                beforeSend: function() {
                    $.fancybox.showActivity();
                },
                success: function(msg) {
                    showResponse(msg);
                    bindRegisterForm();
                    bindForgotPasswordLink();
                    bindLoginLink();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }
    function bindForgotPasswordLink() {
        $('.forgot_password').bind('click', function() {
            $this = $(this);
            $.ajax({
                type: 'post',
                url: b_url + '/auth/forgot_password',
                beforeSend: function() {
                    $.fancybox.showActivity();
                },
                success: function(msg) {
                    showResponse(msg);
                    bindForgotPasswordForm();
                    bindLoginLink();
                    bindRegisterLink();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }

    function bindForgotPasswordForm() {
        $('.enter_form form').bind('submit', function() {
            $this = $(this);
            $.ajax({
                type: 'post',
                url: b_url + '/auth/forgot_password',
                data: $this.serialize(),
                beforeSend: function() {
                    $.fancybox.showActivity();
                },
                success: function(msg) {
                    showResponse(msg);
                    bindLoginLink();
                    bindLoginForm();
                    bindRegisterLink();
                    bindRegisterForm();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }

    function bindLoginLink() {
        $('.auth_me').bind('click', function() {
            $this = $(this);
            $.ajax({
                type: 'post',
                url: b_url + '/auth/login',
                beforeSend: function() {
                    $.fancybox.showActivity();
                },
                success: function(msg) {
                    showResponse(msg);
                    bindLoginForm();
                    bindRegisterLink();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }

    function bindCallbackForm1() {
        $('.order_call form').bind('submit', function() {
            $this = $(this);
            $.ajax({
                type: 'post',
                url: '/shop/shop/callbackBottom',
                data: $this.serialize(),
                beforeSend: function() {
                    $.fancybox.showActivity();
                },
                success: function(msg) {
                    showResponse(msg);
                    bindCallbackForm1();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }

    function bindCallbackForm() {
        $('.order_call form').bind('submit', function() {
            $this = $(this);
            $.ajax({
                type: 'post',
                url: '/shop/shop/callback',
                data: $this.serialize(),
                beforeSend: function() {
                    $.fancybox.showActivity();
                },
                success: function(msg) {
                    showResponse(msg);
                    bindCallbackForm();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        })
    }


    function showResponse(responseText, statusText, xhr, $form) {
        try {
            var obj = $.parseJSON(responseText);
        } catch (e) {
        }

        if (typeof obj != 'undefined') {
            if (obj != null) {
                $.fancybox(obj.msg, {
                    'titleShow': false,
                    'padding': 0,
                    'margin': 0,
                    'overlayOpacity': 0.5,
                    'overlayColor': '#000',
                    'transitionIn': 'elastic',
                    'transitionOut': 'elastic',
                    'showNavArrows': false,
                    'onComplete': function() {
                        setTimeout('$.fancybox.close()', 2000);
                    }
                });
                if (obj.reload === 1)
                    location.reload();
            } else {
                $.fancybox(responseText, {
                    'titleShow': false,
                    'padding': 0,
                    'margin': 0,
                    'overlayOpacity': 0.5,
                    'overlayColor': '#000',
                    'transitionIn': 'elastic',
                    'transitionOut': 'elastic',
                    'showNavArrows': false
                });
            }
        }
        else {
            $.fancybox(responseText, {
                'titleShow': false,
                'padding': 0,
                'margin': 0,
                'overlayOpacity': 0.5,
                'overlayColor': '#000',
                'transitionIn': 'elastic',
                'transitionOut': 'elastic',
                'showNavArrows': false
            });
        }
    }

    $('[name="selectVar"]').live('change', function() {
        $.fancybox.showActivity();
        var vid = $(this).val();
        if ($(this).attr('type') == 'radio') {
            $this = $(this);
        } else {
            $this = $(this).find('[value=' + vid + ']');
        }
        ;
        var pid = $this.attr('data-pid');
        var img = $this.attr('data-img');
        var pr = $this.attr('data-pr');
        var spr = $this.attr('data-spr');
        var vnumber = $this.attr('data-vnumber');
        var vname = $this.attr('data-vname');
        var cs = $this.attr('data-cs');
        var csMain = $this.attr('data-csMain');
        var st = $this.attr('data-st');
        var pp = $this.attr('data-pp');
        if (img != '') {
            $('#mim' + pid).addClass('smallpimagev');
            $('#vim' + pid).attr('src', '/uploads/shop/' + img).removeClass().attr('alt', vname);
            $('#mim' + pid).attr('src', '/uploads/shop/' + pid + '_main.jpg')
        }
        $('#code' + pid).html('Код ' + vnumber);
        $('#pricem' + pid).html(pr + "&nbsp;<sub>" + cs + "</sub>");
        $('#priceB' + pid).html(pr + ' ' + csMain);
        $('#prices' + pid).html(spr + ' ' + cs);
        $('#buy' + pid).attr('data-varid', vid);
        $('#buy' + pid).attr('data-prodid', pid);
        $.ajax({
            type: "post",
            data: "pid=" + pid + "&vid=" + vid + "&stock=" + st + "&pp=" + pp,
            dataType: "json",
            url: '/shop/category/getStyle',
            success: function(obj) {
                $('#p' + pid).removeClass().addClass(obj.stclass + ' buttons');
                $('#pFancy' + pid).removeClass().addClass(obj.stclass + ' buttons');
                $('#buy' + pid).removeClass().addClass(obj.stidentif).html(obj.stmsg).attr('href', obj.stlink).unbind('click');
                $('#buyFancy' + pid).removeClass().addClass(obj.stidentif).html(obj.stmsg).attr('href', obj.stlink).unbind('click');
                if (obj.stidentif == "goNotifMe") {
                    $('.in_cart').html('');
                    bindgoNotifMe();
                }
                if (obj.stidentif == "goBuy") {
                    $('.in_cart').html('');
                    bindGoBuy();
                }
                if (obj.stidentif == "goToCart") {
                    $('.in_cart').html('Уже в корзине');
                }
                $.fancybox.hideActivity();
            }
        })
        return false;
    });
    $('.giftcertcheck').on('click', function() {
        recount();
        
        //$(".cert_fancybox").fancybox();
    });
    $('.addtoSpy').on('click', function() {
        $.fancybox.showActivity();
        var vid = $(this).attr('data-varid');
        var pid = $(this).attr('data-prodid');
        var uid = $(this).attr('data-user_id');
        var pp = $(this).attr('data-price');
        var $this = $(this);
        $.ajax({
            type: "post",
            data: "uid=" + uid + "&pid=" + pid + "&vid=" + vid + "&pp=" + pp,
            url: "/shop/product_spy/spy",
            success: function() {
                $this.html('Отписатся от слежения').removeClass('addtoSpy').addClass('deleteFromSpy');
                $this.unbind('click');
                bindeletefromspy();
                $.fancybox.hideActivity();
            }
        });
    });
    function bindeletefromspy()
    {
        $('.deleteFromSpy').on('click', function() {
            $this = $(this);
            var pid = $(this).attr('data-prodid');
            var uid = $(this).attr('data-user_id');
            $.ajax({
                type: 'post',
                url: '/shop/product_spy/deletefromspy',
                data: "uid=" + uid + "&pid=" + pid,
                success: function() {
                    $this.html('Следить за этим товаром').addClass('js').addClass('gray').removeClass('deleteFromSpy').addClass('addtoSpy');
                    $this.unbind('click');
                    bindaddtoSpy();
                    $.fancybox.hideActivity();
                }
            });
            return false;
        });
    }
    $('.deleteFromSpy').on('click', function() {
        $this = $(this);
        var pid = $(this).attr('data-prodid');
        var uid = $(this).attr('data-user_id');
        $.ajax({
            type: 'post',
            url: '/shop/product_spy/deletefromspy',
            data: "uid=" + uid + "&pid=" + pid,
            success: function() {
                $this.html('Следить за этим товаром').addClass('js').addClass('gray').removeClass('deleteFromSpy').addClass('addtoSpy');
                $this.unbind('click');
                bindaddtoSpy();
                $.fancybox.hideActivity();
            }
        });
        return false;
    });
    function bindaddtoSpy()
    {
        $('.addtoSpy').bind('click', function() {
            $.fancybox.showActivity();
            var vid = $(this).attr('data-varid');
            var pid = $(this).attr('data-prodid');
            var uid = $(this).attr('data-user_id');
            var pp = $(this).attr('data-price');
            var $this = $(this);
            $.ajax({
                type: "post",
                data: "uid=" + uid + "&pid=" + pid + "&vid=" + vid + "&pp=" + pp,
                url: "/shop/product_spy/spy",
                success: function() {
                    $this.html('Отписатся от слежения').removeClass('addtoSpy').addClass('deleteFromSpy');
                    $this.unbind('click');
                    bindeletefromspy();
                    $.fancybox.hideActivity();
                }
            });
        });
    }

    $('.findincats').live('click', function() {
        var id = $(this).attr('data-id');
        $('[name="categoryId"]').attr('value', id);
        $('#orderForm').submit();
    });

    $('.clear_filter').live('click', function() {
        var url = $(this).attr('data-url');
        $(location).attr('href', url);
    });

    $("#button_email").live('click', function() {
        $("#send_email").slideToggle('slow', function() {
            if ($("#send_email").css('display') == 'block')
                $("#button_email").text('Закрыть форму');
            else
                $("#button_email").text('Отправить другу WishList');
        });
    });

    $('[name="editForm"]').validate({
        rules: {
            friendsMail: {
                required: true,
                email: true
            }
        },
        messages: {
            friendsMail: {
                required: "Введите email друга",
                email: "Поле должно содержать правильный адресс почты"
            }
        },
        submitHandler: function() {
            var data = $('[name="friendsMail"]').val();
            $.ajax({
                type: "post",
                url: "/shop/wish_list/sendWishList",
                data: "email=" + data,
                beforeSend: function() {
                    $.fancybox.showActivity();
                },
                success: function() {
                    $.fancybox.hideActivity();
                    $('.notificationWish').text("Ваш список желаний успешно отправлен на " + data);
                    //$('.notificationWish').hide(4000);
                    $("#button_email").trigger('click');
                    $('[name="editForm"]').validate().resetForm();
                }
            });
        }
    });

    $('.fancybuy').live('click', function() {
        var id = $(this).attr('data-id');
        $('#buy' + id).trigger('click');
    });

    $('.delete_tovar').live('click', function() {
        var count_products = $(this).parents('.comparison_tovars').find('.list_desire').length;
        var id = $(this).data('pid');
        $.fancybox.showActivity();
        $.ajax({
            type: "post",
            url: "/shop/compare/remove/" + id,
            success: function() {
                //                if(count_products === 1){
                //                    $(this).parents('.comparison_slider').remove();
                //                    //console.log($(this).parents('.comparison_slider'));
                //                }else{
                $('#product_block_' + id).remove();
                //}
            }
        });
        if (count_products === 1)
            $(this).parents('.comparison_slider').remove();
        $.fancybox.hideActivity();
    });
    $('.prod_show_diff').live('click', function() {
        var $this = $(this);
        if (!$this.is('.disabled')) {

            var rows = $this.closest('.comparison_slider').find('.todiff');

            $.fancybox.showActivity();
            var keys = new Array();
            var values = new Array();
            rows.each(function(index) {
                keys.push($(this).data('rows'));
                values.push($(this).html());
            });
            $.post("/shop/compare/calculate",
                    {
                        ind: keys,
                        val: values
                    },
            function(obj) {
                //console.log(data);
                $this.siblings().toggleClass('disabled').toggleClass('button_compare');
                $this.toggleClass('disabled').toggleClass('button_compare');

                if (obj.result) {
                    //{console.log("success")};
                    $(obj.selector).toggle();
                } else {
                    $this.add($this.siblings()).hide()
                    $this.parent().find('.no_differ').show();
                }
                $.fancybox.hideActivity();
            }, "json"
                    );
        }
    });

    $('#orderSubmit').live('click', function(event) {
        if ($(this).data('logged') === 1) {
            $('#cartForm').submit();
        } else {
            var email = $('[name="userInfo[email]"]').val();
            var name = $('[name="userInfo[fullName]"]').val();
            if ((email != '') && (name != '')) {
                event.preventDefault();
                $.ajax({
                    type: "post",
                    url: "/shop/ajax/checkEmail",
                    data: "email=" + email,
                    dataType: "json",
                    success: function(obj) {
                        if (obj.result === false) {
                            $.ajax({
                                type: "post",
                                url: "/shop/cart/displayPopupConfirm",
                                success: function(msg) {
                                    showResponse(msg);
                                }
                            });
                        } else {
                            $('#cartForm').submit();
                        }
                    }
                });
            } else {
                $('#cartForm').submit();
            }
        }
    });

    $('.confirmYes').live('click', function() {
        $('.loginAjax').trigger('click');
    });

    $('.confirmNo').live('click', function() {
        $('#cartForm').submit();
    });

    $('[name="brand[]"]').live('change', function() {
        $('#brandsfilter').submit();
        $('#brandsfilter input[type=checkbox]').attr('disabled', 'disabled');
    });

    $('[name="pricebutton"]').live('click', function(event) {
        event.preventDefault();
        $('#brandsfilter').submit();
        $('#brandsfilter input[type=checkbox]').attr('disabled', 'disabled');
    });

    $('.propertyCheck').live('change', function() {
        $('#brandsfilter').submit();
        $('#brandsfilter input[type=checkbox]').attr('disabled', 'disabled');
    });

});