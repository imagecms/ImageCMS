$(document).ready(function() {
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
                        editor.execCommand('mceInsertContent', false, '<pre><code class="php">' + text + '</code></pre>\n');
                    }
                }
            });
        }
    });
});
