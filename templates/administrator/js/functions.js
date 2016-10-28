/* global locale, elfToken, MAINSITE */

var editorsEnabled = false;
/**
 * Getting/Setting caret position
 * @param node domObject
 * @param int begin
 * @param int end
 *
 */
function caret(domObject, begin, end) {
    var range;

    if (typeof begin == 'number') {
        end = (typeof end === 'number') ? end : begin;
        return $(domObject).each(function () {
            if (domObject.setSelectionRange) {
                domObject.setSelectionRange(begin, end);
            } else if (domObject.createTextRange) {
                range = domObject.createTextRange();
                range.collapse(true);
                range.moveEnd('character', end);
                range.moveStart('character', begin);
                range.select();
            }
        });
    } else {
        if (domObject[0].setSelectionRange) {
            begin = domObject[0].selectionStart;
            end = domObject[0].selectionEnd;
        } else if (document.selection && document.selection.createRange) {
            range = document.selection.createRange();
            begin = 0 - range.duplicate().moveStart('character', -100000);
            end = begin + range.text.length;
        }
        return {begin: begin, end: end};
    }
}
// read cookie by name
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0)
            return c.substring(nameEQ.length, c.length);
    }
    return null;
}
function setCookie(name, value, expires, path, domain, secure) {
    var today = new Date();
    today.setTime(today.getTime());
    if (expires) {
        expires = expires * 1000 * 60 * 60 * 24;
    }
    var expiresDate = new Date(today.getTime() + (expires));
    document.cookie = name + "=" + encodeURIComponent(value) +
        ((expires) ? ";expires=" + expiresDate.toGMTString() : "") + ((path) ? ";path=" + path : "") +
        ((domain) ? ";domain=" + domain : "") +
        ((secure) ? ";secure" : "");
}

// expand categories tree to show last visited category
function expandCategories(button) {
    var fullPathIds = JSON.parse(decodeURIComponent(readCookie('category_full_path_ids')));
    for (var cat in fullPathIds) {
        if (!$('.cat' + fullPathIds[cat]).hasClass('clicked')) {
            $('.cat' + fullPathIds[cat]).trigger('click');
            $('.cat' + fullPathIds[cat]).addClass('clicked')
            $('.cat' + fullPathIds[cat]).css('display', 'none')
            $('.cat' + fullPathIds[cat]).prev().css('display', 'inline-block')
        }
        if ($(button).hasClass('.cat' + fullPathIds[cat]) && !$(button).hasClass('clicked')) {
            $(button).trigger('click');
            $(button).addClass('clicked');
            $(button).css('display', 'none');
            $(button).prev().css('display', 'inline-block');
        }
    }
}

$(document).ready(function () {
    // run function expandCategories in categoriest list view
    if (window.location.pathname == '/admin/components/run/shop/categories/index') {
        expandCategories();
    }
});

function ajaxLoadChildCategory(el, id) {

    var container = $(el).closest('.row-category');

    if (container.next().attr('class') != 'frame_level sortable ui-sortable')
        $.post('/admin/components/run/shop/categories/ajax_load_parent', {id: id}, function (data) {
            $(data).insertAfter(container);
//            expandCategories($(data).find('.expandButton'))
            initNiceCheck();
            share_alt_init();
            sortInit();
        })


}

function changeDefaultValute(id) {

    $.post('/admin/components/run/shop/currencies/makeCurrencyDefault', {id: id})

}
function changeMainValute(id, curElement) {
    $('.btn-danger').removeAttr('disabled');

    curElement.closest('table').find('.currencies-value').each(function () {
        $(this).removeClass('disabled').removeAttr('disabled');
    });
    curElement.closest('tr').find('.currencies-value').addClass('disabled').attr('disabled', 'disabled');


    $(curElement).closest('tr').find('.btn-danger').attr('disabled', 'disabled');

    $('.frame_prod-on_off').removeClass('d_n');
    $(curElement).closest('tr').find('.frame_prod-on_off').addClass('d_n');

    var additionalCurrency = $(curElement).closest('tr').find('.prod-on_off ');
    if (!$(additionalCurrency).hasClass('disable_tovar')) {
        $(additionalCurrency).addClass('disable_tovar').css('left', '-28px');

        $.ajax({
            type: "post",
            data: {id: id, showOnSite: 0},
            url: '/admin/components/run/shop/currencies/showOnSite',
            success: function (data) {
                //alert(data)
            },
            error: function () {

            }
        });
    }

    $.post('/admin/components/run/shop/currencies/makeCurrencyMain', {id: id})


}
function ChangeMenuItemActive(obj, id) {
    $.post('/admin/components/cp/menu/chose_hidden', {status: $(obj).attr('rel'), id: id}, function () {
        if ($(obj).attr('rel') == 'true')
            $(obj).addClass('disable_tovar').attr('rel', false);
        else
            $(obj).removeClass('disable_tovar').attr('rel', true);
    })

}


function ChangeBannerActive(el, bannerId) {
    var currentActiveStatus = $(el).attr('rel');

    $.post('/admin/components/run/shop/banners/changeActive/', {
        bannerId: bannerId,
        status: currentActiveStatus
    }, function (data) {
        $('.notifications').append(data)
        if (currentActiveStatus == 'true') {
            $(el).addClass('disable_tovar').attr('rel', false);

        } else {
            $(el).removeClass('disable_tovar').attr('rel', true);
        }

    });
}
// on/of sorting method
function ChangeSortActive(el, sortId) {
    var currentActiveStatus = $(el).attr('rel');

    $.post('/admin/components/run/shop/settings/changeSortActive/', {
        sortId: sortId,
        status: currentActiveStatus
    }, function (data) {

        $('.notifications').append(data)
        if (currentActiveStatus == 'true') {
            $(el).addClass('disable_tovar').attr('rel', false);

        } else {
            $(el).removeClass('disable_tovar').attr('rel', true);
        }
        $(el).closest('tr').find('.orderMethodsRefresh').removeClass('disabled')
        $(el).closest('tr').find('.orderMethodsRefresh').removeAttr('disabled')
        $(el).closest('tr').find('.orderMethodsEdit').removeClass('disabled')
        $(el).closest('tr').find('.orderMethodsEdit').removeAttr('disabled')
    });
}

