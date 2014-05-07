$(document).ready(function() {

    function getAnswerCodeMessage(code, type) {
        switch (code.toString()) {
            case '200':
                return true;
                break;
            case '401':
                return lang('Wrong API key.');
                break;
            case '402':
                return lang('API key is locked.');
                break;
            case '403':
                return lang('Exceeded the daily limit on the number of requests.');
                break;
            case '404':
                return lang('Exceeded the daily limit on the amount of translated text.');
                break;
            case '413':
                return lang('Exceeded the maximum allowable size of text.');
                break;
            case '422':
                return lang('Text can not be translated.');
                break;
            case '501':
                return lang('Set direction of translation is not supported.');
                break;
            default:
                return lang('Translation fails.');

        }
    }

    function showTranslationForm(curentElement, e) {
        if (e.ctrlKey && e.altKey) {
            var currentMousePos = {x: -1, y: -1};
            currentMousePos.x = event.pageX - $('#trabslateForm').width() / 2;
            currentMousePos.y = event.pageY + 20;

            var translation = $.trim($(curentElement).html());
            var origin = $.trim($(curentElement).attr('origin'));
            var domain = $.trim($(curentElement).attr('domain'));

            setTimeout(function() {
                $('#trabslateForm').css({
                    top: currentMousePos.y + 'px',
                    left: currentMousePos.x + 'px'
                });
                $('#trabslateForm').find('.succ').hide();
                $('#trabslateForm').find('.error_text').hide();
                $('#trabslateForm').hide().fadeIn(400)
                $('#trabslateForm').find('#translation').val(translation);
                $('#trabslateForm').find('#origin').val(origin);
                $('#trabslateForm').find('#domain').val(domain);
            }, 300);
        }
    }

    $('translate').die().live('mouseover', function(e) {
        showTranslationForm(this, e)
    });

    $('#trabslateForm > .hideformButton').die().live('click', function() {
        $('#trabslateForm').hide();
    });

    $('#trabslateForm button').live('click', function() {
        var translation = $.trim($(this).closest('form').find('#translation').val());
        var origin = $.trim($(this).closest('form').find('#origin').val());
        var comment = $.trim($(this).closest('form').find('#comment').val());
        var domain = $.trim($(this).closest('form').find('#domain').val());
        $.ajax({
            url: '/translator/translate',
            type: 'POST',
            data: {
                translation: translation,
                origin: origin,
                comment: comment,
                domain: domain
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.success) {
                    $('#trabslateForm').find('.succ').find('.success').html('');
                    $('#trabslateForm').find('.succ').find('.success').append('<p>' + data.message + '</p>');
                    $('#trabslateForm').find('.succ').show();
                } else {
                    if (data.errors) {
                        var messageText = '';
                        if ($.isArray(data.message)) {
                            for(var message in data.message){
                                messageText += '<p>' + data.message[message] + '</p>';
                            }
                        } else {
                            messageText = '<p>' + data.message+ '</p>';
                        }

                        $('#trabslateForm').find('.error_text .text-el').html('');
                        $('#trabslateForm').find('.error_text .text-el').append(messageText);
                        $('#trabslateForm').find('.error_text').show();
                    }
                }
            }
        });
        return false;
    });

    $('#autoTranslate').live('click', function() {
        var textToTranslate = encodeURI($('#trabslateForm').find('#origin').val());
        $.ajax({
            url: '/translator/getSettings',
            type: 'POST',
            success: function(data) {
                data = JSON.parse(data);
                if (data.YandexApiKey) {
                    $.ajax({
                        url: 'https://translate.yandex.net/api/v1.5/tr.json/translate?key=' + data.YandexApiKey + '&text=' + textToTranslate + '&lang=' + data.curLocale + '&format=plain',
                        success: function(Answer) {
                            if (Answer.code == '200') {
                                $('#trabslateForm').find('#translation').val(Answer.text[0]);
                                $('#trabslateForm').find('.succ').find('.success').html('');
                                $('#trabslateForm').find('.succ').find('.success').append('<p>' + lang('Successfully translated.') + '</p>');
                                $('#trabslateForm').find('.succ').show();
                            } else {
                                var error = getAnswerCodeMessage(Answer.code);
                                $('#trabslateForm').find('.error_text .text-el').html('');
                                $('#trabslateForm').find('.error_text .text-el').append('<p>' + error + '</p>');
                                $('#trabslateForm').find('.error_text').show();
                            }
                        }
                    });
                } else {
                    $('#trabslateForm').find('.error_text .text-el').html('');
                    $('#trabslateForm').find('.error_text .text-el').append('<p>' + lang('You did not specified Yandex Api Key. Please set it in translator module settins.') + '</p>');
                    $('#trabslateForm').find('.error_text').show();
                }
            }
        });
    });
});