$(document).ready(function() {

    /** Page edit (front) **/
    $('#changeLangSelect').bind('change', function() {
        var selectElement = $(this);
        var pageId = selectElement.find("option:selected").data('page_id');
        var langId = selectElement.find("option:selected").val();
        document.location.href = '/documentation/edit_page/' + pageId + '/' + langId;
    });

});