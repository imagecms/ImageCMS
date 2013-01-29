//temporary
function ChangeBannerActive(el, bannerId)
{
    var currentActiveStatus = $(el).attr('rel');

    $.post('/admin/components/run/shop/banners/changeActive/', {bannerId:bannerId,status:currentActiveStatus}, function(data){
        $('.notifications').append(data)
        if(currentActiveStatus=='true')
            {
                $(el).addClass('disable_tovar').attr('rel',false);
                    
        }else{
                $(el).removeClass('disable_tovar').attr('rel',true);
            }
    
    });
}
var shopAdminMenuCache = false;
var base_url = 'http://p4/';

function showMessage(title, text, messageType)
{
    text = '<h4>' + title + '</h4>' + text;
    messageType = typeof messageType !== 'undefined' ? messageType : 'success';
    if (messageType == 'r')
        messageType = 'error';
    $('.notifications').notify({
        message: {
            html: text
        },
        type: messageType
    }).show();
}

function translite_title(from, to)
{
    var url = base_url + 'admin/pages/ajax_translit/';
    $.post(
            url, {
        'str': $(from).val()
    }, function(data)

    {
        $(to).val(data);
    }
    );
}

function create_description(from, to)
{
    if ( $('.workzone textarea.elRTE').length)
    {
        $('.workzone textarea.elRTE').elrte('updateSource');
    }
    
    
    $.post(
            base_url + 'admin/pages/ajax_create_description/', {
        'text': $(from).val()
    },
    function(data) {
        $(to).val(data);
    }
    );
}

function retrive_keywords(from, to)
{
    if ( $('.workzone textarea.elRTE').length)
    {
        $('.workzone textarea.elRTE').elrte('updateSource');
    }

    $.post(base_url + 'admin/pages/ajax_create_keywords/', {
        'keys': $(from).val()
    },
    function(data) {
        $(to).html(data);
    }
    );
}

function ajax_div(target, url)
{
    $.ajax(url, {
        headers: {
            'X-PJAX': 'X-PJAX'
        },
        success: function(data){
            $('#'+target).append(data);
        }
    });
}

//submit form
$('.formSubmit').live('click', function() {

    //        collectMCEData();
    //update content in textareas with elRTE 
    $this = $(this);

    if ( $('.workzone textarea.elRTE').length)
    {
        $('.workzone textarea.elRTE').elrte('updateSource');
    }
    
    delete window.teInited;
    
    var btn = this;

    var selector = $(this).data('form');
    var action = $(this).data('action');
    $(selector).validate()
    if ($(selector).valid())
    {
        $('#loading').fadeIn(100);
        var options = {
            //                target: '.notifications',
            beforeSubmit: function(formData) {
                formData.push({
                    name: "action",
                    value: action
                });
            },
            success: function(data) {
                $('#loading').fadeOut(100);
                var resp = document.createElement('div');
                resp.innerHTML = data;
                $(resp).find('p').remove();
                $('.notifications').append(resp);
                $(btn).removeClass('disabled').attr('disabled', false);
                return true;
            }
        };
        $(selector).ajaxSubmit(options);
    }
    else
        $(this).removeClass('disabled').attr('disabled', false);
    return false;
});

function updateNotificationsTotal()
{
    //if (isShop)
    $('#topPanelNotifications>div').load('/admin/components/run/shop/notifications/getAvailableNotification');
}

