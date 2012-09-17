//temporary

var shopAdminMenuCache = false;
var base_url = 'http://p4/';

function showMessage(title, text, messageType)
{
	text = '<h4>'+title+'</h4>'+text;
	messageType = typeof messageType !== 'undefined' ? messageType: 'success';
	if (messageType == 'r')
		messageType = 'error';
	$('.notifications').notify({
		message: { html:text },
	 	type: messageType
	}).show();
	
	console.log(text);
}

function translite_title(from, to)
{
	var url = base_url + 'admin/pages/ajax_translit/'; 
        $.post(
			url, {'str': $(from).val()}, function(data)
			{
				$(to).val(data);
			}
		);
}

function create_description(from, to)
{
		$.post(
			base_url + 'admin/pages/ajax_create_description/',{ 'text' :$(from).val()},
			function(data) { $(to).val( data); }
		);		
}

function retrive_keywords(from, to)
{
			$.post(base_url + 'admin/pages/ajax_create_keywords/', {'keys': $(from).val()},		
			function(data) { $(to).html(data);}
			);
}

function ajax_div(target, url)
{
	$('#'+target).load(url);
}

function loadShopInterface()
{
//    $('cmsLogo').removeEvents('click');
//    $('cmsLogo').addEvent('click', function() {
//        ajaxShop('orders/index');  
//    }); 

    // Hide system menu
//    var mainSystemMenu = $('desktopNavbar').getFirst('ul');
//    mainSystemMenu.setStyle('display','none');

    // Hide system navigation (prev,next,refresh)
//    $('topNav').setStyle('display','none');
//    $('shopTopNav').setStyle('display','block');

//    $('topInfoButtons').setStyle('display', 'block');

    // Load and set shop menu
    if (shopAdminMenuCache == false)
    {
//        var shopAdminMainMenu = new Element('div', {
//            id: 'shopAdminMainMenu', 
//            style: 'display:block;'
//        });
    	
    	var shopAdminMainMenu = $('#mainAdminMenu');
        shopAdminMainMenu.load('/application/modules/shop/admin/templates/shopMainMenu.html') ;
//        shopAdminMainMenu.inject('desktopNavbar');
//        shopAdminMainMenu.inject('mainAdminMenu');
        shopAdminMenuCache = true;
    }else{
//        $('shopAdminMainMenu').setStyle('display', 'block');
    }

//    updateNotificationsTotal();
//
//    // Hide linkAdminShop 
//    $('linkAdminShop').setStyle('display', 'none');
//    // Show linkAdminSystem
//    $('linkAdminSystem').setStyle('display', 'block');
//
//    // Hide "page" block
//    $('page').setStyle('display', 'none'); 
//
//    // Show shopAdminPage
//    $('shopAdminPage').setStyle('display', 'block');  
//
//    // Load in sidebar shop categories list
//    // Load shop dashboard
//
//    // Load admin dashboard only first time,
//    if (shopAdminLoaded == false)
//    {
//        // Load orders list.
//        ajaxShop('orders/index');
//        shopAdminLoaded = true;
//    }

//    loadShopSidebarCats();
}

