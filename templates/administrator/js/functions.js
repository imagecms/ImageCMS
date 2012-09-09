//temporary

var base_url = 'http://p4/';

function showMessage(text, messageType)
{
	messageType = typeof messageType !== 'undefined' ? messageType: 'message';
	$('.notifications').notify({
		message: { text: text, type: messageType }
	}).show();
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