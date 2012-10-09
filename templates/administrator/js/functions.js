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

//submit form
$('.formSubmit').live('click',function(){
	var selector = $(this).data('form');
	var action = $(this).data('action');
	$(selector).validate()
	if ($(selector).valid())
	{
		var options = {
				target: '.notifications',
				beforeSubmit: function (formData){
					formData.push( {name: "action", value: action} );
					console.log(formData);
				},
				success: function () {return true;}
		};
		console.log($(selector));
		$(selector).ajaxSubmit(options);
	}
	return false;
});

function updateNotificationsTotal()
{
	$('#topPanelNotifications>div').load('/admin/components/run/shop/notifications/getAvailableNotification');
}


function loadShopInterface()
{
	$('a.logo').attr('href', '/admin/components/run/shop/dashboard');

    // Switch menu
	$('#baseAdminMenu').hide();
	$('#shopAdminMenu').show();
	 
	updateNotificationsTotal();
	$('#topPanelNotifications').show();

}

function loadBaseInterface()
{
	$('a.logo').attr('href', '/admin');

    // Switch menu
	$('#shopAdminMenu').hide();
	$('#baseAdminMenu').show();
	 
	$('#topPanelNotifications').hide();
}

//tinymce

function initTinyMCE()
{
	tinyMCE.init({
        // General options
        mode : "specific_textareas",
        editor_selector : "mceEditor",
        theme : "advanced",
        elements : "elm2",
//        language: "ru",
        //skin : "o2k7",
        //skin_variant : "silver",
        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        file_browser_callback : "tinyBrowser",

        // Example content CSS (should be your site CSS)
        //content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
	});
};


//orders

var orders = new Object({
	
	chOrderStatus:function (status){
		var ids = new Array();
		$('input[name=ids]:checked').each(function(){
			ids.push($(this).val());
		});
		$.post('/admin/components/run/shop/orders/ajaxChangeOrdersStatus/'+status, {ids:ids}, function(data){
			$('#mainContent').after(data);
			$.pjax({url:window.location.pathname, container:'#mainContent'});
			});
		return true;
	},


	chOrderPaid:function (paid){
		var ids = new Array();
		$('input[name=ids]:checked').each(function(){
			ids.push($(this).val());
		});
		$.post('/admin/components/run/shop/orders/ajaxChangeOrdersPaid/'+paid, {ids:ids}, function(data){
			$('#mainContent').after(data);
			$.pjax({url:window.location.pathname, container:'#mainContent'});
			});
		return true;
	},

	deleteOrders:function (){
		$('.modal').modal();
	},

	deleteOrdersConfirm:function ()
	{
		var ids = new Array();
		$('input[name=ids]:checked').each(function(){
			ids.push($(this).val());
		});
		$.post('/admin/components/run/shop/orders/ajaxDeleteOrders/', {ids:ids}, function(data){
			$('#mainContent').after(data);
			$.pjax({url:window.location.pathname, container:'#mainContent'});
			});
		$('.modal').modal('hide');
		return true;
	},
	
	addProduct:function(modelId)
	{
		productName = '';
		variants='';
		$('.modal .modal-body').load('/admin/components/run/shop/orders/ajaxEditAddToCartWindow/'+modelId, function(){
			$('#product_name').autocomplete({
				source: '/admin/components/run/shop/orders/ajaxGetProductList/?categoryId='+$('#Categories').val(),
				select: function(event, ui){
//					console.log(ui);
//					console.log(ui.item);
					productName = ui.item.label;
//					console.log(ui.item.label);
//					console.log(ui.item);
//					console.log(ui.item.variants.lenght);
					$('#product_id').val(ui.item.value);
					vKeys = Object.keys(ui.item.variants);
					
					for (var i=0; i<vKeys.length; i++)
						 
						$('#product_variant_name').append(new Option(ui.item.variants[ vKeys[i] ].name + ui.item.variants[ vKeys[i] ].price + " " + ui.item.cs, vKeys[i], true, true));
					},
				close: function(){$('#product_name').val(productName);}	
			});
			
			$('#Categories').change(function(){ $('#product_name').val(''); });
		});
		$('.modal').modal('show');
		$('#addToCartConfirm').live('click', function(){
			if ($('.modal form').valid())
				$('.modal').modal('hide');
		});
		return false;
	},
	
	deleteProduct:function(id){
		$('.notifications').load('/admin/components/run/shop/orders/ajaxDeleteProduct/'+id);
	}
	
});

