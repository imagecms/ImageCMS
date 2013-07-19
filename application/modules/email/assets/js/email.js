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

    $('#userMailVariables').on('click', function() {
        $('#userMailText #tinymce').append(' ' + $(this).val() + ' ');
    });

    $('#adminMailVariables').on('click', function() {
        $('#adminMailText').append(' ' + $(this).val() + ' ');
    });

    $('.mailTestResultsHide').on('click', function() {
        $('.mailTestResults').css('display', 'none');
        $(this).css('display', 'none');

    });

    $('table.variablesTable .icon-edit').live('click', function() {
        var editor = $(this).closest('tr').find('div.variable');
        console.log(editor);
        var editValue = $.trim(editor.text());
        editor.empty();
        editor.parent().find('.variableEdit').css('display', 'block').val(editValue);

        var editor = $(this).closest('tr').find('div.variableValue');
        console.log(editor);
        var editValue = $.trim(editor.text());
        editor.empty();
        editor.parent().find('.variableValueEdit').css('display', 'block').val(editValue);

        $(this).parent('.editVariable').css('display', 'none');
        $(this).closest('tr').find('.refreshVariable').css('display', 'block');

    });
    $('.addVariable').on('click', function() {
        $('.addVariableContainer').css('display', '');
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
        url: '/email/mailTest',
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
    delete: function(template_id, variable, curElement) {
        $.ajax({
            type: 'POST',
            data: {
                template_id: template_id,
                variable: variable
            },
            url: '/email/admin/deleteVariable',
            success: function(data) {
                curElement.closest('tr').remove();
                showMessage('Сообщение', 'Переменная успешно удалена');
            }
        });
    },
    update: function(curElement, template_id, oldVariable) {
        var variable = curElement.closest('tr').find('.variableEdit');
        var variableValue = curElement.closest('tr').find('.variableValueEdit');

        this.validateVariable(variable.val(), variableValue.val());

        $.ajax({
            type: 'POST',
            data: {
                variable: variable.val(),
                variableValue: variableValue.val(),
                oldVariable: oldVariable,
                template_id: template_id
            },
            url: '/email/admin/updateVariable',
            success: function(data) {
                curElement.closest('tr').find('.variable').text(variable.val());
                curElement.closest('tr').find('.variableValue').text(variableValue.val());
                variable.css('display', 'none');
                variableValue.css('display', 'none');
                curElement.closest('tr').find('.editVariable').css('display', 'block');
                curElement.closest('tr').find('.refreshVariable').css('display', 'none');
                showMessage('Сообщение', 'Переменная успешно обновлена');
            }
        });
    },
    add: function(curElement, template_id) {
        var variable = curElement.closest('tr').find('.variableEdit');
        var variableValue = curElement.closest('tr').find('.variableValueEdit');

        this.validateVariable(variable.val(), variableValue.val());

        $.ajax({
            type: 'POST',
            data: {
                variable: variable.val(),
                variableValue: variableValue.val(),
                template_id: template_id
            },
            url: '/email/admin/addVariable',
            success: function(data) {
                curElement.parent('div').find('.typeVariable').val('');
                $('.addVariableContainer').css('display', 'none');
                $(data).insertBefore('table.variablesTable .addVariableContainer');
                showMessage('Сообщение', 'Переменная успешно додана');
            }
        });
    },
    updateVariablesList: function(curElement, template_id) {
        if (!curElement.hasClass('active')) {
            $.ajax({
                type: 'POST',
                data: {
                    template_id: template_id
                },
                url: '/email/admin/getTemplateVariables',
                success: function(data) {
                    $('#userMailVariables').html(data);
                    $('#adminMailVariables').html(data);
                }
            });
        }
    },
    validateVariable: function(variable, variableValue) {
        if (variable[0] != '%' || variable[variable.length - 1] != '%') {
            showMessage('Сообщение', 'Переменну должни окружать %', 'r');
            exit;
        }
        if (!variableValue) {
            showMessage('Сообщение', 'Переменная должна иметь значение', 'r');
            exit;
        }
    }
};
