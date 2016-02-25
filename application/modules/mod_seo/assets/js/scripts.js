jQuery.fn.extend({
    insertAtCaret: function (myValue) {
        return this.each(function (i) {
            if (document.selection) {
                //For browsers like Internet Explorer
                this.focus();
                var sel = document.selection.createRange();
                sel.text = myValue;
                this.focus();
            }
            else if (this.selectionStart || this.selectionStart == '0') {
                //For browsers like Firefox and Webkit based
                var startPos = this.selectionStart;
                var endPos = this.selectionEnd;
                var scrollTop = this.scrollTop;
                this.value = this.value.substring(0, startPos) + myValue + this.value.substring(endPos, this.value.length);
                this.focus();
                this.selectionStart = startPos + myValue.length;
                this.selectionEnd = startPos + myValue.length;
                this.scrollTop = scrollTop;
            } else {
                this.value += myValue;
                this.focus();
            }
        });
    }
});

$(document).ready(function () {

    function log(arg) {
        console.log(arg)
    }

    var popover_ref = false;
    $('.popover_ref').live('click', function () {
        popover_ref = this;
    })

    $('b').live('click', function () {
        if (!popover_ref) {
            return false;
        }

        var variable = $.trim($(this).text());
        if (variable[0] === '%' & variable[variable.length - 1] === '%') {
            variable = ' ' + variable + ' ';
            $(popover_ref).closest('label').find('textarea').insertAtCaret(variable);
            $(popover_ref).closest('label').find('input').insertAtCaret(variable);

            if (tinyMCE.activeEditor) {
                var activeEditor = tinyMCE.activeEditor.contentAreaContainer;
                var curEditor = $(popover_ref).closest('.control-group').find('div[id*="mceu_"].mce-edit-area');
            }

            if ($(activeEditor).is(curEditor)) {
                tinyMCE.execCommand("mceInsertContent", false, variable);
            }
        }
    });


    /**  Autocomplete for categories    */
    if ($('#autocomleteCategory').length) {
        $('#autocomleteCategory').autocomplete({
            source: base_url + 'admin/components/cp/mod_seo/categoryAutocomplete?limit=20',
            select: function (event, ui) {
                categoriesData = ui.item;
            },
            close: function () {
                $('#autocomleteCategoryId').val(categoriesData.id);
            }
        });
    }


    /** Change active or not category*/
    $('body').on('click', 'span.prod-on_off.categorySeo', function () {
        var catId = $(this).attr('data-id');
        changeActive();
        $.ajax({
            type: 'POST',
            data: 'id=' + catId,
            url: base_url + 'admin/components/init_window/mod_seo/ajaxChangeActiveCategory',
            success: function (response) {
                if (response == 'true')
                    showMessage(lang('Message'), lang('Status changed'))
            }
        });
    });


    /** Change use for empty meta*/
    $('body').on('click', 'span.prod-on_off.emptyMetaSeo', function () {
        var catId = $(this).attr('data-id');
        changeEmtyActive();
        $.ajax({
            type: 'POST',
            data: 'id=' + catId,
            url: base_url + 'admin/components/init_window/mod_seo/ajaxChangeEmptyMetaCategory',
            success: function (response) {
                if (response == 'true')
                    showMessage(lang('Message'), lang('Status changed'));
            }
        });
    });

    function changeEmtyActive() {
        $('.prod-on_off.emptyMetaSeo').die('click');
        $('.prod-on_off.emptyMetaSeo').live('click', function () {
            var $this = $(this);
            if (!$this.hasClass('disabled')) {
                if ($this.hasClass('disable_tovar')) {

                    $this.parent().attr('data-original-title', lang('No'))
                    $('.tooltip-inner').text(lang('No'));

                }
                else {

                    if ($this.parent().data('only-original-title') == undefined) {
                        $this.parent().attr('data-original-title', lang('Yes'))

                        $('.tooltip-inner').text(lang('Yes'));
                    }
                }

            }
        });
    }

    /**Change Active */
    function changeActive() {
        $('.prod-on_off.categorySeo').die('click');
        $('.prod-on_off.categorySeo').live('click', function () {
            var $this = $(this);
            if (!$this.hasClass('disabled')) {
                if ($this.hasClass('disable_tovar')) {

                    $this.parent().attr('data-original-title', lang('Not show'))
                    $('.tooltip-inner').text(lang('Not show'));

                }
                else {

                    if ($this.parent().data('only-original-title') == undefined) {
                        $this.parent().attr('data-original-title', lang('Show'))

                        $('.tooltip-inner').text(lang('Show'));
                    }
                }

            }
        });
    }

});


