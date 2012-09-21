//temporary

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
	$(target).load(url);
}

