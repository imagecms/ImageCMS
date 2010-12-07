function ajax_me(form_id)
{
	$(form_id).addEvent('submit', function(event) {

		event.stop();

        $(form_id).getElements('input[type=submit]').each(function(number){
            number.disabled = true;
        });

		var req = new Request.HTML({
			method: $(form_id).get('method'),
			url: $(form_id).get('action'),

			onRequest: function() { start_ajax(); },
			onFailure: function() { },
			onSuccess: function() { },
			onComplete: function(response) { my_alert(form_id); }
		}).post($(form_id));

	});
}

function ajax_form(form_id,update_block)
{
	var update_div = update_block;

	$(form_id).addEvent('submit', function(event) {

		event.stop();

        $(form_id).getElements('input[type=submit]').each(function(number){
            number.disabled = true;
        }); 

		var req = new Request.HTML({
			method: $(form_id).get('method'),
			url: $(form_id).get('action'),
			update: update_div,
			onRequest: function() { start_ajax(); },
			onFailure: function() { },
			onSuccess: function() { },
			onComplete: function(response) { my_alert(form_id); }
		}).post($(form_id));
	});
}

function start_ajax()
{
	$('spinner2').src = theme + '/images/spinner.gif';
}

function stop_ajax()
{
	$('spinner2').src = theme + '/images/spinner-placeholder.gif';
}

function change_page_status(page_id)
{
			var req = new Request.HTML({
			method: 'post',
			url: base_url + 'admin/pages/ajax_change_status/' + page_id,
			onComplete: function(response) { }
		}).post();
}

function ajax_div(div_id,act)
{
    if ( $(div_id) != null  )
    {
    history(div_id,act);
	start_ajax();

	var update_div = $(div_id);

    update_div.set('html','<img src=' + theme  + '/images/ajax_div.gif width=32 height=32 />');

		var req = new Request.HTML({
			method: 'post',
			url: act,
			update: update_div,
			evalResponse: true,
			onComplete: function(response) { 
                stop_ajax(); 
            },
            onFailure: function(){
                update_div.set('text', 'Request failed.');
            }
            
		}).send();
    }
}

function history_refresh()
{
      var req = new Request.HTML({
			method: 'post',
			url: history[h_steps],
			update: 'page',
			evalResponse: true,
			onComplete: function(response) { stop_ajax(); }
		}).send();
}

// History for page div
function history(div,url)
{
	if(div == 'page')
	{
		h_steps = h_steps + 1;
		history[h_steps] = url;
	}
}

//go back
function history_back()
{
	if(cur_pos > h_steps)
	{
		//do something
	}else{
			cur_pos = cur_pos + 1;
			start_ajax();
			upd = h_steps - cur_pos;
			var req = new Request.HTML({
			method: 'post',
			url: history[upd],
			update: 'page',
			evalResponse: true,
			onComplete: function(response) { stop_ajax(); }
		}).send();

	}
}

//go forward
function history_forward()
{
	if(cur_pos != 0)
	{
			cur_pos = cur_pos - 1;
			upd = h_steps - cur_pos;

			start_ajax();

			var req = new Request.HTML({
			method: 'post',
			url: history[upd],
			update: 'page',
			evalResponse: true,
			onComplete: function(response) { stop_ajax(); }
		}).send();

	}

}

function my_alert(form_id){
	if ($(form_id) != null)
    {
        $(form_id).removeEvents();

        $(form_id).getElements('input[type=submit]').each(function(number){
            number.disabled = false;
        }); 

    }
	stop_ajax();
}

function showMessage(title,message)
{
	var roar = new Roar({
			duration: 5000
	});

	roar.alert(title,message);
}

function cats_options(cat_id)
{
	ajax_div('page', base_url + 'admin/pages/GetPagesByCategory/' + cat_id);
}


