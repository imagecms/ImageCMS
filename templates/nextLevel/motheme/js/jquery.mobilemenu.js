(function($){
	
	//plugin's default options
	var settings = {
		prependTo: 'nav',				//insert at top of page by default
		switchWidth: 768,				//width at which to switch to select, and back again
		topOptionText: 'Select a page:'	//default "unselected" state
	},
	
	menuCount = 0,						//used as a unique index for each menu if no ID exists
	uniqueLinks = [];					//used to store unique list items for combining lists

	//go to page
	function goTo(url){document.location.href = url;}
	
	//does menu exist?
	function menuExists(){return ($('.mnav').length) ? true : false;}

	//validate selector's matched list(s)
	function isList($this){
		var pass = true;
		$this.each(function(){
			if(!$(this).is('ul') && !$(this).is('ol')){
				pass=false;
			}
		});
		return pass;
	}//isList()

	//function to decide if mobile or not
	function isMobile(){return ($(document).width() < settings.switchWidth);}
	
	//function to get text value of element, but not it's children
	function getText($item){return $.trim($item.clone().children('ul, ol').remove().end().text());}
	
	//function to check if URL is unique
	function isUrlUnique(url){return ($.inArray(url, uniqueLinks) === -1) ? true : false;}

	//function to create options in the select menu
	function createOption($item, $container, text){
		//if no text param is passed, use list item's text, otherwise use settings.groupPageText
		var $selected='', $disabled='', $sel_text='';
		
		if ($item.hasClass('current')) $selected='selected';
		if ($item.hasClass('disabled')) {
			if ($('.current').length) $disabled='disabled';
			else $disabled='selected';
		}
		
		$sel_text=$.trim(getText($item));
		$sel_text = $sel_text.replace('»', '');
		if ($item.parent('ul ul').length) $sel_text = ' – ' + $sel_text;
		if ($item.parent('ul ul ul').length) $sel_text = '– ' + $sel_text;
		if ($item.parent('ul ul ul ul').length) $sel_text = '– ' + $sel_text;

		if(!text){$('<option value="'+$item.find('a:first').attr('href')+'" ' + $selected + ' ' + $disabled + '>' + $sel_text +'</option>').appendTo($container);}
		else {$('<option value="'+$item.find('a:first').attr('href')+'" ' + $selected + ' ' + $disabled + '>'+text+'</option>').appendTo($container);}
	}//createOption()
	
	//function to create submenus
	function createGroup($group, $container){
		//loop through each sub-nav list
		$group.children('ul, ol').each(function(){
			$(this).children('li').each(function(){
				createOption($(this), $container);
				
				$(this).each(function(){
					var $li_ch = $(this),
						$container_ch =  $container;
					createGroup($li_ch, $container_ch);
				});
			});
		});
		
	}//createGroup()
	
	//function to create <select> menu
	function createSelect($menu){
		//create <select> to insert into the page
		var $select = $('<select id="mm'+menuCount+'" class="mnav">');
		menuCount++;
		
		//create default option if the text is set (set to null for no option)
		if(settings.topOptionText){createOption($('<li class="disabled"><a href="#">'+settings.topOptionText+'</a></li>'), $select);}
		
		//loop through first list items
		$menu.children('li').each(function(){
			var $li = $(this);

			//if nested select is wanted, and has sub-nav, add optgroup element with child options
			if($li.children('ul, ol').length){
				createOption($li, $select);
				createGroup($li, $select);
			}
			
			//otherwise it's a single level select menu, so build option
			else {createOption($li, $select);}
		});
		
		//add change event and prepend menu to set element
		$select
			.change(function(){goTo($(this).val());})
			.prependTo(settings.prependTo);
	}//createSelect()

	
	//function to run plugin functionality
	function runPlugin(){
		//menu doesn't exist
		if(isMobile() && !menuExists()){
			$menus.each(function(){
				createSelect($(this));
			});
		}

		//menu exists, and browser is mobile width
		if(isMobile() && menuExists()){
			$('.mnav').show();
			$menus.hide();
		}

		//otherwise, hide the mobile menu
		if(!isMobile() && menuExists()){
			$('.mnav').hide();
			$menus.show();
		}
	}//runPlugin()

	//plugin definition
	$.fn.mobileMenu = function(options){
		//override the default settings if user provides some
		if(options){$.extend(settings, options);}
		//check if user has run the plugin against list element(s)
		if(isList($(this))){
			$menus = $(this);
			runPlugin();
			$(window).resize(function(){runPlugin();});
		} else {
			alert('mobileMenu only works with <ul>/<ol>');
		}
	};//mobileMenu()
})(jQuery);

$(document).ready(function(){
	$('.sf-menu').mobileMenu();
});