function autosearch(el, path, div, tpl) {
    if ($(el).val() == 'default')
        return false;
    selector = div;
    $.post(path, {
        queryString: $(el).val(),
        tpl: tpl
    }, function(data) {
        if (data.length > 0) {
            $(div).fadeIn();
            $(div).html(data);
        }
        else
            $(div).fadeOut();
    });
}

$(document).ready(function() {
    selector = '';
    $('body').live('click', function(event) {
        event.stopPropagation();
        if ($(event.target).is(selector) || $(event.target).parents().is(selector))
            return;
        else
            $(selector).fadeOut();
    })
})

