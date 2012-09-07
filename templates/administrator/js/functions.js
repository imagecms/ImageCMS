function showMessage(text, messageType='message')
{
	$('.notifications').notify({
		message: { text: 'Aw yeah, It works!', type: messageType }
	}).show();
}