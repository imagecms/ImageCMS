$('input#phone').mask("+99 (999) 999-99-99");

function showError(fieldId, errorMessage) {
    $('input#' + fieldId).siblings('label[for="' + fieldId + '"]').remove();
    $('input#' + fieldId).after('<label for="' + fieldId + '" generated="true" class="alert alert-error">' + errorMessage + '</label>');
}


