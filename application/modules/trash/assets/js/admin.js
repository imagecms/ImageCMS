/* global base_url */

$(document).ready(
        function () {

            // переключалка поиска
            $("#autocomplete_param").on(
                    "change",
                    function () {
                        var val = $(this).val();
                        if (val == 'old') {
                            $("#search_urls").autocomplete("option", "source", base_url + 'admin/components/cp/trash/search_url/old');
                        } else {
                            $("#search_urls").autocomplete("option", "source", base_url + 'admin/components/cp/trash/search_url/new');
                        }
                    }
            );

            // search comments with product name or part of comments
            if ($.exists('#search_urls')) {

                $('#search_urls').autocomplete(
                        {                            
                            minLength: 3,
                            source: base_url + 'admin/components/cp/trash/search_url/old',
                            delay: 300,
                            select: function (event, ui) {
                                location.replace(base_url + "admin/components/init_window/trash/edit_trash/" + ui.item.identifier.id);
                            },
                            close: function () {
                                $("#search_urls").attr('value', '');
                            }
                        }
                );
            }

        }
);