var shopAdminMenuCache = false;

function showMessage(title, text, messageType, delay) {
    delay = delay || 6000;
    text = '<h4>' + title + '</h4>' + text;
    messageType = typeof messageType !== 'undefined' ? messageType : 'success';
    if (messageType == 'r')
        messageType = 'error';
    $('.notifications').notify({
        message: {
            html: text
        },
        type: messageType,
        fadeOut: {
            enabled: true,
            delay: delay
        }
    }).show();
}

function translite_title(from, to) {
    var url = base_url + 'admin/pages/ajax_translit/';
    $.post(
        url, {
            'str': $(from).val()
        }, function (data) {
            $(to).val(data);
        }
    );
}

function create_description(from, to) {
    if ($('.workzone textarea.elRTE').length)
        $('.workzone textarea.elRTE').elrte('updateSource');

    $.post(
        base_url + 'admin/pages/ajax_create_description/', {
            'text': $(from).val()
        },
        function (data) {
            $(to).val(data);
        }
    );
}

function retrive_keywords(from, to) {
    if ($('.workzone textarea.elRTE').length)
        $('.workzone textarea.elRTE').elrte('updateSource');

    $.post(base_url + 'admin/pages/ajax_create_keywords/', {
            'keys': $(from).val()
        },
        function (data) {
            $(to).html(data);
        }
    );
}

function ajax_div(target, url) {
    $.ajax(url, {
        headers: {
            'X-PJAX': 'X-PJAX'
        },
        success: function (data) {
            $('#' + target).append(data);
        }
    });
}
function validateNumeric(selector) {
    $(selector).bind('keyup', function () {

        var value = $(this).val();
        console.log(value);
        var regexp = /[^0-9]/gi;
        value = value.replace(regexp, '');

        // Can not begin from 0
        if (parseInt(value) == 0)
            value = '';
        $(this).val(value);

        // Percent
        if (parseInt(value) > 99) {
            $(this).val(99);
        }
    })

}

//submit form
$('form input[type="submit"], form button[type="submit"]').off('click.validate').on('click.validate', function (e) {
    var form = $(this).closest('form');

    form.validate();
    if (!form.valid())
        e.preventDefault();
});

function handleFormSubmit() {
    //        collectMCEData();
    //update content in textareas with elRTE
    var $this = $(this);

    if ($('.workzone textarea.elRTE').length)
        $('.workzone textarea.elRTE').elrte('updateSource');

    //copy data into textarea
//    if(textEditor && 'tinymce' == textEditor){
//        tinyMCE.triggerSave();
//    }

    var selector = $this.attr('data-form'),
        action = $this.data('action'),
        data = $this.data('adddata'),
        form = $(selector);


    form.validate();
    if (form.valid()) {
        showLoading();
        var options = {
            data: $.extend({
                "action": action
            }, eval('(' + data + ')')),
            success: function (data) {
                hideLoading();
                var resp = document.createElement('div');
                resp.innerHTML = data;
                $(resp).find('p').remove();
                $('.notifications').append(resp);
                $this.removeClass('disabled').attr('disabled', false);
                return true;
            }
        };
        form.ajaxSubmit(options);
    }
    else
        $this.removeClass('disabled').attr('disabled', false);
    return false;
}
$('body').off('click.validate').on('click.validate', '.formSubmit', handleFormSubmit);

function loadShopInterface() {
    if ($.browser.opera == true) {
        window.location = '/admin/components/run/shop/dashboard';
    }
    if ($('#baseSearch')) {
        $('#baseSearch').val('');
        $('#baseSearch').attr('id', 'shopSearch');
        $('#adminAdvancedSearch').attr('action', '/admin/components/run/shop/search/advanced');
        initShopSearch();
    }
    // Switch menu
    $('#baseAdminMenu').hide();
    $('#shopAdminMenu').show();

    $('li').removeClass('active');
    $('#shopAdminMenu li.homeAnchor').addClass('active');

    $.pjax({
        url: '/admin/components/run/shop/dashboard',
        container: '#mainContent',
        timeout: 3000
    });
    isShop = true;
    $('a.logo').attr('href', '/admin/components/run/shop/dashboard');
    return false;
}

function loadBaseInterface() {
    if ($.browser.opera == true) {
        window.location = '/admin';
    }

    if ($('#shopSearch')) {
        $('#shopSearch').val('');
        $('#shopSearch').attr('id', 'baseSearch');
        $('#adminAdvancedSearch').attr('action', '/admin/admin_search');
        initBaseSearch();
    }
    // Switch menu
    $('#shopAdminMenu').hide();
    $('#baseAdminMenu').show();

    $('li').removeClass('active');
    $('#baseAdminMenu li.homeAnchor').addClass('active');

    $.pjax({
        url: '/admin/dashboard',
        container: '#mainContent',
        timeout: 3000
    });
    isShop = false;
    $('a.logo').attr('href', '/admin/dashboard');
    return false;
}

function initBaseSearch() {
    $.get('/admin/admin_search/autocomplete', function (data) {
        baseAutocompleteData = JSON.parse(data);
        $('#baseSearch').autocomplete({
            source: baseAutocompleteData
        });
    });
}

