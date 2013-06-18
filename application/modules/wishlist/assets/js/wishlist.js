function addToWL(id, varId) {

    if (!$('#' + varId).hasClass('inWL')) {
        $.ajax({
            type: 'POST',
            url: '/wishlist/addItem/' + id + '/' + varId,
            success: function(data) {
                obj = JSON.parse(data);
                if (obj.answer === 'sucesfull') {
                    $('#' + varId).val('Уже в Списке Желания');
                    document.getElementById(varId).className = 'btn inWL';
                    document.getElementById(varId).onclick = 'btn inWL';
                    $('#' + varId).die('click').on("click", function() {
                        document.location.href = '/wishlist';
                    });
                }
            }
        });
    } else {
        document.location.href = '/wishlist';
    }
}

function unspy(hash) {
    $.ajax({
        type: 'POST',
        url: '/pricespy/unspy/' + hash,
        success: function(data) {
            obj = JSON.parse(data);
            if (obj.answer === 'sucesfull')
                $("#" + hash).remove();
        }
    });
}