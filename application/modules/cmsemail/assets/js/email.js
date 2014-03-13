$(document).ready(function() {


    $('.protocolSettings').on('change', function() {
        if ($(this).val() === "SMTP") {
            $('.portControlGroup').css('display', 'block');
        } else {
            $('.portControlGroup').css('display', 'none');
        }
    });

    $('.niceCheck').on('click', function() {
        if ($(this).find('.wraper_activSettings').attr('checked')) {
            $('.wraperControlGroup').slideUp(500);
        } else {
            $('.wraperControlGroup').slideDown(500);
        }
    });

    $('#userMailVariables').die().live('click', function() {
        tinyMCE.execInstanceCommand('userMailText', "mceInsertContent", false, ' ' + $(this).val() + ' ');
    });


    $('#adminMailVariables').die().live('click', function() {
        tinyMCE.execInstanceCommand('adminMailText', "mceInsertContent", false, ' ' + $(this).val() + ' ');
    });

    $('.mailTestResultsHide').on('click', function() {
        $('.mailTestResults').css('display', 'none');
        $(this).css('display', 'none');

    });

    $('table.variablesTable .icon-edit').die().live('click', function() {
        var editor = $(this).closest('tr').find('div.variable');

        var editValue = $.trim(editor.text());
        editor.empty();
        editor.parent().find('.variableEdit').css('display', 'block').val(editValue);

        var editor = $(this).closest('tr').find('div.variableValue');
        var editValue = $.trim(editor.text());
        editor.empty();
        editor.parent().find('.variableValueEdit').css('display', 'block').val(editValue);

        $(this).parent('.editVariable').css('display', 'none');
        $(this).closest('tr').find('.refreshVariable').css('display', 'block');

    });

    $('.addVariable').on('click', function() {
        $('.addVariableContainer').show();
    });
});

function mailTest() {
    var from = $('#from').val();
    var from_email = $('#from_email').val();
    var theme = $('#theme').val();
    var protocol = $('#protocol').val();
    var port = $('#port').val();
    var mailpath = $('#mailpath').val();
    var send_to = $('#admin_email').val();

    $.ajax({
        type: 'POST',
        data: {
            from: from,
            from_email: from_email,
            theme: theme,
            protocol: protocol,
            port: port,
            mailpath: mailpath,
            send_to: send_to
        },
        url: '/admin/components/cp/cmsemail/mailTest',
        success: function(data) {
            $('.mailTestResults').html(data);
            $('.mailTestResults').css('display', 'block');
            $('.mailTestResultsHide').css('display', 'block');
            var curPos = $(document).scrollTop();
            var height = $("body").height();
            var scrollTime = (height - curPos) / 1.73;
            $("body,html").animate({"scrollTop": height}, scrollTime);
        }
    });
    return false;
}

var EmailTemplateVariables = {
    delete: function(template_id, variable, curElement, locale) {
        $.ajax({
            type: 'POST',
            data: {
                template_id: template_id,
                variable: variable
            },
            url: '/admin/components/cp/cmsemail/deleteVariable/' + locale,
            success: function(data) {
                if (!data) {
                    showMessage(lang('Error'), lang('Variable is not removed'), 'r');
                    return false;
                }
                curElement.closest('tr').remove();
                showMessage(lang('Message'), lang('Variable successfully removed'));
            }
        });
    },
    update: function(curElement, template_id, oldVariable, locale) {
        var closestTr = curElement.closest('tr');
        var variable = closestTr.find('.variableEdit');
        var variableValue = closestTr.find('.variableValueEdit');

        this.validateVariable(variable.val(), variableValue.val());

        $.ajax({
            type: 'POST',
            data: {
                variable: $.trim(variable.val()),
                variableValue: $.trim(variableValue.val()),
                oldVariable: oldVariable,
                template_id: template_id
            },
            url: '/admin/components/cp/cmsemail/updateVariable/' + locale,
            success: function(data) {
                if (!data) {
                    showMessage(lang('Error'), lang('Variable is not updated'), 'r');
                    return false;
                }
                closestTr.find('.variable').text(variable.val());
                closestTr.find('.variableValue').text(variableValue.val());
                variable.css('display', 'none');
                variableValue.css('display', 'none');
                closestTr.find('.editVariable').css('display', 'block');
                closestTr.find('.refreshVariable').css('display', 'none');
                showMessage(lang('Message'), lang('Variable successfully updated'));
            }
        });
    },
    add: function(curElement, template_id, locale) {
        var variable = curElement.closest('tr').find('.variableEdit');
        var variableValue = curElement.closest('tr').find('.variableValueEdit');

        this.validateVariable(variable.val(), variableValue.val());

        $.ajax({
            type: 'POST',
            data: {
                variable: $.trim(variable.val()),
                variableValue: $.trim(variableValue.val()),
                template_id: template_id
            },
            url: '/admin/components/cp/cmsemail/addVariable/' + locale,
            success: function(data) {
                if (!data) {
                    showMessage(lang('Error'), lang('Variable is not added'), 'r');
                    return false;
                }
                curElement.parent('div').find('.typeVariable').val('');
                $('.addVariableContainer').css('display', 'none');
//                $('.addVariableContainer button').data('variable', $.trim(variable.val()));
                $(data).insertBefore('table.variablesTable .addVariableContainer');
                showMessage(lang('Message'), lang('Variable successfully added'));
            }
        });
    },
    updateVariablesList: function(curElement, template_id, locale) {
        if (!curElement.hasClass('active')) {
            $.ajax({
                type: 'POST',
                data: {
                    template_id: template_id
                },
                url: '/admin/components/cp/cmsemail/getTemplateVariables/' + locale,
                success: function(data) {
                    $('#userMailVariables').html(data);
                    $('#adminMailVariables').html(data);
                }
            });
        }
    },
    validateVariable: function(variable, variableValue) {
        var variable = $.trim(variable);
        var variableValue = $.trim(variableValue);

        if (!variable) {
            showMessage(lang('Error'), lang('Enter variable'), 'r');
            exit;
        }

        if (variable.match(/[а-яА-Я]{1,}/)) {
            showMessage(lang('Error'), lang('Variable should contain only Latin characters'), 'r');
            exit;
        }

        if ((variable[0] != '$' || variable[variable.length - 1] != '$') || variable.length < 3) {
            showMessage(lang('Error'), lang('Variable must be surrounded by $'), 'r');
            exit;
        }
        
        if (!variableValue) {
            showMessage(lang('Error'), lang('Variable must have a value'), 'r');
            exit;
        }
    }
};