function initShopSearch() {

    $('#shopSearch').autocomplete({
        source: '/admin/components/run/shop/search/autocomplete'
    });
}

function initElRTE() {
    elRTE.prototype.options.toolbars.custom = [
        "copypaste", "undoredo", "elfinder", "style", "alignment", "direction", "colors", "format", "indent", "lists", "links", "elements", "media", "tables", "fullscreen"
    ];
    elRTE.prototype.options.toolbars.empty = [];
    var opts = {
        //lang: 'ru',   // set your language
        styleWithCSS: false,
        height: 300,
        fmAllow: true,
        lang: locale.substr(0, 2),
        allowTextNodes: false,
        //        Format: 'Paragraph',
        fmOpen: function (callback) {
            //			    if (typeof dialog === 'undefined') {
            // create new elFinder
            dialog = $('<div />').dialogelfinder({
                url: '/admin/elfinder_init',
                lang: locale.substr(0, 2),
                commands: [
                    'open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook',
                    'download', 'rm', 'rename', 'mkdir', 'mkfile', 'upload', 'edit', 'preview', 'extract', 'archive', 'search', 'info', 'view', 'help', 'sort'
                ],
                uiOptions: {
                    // toolbar configuration
                    toolbar: [
                        ['back', 'forward'],
                        ['reload'],
                        ['home', 'up'],
                        ['mkdir', 'mkfile', 'upload'],
                        //        		['mkfile', 'upload'],
                        //        		['open', 'download', 'getfile'],
                        ['download'],
                        ['info'],
                        ['quicklook'],
                        ['rm'],
                        //        		['duplicate', 'rename', 'edit', 'resize'],
                        ['duplicate', 'rename', 'edit'],
                        ['extract', 'archive'],
                        ['view', 'sort'],
                        ['help'],
                        ['search']
                    ],
                },
                contextmenu: {
                    // navbarfolder menu
                    //        	navbar : ['open', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'info'],

                    // current directory menu
                    //        	cwd    : ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'info'],

                    // current directory file menu
                    files: [
                        'edit', 'rename', '|', 'download', '|',
                        'rm', '|', 'archive', 'extract', '|', 'info'
                    ]
                },
                commandsOptions: {
                    getfile: {
                        oncomplete: 'destroy' // close/hide elFinder
                    }
                },
                getFileCallback: function (file) {
                    callback('/' + file.path);
                },
                customData: {
                    cms_token: elfToken
                }
                //			        getFileCallback: callback // pass callback to file manager
            });
            //			    } else {
            //			      // reopen elFinder
            //			      dialog.dialogelfinder('open')
            //			    }
        },
        toolbar: 'custom'
    };
    $('textarea.elRTE.focusOnClick').each(function () {
        var rte = $(this);
        rte.on('focus', function () {
            rte.elrte(opts);
        });
    });

    $('textarea.elRTE').not('.focusOnClick').each(function () {
        var rte = $(this);
        if (rte.is(':visible') && !rte.closest('div.workzone').length > 0)
            rte.elrte(opts);
    });
}

// RESPONSIVE FILEMANAGER init settings
function initFileManager() {
    console.log("filemanager init");
    if (0 !== $('.iframe-btn').length) {
        $('.iframe-btn').fancybox({
            'width': 900,
            'height': 600,
            'type': 'iframe',
            'autoScale': false
        });
    }

    function responsive_filemanager_callback(field_id) {
        console.log(field_id);
        var url = jQuery('#' + field_id).val();
        alert('update ' + field_id + " with " + url);
        //your code
    }

}
// RESPONSIVE FILEMANAGER init end

// only numeric input symbols
function validateN(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    var regex = /^[0-9]+$/;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault)
            theEvent.preventDefault();
    }
}
// only numeric input symbols end


function discountPerc(el, evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    var regex = /^[0-9]+$/;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault)
            theEvent.preventDefault();
    }
}


// only numeric input symbols width dott
function validateNwDott(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault)
            theEvent.preventDefault();
    }
}
// only numeric input symbols end

function isEditorInitialized(editor) {
    return editor && editor.initialized;
}

function initTinyMCE(selector) {
    selector = selector ? selector : 'textarea.elRTE';
    tinymce.remove(selector);
    tinymce.editors = [];
    console.log('initTinyMCE');
    var availableLocales = ['uk', 'ru', 'en'];
    try {
        tinymce.init({
            fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
            selector: selector,
            verify_html: false,
            forced_root_block: 'p',
            browser_spellcheck: true,
            language: (-1 != availableLocales.indexOf(locale.substr(0, 2))) ? locale.substr(0, 2) : 'en',
            toolbar_items_size: 'small',
            plugins: [
                "codemirror advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager",
                "fullscreen imagetools save"
            ],
            convert_urls: false,
            setup: function (editor) {
                editor.on('change', function (e) {
                    tinyMCE.triggerSave();
                });
            },
            image_advtab: true,
            image_title: true,
            toolbar: "undo redo | fontsizeselect | fontselect | bold italic underline | backcolor forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fullscreen",
            external_filemanager_path: "/application/third_party/filemanager/",
            filemanager_title: "Responsive Filemanager",
            external_plugins: {"filemanager": "/application/third_party/filemanager/plugin.min.js"},
            codemirror: {
                indentOnInit: true, // Whether or not to indent code on init.
                path: 'CodeMirror', // Path to CodeMirror distribution
                config: {           // CodeMirror config object
                    mode: 'text/html',
                    extraKeys: {
                        "Ctrl-Space": "autocomplete",
                    },
                    lineNumbers: true,
                    lineWrapping: true,
                    foldGutter: true,
                    gutters: [
                        "CodeMirror-linenumbers",
                        "CodeMirror-foldgutter"
                    ],
                    selectionPointer: true,
                },


                cssFiles: [
                    // Start code hinting
                    'addon/hint/show-hint.css',
                    // End code hinting

                    // Start code folding
                    'addon/fold/foldgutter.css',
                    // End code folding
                ],
                jsFiles: [          // Additional JS files to load
                    'mode/clike/clike.js',
                    'mode/php/php.js',

                    // Start code hinting
                    'addon/hint/show-hint.js',
                    'addon/hint/xml-hint.js',
                    'addon/hint/html-hint.js',
                    // End code hinting

                    // Start code folding
                    "addon/fold/foldcode.js",
                    "addon/fold/foldgutter.js",
                    "addon/fold/brace-fold.js",
                    "addon/fold/xml-fold.js",
                    "addon/fold/markdown-fold.js",
                    "addon/fold/comment-fold.js",
                    // End code folding

                    "addon/selection/selection-pointer.js",

                    "mode/xml/xml.js",
                    "mode/htmlmixed/htmlmixed.js",
                    "mode/javascript/javascript.js",
                    "mode/css/css.js",
                ]
            }
        });
        tinymce.initialized = true;
    } catch (err) {
        console.log('error - ' + err.message);
    }
}

