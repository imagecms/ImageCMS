function denyPermitions() {
    if (!$.exists('.permition_deny')) {
        $('body').append('<div class="modal hide fade permition_deny"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3>' + langs.accessDenied + '</h3></div><div class="modal-body"><p>' + langs.thisIsDemoMessage + '</p></div></div>');
    }

    if ($.exists('.formSubmit')) {
        $('.formSubmit').die('click').unbind('click');
        if ($.exists('.permition_deny')) {
            $('.formSubmit').bind('click', function() {
                $('.permition_deny').modal();
            })
        }
    }

    if ($.exists('.icon-trash')) {
        var parent = $('.icon-trash').parent();
        parent.removeAttr('onclick').die('click').unbind('click');
        if ($.exists('.permition_deny')) {
            parent.bind('click', function() {
                $('.permition_deny').modal();
            })
        }
    }

    if ($.exists('.com_del')) {
        $('.com_del').die('click').unbind('click');
        if ($.exists('.permition_deny')) {
            $('.com_del').bind('click', function() {
                $('.permition_deny').modal();
            })
        }
    }

    if ($.exists('.prod-on_off')) {
        $('.frame_prod-on_off').children('span').die('click').unbind();
        $('.frame_prod-on_off').children('span').bind('click', function() {
            $('.permition_deny').modal();
            return false;
        });
    }


}
