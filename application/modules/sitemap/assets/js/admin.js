/**
 * Site Map url object
 * @type type
 */
var SiteMap = {
    addHidenUrl: function(curElement) {
        var hide_url = $('#hide_url').val();
        var newUrlContainer = $('.addHidenUrlClone').clone();
        $(newUrlContainer).find('.hide_url').val(hide_url);
        $(newUrlContainer).find('.hide_url').attr('name', 'hide_urls[]');
        $(newUrlContainer).insertAfter('.addHidenUrlClone');
        $(newUrlContainer).removeClass('addHidenUrlClone');
        $(newUrlContainer).show();
        $('#hide_url').val('');
        $('.robots_check').each(function(number) {
            $(this).attr('name', 'robots_check[' + number + ']');
        });
    },
    removeHidenUrl: function(curElement) {
        $(curElement).closest('.control-group').remove();
        $('.robots_check').each(function(number) {
            $(this).attr('name', 'robots_check[' + number + ']');
        });
    },
    saveSiteMap: function() {
        $.ajax({
            url: '/admin/components/init_window/sitemap/saveSiteMap',
            success: function(data) {
                $('.notifications.top-right').append(data);
            }
        });
    }
};