function initTextEditor(name) {
    if (typeof (name) != 'undefined' && name.length != 0 && name != 'none')
        ({
            'elrte': initElRTE,
            'tinymce': initTinyMCE
        }[name]())
}

var dlg = false;
function elFinderPopup(type, id, path, onlyMimes) {
    fId = id;
    if (typeof path == 'undefined')
        path = '';
    if (typeof onlyMimes == 'undefined')
        onlyMimes = [];
    //todo: create diferent browsers (check 'type' variable)
    if (!dlg) {
        dlg = $('#elFinder').dialogelfinder({
            url: '/admin/elfinder_init',

            lang: locale.substr(0, 2),
            commands: [
                'open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook',
                'download', 'rm', 'rename', 'mkdir', 'mkfile', 'upload', 'edit', 'preview', 'extract', 'archive', 'search', 'info', 'view', 'help', 'sort'
            ],
            uiOptions: {
                // toolbar configuration
                toolbar: [
                    ['back', 'forward'],
                    ['reload'],
                    ['home', 'up'],
                    ['mkdir', 'mkfile', 'upload'],
                    //        		['mkfile', 'upload'],
                    //        		['open', 'download', 'getfile'],
                    ['download'],
                    ['info'],
                    ['quicklook'],
                    ['rm'],
                    //        		['duplicate', 'rename', 'edit', 'resize'],
                    ['duplicate', 'rename', 'edit'],
                    ['extract', 'archive'],
                    ['view', 'sort'],
                    ['help'],
                    ['search']
                ],
                // directories tree options
                tree: {
                    // expand current root on init
                    openRootOnLoad: true,
                    // auto load current dir parents
                    syncTree: true
                },
            },
            commandsOptions: {
                getfile: {
                    oncomplete: 'close' // close/hide elFinder
                },
            },
            getFileCallback: function (file) {
                if (path != '') {
                    var str = file.path;
                    var m = str.match('[\\\\ /]');
                    file.path = file.path.substr(m.index + 1);
                    if (path[0] != '/')
                        path = '/' + path;
                }
                file.path = file.path.replace(/\134/g, '/');
                $('#' + fId).val(path + '/' + file.path);

                if (type == 'image' && $('#' + fId + '-preview').length) {
                    var img = document.createElement('img');
                    img.src = $('#' + fId).val();
                    img.className = "img-polaroid";
                    $('#' + fId + '-preview').html(img);
                }
            },
            contextmenu: {
                // navbarfolder menu
                //        	navbar : ['open', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'info'],

                // current directory menu
                //        	cwd    : ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'info'],

                // current directory file menu
                files: [
                    'edit', 'rename', '|', 'download', '|',
                    'rm', '|', 'archive', 'extract', '|', 'info'
                ]
            },
            customData: {
                cms_token: elfToken,
                path: path
            },
            onlyMimes: [onlyMimes]
        });
    }
    else
        dlg.show();
    return false;
}

