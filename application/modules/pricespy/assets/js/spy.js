function spy(id, varId, $this) {
    $.ajax({
        type: 'POST',
        url: 'pricespy/spy/' + id + '/' + varId,
        success: function(obj) {
//            if (obj.answer == 'sucesfull') {
                $('.btn').val('aaaa');
//            }
//            else {
//            }
        }
    });
}

function unspy(hash) {
    $.ajax({
        type: 'POST',
        url: 'pricespy/unSpy/' + hash,
        onComplete: function(response) {

        }
    });
}
