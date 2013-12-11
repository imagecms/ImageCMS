
/**
 * If there are unsaved changes, then dialog box will be shown
 * @type 
 */
window.onbeforeunload = onUnload;
function onUnload() {
    if (wasChanges == true) {
        return 'Есть несохраненные изменения. Действительно выйти?';
    }
}
var wasChanges = false;

tinymce.init({
    selector: "div.descriptionEditTinyMCE",
    inline: true,
    cleanup: false,
    skin: 'charcoal',
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table  contextmenu spellchecker responsivefilemanager",
        "nonbreaking textcolor"
    ],
    nonbreaking_force_tab: true,
    language: 'ru',
    paste_text_sticky: true,
    force_br_newlines: true,
    force_p_newlines: false,
    forced_root_block: false,
    toolbar_items_size: 'small',
    spellchecker_language: "ru",
    spellchecker_rpc_url: "http://speller.yandex.net/services/tinyspell",
    toolbar: "nonbreaking | undo redo | styleselect | bold italic underline | forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | highlightcode | danger | spellchecker | save_button",
    image_advtab: true,
    external_filemanager_path: "/templates/documentation/js/tinymce/plugins/responsivefilemanager/",
    filemanager_title: "Responsive Filemanager",
    external_plugins: {"filemanager": "/templates/documentation/js/tinymce/plugins/responsivefilemanager/plugin.min.js"},
    setup: function(editor) {
        editor.addShortcut('ctrl+s', 'description', function() {
            $.ajax({
                type: 'post',
                data: {
                    "desc": tinyMCE.activeEditor.getContent().toString(),
                    "id": id
                },
                url: '/documentation/save_desc',
                complete: function(obj) {
                    tinyMCE.activeEditor.windowManager.alert("Измeнения сохранены");
                    wasChanges = false;
                }
            });
        });

        editor.addButton('highlightcode', {
            type: 'listbox',
            text: 'code',
            icon: 'code',
            onselect: function(e) {
                switch (this.value()) {
                    case ('php'):
                        var text = editor.selection.getContent();
                        if (text && text.length > 0) {
                            text = strip_tags(text, '');
                            editor.execCommand('mceInsertContent', false, '<pre><code class="php">' + text + '</code></pre><p> </p>');
                            hljs.initHighlighting.called = false;
                            hljs.initHighlighting();
                        }
                        break;
                    case ('css'):
                        var text = editor.selection.getContent();
                        if (text && text.length > 0) {
                            text = strip_tags(text, '');
                            editor.execCommand('mceInsertContent', false, '<pre><code class="css">' + text + '</code></pre><p> </p>');
                            hljs.initHighlighting.called = false;
                            hljs.initHighlighting();
                        }
                        break;
                    case ('html'):
                        var text = editor.selection.getContent();
                        if (text && text.length > 0) {
                            text = strip_tags(text, '');
                            editor.execCommand('mceInsertContent', false, '<pre><code class="xml">' + text + '</code></pre><p> </p>');
                            hljs.initHighlighting.called = false;
                            hljs.initHighlighting();
                        }
                        break;
                    case ('smarty'):
                        var text = editor.selection.getContent();
                        if (text && text.length > 0) {
                            text = strip_tags(text, '');
                            editor.execCommand('mceInsertContent', false, '<pre><code class="django xml">' + text + '</code></pre><p> </p>');
                            hljs.initHighlighting.called = false;
                            hljs.initHighlighting();
                        }
                        break;
                    case ('javascript'):
                        var text = editor.selection.getContent();
                        if (text && text.length > 0) {
                            text = strip_tags(text, '');
                            editor.execCommand('mceInsertContent', false, '<pre><code class="javascript">' + text + '</code></pre><p> </p>');
                            hljs.initHighlighting.called = false;
                            hljs.initHighlighting();
                        }
                        break;
                    case ('main'):
                        var text = editor.selection.getContent();
                        if (text && text.length > 0) {
                            text = strip_tags(text, '');
                            editor.execCommand('mceInsertContent', false, '<p class="bs-callout-danger">' + text + '</p><p></p>');
                            hljs.initHighlighting.called = false;
                            hljs.initHighlighting();
                        }
                        break;
                }
            },
            values: [
                {text: 'php', value: 'php'},
                {text: 'javascript', value: 'javascript'},
                {text: 'smarty', value: 'smarty'},
                {text: 'css', value: 'css'},
                {text: 'html', value: 'html'},
                {text: 'Важное', value: 'main'}
            ]
        });

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
                        tinyMCE.activeEditor.windowManager.alert("Измeнения сохранены");
                        wasChanges = false;
                    }
                });
            }
        });
        editor.on('change', function() {
            wasChanges = true;
        });

    }


});