function elFinderTPLEd() {
    if (MAINSITE) {
        var commands = [
            'open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook',
            'rm', 'rename', 'mkdir', 'mkfile', 'upload', 'edit', 'preview', 'search', 'info', 'view', 'help', 'sort'
        ];
    } else {
        var commands = [
            'open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook',
            'download', 'rm', 'rename', 'mkdir', 'mkfile', 'upload', 'edit', 'preview', 'extract', 'archive', 'search', 'info', 'view', 'help', 'sort'
        ];
    }

    //todo: create diferent browsers (check 'type' variable)
    eD = $('#elFinderTPLEd').elfinder({
        url: '/admin/elfinder_init/1',
        height: $(window).height() * 0.6,
        lang: locale.substr(0, 2),
        commands: commands,
        commandsOptions: {
            edit: {
                dialogWidth: 980,
                mimes: ['text/plain', 'text/css', 'text/html', 'text/javascript', 'text/x-php'],
                editors: [{
                    mimes: ['text/plain', 'text/css', 'text/html', 'text/javascript', 'text/x-php'],
                    load: function (textarea) {

                        textarea.editor = {
                            instance: null
                        };

                        var mimeType = this.file.mime;
                        return CodeMirror.fromTextArea(textarea, {
                            mode: mimeType,
                            lineNumbers: true,
                            //extraKeys: {
                            //    "Ctrl-Space": "autocomplete"
                            //},
                            lineWrapping: true,
                            foldGutter: true,
                            gutters: [
                                "CodeMirror-linenumbers",
                                "CodeMirror-foldgutter"
                            ],
                            //
                            selectionPointer: true

                        });
                    },
                    save: function (textarea, editor) {
                        $(textarea).val(editor.getValue());
                    }
                }]
            }
        },
        uiOptions: {
            // toolbar configuration
            toolbar: [
                ['back', 'forward'],
                ['reload'],
                ['home', 'up'],
                ['mkdir', 'mkfile', 'upload'],
                //        		['mkfile', 'upload'],
                //        		['open', 'download', 'getfile'],
                ['download'],
                ['info'],
                //        		['quicklook'],
                ['rm'],
                //        		['duplicate', 'rename', 'edit', 'resize'],
                ['rename', 'edit'],
                ['extract', 'archive'],
                ['view', 'sort'],
                ['help'],
                ['search']
            ],
            // directories tree options
            tree: {
                // expand current root on init
                openRootOnLoad: true,
                // auto load current dir parents
                syncTree: true
            },
        },
        getFileCallback: function (e, ev, c) {
            //self.fm.select($(this), true);
            eD.exec('edit');
            return false;

            //self.ui.exec(self.ui.isCmdAllowed('open') ? 'open' : 'select');
        },
        contextmenu: {
            // navbarfolder menu
            //        	navbar : ['open', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'info'],

            // current directory menu
            //        	cwd    : ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'info'],

            // current directory file menu
            files: [
                'edit', 'rename', '|', 'download', '|', 'copy', 'cut', 'paste', '|',
                'rm', '|', 'archive', 'extract', '|', 'info'
            ]
        },
        customData: {
            cms_token: elfToken
        }
        //onlyMimes: ['text'],
    }).elfinder('instance');

    eD.bind('get', function (v) {
        $('textarea.elfinder-file-edit').closest('div.ui-dialog').css({
            'width': '90%',
            'left': '5%'
        });
    });
}