var orderStatuses = new Object({
	reorderPositions:function(){
		var i=1;
		$('.sortable tr').each(function(){
			$(this).find('input').val(i);
			i++;
		});	
		$('#orderStatusesList').ajaxSubmit({target:'.notifications'});
		return true;
	},
	deleteOne:function(id){
		$('.modal .modal-body').load('/admin/components/run/shop/orderstatuses/ajaxDeleteWindow/'+id, function(){
			return true;
		});
		$('.modal').modal('show');
	}
});

var callbacks = new Object({
	deleteOne:function(id){
		$.post('/admin/components/run/shop/callbacks/deleteCallback', {id:id}, function(data){
			$('.notifications').append(data);
		});
	},
	
	deleteMany:function(){
		var id = new Array();
		$('input[name=ids]:checked').each(function(){
			id.push($(this).val());
		});
		
		this.deleteOne(id);
		$('.modal').modal('hide');
		return true;
	},
	
	changeStatus:function(id, statusId)
	{
		$.post('/admin/components/run/shop/callbacks/changeStatus', {CallbackId:id, StatusId:statusId}, function(data){
			$('.notifications').append(data);
		});
		$('#callback_'+id).closest('tr').data('status', statusId);
		this.reorderList(id);
	},
	reorderList:function(id)
	{
		var stId = $(' #callback_'+id).data('status');
		//var html = $('#callback_'+id);
		console.log(id);
		console.log(stId);
//		$('#callback_'+id).remove()
//		$('#callbacks_'+stId ).append(html);
		$('#callbacks_'+stId + ' table tbody' ).append($('#callback_'+id));
		console.log($('#callback_'+$(this).data('id')));
		
//		$('.tab-pane tr').each(function(id){
//			var stId = $(this).data('status');
//			$('#callbacks_'+stId + ' #callback_'+id).append($('#callback_'+$(this).data('id'))).remove();
//			console.log($('#callback_'+$(this).data('id')));
//		});
	},
	
	changeTheme:function(id, themeId)
	{
		$.post('/admin/components/run/shop/callbacks/changeTheme', {CallbackId:id, ThemeId:themeId}, function(data){
			$('.notifications').append(data);
		});
	},
	
	setDefaultStatus:function(id, element)
	{
		
		$('.prod-on_off').addClass('disable_tovar').css('left', '-28px');
		$.post('/admin/components/run/shop/callbacks/setDefaultStatus', {id:id}, function(data){
			$('.notifications').append(data);
		});
		//console.log(element);
		//if ((element).removeClass('disable_tovar'))
		return true;
	},
	
	deleteStatus:function(id)
	{
		$.post('/admin/components/run/shop/callbacks/deleteStatus', {id:id}, function(data){
			$('.notifications').append(data);
		});
	},
	
	deleteTheme:function(id)
	{
		$.post('/admin/components/run/shop/callbacks/deleteTheme', {id:id}, function(data){
			$('.notifications').append(data);
		});
	},
	
	reorderThemes:function()
	{
		var positions = new Array();
		$('.sortable tr').each(function(){
			positions.push($(this).data('id'));
		});	
		
		$.post('/admin/components/run/shop/callbacks/reorderThemes', {positions:positions}, function(data){
			$('.notifications').append(data);
		});
		return true;
	}
});

var shopCategories = new Object({
	deleteCategories:function (){
		$('.modal').modal();
	},
	deleteCategoriesConfirm:function ()
	{
		var ids = new Array();
		$('input[name=id]:checked').each(function(){
			ids.push($(this).val());
		});
//		console.log(ids);
		$.post('/admin/components/run/shop/categories/delete', {id:ids}, function(data){
			$('#mainContent').after(data);
			$.pjax({url:window.location.pathname, container:'#mainContent'});
			});
		$('.modal').modal('hide');
		return true;
	}
});


