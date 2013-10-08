$("a.articleHistoryControl").on('click', function() {
    var url = $(this).attr("data-url");
    $.ajax({
        url: url,
        async: false,
        type: "get",
        dataType: "text",
        complete: function(data) {
            location.reload();
        }
    });

});

$("a.compareWithOriginal").on('click', function() {
    var oldText = $(this)
            .parent()
            .parent()
            .siblings(".article-data")
            .text();

    var currentText = $(".article-data.active-article-status").text();

    var dmp = new diff_match_patch();
    var res = dmp.diff_main(oldText, currentText);
    var diffHtmlResult = dmp.diff_prettyHtml(res);

    $("#articles_diff .modal-body")
            .empty()
            .html(diffHtmlResult);
    $("#articles_diff").modal("show");
});