var orders = new Object({
    mergeSelected: function () {
        $('#merge-orders-modal').modal();
    },
    mergeOrdersConfirm: function () {
        var ids = new Array();
        $('input[name=ids]:checked').each(function () {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/orders/ajaxMergeOrders/', {
            ids: ids
        }, function (data) {
            $('#mainContent').after(data);
            $.pjax({
                url: window.location.pathname,
                container: '#mainContent',
                timeout: 3000
            });
        });
        $('.modal').modal('hide');
        return true;
    },
    chOrderStatus: function (status) {
        var ids = new Array();
        $('input[name=ids]:checked').each(function () {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/orders/ajaxChangeOrdersStatus/' + status, {
            ids: ids
        }, function (data) {
            $('#mainContent').after(data);
            $.pjax({
                url: window.location.href,
                container: '#mainContent',
                timeout: 3000
            });
        });
        return true;
    },
    fixAddressA: function () {
        $('#postAddressBtn').attr('href', "http://maps.google.com/?q=" + $('#postAddress').val());
        return true;
    },
    chOrderPaid: function (paid) {
        var ids = new Array();
        $('input[name=ids]:checked').each(function () {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/orders/ajaxChangeOrdersPaid/' + paid, {
            ids: ids
        }, function (data) {
            $('#mainContent').after(data);
            $.pjax({
                url: window.location.href,
                container: '#mainContent',
                timeout: 3000
            });
        });
        return true;
    },
    chPrint: function () {
        var ids = new Array();
        var orderIds = '';
        $('input[name=ids]:checked').each(function () {
            orderIds += "/" + parseInt($(this).val());
        });

        location.href = "/admin/components/run/shop/orders/ajaxPrint" + orderIds;
    },
    deleteOrders: function () {
        $('#delete-orders-modal').modal();
    },
    deleteOrdersConfirm: function () {
        var ids = new Array();
        $('input[name=ids]:checked').each(function () {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/orders/ajaxDeleteOrders/', {
            ids: ids
        }, function (data) {
            $('#mainContent').after(data);
            $.pjax({
                url: window.location.pathname,
                container: '#mainContent',
                timeout: 3000
            });
        });
        $('.modal').modal('hide');
        return true;
    },
    addProduct: function (modelId) {
        productName = '';
        variants = '';
        pNumber = ''
        $('.modal:not(.addNotificationMessage) .modal-body').load('/admin/components/run/shop/orders/ajaxEditAddToCartWindow/' + modelId, function () {
            $('#product_name').autocomplete({
                source: '/admin/components/run/shop/orders/ajaxGetProductsList/?categoryId=' + $('#Categories').val(),
                select: function (event, ui) {
                    productName = ui.item.label;
                    $('#product_id').val(ui.item.value);
                    vKeys = Object.keys(ui.item.variants);

                    $('#product_variant_name').html('');
                    for (var i = 0; i < vKeys.length; i++) {
                        $('#product_variant_name').append(new Option(ui.item.variants[vKeys[i]].name + ' - ' + ui.item.variants[vKeys[i]].price + " " + ui.item.cs, vKeys[i], true, true));
                    }

                    $("#product_variant_name").trigger("chosen:updated")

                },
                close: function () {
                    $('#product_name').val(productName);
                }
            });

            if ($.exists('#productNumber')) {
                $('#productNumber').autocomplete({
                    minChars: 1,
                    source: function (request, callback) {
                        var data = {
                            term: request.term,
                            noids: (function () {
                                var productIds = [];
                                $('#productsInCart tbody tr td:first-child a').each(function () {
                                    var pid = $(this).attr('href').split('/').pop();
                                    if (!isNaN(pid))
                                        productIds.push(pid);
                                });
                                return productIds;
                            })()
                        };
                        $.get('/admin/components/run/shop/orders/ajaxGetProductList/number', data, function (response) {
                            callback(response);
                        }, 'json');
                    },
                    select: function (event, ui) {
                        productName = ui.item.name;
                        pNumber = ui.item.number;

                        $('#product_id').val(ui.item.value);
                        vKeys = Object.keys(ui.item.variants);

                        $('#product_variant_name').html('');
                        for (var i = 0; i < vKeys.length; i++)
                            $('#product_variant_name').append(new Option(ui.item.variants[vKeys[i]].name + ' - ' + ui.item.variants[vKeys[i]].price + "  " + ui.item.cs, vKeys[i], true, true));
                    },
                    close: function () {
                        $('#product_name').val(productName);

                        $('#productNumber').val(pNumber);
                    }


                });
            }

            $('#Categories').change(function () {
                $('#product_name').autocomplete({
                    source: '/admin/components/run/shop/orders/ajaxGetProductList/?categoryId=' + $('#Categories').val(),
                    select: function (event, ui) {
                        productName = ui.item.label;
                        $('#product_id').val(ui.item.value);
                        vKeys = Object.keys(ui.item.variants);

                        for (var i = 0; i < vKeys.length; i++)
                            $('#product_variant_name').append(new Option(ui.item.variants[vKeys[i]].name + ' ' + ui.item.variants[vKeys[i]].price + "  " + ui.item.cs, vKeys[i], true, true));
                    },
                    close: function () {
                        $('#product_name').val(productName);

                    }
                });
                $('#product_name').val('');
                $('#product_variant_name').empty();
                $('#product_quantity').val('');
            });
        });
        $('.modal:not(.addNotificationMessage)').modal('show');
        $('#addToCartConfirm').on('click', function () {
            if ($('.modal form').valid())
                $('.modal').modal('hide');
        });
        return false;
    },
    deleteProduct: function (id) {
        $('.notifications').load('/admin/components/run/shop/orders/ajaxDeleteProduct/' + id);
    },
    refreshTotalPrice: function (dmId) {
        var deliveryPrice = deliveryPrices[dmId];
        if (deliveryPrice === undefined)
            deliveryPrice = 0;
        var totalPrice = deliveryPrice + productsAmount - giftPrice;

        $('.totalOrderPrice').html(totalPrice);
    },
    updateOrderItem: function (id, btn, order) {
        var data = {};

        if ($(btn).data('update') == 'price')
            data.newPrice = $(btn).closest('td').find('input').val();

        if ($(btn).data('update') == 'count')
            data.newQuantity = $(btn).closest('td').find('input').val();

        $.post('/admin/components/run/shop/orders/ajaxEditOrderCartNew/' + id, data, function (data) {
            $('.notifications').append(data);
        });
    },
    getProductsInCategory: function (categoryId) {
        $('.variantInfoBlock').hide();
        $.ajax({
            url: '/admin/components/run/shop/orders/ajaxGetProductsInCategory/',
            type: "post",
            data: 'categoryId=' + categoryId,
            async: false,
            success: function (data) {
                var products = JSON.parse(data)
                $(".variantsForOrders").empty();
                $(".productsForOrders").empty().each(function () {
                    if (products.length > 0)
                        for (var i = 0; i < products.length; i++)
                        $('<option/>', {
                            value: products[i]['id'],
                            text: products[i]['name'],
                            'data-product-name': products[i]['name']
                        }).appendTo($(this));
                    else
                        $('<option>', {
                            text: langs.notFound,
                            disabled: 'disabled'
                        }).appendTo($(this));
                });
            }
        });
    },
    getProductVariantsByProduct: function (productId, productName) {
        $('.variantInfoBlock').hide();
        $.ajax({
            url: '/admin/components/run/shop/orders/ajaxGetProductVariants/',
            type: "post",
            data: 'productId=' + productId,
            complete: function (data) {
                var productVariants = JSON.parse(data.responseText),
                    separate = '';
                $(".variantsForOrders").empty().each(function () {
                    for (var i = 0; i < productVariants.length; i++) {
                        var $this = $(this);
                        variantName = '';
                        if (productVariants[i]['name'] != '' && productVariants[i]['name'] != null) {
                            variantName = productVariants[i]['name'];
                            separate = ' - '
                        }
                        var price = parseFloat(productVariants[i]['price']).toFixed(pricePrecision);
                        $this.append($('<option data-number=\'' + productVariants[i]['number'] + '\' data-stock=\'' + productVariants[i]['stock'] + '\' data-price=\'' + price + '\' data-variantName=\'' + variantName +
                            '\' data-product-id=' + productId + ' data-product-name=\'' + productName + '\' data-productCurrency=' + curr + ' data-variantId=' + productVariants[i]['id'] +
                            ' value=' + productVariants[i]['id'] + ' data-orig_price="' + productVariants[i]['origPrice'] + '">' + variantName + separate + price + ' ' + curr + '</option>'));

                        $($this.find('option')[0]).trigger('click');
                        $this.trigger('change');
                        $(".chosen-container").each(function () {
                            $this.trigger("chosen:updated");
                        });
                    }
                });
            }
        });
    },
//    getProductVariantsByProduct: function(productId, productName) {
//        $('.variantInfoBlock').hide();
//        $.ajax({
//            url: '/admin/components/run/shop/orders/ajaxGetProductVariants/',
//            type: "post",
//            data: 'productId=' + productId,
//            complete: function(data) {
//                var productVariants = JSON.parse(data.responseText),
//                        separate = '';
//                $(".variantsForOrders").empty().each(function() {
//                    for (var i = 0; i < productVariants.length; i++) {
//                        var $this = $(this),
//                                variantName = '';
//                        if (productVariants[i]['name'] != '') {
//                            variantName = productVariants[i]['name'];
//                            separate = ' - '
//                        }
//                        var price = parseFloat(productVariants[i]['price']).toFixed(pricePrecision);
//                        $this.append($('<option data-number=\'' + productVariants[i]['number'] + '\' data-stock=\'' + productVariants[i]['stock'] + '\' data-price=\'' + price + '\' data-variantName=\'' + variantName +
//                                '\' data-product-id=' + productId + ' data-product-name=\'' + productName + '\' data-productCurrency=' + curr + ' data-variantId=' + productVariants[i]['id'] +
//                                ' value=' + productVariants[i]['id'] + ' data-orig_price="' + productVariants[i]['origPrice'] + '">' + variantName + separate + price + ' ' + curr + '</option>'));
//
//                        $($this.find('option')[0]).trigger('click');
//                        $this.trigger('change');
//                    }
//                });
//            }
//        });
//    },
    //Add product to cart in admin
    addToCartAdmin: function (element) {
        var clonedElement = $('.addNewProductBlock').clone(true).removeClass('addNewProductBlock'),
            data = element.data(),
            variantName = '-';

        if (data.variantname != 'noName') {
            variantName = data.variantname;
            if (!data.variantname) {
                variantName = '-';
            }

        }
//        console.log(data)
        clonedElement.find('.variantCartNumber').html(data.number);
        clonedElement.find('.variantCartName').html(variantName);
        clonedElement.find('.productCartName').html('<a target="_blank" href="/admin/components/run/shop/products/edit/' + data.productId + '">' + data.productName + '</a>');
        clonedElement.find('.productCartPrice').html(parseFloat(data.price).toFixed(pricePrecision));
        clonedElement.find('.productCartPriceSymbol').html(data.productcurrency);

        //Input values
        clonedElement.find('.inputProductId').val(data.productId);
        clonedElement.find('.inputProductName').val(data.productName);
        clonedElement.find('.inputVariantId').val(data.variantid);
        clonedElement.find('.inputVariantName').val(variantName);
        clonedElement.find('.inputPrice').val(data.price);
        clonedElement.find('.inputQuantity').val(1);


        $('#insertHere').append(clonedElement);

        var inputUpdatePrice = clonedElement.find('.productCartQuantity');
        inputUpdatePrice.data('stock', data.stock);
        orders.updateQuantityAdmin(inputUpdatePrice);

    },
    deleteCartProduct: function (element) {
        var tr = $(element).closest('tr');
        tr.remove();
        orders.updateTotalCartSum();
        if ($('.addVariantToCart').data('productId') == tr.find('.inputProductId').val())
            $('.addVariantToCart').removeClass('btn-primary').removeAttr('disabled').addClass('btn-success').removeClass('btn-danger disabled').html(langs.addToCart);
    },
    updateQuantityAdmin: function (element) {
        var stock = $(element).data('stock');
        var row = $(element).closest('tr');
        var quantity = $(element).val();
        var price = row.find('.productCartPrice').html();

//Условие убрано в связи с заданием ICMS-1518
//        if (checkProdStock == 1 && quantity > stock) {
//            $(element).val(stock);
//            quantity = stock;
//        }
        total = price * quantity;
        row.find('.productCartTotal').html(total.toFixed(pricePrecision));

        orders.updateTotalCartSum();

    },
    updateTotalCartSum: function () {
        var total = parseFloat(0);
        allPrices = $('#insertHere').find('.productCartTotal')
        allPrices.each(function (i, element) {
            total = total + parseFloat($(element).html());
        })
        $('#totalCartSum').html(parseFloat(total).toFixed(pricePrecision));
        $('input[name="shop_orders[total_price]"]').val(parseFloat(total).toFixed(pricePrecision));
    },
    isInCart: function (variantId) {
        var productBlocksInCart = $('#insertHere').find('.inputVariantId');
        var countProductsInCart = productBlocksInCart.length;
        var checkResult = 'false';

        if (countProductsInCart > 0) {
            productBlocksInCart.each(function (index, el) {
                if (variantId == el.value) {
                    checkResult = 'true';
                    return false;
                }
            });
        }
        return checkResult;

    }
});

