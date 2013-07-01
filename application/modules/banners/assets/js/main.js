function ChangeBannerSliderActive(obj, id) {
    $.post('/admin/components/init_window/banners/chose_active', {status: $(obj).attr('rel'), id: id}, function() {
        if ($(obj).attr('rel') == 'true')
            $(obj).addClass('disable_tovar').attr('rel', false);
        else
            $(obj).removeClass('disable_tovar').attr('rel', true);
    })

}

function DeleteSliderBanner() {
    var ids = new Array();
    $('[name=ids]:checked').each(function() {
        ids.push($(this).val());
    })
    $.post('/admin/components/init_window/banners/delete', {id: JSON.stringify(ids)}, function() {
        window.location.reload()
    })
}

function selectEntity(obj) {
    var el = $(obj);
    var id = el.attr('data-id');
    var name = el.text();
    var type = $('#banner_type').val();
    var html = "<option value='" + type + "_" + id + "' ondblclick='delEntity(this)'>" + type + ' - ' + name + "</option>";
    $('#data').append(html);

    var $s = $('#data');

    var optionTop = $s.find('[value="' + type + "_" + id + '"]').offset().top;
    var selectTop = $s.offset().top;

    $s.scrollTop($s.scrollTop() + (optionTop - selectTop));

    return false;
}

function delEntity(obj) {

    $(obj).remove();
    return false;

}
<<<<<<< HEAD

=======
//autosearch(this, '/admin/components/init_window/banners/autosearch', '#autodrop', 'autodrop')
>>>>>>> d888f7481798821a48812ef40868da9a7f0cb876
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
<<<<<<< HEAD
}

function selects() {
    $('#data option').attr('selected', 'selected');

}

=======
}

function selects() {
    $('#data option').attr('selected', 'selected');

}

>>>>>>> d888f7481798821a48812ef40868da9a7f0cb876

$(document).ready(function() {
    if ($('.slider').length) {
        $('.slider').cycle();
    }

    selector = '';
    $('body').live('click', function(event) {
        event.stopPropagation();
        if ($(event.target).is(selector) || $(event.target).parents().is(selector))
            return;
        else
            $(selector).fadeOut();
    })


});
