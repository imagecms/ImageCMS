function denyPermitions() {
    if (!$.exists('.permition_deny')) {
        $('body').append('<div class="modal hide fade permition_deny"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3>' + langs.accessDenied + '</h3></div><div class="modal-body"><p>' + langs.thisIsDemoMessage + '</p></div></div>');
    }

    if ($.exists('.formSubmit')) {
        $('body').off('click.permitions');
        if ($.exists('.permition_deny')) {
            $('.formSubmit').on('click', function(e) {
                $('.permition_deny').modal();
                e.stopPropagation()
                return false;
            });
        }
    }

    if ($.exists('.icon-trash')) {
        var parent = $('.icon-trash').parent();
        parent.removeAttr('onclick').die('click').unbind('click');
        if ($.exists('.permition_deny')) {
            parent.bind('click', function(e) {
                $('.permition_deny').modal();
                e.stopPropagation()
                return false;
            })
        }
    }

    if ($.exists('.com_del')) {
        $('.com_del').die('click').unbind('click');
        if ($.exists('.permition_deny')) {
            $('.com_del').bind('click', function(e) {
                $('.permition_deny').modal();
                e.stopPropagation()
                return false;
            })
        }
    }


    if ($.exists('.frame_prod-on_off')) {
        // $('.frame_prod-on_off').children('span').die('click').unbind();
        $('.frame_prod-on_off > span').on('click', function(e) {
            $('.permition_deny').modal();
            e.stopPropagation()
            return false;
        });
    }

    if ($.exists('.show_template_agreement')) {
        $('.show_template_agreement').live('click', function(e) {
            $('#license_agreement_modal').remove();
            $('.modal-backdrop').remove();
            $('.permition_deny').modal();
            e.stopPropagation()
            return false;
        });
    }

}