var orderStatuses = new Object({
    reorderPositions: function () {
        var i = 1;
        $('.sortable tr').each(function () {
            $(this).find('input').val(i);
            i++;
        });
        $('#orderStatusesList').ajaxSubmit({
            target: '.notifications'
        });
        return true;
    },
    deleteOne: function (id) {
        $('.modal .modal-body').load('/admin/components/run/shop/orderstatuses/ajaxDeleteWindow/' + id, function () {
            return true;
        });
        $('.modal:not(.addNotificationMessage)').modal('show');
    }
});

var callbacks = new Object({
    deleteOne: function (id) {
        $.post('/admin/components/run/callbacks/deleteCallback', {
            id: id
        }, function (data) {
            $('.notifications').append(data);
        });
    },
    deleteMany: function () {
        var id = new Array();
        $('input[name=ids]:checked').each(function () {
            id.push($(this).val());
        });

        this.deleteOne(id);
        $('.modal').modal('hide');
        return true;
    },
    changeStatus: function (id, statusId) {
        $.post('/admin/components/run/callbacks/changeStatus', {
            CallbackId: id,
            StatusId: statusId
        }, function (data) {
            $('.notifications').append(data);
        });
        $('#callback_' + id).closest('tr').data('status', statusId);
        this.reorderList(id);
    },
    reorderList: function (id) {
        var stId = $(' #callback_' + id).data('status');
        $('#callbacks_' + stId + ' table tbody').append($('#callback_' + id));
    },
    changeTheme: function (id, themeId) {
        $.post('/admin/components/run/callbacks/changeTheme', {
            CallbackId: id,
            ThemeId: themeId
        }, function (data) {
            $('.notifications').append(data);
        });
    },
    setDefaultStatus: function (id, element) {
        $('.btn-danger').removeAttr('disabled');
        $('.prod-on_off').addClass('disable_tovar').css('left', '-28px');
        if ($(element).hasClass('disable_tovar')) {
            $(element).closest('tr').find('.btn-danger').attr('disabled', 'disabled');
            $(element).closest('tr').find('.prod-on_off').css('left', '0');
        }

        $.post('/admin/components/run/callbacks/setDefaultStatus', {
            id: id
        }, function (data) {
            $('.notifications').append(data);
            location.reload();
        });

        return true;
    },
    deleteStatus: function (id, curElement) {
        if (!$(curElement).closest('tr').find('.disable_tovar').length) {
            return false;
        }
        $.post('/admin/components/run/callbacks/deleteStatus', {
            id: id
        }, function (data) {
            $('.notifications').append(data);
        });
    },
    deleteTheme: function (id) {
        $.post('/admin/components/run/callbacks/deleteTheme', {
            id: id
        }, function (data) {
            $('.notifications').append(data);
        });
    },
    reorderThemes: function () {
        var positions = new Array();
        $('.sortable tr').each(function () {
            positions.push($(this).data('id'));
        });

        $.post('/admin/components/run/callbacks/reorderThemes', {
            positions: positions
        }, function (data) {
            $('.notifications').append(data);
        });
        return true;
    }
});

