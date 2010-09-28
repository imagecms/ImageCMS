
var shop_url = base_url + 'admin/components/run/shop/'; 
var shopAdminMenuCache = false;
var shopAdminLoaded = false;

// TODO: Put all css code to css file.
window.addEvent('domready', function(){
    // Create switcher html code
    var shopSwitcher = new Element('div', {id: 'shopSwitcher',style: 'float:right;'}); 
    var switcherCode = '<a href="" id="linkAdminShop" onClick="javascript:loadShopInterface(); return false;">Администрировать магазин →</a>'+
                        '<a href="" style="display:none;" id="linkAdminSystem" onClick="javascript:restoreAdminInterface(); return false;">← Назад к системе</a>';
    shopSwitcher.set('html',switcherCode);
    shopSwitcher.inject($('spinner2'), 'after');

    // Create shopAdminPage block where we'll load content.
    var shopAdminPage = new Element('div', {id: 'shopAdminPage', style: 'display:none;background-color:#F8F8F8;overflow-x:auto;overflow-y:auto;height:100%;'});

    // Inject it after main "page" block
    shopAdminPage.inject($('page'), 'after');

    loadShopInterface();
    setTimeout("loadShopSidebarCats()", 200);
});

/**
 * Load shop main menu and sidebar categories list. 
 * 
 * @access public
 * @return void
 */
function loadShopInterface()
{
    // Hide system menu
    var mainSystemMenu = $('desktopNavbar').getFirst('ul');
    mainSystemMenu.setStyle('display','none');

    // Load and set shop menu
    if (shopAdminMenuCache == false)
    {
        var shopAdminMainMenu = new Element('div', {id: 'shopAdminMainMenu', style: 'display:block;'});
        shopAdminMainMenu.load('/application/modules/shop/admin/templates/shopMainMenu.html');
        shopAdminMainMenu.inject('desktopNavbar');
        shopAdminMenuCache = true;
    }else{
        $('shopAdminMainMenu').setStyle('display', 'block');
    }

    // Hide linkAdminShop 
    $('linkAdminShop').setStyle('display', 'none');
    // Show linkAdminSystem
    $('linkAdminSystem').setStyle('display', 'block');

    // Hide "page" block
    $('page').setStyle('display', 'none'); 

    // Show shopAdminPage
    $('shopAdminPage').setStyle('display', 'block');  

    // Load in sidebar shop categories list
    // Load shop dashboard
    
    // Load admin dashboard only first time,
    if (shopAdminLoaded == false)
    {
        // Load admin dashboard
        ajaxShop('categories');
        shopAdminLoaded = true;
    }

    loadShopSidebarCats(); 
}

/**
 * restoreAdminInterface 
 * 
 * @access public
 * @return void
 */
function restoreAdminInterface()
{
    // Show linkAdminShop 
    $('linkAdminShop').setStyle('display', 'block');
    // Hide linkAdminSystem
    $('linkAdminSystem').setStyle('display', 'none');

    // Show "page" block
    $('page').setStyle('display', 'block');

    // Hide shopAdminPage
    $('shopAdminPage').setStyle('display', 'none');

    // Show system menu
    var mainSystemMenu = $('desktopNavbar').getFirst('ul');
    mainSystemMenu.setStyle('display','block');

    // Hide shop menu
    $('shopAdminMainMenu').setStyle('display','none');

    // Load system categories
    ajax_div('categories',base_url + 'admin/categories/update_block/');
}

/**
 * Save categories positions. (category list view)
 */
function SaveCategoriesPositions()
{
    var item_pos = new Array();

    var items = $('ShopCatsHtmlTable').getElements('input');
    items.each(function(el,i){
            if(el.hasClass('SCategoryPos')) 
            {
                id = el.id;
                val = el.value;
                new_pos = id + '_' + val;
                item_pos.include( new_pos );
            }  
            });

    var req = new Request.HTML({
       method: 'post',
       url: shop_url + 'categories/save_positions',
       onRequest: function() { },
       onComplete: function(response) { 
            // Update list
            ajaxShop('categories/c_list');
       }
    }).post({'positions': item_pos });
}

/**
 * Load shop categories into sidebar.
 */
function loadShopSidebarCats()
{
    ajax_div('categories', shop_url + 'ajaxCategoriesTree');
}

function ajaxShop(url)
{
    ajax_div('shopAdminPage', shop_url + url);
}

/**
 * Submit form from one of footer buttons.
 */
function ajaxShopForm(button)
{
    var form = button.form;

    if (button.name)
    {
        var hiddenElement = new Element('input', {type: 'hidden',name: button.name,value: 1});
        hiddenElement.inject($(form));
    }

    $(form).addEvent('submit', function(event) {
        event.stop();

        $(form).getElements('input[type=submit]').each(function(number){
            number.disabled = true;
        }); 

        var req = new Request.HTML({
            method: $(form).get('method'),
            url: $(form).get('action'),

            onRequest: function() { start_ajax(); },
            onFailure: function() { },
            onSuccess: function() { },
            onComplete: function(response) { my_alert(form); }
        }).post($(form));

        hiddenElement.destroy();
    });
}

function preview_shop_image(image_name)
{
    $('imagePreviewBox').setStyle('display', 'block');
    $('imagePreviewBoxImage').set('src','/uploads/shop/' + image_name + '?' + Math.floor(Math.random()*9999));    
}

function nl2br(text){
    text = escape(text);
    if(text.indexOf('%0D%0A') > -1){
        re_nlchar = /%0D%0A/g ;
    }else if(text.indexOf('%0A') > -1){
        re_nlchar = /%0A/g ;
    }else if(text.indexOf('%0D') > -1){
        re_nlchar = /%0D/g ;
    }
    return unescape( text.replace(re_nlchar,'<br />') );
}

function shopLoadProperiesByCategory(selectBox, propertyId)
{
    if (propertyId > 0) {
        var property_id = '/' + propertyId;
    }else{
        var property_id = '';
    }

    var req = new Request.HTML({
            method: 'post',
            url: shop_url + 'properties/renderForm/' + selectBox.value + property_id,
            update: 'productPropertiesContainer',
            onRequest: function() { start_ajax(); },
            onFailure: function() { },
            onSuccess: function() { },
            onComplete: function(response) { stop_ajax(); }
        }).send();  
}

function filterPropertiesByCategory(selectBox)
{
    ajaxShop('properties/index/' + selectBox.value); 
}