function confirm_delete_cat(name,id)
{
alertBox.confirm('<h1>Удалить категорию ' + name + '? </h1> Внимание! Также будут удалены все страницы из этой категории!', {onComplete:
	function(returnvalue) {
	if(returnvalue)
	{
		var req = new Request.HTML({
			method: 'post',
			url: base_url + 'admin/categories/delete',
			evalResponse: true,
			onComplete: function(response) {  
               	ajax_div('categories', base_url + '/admin/categories/update_block');             
               	ajax_div('page', base_url + '/admin/categories/cat_list');             
            }
		}).post({'id': id});

	}
	else
	{

	}
	}
});
}

function delete_cache(param)
{
block_screen();
		var req = new Request.HTML({
			method: 'post',
			url: base_url + 'admin/delete_cache/',
			evalResponse: true,
			onComplete: function(response) { MochaUI.closeWindow($('block_sc')); }
		}).post({'param': param});
}

function translite_title(str)
{
			var req = new Request.HTML({
			method: 'post',
			url: base_url + 'admin/pages/ajax_translit/',
			onComplete: function(responseTree,responseElements,responseHTML,responseJavaScript) { $('page_url').value = responseHTML;	}
		}).post({'str': str});
}

function translite_cat_name(str)
{
			var req = new Request.HTML({
			method: 'post',
			url: base_url + 'admin/pages/ajax_translit/',
			onComplete: function(responseTree,responseElements,responseHTML,responseJavaScript) { $('cat_url').value = responseHTML;	}
		}).post({'str': str});
}

function retrive_keywords(str)
{
			var req = new Request.HTML({
			method: 'post',
			url: base_url + 'admin/pages/ajax_create_keywords/',
			onComplete: function(responseTree,responseElements,responseHTML,responseJavaScript) { $('keywords_list').set('html',responseHTML);	}
		}).post({'keys': str});
}

function create_description(str)
{
		var req = new Request.HTML({
		method: 'post',
		url: base_url + 'admin/pages/ajax_create_description/',
		onComplete: function(responseTree,responseElements,responseHTML,responseJavaScript) { $('page_description').value = responseHTML;	}
		}).post({'text': str});
}

function block_screen()
{
	   new MochaUI.Window({
			id: 'block_sc',
			title: 'Locked',
			type: 'modal',
			loadMethod: 'html',
			minimizable: 'false',
			maximizable: 'false',
			closable: 'false',
			draggable: 'false',
			width: 0,
			height: 0,
			x: -50,
			y: 10
		});
}


//history hotkeys
function hotkeys(e) {
	if (!e) e = window.event;
	var k = e.keyCode;
	if (e.ctrlKey) {
	if (k == 37) { d = 'back'; } // Ctrl+Left
	if (k == 39) { d = 'up'; } // Ctrl+Right
	}
	if (d == 'back')
	{
	k = 0;
	d = 0;
	history_back();
	}
	if (d == 'up')
	{
	k = 0;
	d = 0;
	history_forward();
}
}

function init_keys() {
	document.onkeydown = hotkeys;
}


function com_settings(com_name)
{
			new MochaUI.Window({
			id: 'edit_component_window',
			title: 'Настройки компонента: ' + com_name,
			loadMethod: 'xhr',
			contentURL: base_url + 'admin/components/component_settings/' + com_name,
			width: 490,
			height: 190
		});
}

function com_admin(com_name)
{
		var req = new Request.HTML({
		method: 'post',
		url: base_url + 'admin/components/init_window/',
		onComplete: function() {}
		}).post({'component': com_name});
}

function com_info(com_name)
{
		var req = new Request.HTML({
		method: 'post',
		url: base_url + 'admin/components/com_info/',
		onComplete: function() {}
		}).post({'component': com_name});
}

function delete_lang(lang_id)
{
alertBox.confirm('<h1> </h1><p>Удалить язкык ID: '+ lang_id +'? <br/>Внимание! Также будут удалены страницы на этом языке.</p>', {onComplete:
	function(returnvalue) {
	if(returnvalue)
	{
		var req = new Request.HTML({
		method: 'post',
		url: base_url + 'admin/languages/delete/',
		onComplete: function() {}
		}).post({'lang_id': lang_id});
	}
	else
	{

	}
	}
});

}

