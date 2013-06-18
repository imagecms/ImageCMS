function addToWL(varId) {
    //if (!$('#' + varId).hasClass('inWL')) {
    var checkedList = $('#wishCart input[type=radio]:checked');
    if (checkedList.length) {
        var listID = checkedList.data('id');
        var listName = "";
        if(checkedList.hasClass('newWishList')){
            listID = false;
            listName = $('.wish_list_name').val();
        }
        $.ajax({
            type: 'POST',
            url: '/wishlist/addItem/' + varId + '/' + listID + '/' + listName,
            success: function(data) {
                if (data) {
                    $('.overlayDrop').remove();
                    $('#wishCart').css('display', 'none');
                }
//                obj = JSON.parse(data);
//                if (obj.answer === 'sucesfull') {
//                    $('#' + varId).val('Уже в Списке Желания');
//                    document.getElementById(varId).className = 'btn inWL';
//                    document.getElementById(varId).onclick = 'btn inWL';
//                    $('#' + varId).die('click').on("click", function() {
//                        document.location.href = '/wishlist';
//                    });
//                }
            }
        });
    }

//    } else {
//        //document.location.href = '/wishlist';
//    }
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
function renderPopup(varId, wlBtn) {
    console.log(wlBtn)

    var popupTemplate = '';
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/wishlist/renderPopup/' + varId,
        success: function(data) {
            if (data) {
                popupTemplate = data.popup;
                if (!$('.wishTMP').length) {
                    body.append(popupTemplate);
                }

                body.append('<div class="overlayDrop drop_overlay_fixed" style="position: fixed; width: 100%; height: 100%; left: 0px; top: 0px; z-index: 1001; background-color: rgb(0, 0, 0); opacity: 0.6;"></div>')
                $('#wishCart').css('display', 'block');

            }
        }
    });

//    $('#wishCart').css('display', 'block');
//    console.log($('#wishCart'))




}
function removePopup() {
    $('.overlayDrop').remove();
    $('#wishCart').css('display', 'none');
}

$('.overlayDrop').live('click', function() {
    this.remove();
    $('#wishCart').css('display', 'none');

});