function loadShopInterface()
{
//    if ($.browser.opera == true)
//    {
//        window.location = '/admin/components/run/shop/dashboard';
//    }
    if ($('#baseSearch'))
    {
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

    updateNotificationsTotal();
    $('#topPanelNotifications').fadeIn(300);
    $.pjax({
        url: '/admin/components/run/shop/dashboard',
        container: '#mainContent',
        timeout: 3000
    });
    isShop = true;
    $('a.logo').attr('href', '/admin/components/run/shop/dashboard');
    return false;
}

function loadBaseInterface()
{
    if ($.browser.opera == true)
    {
        window.location = '/admin';
    }

    if ($('#shopSearch'))
    {
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

    $('#topPanelNotifications').fadeOut(300);
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
    $.get('/admin/admin_search/autocomplete', function(data) {
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

function initElRTE()
{
    elRTE.prototype.options.toolbars.custom = [
         "copypaste","undoredo","elfinder","style","alignment","direction","colors","format","indent","lists","links","elements","media","tables","fullscreen"
    ];    
    elRTE.prototype.options.toolbars.empty = [];
    var opts = {
        //lang         : 'ru',   // set your language
        styleWithCSS: false,
        height: 300,
        fmAllow: true,
        lang: 'ru',
        fmOpen: function(callback) {
            //			    if (typeof dialog === 'undefined') {
            // create new elFinder
            dialog = $('<div />').dialogelfinder({
                url: '/admin/elfinder_init',
                lang: 'ru',
            commands: [
                'open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook',
                'download', 'rm', 'rename', 'mkdir', 'mkfile', 'upload',  'edit', 'preview', 'extract', 'archive', 'search', 'info', 'view', 'help','sort'
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
                'rm', '|',  'archive', 'extract', '|', 'info'
            ]
            },
                commandsOptions: {
                    getfile: {
                        oncomplete: 'destroy' // close/hide elFinder
                    }
                },
                getFileCallback: function(file) {
                    callback('/' + file.path);
                },
                customData : {
                    cms_token : elfToken
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
    $('textarea.elRTE.focusOnClick').each(
            function() {
                var rte  = this;
                opts.height = 300; 
                $(rte).on('focus', function(){
                    $(rte).elrte(opts);
                    
                    //$(rte).delay(300).closest('.el-rte').find('.workzone, iframe, textarea').animate({'height':'300px'}, 400);
                });
            }
    );
    
    $('textarea.elRTE').not('.focusOnClick').each(function(){
            if ($(this).is(':visible'))
                if (!$(this).closest('div.workzone').length)
                    $(this).elrte(opts);
        });
}

function initTinyMCE()
{
    var opts = {
            // Location of TinyMCE script
            height: 300,
            script_url : '/js/tiny_mce/tiny_mce.js',
            mode : "textarea",
            // General options
            theme : "advanced",
            skin: "o2k7",
            skin_variant: "silver",
            plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

            // Theme options
            theme_advanced_buttons1 : /*"save"+*/"newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,|,cut,copy,paste,pastetext,pasteword, |, search,replace",
            theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor, |, insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
//            theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,

            // Example content CSS (should be your site CSS)
            content_css : "css/content.css",

            // Drop lists for link/image/media/template dialogs
            template_external_list_url : "lists/template_list.js",
            external_link_list_url : "lists/link_list.js",
           // external_image_list_url : "lists/image_list.js",
            media_external_list_url : "lists/media_list.js",

            // Replace values for the template plugin
            template_replace_values : {
                    username : "Some User",
                    staffid : "991234"
            },
                
           file_browser_callback : function(field_name, url, type, win) {
                $('<div/>').dialogelfinder({
                    url: '/admin/elfinder_init',
                    lang: 'ru',
                    dialog: { width: 900, modal: true, title: 'Files', zIndex: 900001 },
                    
                    getFileCallback: function(file) {
                        win.document.forms[0].elements[field_name].value = '/' + file.path;
                    },
                    commandsOptions: {
                        getfile: {
                            oncomplete: 'destroy' // close/hide elFinder
                        },
                },
                customData : {
                            cms_token : elfToken,
                        }
               });
           }
    };

    $('textarea.elRTE.focusOnClick').each(
            function() {
                opts.height = 200; 
                $(this).on('focus', function(){
                    $(this).tinymce(opts);
                    $(this).delay(300).closest('.controls').find('.mceIframeContainer, .mceIframeContainer iframe').animate({'height':'300px'}, 400);
                });
            }
    );

    $('textarea.elRTE').not('.focusOnClick').each(function(){ 
        opts.elements = $(this).attr('id');
        $(this).tinymce(opts);
    });
}

function initTextEditor(name)
{
    if (!window.hasOwnProperty('teInited'))
    {
            if (typeof(name) != 'undefined' && name.length != 0)
            ({
                'elrte': initElRTE,
                'tinymce' : initTinyMCE
            }[name]());
        window.teInited = true;
    }
        
}

var dlg = false;
function elFinderPopup(type, id, path)
{
    if (typeof path == 'undefined')
        path = '';
    //todo: create diferent browsers (check 'type' variable)
    if (!dlg)
    {
        dlg = $('#elFinder').dialogelfinder({
            url: '/admin/elfinder_init',
            lang: 'ru',
            commands: [
                'open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook',
                'download', 'rm', 'rename', 'mkdir', 'mkfile', 'upload',  'edit', 'preview', 'extract', 'archive', 'search', 'info', 'view', 'help','sort'
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
                }
            },
            getFileCallback: function(file) {
                if (path != '')
                {
                    var str = file.path;
                    var m = str.match('[\\\\ /]');
                    console.log(m)
                    file.path = file.path.substr(m.index+1);
                    if (path[0] != '/')
                        path = '/'+path;
                }
                $('#' + id).val(path+'/' + file.path);
                if (type == 'image' && $('#' + id + '-preview').length)
                {
                    var img = document.createElement('img');
                    img.src = $('#' + id).val();
                    img.className = "img-polaroid";
                    $('#' + id + '-preview').html(img);
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
                'rm', '|',  'archive', 'extract', '|', 'info'
            ]
        },
        customData : {
                cms_token : elfToken,
                path:path
            }
        });
    }
    else
        dlg.show();
    return false;
}

function elFinderTPLEd()
{
    //todo: create diferent browsers (check 'type' variable)
    eD = $('#elFinderTPLEd').elfinder({
        url: '/admin/elfinder_init/1',
        height: $(window).height() * 0.6,
        lang: 'ru',
        commands : [
            'open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook',
            'download', 'rm', 'rename', 'mkdir', 'mkfile', 'upload',  'edit', 'preview', 'extract', 'archive', 'search', 'info', 'view', 'help','sort'
        ],
        commandsOptions: {
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
        editors: {
            editor: {
                load: function() {
                },
                save: function() {
                },
                mimes: []
            }
        },
        getFileCallback: function(e, ev, c) {
            //self.fm.select($(this), true);
            eD.exec('edit');
            return  false;

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
                'rm', '|',  'archive', 'extract', '|', 'info'
            ]
        },
        customData : {
                    cms_token : elfToken
                }
        //onlyMimes: ['text'],
    }).elfinder('instance');

    eD.bind('get', function(v) {
        $('textarea.elfinder-file-edit').closest('div.ui-dialog').css({
            'width': '90%',
            'left': '5%'
        });
    });
}

var orders = new Object({
    chOrderStatus: function(status) {
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/orders/ajaxChangeOrdersStatus/' + status, {
            ids: ids
        }, function(data) {
            $('#mainContent').after(data);
            $.pjax({
                url: window.location.pathname,
                container: '#mainContent',
                timeout: 3000
            });
        });
        return true;
    },
    fixAddressA: function()
    {
        $('#postAddressBtn').attr('href', "http://maps.google.com/?q=" + $('#postAddress').val());
        return true;
    },
    chOrderPaid: function(paid) {
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/orders/ajaxChangeOrdersPaid/' + paid, {
            ids: ids
        }, function(data) {
            $('#mainContent').after(data);
            $.pjax({
                url: window.location.pathname,
                container: '#mainContent',
                timeout: 3000
            });
        });
        return true;
    },
    deleteOrders: function() {
        $('.modal').modal();
    },
    deleteOrdersConfirm: function()
    {
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post('/admin/components/run/shop/orders/ajaxDeleteOrders/', {
            ids: ids
        }, function(data) {
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
    addProduct: function(modelId)
    {
        productName = '';
        variants = '';
        $('.modal .modal-body').load('/admin/components/run/shop/orders/ajaxEditAddToCartWindow/' + modelId, function() {
            $('#product_name').autocomplete({
                source: '/admin/components/run/shop/orders/ajaxGetProductList/?categoryId=' + $('#Categories').val(),
                select: function(event, ui) {
                    productName = ui.item.label;
                    $('#product_id').val(ui.item.value);
                    vKeys = Object.keys(ui.item.variants);

                    for (var i = 0; i < vKeys.length; i++)
                        $('#product_variant_name').append(new Option(ui.item.variants[ vKeys[i] ].name + ui.item.variants[ vKeys[i] ].price + " " + ui.item.cs, vKeys[i], true, true));
                },
                close: function() {
                    $('#product_name').val(productName);
                }
            });

            $('#Categories').change(function() {
                $('#product_name').autocomplete({
                source: '/admin/components/run/shop/orders/ajaxGetProductList/?categoryId=' + $('#Categories').val(),
                select: function(event, ui) {
                    productName = ui.item.label;
                    $('#product_id').val(ui.item.value);
                    vKeys = Object.keys(ui.item.variants);

                    for (var i = 0; i < vKeys.length; i++)
                        $('#product_variant_name').append(new Option(ui.item.variants[ vKeys[i] ].name + ui.item.variants[ vKeys[i] ].price + " " + ui.item.cs, vKeys[i], true, true));
                },
                close: function() {
                    $('#product_name').val(productName);
                   
                }
            });
                $('#product_name').val('');
                $('#product_variant_name ').empty();
                $('#product_quantity').val('');
            });
        });
        $('.modal').modal('show');
        $('#addToCartConfirm').live('click', function() {
            if ($('.modal form').valid())
                $('.modal').modal('hide');
        });
        return false;
    },
    deleteProduct: function(id) {
        $('.notifications').load('/admin/components/run/shop/orders/ajaxDeleteProduct/' + id);
    },
    refreshTotalPrice: function(dmId)
    {
        deliveryPrice = deliveryPrices[dmId];
        if (deliveryPrice === undefined)
            deliveryPrice = 0;
        var totalPrice = deliveryPrice + productsAmount - giftPrice;

        $('.totalOrderPrice').html(totalPrice);
    },
    updateOrderItem: function(id, btn)
    {
        var data = {};
        if ($(btn).data('update') == 'price')
            //    		alert($(btn).closest('td').find('input').val());
            data.newPrice = $(btn).closest('td').find('input').val();
        if ($(btn).data('update') == 'count')
            data.newQuantity = $(btn).closest('td').find('input').val();

        $.post('/admin/components/run/shop/orders/ajaxEditOrderCart/' + id, data, function(data) {
            $('.notifications').append(data);
        });
    }

});

var orderStatuses = new Object({
    reorderPositions: function() {
        var i = 1;
        $('.sortable tr').each(function() {
            $(this).find('input').val(i);
            i++;
        });
        $('#orderStatusesList').ajaxSubmit({
            target: '.notifications'
        });
        return true;
    },
    deleteOne: function(id) {
        $('.modal .modal-body').load('/admin/components/run/shop/orderstatuses/ajaxDeleteWindow/' + id, function() {
            return true;
        });
        $('.modal').modal('show');
    }
});

var callbacks = new Object({
    deleteOne: function(id) {
        $.post('/admin/components/run/shop/callbacks/deleteCallback', {
            id: id
        }, function(data) {
            $('.notifications').append(data);
        });
    },
    deleteMany: function() {
        var id = new Array();
        $('input[name=ids]:checked').each(function() {
            id.push($(this).val());
        });

        this.deleteOne(id);
        $('.modal').modal('hide');
        return true;
    },
    changeStatus: function(id, statusId)
    {
        $.post('/admin/components/run/shop/callbacks/changeStatus', {
            CallbackId: id,
            StatusId: statusId
        }, function(data) {
            $('.notifications').append(data);
        });
        $('#callback_' + id).closest('tr').data('status', statusId);
        this.reorderList(id);
    },
    reorderList: function(id)
    {
        var stId = $(' #callback_' + id).data('status');
        $('#callbacks_' + stId + ' table tbody').append($('#callback_' + id));
    },
    changeTheme: function(id, themeId)
    {
        $.post('/admin/components/run/shop/callbacks/changeTheme', {
            CallbackId: id,
            ThemeId: themeId
        }, function(data) {
            $('.notifications').append(data);
        });
    },
    setDefaultStatus: function(id, element)
    {

        $('.prod-on_off').addClass('disable_tovar').css('left', '-28px');
        $.post('/admin/components/run/shop/callbacks/setDefaultStatus', {
            id: id
        }, function(data) {
            $('.notifications').append(data);
        });
        return true;
    },
    deleteStatus: function(id)
    {
        $.post('/admin/components/run/shop/callbacks/deleteStatus', {
            id: id
        }, function(data) {
            $('.notifications').append(data);
        });
    },
    deleteTheme: function(id)
    {
        $.post('/admin/components/run/shop/callbacks/deleteTheme', {
            id: id
        }, function(data) {
            $('.notifications').append(data);
        });
    },
    reorderThemes: function()
    {
        var positions = new Array();
        $('.sortable tr').each(function() {
            positions.push($(this).data('id'));
        });

        $.post('/admin/components/run/shop/callbacks/reorderThemes', {
            positions: positions
        }, function(data) {
            $('.notifications').append(data);
        });
        return true;
    }
});

var shopCategories = new Object({
    deleteCategories: function() {
        $('.modal').modal();
    },
    deleteCategoriesConfirm: function(simple)
    {
        var ids = new Array();
        if (simple == undefined) {
            $('input[name=ids]:checked').each(function() {
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
        }, function(data) {
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
    deleteCategories: function() {
        $('.modal').modal();
    },
    deleteCategoriesConfirm: function()
    {
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post('/admin/components/cp/gallery/delete_category', {
            id: ids
        }, function(data) {
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
    whatDelete: function(el) {
        var el = el;

        var closest_tr = $(el).closest('tr');
        var mini_layout = $(el).closest('.mini-layout');

        if (closest_tr[0] != undefined) {
            this.id = $(el).closest('tr').find("[type = hidden]").val();
        }
        else if (mini_layout[0] != undefined) {
            this.id = mini_layout.find('[name = album_id]').val();
        }
    },
    deleteCategoriesConfirm: function()
    {
        if (mini_layout[0] != undefined) {
            url = '/admin/components/cp/gallery/category/' + mini_layout.find('[name = category_id]').val();
        }
        else
            url = window.location.pathname;

        $.post('/admin/components/cp/gallery/delete_album', {
            album_id: this.id
        }, function(data) {
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
    $('[data-frame]').each(function() {
        cloneObject($(this))
    })
    function cloneObject(data) {
        var data = data;
        var add_variants = {
            cloneObjectVariant: data.find('[data-rel="add_new_clone"]'),
            frameSetClone: data.find('tbody'),
            frameСlone: function() {
                var variant_row = this.frameSetClone.find('tr:first').clone();
                return this.frameSetClone.find('tr:first').clone().find('input').val('').parents('tr')
            },
            addNewVariant: function() {
                btn_temp = btn_temp.clone().show();
                return this.frameСlone().find('td:last').append(btn_temp).parents('tr');
            }
        }
        add_variants.cloneObjectVariant.on('click', function() {
            add_variants.frameSetClone.append(add_variants.addNewVariant());
        })
        $('[data-remove]').live('click', function() {
            $(this).closest('tr').remove();
        })
    }
}

window.onload = clone_object();
