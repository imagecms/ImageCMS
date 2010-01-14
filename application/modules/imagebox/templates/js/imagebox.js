
function show_main_window()
{
        //tinyMCE.activeEditor.selection.setContent('asd'); // Insert image code

		new MochaUI.Window({
			id: 'imagebox_module_main_w',
			title: 'ImageBox',
			type: 'modal',
			loadMethod: 'xhr',
			contentURL: base_url + 'admin/components/cp/imagebox/main',
			width: 550,
			height: 450
		});
}

function imagebox_uploadCallback()
{
    var imgIFrame = document.getElementById('imagebox_upload_target');
    var data = imgIFrame.contentWindow.document.body.innerHTML;

    if (data.test('Error:') == true)
    {
        showMessage('Ошибка', data);
    }else{
        tinyMCE.activeEditor.selection.setContent( data );
        MochaUI.closeWindow($('imagebox_module_main_w'));
    }
}

