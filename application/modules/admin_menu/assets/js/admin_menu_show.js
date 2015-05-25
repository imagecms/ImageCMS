var AdminMenu = {
    searchModule: function (el) {
        var searchText = $(el).val().toLowerCase();
        var modules = $(el).closest('ul').find('a');

        if (event.keyCode != 13) {
            if (searchText) {
                $(modules).each(function () {
                    var moduleName = $.trim($(this).text()).toLowerCase();
                    if (moduleName.indexOf(searchText) != -1) {
                        $(this).closest('li').show();
                    } else {
                        if ($(this).attr('href').indexOf('modules_table') == -1) {
                            $(this).closest('li').hide();
                        }
                    }
                });
            } else {
                $(modules).closest('ul').find('li').show();
            }
        } else {
            var searched = $(el).closest('ul').find('li').not('[style="display: none;"]');
            if (searched.length >= 4) {
                var url = $(searched[4]).find('a').attr('href');
                if (url) {
                    location.href = url;
                }
            }
        }
    }
};