function spy(varId) {
    $.ajax({
        type: 'POST',
        url: 'pricespy/spy/' + varId,
        onComplete: function(response) {

        }
    });
}
function unspy(varId) {
    $.ajax({
        type: 'POST',
        url: 'pricespy/unSpy/' + varId,
        onComplete: function(response) {

        }
    });
}
