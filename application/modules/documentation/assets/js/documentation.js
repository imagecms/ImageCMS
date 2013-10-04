tinymce.init({
    selector: "div.description",
    inline: true,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste spellchecker responsivefilemanager"
    ],
    language: 'ru',
    toolbar_items_size: 'small',
    spellchecker_language: "ru",
    spellchecker_rpc_url: "http://speller.yandex.net/services/tinyspell",
    toolbar: "undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | highlightcode | spellchecker | save_button",
    image_advtab: true,
    external_filemanager_path: "/templates/documentation/js/tinymce/plugins/responsivefilemanager/",
    filemanager_title: "Responsive Filemanager",
    external_plugins: {"filemanager": "/templates/documentation/js/tinymce/plugins/responsivefilemanager/plugin.min.js"},
    setup: function(editor) {
        editor.addButton('save_button', {
            text: 'Сохранить',
            icon: 'save',
            onclick: function() {
                $.ajax({
                    type: 'post',
                    data: {
                        "desc": tinyMCE.activeEditor.getContent().toString(),
                        "id": id
                    },
                    url: '/documentation/save_desc',
                    complete: function(obj) {
                        tinyMCE.activeEditor.windowManager.alert("Изминения сохранены");
                    }
                });
            }
        });
        editor.addButton('highlightcode', {
            text: 'Код',
            icon: 'code',
            onclick: function() {
                var text = editor.selection.getContent({'format': 'text'});
                if (text && text.length > 0) {
                    editor.execCommand('mceInsertContent', false, '<p>Код:</p><pre><code class="php">' + text + '</code></pre><p> </p>');
                }
            }
        });
    }
});

tinymce.init({
    selector: "h1",
    inline: true,
    toolbar_items_size: 'small',
    toolbar: "undo redo | spellchecker | save_button",
    plugins: ["spellchecker"],
    spellchecker_language: "ru",
    spellchecker_rpc_url: "http://speller.yandex.net/services/tinyspell",
    menubar: false,
    setup: function(editor) {
        editor.addButton('save_button', {
            text: 'Сохранить',
            icon: 'save',
            onclick: function() {
                $.ajax({
                    type: 'post',
                    data: {
                        "h1": tinyMCE.activeEditor.getContent().toString(),
                        "id": id
                    },
                    url: '/documentation/save_title',
                    complete: function(obj) {
                        tinyMCE.activeEditor.windowManager.alert("Изминения сохранены");
                    }
                });
            }
        });
    }
});

tinymce.init({
    selector: ".TinyMCEForm",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste spellchecker responsivefilemanager"
    ],
    language: 'ru',
    spellchecker_language: "ru",
    spellchecker_rpc_url: "http://speller.yandex.net/services/tinyspell",
    toolbar: "undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | highlightcode | spellchecker",
    image_advtab: true,
    toolbar_items_size: 'small',
    external_filemanager_path: "/templates/documentation/js/tinymce/plugins/responsivefilemanager/",
    filemanager_title: "Responsive Filemanager",
    external_plugins: {"filemanager": "/templates/documentation/js/tinymce/plugins/responsivefilemanager/plugin.min.js"},
    setup: function(editor) {
        editor.addButton('highlightcode', {
            text: 'Код',
            icon: 'code',
            onclick: function() {
                var text = editor.selection.getContent({'format': 'text'});
                if (text && text.length > 0) {
                    editor.execCommand('mceInsertContent', false, '<p>Код:</p><pre><code class="php">' + text + '</code></pre><p> </p>');
                }
            }
        });
    }
});

function translite_title(from, to) {
    var url = '/documentation/ajax_translit';
    $.post(
            url, {
                'str': $(from).val()
            }, function(data)

    {
        $(to).val(data);
    });
}

/**  * */
$(document).ready(function() {

    /** Page edit (front) **/
    $('#changeLangSelect').bind('change', function() {
        var selectElement = $(this);
        var pageId = selectElement.find("option:selected").data('page_id');
        var langId = selectElement.find("option:selected").val();
        document.location.href = '/documentation/edit_page/' + pageId + '/' + langId;
    });

});
