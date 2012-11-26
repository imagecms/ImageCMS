$(function() {
    $( "#text" ).autocomplete({
        source: $( "#text").closest("form").attr("action"),
        minLength: 2,
        select: function( event, ui ) {
            return false;
        },
        open: function(event, ui){
            return false;
        }
    })
        .data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( "<a  onclick=\"window.location = '" + item.url + "';\">" + item.label + "<br>"  + "<img src=\"/uploads/shop/" + item.image + "\" alt=\"image\" border=\"0\">"
            + "<div class=\"price\">Цена:" + item.price + " " +currencySymbol +"</div>" +"</a>" )
            .appendTo( ul );
    };
    });

    $(function() {
        // a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#actual" ).datepicker({minDate: new Date() });
        $( "#actual" ).datepicker( "option", "dateFormat", 'dd-mm-yy');

        var productId = $( "[name=productId]" ),
            variantId = $( "[name=variantId]" ),
            name = $( "#name" ),
            email = $( "#email" ),
            phone = $( "#phone" ),
            actual = $( "#actual" ),
            comment = $( "#comment" ),
            allFields = $( [] ).add( name ).add( email ).add( phone ).add( actual ).add( comment ),
            tips = $( "#dialog-form .validateTips" );

        function updateTips( t ) {
            tips
                .html( t )
                .addClass( "ui-state-highlight" );
            setTimeout(function() {
                tips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
        }

        function showGif( t ) {
            tips.html( t );
        }

        $( "#dialog-form" ).dialog({
            autoOpen: false,
            width: 350,
            modal: true,
            buttons: {
                "Сообщить о появлении" : function() {
                    allFields.removeClass( "ui-state-error" );
                    showGif("<center><img src='/application/modules/imagebox/templates/js/lightbox/images/loading.gif' /></center>");
                    $.post("/shop/cart/sendNotifyingRequest", {productId: productId.val(),
                            variantId: variantId.val(),
                            name: name.val(),
                            email: email.val(),
                            phone: phone.val(),
                            actual:actual.val(),
                            comment:comment.val()
                        },
                        function(data) {
                            if (data == "done"){
                                updateTips('Ваш запрос отправлен!');
                                setTimeout(function() {
                                    $( "#dialog-form" ).dialog( "close" );
                                }, 1000 );
                            } else updateTips(data);
                        });
                },
                "Отмена" : function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                allFields.val( "" );
                tips.html( "" );
            }
        });

        $( "#send-request" )
            .click(function() {
                $( "#dialog-form" ).dialog( "open" );
            });
    });
    $(function() {

        var cThemeId = $("#callback-dialog-theme"),
            cName = $( "#callback-dialog-name" ),
            cPhone = $( "#callback-dialog-phone" ),
            cComment = $( "#callback-dialog-comment" ),
            cAllFields = $( [] ).add( cThemeId ).add( cComment ),
            cTips = $( "#callback-dialog-form .validateTips" );

        function updateTips( t ) {
            cTips
                .html( t )
                .addClass( "ui-state-highlight" );
            setTimeout(function() {
                cTips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
        }

        function showGif( t ) {
            cTips.html( t );
        }

        $( "#callback-dialog-form" ).dialog({
            autoOpen: false,
            width: 350,
            modal: true,
            buttons: {
                "Запросить CallBack" : function() {
                    cAllFields.removeClass( "ui-state-error" );
                    showGif("<center><img src='/application/modules/imagebox/templates/js/lightbox/images/loading.gif' /></center>");
                    $.post("/shop/callback", {   ThemeId : cThemeId.val(),
                            Name : cName.val(),
                            Phone : cPhone.val(),
                            Comment : cComment.val()
                        },
                        function(data) {
                            if (data == "done"){
                                updateTips('Ваш запрос отправлен! В ближайшее время с Вами свяжеться наш менеджер.');
                                setTimeout(function() {
                                    $( "#callback-dialog-form" ).dialog( "close" );
                                }, 2500 );
                            } else updateTips(data);
                        });
                },
                "Отмена" : function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                cAllFields.val( "" );
                cTips.html( "" );
            }
        });

        $( "#callback-send-request" )
            .click(function() {
                $( "#callback-dialog-form" ).dialog( "open" );
            });
    });