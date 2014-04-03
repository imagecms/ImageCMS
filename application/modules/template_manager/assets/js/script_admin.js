$(document).ready(function() {
    setTimeout(function() {
        $('.t_notice_on_load').fadeOut();
    }, 3000);
});




// prewiew local image
$('#logofav input[type="file"]').die('change').live('change', function(e) {
    // checking if file is image
    var allowedFileExtentions = ['jpg', 'jpeg', 'png', 'ico', 'gif'];
    var ext = $(this).val().split('.').pop();
    var extentionIsAllowed = false;
    for (var i = 0; i < allowedFileExtentions.length; i++) {
        if (allowedFileExtentions[i] == ext) {
            extentionIsAllowed = true;
            break;
        }
    }
    if (extentionIsAllowed == false) {
        $(this).removeAttr("value");
        showMessage("Ошибка", "Можно загружать только изображения", "error");
        return;
    }

    // creating image preview
    var file = this.files[0];
    var img = document.createElement("img");
    var reader = new FileReader();
    reader.onloadend = function() {
        img.src = reader.result;
    };

    reader.readAsDataURL(file);
    $(img).addClass('img-polaroid');
    $(this).siblings('.controls').html(img);

});