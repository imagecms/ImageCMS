function addToWL(id, varId) {
    template = _.template($('script#wishPopupTemplate').html());
    $('#wishCart').css('display', 'block');
    console.log($('#wishCart'))
    if (!$('.wishTMP').length)
    {
        $('#wishCart').append(_.template($('script#wishPopupTemplate').html(), {}));
    }

    body.append('<div class="overlayDrop drop_overlay_fixed" style="position: fixed; width: 100%; height: 100%; left: 0px; top: 0px; z-index: 1001; background-color: rgb(0, 0, 0); opacity: 0.6;"></div>')

    $('.overlayDrop').click(function() {
        this.remove();
        $('#wishCart').css('display', 'none');

    });

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

