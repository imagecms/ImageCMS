window.addEvent('domready', function() {

alertBox = new SexyAlertBox();	
        
new MochaUI.Column({
    id: 'sideColumn1',
    placement: 'left',
    width: 200,
    resizeLimit: [100, 300]
});

new MochaUI.Column({
    id: 'mainColumn',
    placement: 'main',	
    width: null,
});

new MochaUI.Panel({
    id: 'files-panel',
    title: 'Категории',
    loadMethod: 'xhr',
    contentURL: base_url + 'admin/sidebar_cats',	
    column: 'sideColumn1',
});

/*new MochaUI.Panel({*/
/*id: 'panel2',*/
/*title: 'Panel',*/
/*loadMethod: 'html',*/
/*content: 'content2',*/
/*column: 'sideColumn1',*/
/*height: 300*/
/*});*/

new MochaUI.Panel({
    id: 'page',
    title: 'Main Content',
    loadMethod: 'html',
    //contentURL: base_url + 'admin/dashboard/index',
    content:'',
    column: 'mainColumn',
    panelBackground: '#f8f8f8'
});

$('page_headerContent').dispose();
$('page_header').dispose();
$('page').setStyle('height', '100%');
$('mainColumn_spacer').setStyle('display', 'none');

        });
