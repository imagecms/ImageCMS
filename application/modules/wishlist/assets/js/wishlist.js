function addToWL(varId) {
    //if (!$('#' + varId).hasClass('inWL')) {
    var checkedList = $('#wishCart input[type=radio]:checked');
    if (checkedList.length) {
        var listID = checkedList.data('id');
        var listName = false;
        var commentProduct = $('.wishProductComment').val();
        
        if(checkedList.hasClass('newWishList')){
            listID = false;
            listName = $('.wish_list_name').val();
        }
        
        $.ajax({
            type: 'POST',
            data: {
                varId: varId,
                listID: listID,
                listName: listName,
                commentProduct: commentProduct                
            },
            url: '/wishlist/addItem',
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
    
    
//    }

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
    var popupTemplate = '';
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/wishlist/renderPopup/' + varId,
        success: function(data) {
            if (data) {
                if (!$('.wishTMP').length) {
                    body.append(data.popup);
                }
                body.append('<div class="overlayDrop drop_overlay_fixed" style="position: fixed; width: 100%; height: 100%; left: 0px; top: 0px; z-index: 1001; background-color: rgb(0, 0, 0); opacity: 0.6;"></div>')
                $('#wishCart').css('display', 'block');
            }
        }
    });
}

function removePopup() {
    $('.overlayDrop').remove();
    $('#wishCart').css('display', 'none');
}

$('.overlayDrop').live('click', function() {
    this.remove();
    $('#wishCart').css('display', 'none');

});
