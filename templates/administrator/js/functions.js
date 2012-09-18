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

function chOrderStatus(status){
	var ids = new Array();
	$('input[name=ids]:checked').each(function(){
		ids.push($(this).val());
	});
	$.post('/admin/components/run/shop/orders/ajaxChangeOrdersStatus/'+status, {ids:ids}, function(data){
		$('#mainContent').after(data);
		$.pjax({url:window.location.pathname, container:'#mainContent'});
		});
	return true;
}


function chOrderPaid(paid){
	var ids = new Array();
	$('input[name=ids]:checked').each(function(){
		ids.push($(this).val());
	});
	$.post('/admin/components/run/shop/orders/ajaxChangeOrdersPaid/'+paid, {ids:ids}, function(data){
		$('#mainContent').after(data);
		$.pjax({url:window.location.pathname, container:'#mainContent'});
		});
	return true;
}

function deleteOrders(){
	
	$('#orders_delete_dialog').dialog({
		modal: true,
		buttons: {
			"Delete all items": function() {
				$( this ).dialog( "close" );
				
				var ids = new Array();
				$('input[name=ids]:checked').each(function(){
					ids.push($(this).val());
				});
				$.post('/admin/components/run/shop/orders/ajaxDeleteOrders/', {ids:ids}, function(data){
					$('#mainContent').after(data);
					$.pjax({url:window.location.pathname, container:'#mainContent'});
					});
				return true;
				
			},
			Cancel: function() {
				$( this ).dialog( "close" );
				return false;
			}
		}
	});
}