var shopCategories = new Object({
    deleteCategories: function () {
        $('.categoryDeleteModal').modal();
    },
    deleteCategoriesConfirm: function (simple) {
        var ids = new Array();
        if (simple == undefined) {
            $('input[name=ids]:checked').each(function () {
                ids.push($(this).val());
            });
        }
        else
            ids.push(simple);

        var url = '/admin/components/run/shop/categories/delete';
        if ($('[data-url-delete]').length > 0)
            url = $('[data-url-delete]').data('url-delete');
        $.post(url, {
            id: ids
        }, function (data) {
            $('#mainContent').after(data);
            $.pjax({
                url: window.location.pathname,
                container: '#mainContent',
                timeout: 3000
            });
        });
        $('.modal').modal('hide');
        return true;
    }
});

var GalleryCategories = new Object({
    deleteCategories: function () {
        $('.modal').modal();
    },
    deleteCategoriesConfirm: function () {
        var ids = new Array();
        $('input[name=ids]:checked').each(function () {
            ids.push($(this).val());
        });
        $.post('/admin/components/cp/gallery/delete_category', {
            id: ids
        }, function (data) {
            $('#mainContent').after(data);
            $.pjax({
                url: window.location.pathname,
                container: '#mainContent',
                timeout: 3000
            });
        });
        $('.modal').modal('hide');
        return false;
    }
});
var GalleryAlbums = new Object({
    whatDelete: function (el) {
        var el = el;

        var closest_tr = $(el).closest('tr');
        var mini_layout = $(el).closest('.mini-layout');

        if (closest_tr[0] != undefined) {
            this.id = $(el).closest('table').find("[type = hidden]").val();
        }
        else if (mini_layout[0] != undefined) {
            this.id = mini_layout.find('[name = album_id]').val();
        }
    },
    deleteCategoriesConfirm: function () {
        if (mini_layout[0] != undefined) {
            url = '/admin/components/cp/gallery/category/' + mini_layout.find('[name = category_id]').val();
        }
        else
            url = window.location.pathname;

        $.post('/admin/components/cp/gallery/delete_album', {
            album_id: this.id
        }, function (data) {
            $.pjax({
                url: url,
                container: '#mainContent',
                timeout: 3000
            });
        });
        $('.modal').modal('hide');
        return false;
    }
});

function clone_object() {
    btn_temp = $('[data-remove="example"]');
    $('[data-frame]').each(function () {
        cloneObject($(this))
    })
    function cloneObject(data) {
        var data = data;
        var add_variants = {
            cloneObjectVariant: data.find('[data-rel="add_new_clone"]'),
            frameSetClone: data.find('tbody'),
            frameClone: function () {
                var variant_row = this.frameSetClone.find('tr:first').clone();
                return this.frameSetClone.find('tr:first').clone().find('input').val('').parents('tr')
            },
            addNewVariant: function () {
                btn_temp = btn_temp.clone().show();
                return this.frameClone().find('td:last').append(btn_temp).parents('tr');
            }
        }
        add_variants.cloneObjectVariant.on('click', function () {
            add_variants.frameSetClone.append(add_variants.addNewVariant());
        })
        $('[data-remove]').live('click', function () {
            $(this).closest('tr').remove();
        })
    }
}
var variantInfo = new Object({
    getImage: function (variantId) {
        var imageName = '';
        $.ajax({
            url: "/admin/components/run/shop/orders/getImageName",
            async: false,
            type: "post",
            data: 'variantId=' + variantId,
            success: function (data) {
                imageName = data;
            }
        });
        return imageName;
    }
})

window.onload = clone_object();

function disableOnEnterPress(curObj) {
    var code = event.keyCode || event.which;
    if (code == 13) {
        event.preventDefault();
        return false;
    }
}

var Languages = {
    changeActive: function (curObj) {
        var defaultLanguage = $(curObj).closest('tr').find('button.lan_def');

        if ($(defaultLanguage).hasClass('active')) {
            showMessage(lang('Message'), lang('Can not deactivate default language'), 'r');
            event.stopPropagation();
            return false;
        }

        var languageId = $(curObj).data('id');
        var active = $(curObj).find('input[name="active"]').attr('checked');
        active = active ? 0 : 1;

        $.ajax({
            url: "/admin/languages/ajaxChangeActive",
            async: false,
            type: "post",
            data: {
                id: languageId,
                active: active
            },
            success: function (data) {
            }
        });
    }

}
