$(document).ready(function()
{
	var tabContainers = $('div.tabs > div');
	tabContainers.hide().filter(':first').show();
			
	$('div.tabs ul.tabNavigation a').click(function () {
            tabContainers.hide();
            tabContainers.filter(this.hash).show();
            $('div.tabs ul.tabNavigation a').removeClass('selected');
            $(this).addClass('selected').blur();
            return false;
            }).filter(':first').click();

});