function set_def_lang(lang)
{
		var req = new Request.HTML({
		method: 'post',
		url: base_url + 'admin/languages/set_default/',
		onComplete: function() {}
		}).post({'lang': lang});
}

function change_edit_lang(page,lang)
{
	ajax_div('page',base_url + 'admin/pages/edit/' + page + '/' + lang);
}


function confirm_delete_page(page_id)
{
alertBox.confirm('<h1> </h1><p>Удалить страницу ID: '+ page_id + '? </p>', {onComplete:
	function(returnvalue) {
	if(returnvalue)
	{
				var req = new Request.HTML({
				method: 'post',
				url: base_url + 'admin/pages/delete/' + page_id,
				onComplete: function(response) { }
			}).post();
	}
	else
	{

	}
	}
});
}

function ajax_request(url)
{
		var req = new Request.HTML({
			method: 'post',
			url: url,
			evalResponse: true,
			onComplete: function(response) { }
		}).send();
}

function edit_group(id)
{
		new MochaUI.Window({
			id: 'group_edit_window',
			title: 'Редактировать группу',
			type: 'modal',
			loadMethod: 'xhr',
			contentURL: base_url + 'admin/components/cp/user_manager/edit/' + id,
			width: 490,
			height: 300
		});
}

function delete_group(id)
{
	alertBox.confirm('<h1> </h1><p>Удалить группу ID: '+ id +'? </p>', {onComplete:
	function(returnvalue) {
		if(returnvalue)
		{
					var req = new Request.HTML({
					method: 'post',
					url: base_url + 'admin/components/cp/user_manager/delete/' + id,
					onComplete: function(response) { }
				}).post();
		}
	}
});
}

// Save pages position and refresh list.
// Called in administrator/pages.tpl
function save_pages_position(redirectUrl)
{
    var pages_pos = new Array();     

    var items = $('pages_table').getElements('input');
    items.each(function(el,i){
            if(el.hasClass('page_pos')) 
            {
                id = el.id;
                val = el.value;
                new_pos = id + '_' + val;
                pages_pos.include( new_pos );
            }
            });

    start_ajax();

    var req = new Request.HTML({
       method: 'post',
       url: base_url + 'admin/pages/save_positions/',
       onRequest: function() { },
       onComplete: function(response) {
           // Reload pages list
           ajax_div('page', redirectUrl);
           stop_ajax();
       }
    }).post({'pages_pos': pages_pos });
}

function delete_sel_pages(cat_id)
{
alertBox.confirm('<h1> </h1><p>Удалить отмеченые страницы? </p>', {onComplete:
function(returnvalue){
if(returnvalue)
{
    var pages_arr = new Array();     

    var items = $('pages_table').getElements('input');
    items.each(function(el,i){
            if(el.checked == true) 
            {
                id = el.id;
                val = el.value;
                el_info = id;
                pages_arr.include( el_info );
            }  
            });

    var req = new Request.HTML({
       method: 'post',
       url: base_url + 'admin/pages/delete_pages/',
       onRequest: function() { },
       onComplete: function(response) {  
            ajax_div('page', base_url + 'admin/pages/GetPagesByCategory/' + cat_id);   
        }
    }).post({'pages': pages_arr });
}
}
});
}
		
function side_panel(action)
{
    //Cookie.dispose('sidepanel'); 

    if (action == 'show') 
    {
        document.getElementById('sidebar1').style.display='block'; 
        document.getElementById('sidebar2').style.display='none'; 
        var sp = Cookie.write('sidepanel', 'hide', {duration: 99}); 
    }else{
        document.getElementById('sidebar1').style.display='none'; 
        document.getElementById('sidebar2').style.display='block'; 
        var sp = Cookie.write('sidepanel', 'show', {duration: 99}); 
    }

    return true;
}

