var YmarketProductTab = {
    showHideMonths: function(curObj) {
        if (!$(curObj).hasClass('active')) {
            $(curObj).closest('.controls').find('select').show();
            $(curObj).closest('.controls').find('select').removeAttr('disabled');
        } else {
            $(curObj).closest('.controls').find('select').hide();
            $(curObj).closest('.controls').find('select').attr('disabled', 'disabled');
        }
    }
};

function changeAgregator(agregator){
    $('.tab-pane').css('display','none');
    $('#'+agregator).css('display', 'block');
    $('select').trigger('chosen:updated');
}