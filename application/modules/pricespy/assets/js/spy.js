function spy(id, varId) {
    if (!$('#' + varId).hasClass('inSpy')) {
        $.ajax(
            {
                type: 'POST',
                url: '/pricespy/spy/' + id + '/' + varId,
                success: function (data) {
                    obj = JSON.parse(data);
                    if (obj.answer === 'sucesfull') {
                        console.log(document.getElementById(varId).className);
                        document.getElementById(varId).className = 'btn inSpy';
                        document.getElementById(varId).onclick = 'btn inSpy';
                        document.getElementById(varId).value = 'Уже в отслеживание';
                        $('#' + varId).die('click').on(
                            "click",
                            function () {
                                    document.location.href = '/pricespy';
                            }
                        );
                    }
                }
                }
        );
    } else {
        document.location.href = '/pricespy';
    }
}

function unspy(hash) {
    $.ajax(
        {
            type: 'POST',
            url: '/pricespy/unspy/' + hash,
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.answer === 'sucesfull') {
                    $("#" + hash).remove();
                }
            }
            }
    );
}