function move_to_cat(action)
{
    var pages_arr = new Array();     
    c_id = $('move_cat_id').value;
    var items = $('pages_table').getElements('input');
    items.each(function(el,i){
            if(el.checked == true) 
            {
                id = el.id;
                val = el.value;
                el_info = id;
                pages_arr.include( el_info );
            }  
            });
    var req = new Request.HTML({
       method: 'post',
       url: base_url + 'admin/pages/move_pages/' + action,
       onRequest: function() { },
       onComplete: function(response) {}
    }).post({'pages': pages_arr, 'new_cat': c_id });
}

function change_comments_status()
{
    cat_id = $('category_selectbox').value;
    var request = new Request.JSON({
        url: base_url + 'admin/categories/get_comments_status/' + cat_id ,
        onComplete: function(jsonObj) {
               if(jsonObj.comments_default == 1)
               {
                    $('comments_status').checked = true;
               }else{
                    $('comments_status').checked = false;
               }
        }
    }).post();
}


function show_help(item)
{
    a = $(item).getStyle('visibility');

    if(a == 'hidden')
    {
        $(item).set({
            'styles': {
                'visibility': 'visible',
            }
        });
    }else{
        $(item).set({
            'styles': {
                'visibility': 'hidden',
            }
        });

    }
}

// Widgets
function create_widget()
{
    name = $('widget_name').value;
    desc = $('widget_desc').value;
    type = $('widget_type_sel').value;

    if (type == 'module')
    {
        module = selected_module;
        method = selected_method;

        var request = new Request.HTML({
            url: base_url + 'admin/widgets_manager/create',
            onComplete: function() {
            }
        }).post({
            'name' : name,
            'desc' : desc,
            'type' : type,
            'module' : module,
            'method' : method,
            });
    }

    if (type == 'html')
    {
        var html_code = '';
        //if (tinymce_loaded == false) {
        //    html_code = $('html_code').value;
        //} else {
        //    html_code = tinyMCE.get('html_code').getContent();
        //}

        try {
            html_code = $('html_code').value;
        }catch(e){
            html_code = tinyMCE.get('html_code').getContent();
        }

        var request = new Request.HTML({
            url: base_url + 'admin/widgets_manager/create',
            onComplete: function() {
            }
        }).post({
            'name' : name,
            'desc' : desc,
            'type' : type,
            'html_code' : html_code,
            });
    }
}

function edit_widget_html(id)
{
    ajax_div('page', base_url + 'admin/widgets_manager/edit_html_widget/' + id);
}

function select_widget(module, method, title)
{
    $('widget_title').highlight('#47B1C1').focus();
    $('widget_title').set('html', '<a href="#">' + title + '</a>');
    selected_module = module;
    selected_method = method;
}

function load_create_tpl()
{
    type = $('widget_type_sel').value;

    if (type == 'module')
    {
        $('module_info').setStyle('display', 'block');
        $('html_tpl').setStyle('display', 'none');
        ajax_div('widget_create_div', base_url + 'admin/widgets_manager/display_create_tpl/' + type);
    }

    if (type == 'html')
    {
        $('html_tpl').setStyle('display', 'block');
        $('module_info').setStyle('display', 'none');
        $('widget_create_div').set('html', '');
    }
}

function edit_widget(id)
{
    ajax_div('page', base_url + 'admin/widgets_manager/edit/' + id );
}

function confim_delete_widget(name)
{
alertBox.confirm('<h1> </h1><p>Удалить виджет ' + name + '? </p>', {onComplete:
function(returnvalue){
if(returnvalue)
{
        var req = new Request.HTML({
           method: 'post',
           url: base_url + 'admin/widgets_manager/delete',
           onRequest: function() { },
           onComplete: function(response) {
                ajax_div('page', base_url + 'admin/widgets_manager');
            }
        }).post({'widget_name': name });
}
}
});
}