function addToWL(varId) {
    var checkedList = $('#wishCart input[type=radio]:checked');
    if (checkedList.length) {
        var listID = checkedList.data('id');
        var listName = false;
        var commentProduct = $('.wishProductComment').val();

        if (checkedList.hasClass('newWishList')) {
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
            url: '/wishlist/wishlistAJAX/addItem',
            success: function(data) {
                if (data) {
                    $('.overlayDrop').remove();
                    $('#wishCart').css('display', 'none');
                    obj = JSON.parse(data);
                    if (obj.answer === 'sucesfull') {
                        $('#' + varId).val('Уже в Списке Желания');
                        $('#' + varId).addClass('inWL');
                        $('#' + varId).bind('click');
                        $('#' + varId).die('click').on("click", function() {
                            document.location.href = '/wishlist';
                        });
                    }
                }
            }
        });
    }
}

function delFromWL($this, varID, WLID) {
    $.ajax({
        type: 'POST',
        data: {
            varID: varID,
            WLID: WLID
        },
        url: '/wishlist/wishlistAJAX/deleteItem',
        success: function(data) {
            obj = JSON.parse(data);
            if (obj.answer === 'sucesfull')
                $($this).closest('tr').remove();
        }
    });
}

function delWL($this) {
    $.ajax({
        type: 'POST',
        url: '/wishlist/wishlistAJAX/deleteItem',
        success: function(data) {
            obj = JSON.parse(data);
            if (obj.answer === 'sucesfull')
                $($this).closest('.table').remove();
        }
    });
}
function editWL(){
    var title = $('.wishListTitle').text();
}

function renderPopup(varId, wlBtn) {
    if (!$('#' + varId).hasClass('inWL')) {
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
    } else
        document.location.href = '/wishlist';
}

function removePopup() {
    $('.overlayDrop').remove();
    $('#wishCart').remove();
}

$('.overlayDrop').live('click', function() {
    
    this.remove();
    $('#wishCart').remove();

});
$('.newWishList').live('click', function() {
    var listCount = $(this).data('listscount');
    if (listCount >= 10) {
        if (!$('.listsLimit').length) {
            $('.newWishListLable').append('<div class="listsLimit">Лимит вишлистов закончен</div>');
        }

        $(this).removeAttr('checked');
        $('.wish_list_name').blur();
        return false;
    }
});
