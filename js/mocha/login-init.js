
initializeWindows = function(){

	MochaUI.LoginWindow = function(){
		new MochaUI.Window({
			id: 'loginwindow',
			title: 'Вход',
			loadMethod: 'xhr',
			contentURL: base_url + 'admin/login/show_form',			container: 'pageWrapper',
			resizable: false,
			maximizable: false,
			minimizable: false,
			closable: true,
			width: 420,
			height: 320
		});
	}
	// Deactivate menu header links
	$$('a.returnFalse').each(function(el){
		el.addEvent('click', function(e){
			new Event(e).stop();
		});
	});


	// Build windows onDomReady
    MochaUI.LoginWindow();

}

// Initialize MochaUI when the DOM is ready
window.addEvent('domready', function(){
initializeWindows();
});


// This runs when a person leaves your page.
window.addEvent('unload', function(){
	if (MochaUI) MochaUI.garbageCleanUp();
});
