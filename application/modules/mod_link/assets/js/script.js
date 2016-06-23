$(document).ready(function () {


    $(document).on('pjax:end', function () {
        initAutocomplete()
    });

    initAutocomplete();

    function initAutocomplete() {

        $('#linkedProducts').autocomplete({
            minChars: 0,
            source: function (request, response) {
                var locale = $("input[name='linked[locale]']").val()
                $.ajax({
                    url: '/admin/components/run/shop/kits/get_products_list/products',
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        limit: 20,
                        q: request.term,
                        noids: getLinkedProductsIds(),
                        locale: locale ? locale : null,
                    },
                    success: function (data) {
                        response(data);
                    }
                })

            },
            select: function (event, ui) {
                var product = ui.item;
                var row = $("#row_default").clone();
                var src = product.photo ? product.photo : base_url + '/templates/administrator/images/select-picture.png';

                $(row.find("td")[1]).html('<a href="/admin/components/run/shop/products/edit/' + product.id + '">' + product.name + '</a>');//.val(product.name);
                $(row.find("td")[2]).find('img').attr('src', src);

                var input = $(row.find("input"));
                input.attr('name', 'linked[products][]');
                input.val(product.id);

                var table = $('#linkedProductsBlock tbody');
                table.prepend(row);
                row.show();

                $('#linkedProductsBlock').show();
            },
            close: function (event, ui) {
                $(this).attr('value', '');
            }
        });

        $('.remove_linked_row').live('click', function () {
            $(this).closest('tr').remove();
            if ($('#linkedProductsBlock').find('tbody tr').length === 1) {
                $('#linkedProductsBlock').hide();
            }
        });
    }

    function getLinkedProductsIds() {
        var inputs = $("#linkedProductsBlock input[name='linked[products][]']");
        var idsString = '';
        $(inputs).each(function () {
            idsString += this.value + ",";
        });
        idsString = idsString.substring(0, (idsString.length - 1));
        return idsString;
    }

    $(document).on('click','#permanentCheck', function () {
        $('#hideDate').toggle()
    });
})