function addToWL(varId) {
    var checkedList = $('#wishCart input[type=radio]:checked');
    if (checkedList.length) {
        var listID = checkedList.data('id');
        var listName = false;
        var commentProduct = $('.wishProductComment').val();

        if (checkedList.hasClass('newWishList')) {
            listID = false;
            listName = $('.wish_list_name').val();
            if (listName === "Создать список") {
                $('#errors').css('display', 'block')
                $('#wishCart .error').html('');
                $('#wishCart .error').append('<p>Неверная назва списка</p>');
                return false;
            }
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
                    var errors = {};
                    var response = JSON.parse(data);

                    if (response.answer == "error") {
                        errors = response.errors;
                        var outErrors = "";
                        for (var error in errors) {
                            outErrors += errors[error];
                        }
                        $('#errors').css('display', 'block')
                        $('#wishCart .error').html('');
                        $('#wishCart .error').append(outErrors);
                    }
//                   // $('.overlayDrop').remove();
                    $('#wishCart .addWL').css('display', 'none');
                    $('#wishCart .share_tov').css('display', 'block');

                    //--------------------

                    $('#' + varId).val('Уже в Списке Желания');
                    $('#' + varId).addClass('inWL');
                    $('#' + varId).bind('click');
                    $('#' + varId).die('click').on("click", function() {
                        document.location.href = '/wishlist';
                    });

                }
            }
        });
    } else {
        $('#errors').css('display', 'block')
        $('#wishCart .error').html('');
        $('#wishCart .error').append('<p>Список не обран</p>');
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
function editWL() {
    var title = $('.wishListTitle').text();
    $('.wishListTitle').replaceWith('<input type="text value="' + +'">')
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
    var maxListsCount = $(this).data('maxlistscount');
    if (listCount >= maxListsCount) {
        if (!$('.listsLimit').length) {
            $('.newWishListLable').append('<div class="listsLimit">Лимит вишлистов закончен</div>');
        }

        $(this).removeAttr('checked');
        $('.wish_list_name').blur();
        return false;
    }
});