tinymce.init({
    selector: ".titleEditTinyMCE",
    inline: true,
    cleanup: false,
    toolbar_items_size: 'small',
    skin: 'charcoal',
    toolbar: "undo redo | spellchecker | save_button",
    plugins: ["spellchecker"],
    spellchecker_language: "ru",
    spellchecker_rpc_url: "http://speller.yandex.net/services/tinyspell",
    menubar: false,
    setup: function(editor) {
        editor.addShortcut('ctrl+s', 'description', function() {
            $.ajax({
                type: 'post',
                data: {
                    "h1": tinyMCE.activeEditor.getContent().toString(),
                    "id": id
                },
                url: '/documentation/save_title',
                complete: function(obj) {
                    tinyMCE.activeEditor.windowManager.alert("Измeнения сохранены");
                    wasChanges = false;
                }
            });
        });

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
                        tinyMCE.activeEditor.windowManager.alert("Измeнения сохранены");
                        wasChanges = false;
                    }
                });
            }
        });

        editor.on('change', function() {
            wasChanges = true;
        });
    }
});

tinymce.init({
    cleanup: false,
    selector: ".TinyMCEForm",
    skin: 'charcoal',
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu  spellchecker responsivefilemanager textcolor"
    ],
    language: 'ru',
    paste_text_sticky: true,
    force_br_newlines: true,
    force_p_newlines: false,
    forced_root_block: false,
    spellchecker_language: "ru",
    spellchecker_rpc_url: "http://speller.yandex.net/services/tinyspell",
    toolbar: "undo redo | styleselect | bold italic underline | forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | highlightcode | danger | spellchecker",
    image_advtab: true,
    toolbar_items_size: 'small',
    external_filemanager_path: "/templates/documentation/js/tinymce/plugins/responsivefilemanager/",
    filemanager_title: "Responsive Filemanager",
    external_plugins: {"filemanager": "/templates/documentation/js/tinymce/plugins/responsivefilemanager/plugin.min.js"},
    setup: function(editor) {
        editor.addButton('highlightcode', {
            type: 'listbox',
            text: 'code',
            icon: 'code',
            onselect: function(e) {
                switch (this.value()) {
                    case ('php'):
                        var text = editor.selection.getContent();
                        if (text && text.length > 0) {
                            text = strip_tags(text, '');
                            editor.execCommand('mceInsertContent', false, '<pre><code class="php">' + text + '</code></pre><p> </p>');
                            hljs.initHighlighting.called = false;
                            hljs.initHighlighting();
                        }
                        break;
                    case ('css'):
                        var text = editor.selection.getContent();
                        if (text && text.length > 0) {
                            text = strip_tags(text, '');
                            editor.execCommand('mceInsertContent', false, '<pre><code class="css">' + text + '</code></pre><p> </p>');
                            hljs.initHighlighting.called = false;
                            hljs.initHighlighting();
                        }
                        break;
                    case ('html'):
                        var text = editor.selection.getContent();
                        if (text && text.length > 0) {
                            text = strip_tags(text, '');
                            editor.execCommand('mceInsertContent', false, '<pre><code class="xml">' + text + '</code></pre><p> </p>');
                            hljs.initHighlighting.called = false;
                            hljs.initHighlighting();
                        }
                        break;
                    case ('smarty'):
                        var text = editor.selection.getContent();
                        if (text && text.length > 0) {
                            text = strip_tags(text, '');
                            editor.execCommand('mceInsertContent', false, '<pre><code class="django xml">' + text + '</code></pre><p> </p>');
                            hljs.initHighlighting.called = false;
                            hljs.initHighlighting();
                        }
                        break;
                    case ('javascript'):
                        var text = editor.selection.getContent();
                        if (text && text.length > 0) {
                            text = strip_tags(text, '');
                            editor.execCommand('mceInsertContent', false, '<pre><code class="javascript">' + text + '</code></pre><p> </p>');
                            hljs.initHighlighting.called = false;
                            hljs.initHighlighting();
                        }
                        break;
                    case ('main'):
                        var text = editor.selection.getContent();
                        if (text && text.length > 0) {
                            text = strip_tags(text, '');
                            editor.execCommand('mceInsertContent', false, '<p class="bs-callout-danger">' + text + '</p><p></p>');
                            hljs.initHighlighting.called = false;
                            hljs.initHighlighting();
                        }
                        break;
                }
            },
            values: [
                {text: 'php', value: 'php'},
                {text: 'javascript', value: 'javascript'},
                {text: 'smarty', value: 'smarty'},
                {text: 'css', value: 'css'},
                {text: 'html', value: 'html'},
                {text: 'Важное', value: 'main'}
            ]
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


/** 
 * Create category check validation and display result 
 * @returns {undefined} 
 * */
function createCategory() {
    var formIdent = $('#create_cat');
    var formData = formIdent.serialize();
    $('.modalErrosBlock').hide();
    $('.modalCategoryCreatedSuccesBlock').hide();

    $.ajax({
        async: false,
        type: 'post',
        url: formIdent.attr('action'),
        data: formData,
        success: function(response) {
            /** Parse json response **/
            try {
                responseObj = $.parseJSON(response);
            } catch (e) {
                return 'error parsing jsone';
            }
            /** Process results **/
            if (responseObj.success === 'false') {
                console.log(responseObj);
                $('.modalErrosBlock').html(responseObj.errors);
                $('.modalErrosBlock').show();
            } else {
                $('.modalCategoryCreatedSuccesBlock').show();
                setTimeout("location.reload(true);", 1000);
            }
        }
    });
}

/** 
 * Edit category check validation and display result 
 * @returns {undefined} 
 * */
function editCategory() {
    var formIdent = $('#edit_cat');
    var formData = formIdent.serialize();
    $('.modalErrosBlock').hide();
    $('.modalCategoryCreatedSuccesBlock').hide();
    console.log(formData);
    $.ajax({
        async: false,
        type: 'post',
        url: formIdent.attr('action'),
        data: formData,
        success: function(response) {
            /** Parse json response **/
            try {
                responseObj = $.parseJSON(response);
            } catch (e) {
                return 'error parsing jsone';
            }
            /** Process results **/
            if (responseObj.success === 'false') {
                console.log(responseObj);
                $('.modalErrosBlock').html(responseObj.errors);
                $('.modalErrosBlock').show();
            } else {
                $('.modalCategoryCreatedSuccesBlock').show();
                console.log(responseObj.data.full_url);
                setTimeout(function() {
                    window.location = "/" + responseObj.data.full_url;
                }, 1000);
            }
        }
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

function strip_tags(str, allowed_tags)
{

    var key = '', allowed = false;
    var matches = [];
    var allowed_array = [];
    var allowed_tag = '';
    var i = 0;
    var k = '';
    var html = '';
    var replacer = function(search, replace, str) {
        return str.split(search).join(replace);
    };
    // Build allowes tags associative array
    if (allowed_tags) {
        allowed_array = allowed_tags.match(/([a-zA-Z0-9]+)/gi);
    }
    str += '';

    // Match tags
    matches = str.match(/(<\/?[\S][^>]*>)/gi);
    // Go through all HTML tags
    for (key in matches) {
        if (isNaN(key)) {
            // IE7 Hack
            continue;
        }

        // Save HTML tag
        html = matches[key].toString();
        // Is tag not in allowed list? Remove from str!
        allowed = false;

        // Go through all allowed tags
        for (k in allowed_array) {            // Init
            allowed_tag = allowed_array[k];
            i = -1;

            if (i != 0) {
                i = html.toLowerCase().indexOf('<' + allowed_tag + '>');
            }
            if (i != 0) {
                i = html.toLowerCase().indexOf('<' + allowed_tag + ' ');
            }
            if (i != 0) {
                i = html.toLowerCase().indexOf('</' + allowed_tag);
            }

            // Determine
            if (i == 0) {
                allowed = true;
                break;
            }
        }
        if (!allowed) {
            str = replacer(html, "", str); // Custom replace. No regexing
        }
    }
    return str;
}








;