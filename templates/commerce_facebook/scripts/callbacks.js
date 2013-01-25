// Initi callback window
$(function() {

    var themeId = $("#callback-dialog-theme"),
        name = $( "#callback-dialog-name" ),
        phone = $( "#callback-dialog-phone" ),
        comment = $( "#callback-dialog-comment" ),
        allFields = $( [] ).add( themeId ).add( comment ),
        tips = $( "#callback-dialog-form .validateTips" );

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

    $( "#callback-dialog-form" ).dialog({
        autoOpen: false,
        width: 350,
        modal: true,
        buttons: {
            "Запросить CallBack" : function() {
                allFields.removeClass( "ui-state-error" );
                showGif("<center><img src='/application/modules/imagebox/templates/js/lightbox/images/loading.gif' /></center>");
                $.post("/shop/callback", {   ThemeId : themeId.val(),
                        Name : name.val(),
                        Phone : phone.val(),
                        Comment : comment.val()
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
            allFields.val( "" );
            tips.html( "" );
        }
    });

    $( "#callback-send-request" )
        .click(function() {
            $( "#callback-dialog-form" ).dialog( "open" );
        });
});