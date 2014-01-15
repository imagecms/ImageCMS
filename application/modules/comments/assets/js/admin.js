
function expand_hide_Children(curElement, parent_id) {
    var expandImg = curElement.prev().prev();
    var hideImg = curElement.prev();

    if ($(expandImg).css('display') == 'none') {
        hide_Children(parent_id, hideImg);
        return true;
    }

    if ($(hideImg).css('display') == 'none') {
        expand_Children(parent_id, expandImg);
        return true;
    }
}

function expand_Children(parent_id, curElement)
{
    $(curElement).next().css('display', 'inline-block');
    $(curElement).css('display', 'none');
    
    $(curElement).next().next().text(lang('Hide answers'));
    var items = $('.comment_child_' + parent_id).css('display', 'table-row');
}

function hide_Children(parent_id, curElement)
{
    $(curElement).prev().css('display', 'inline-block');
    $(curElement).css('display', 'none');
    $(curElement).next().text(lang('Show answers'));
    var items = $('.comment_child_' + parent_id).css('display', 'none');
}
