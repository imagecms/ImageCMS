<div id="global_selector">
	<ul>
		<li><a href="{$SELF_URL}/display_selector/{$insert_id}/page">Страницы</a></li>
		<li><a href="{$SELF_URL}/display_selector/{$insert_id}/category">Категории</a></li>
		<li><a href="{$SELF_URL}/display_selector/{$insert_id}/module">Модули</a></li>
		<li><a href="{$SELF_URL}/display_selector/{$insert_id}/url">URL</a></li>
	</ul>
</div>	

{literal}
    <style type="text/css">
     #pages_list  a:hover {
        background-color: #6f9fbd; 
        color:#fff;        
        border-left:5px solid #4BBBDD;
    }
    #category_list  a:hover {
        background-color: #6f9fbd; 
        color:#fff;        
        border-left:5px solid #4BBBDD;
    }
    #module_list a:hover {
        background-color: #6f9fbd; 
        color:#fff;        
        border-left:5px solid #4BBBDD;
    }
    .clicked {
        background-color:#77C4DB; 
        color:#fff;        
        border-left:5px solid #4BBBDD;
    }
    .non_cliked{}
    </style>

    <script type="text/javascript">

        var c_load = 0;
        var fx_step = 0;

        var selector_tabs = new SimpleTabs('global_selector',
        {
            selector: 'li a',
            cache:true,
            onComplete: function() {
                if (menu_action == 'update')
                {
                    load_item_data();
                }
            }
        });

        function load_item_data()
        {
            var request = new Request.JSON({
                url: base_url + 'admin/components/run/menu/get_item' ,
                onComplete: function(jsonObj) {
                window.addEvent('domready', function() {
                       process_item_data(jsonObj);
                   });
                }
            }).post({'item_id': menu_update_id});
        }

        function process_item_data(data)
        {
			if (data == null)
			{
               // alert('not found');
            }else{
                
                switch (data.item_type)
                {
                    case 'page': 
                        //load and set item data
 

                        $('item_id').set('text',data.item_id);
                        $('item_title').value = data.title;
                        item_hidden = data.hidden;

                        if(item_hidden == 0) {
                            $('page_nohidden').setProperty('checked','true');
                        }else{
                            $('page_hidden').setProperty('checked','true'); 
                        }
			
			item_newpage = data.add_data.newpage;
			
			if(item_newpage == 0) {
                            $('page_nonewpage').setProperty('checked','true');
                        }else{
                            $('page_newpage').setProperty('checked','true'); 
                        }

                        if (data.parent_id != 0) {
                            $('item_parent_id').getElements('option').each(function(option,i) {
                                if (option.value == data.parent_id)
                                {
                                    $('item_parent_id').options[i].selected = 'selected';
                                }
                                }); 
                        }
                        
                        $('page_image').value = data.item_image;
                       	
                        roles = data.roles;                         
                        if (roles != false) {
                        roles.each(function(item, index){
                            $('item_roles').getElements('option').each(function(option,i2) {
                                if (option.value == item)
                                {
                                    $('item_roles').options[i2].selected = 'selected';
                                }
                                }); 
                        });
                        }

                    break;

                    case 'category':
                    if (c_load == 0){
                        selector_tabs.select(1);
                        c_load = 1;
                    }

                        fx_step = fx_step + 1;
                        if (fx_step == 2)
                        {

                        $('cat_id').set('text', data.item_id);
                        $('cat_title').value = data.title;
                        cat_hidden = data.hidden;

                        if(cat_hidden == 0) {
                            $('cat_nohidden').setProperty('checked','true');
                        }else{
                            $('cat_hidden').setProperty('checked','true'); 
                        }
			
			cat_newpage = data.add_data.newpage;
			
			if(cat_newpage == 0) {
                            $('cat_nonewpage').setProperty('checked','true');
                        }else{
                            $('cat_newpage').setProperty('checked','true'); 
                        }

                        if (data.parent_id != 0) {
                            $('cat_parent_id').getElements('option').each(function(option,i) {
                                if (option.value == data.parent_id)
                                {
                                    $('cat_parent_id').options[i].selected = 'selected';
                                }
                                if (option.value == data.id)
                                {
                                   $('cat_parent_id').options[i].disabled = 'disabled'; 
                                }
                                }); 
                        }
                        
                        $('cat_image').value = data.item_image;
                       
                        roles = data.roles;                         
                        if (roles != false) {
                        roles.each(function(item, index){
                            $('cat_roles').getElements('option').each(function(option,i2) {
                                if (option.value == item)
                                {
                                    $('cat_roles').options[i2].selected = 'selected';
                                }
                                }); 
                        });
                        }
                        }

                    break;

                    case 'url':
                    if (c_load == 0){
                        selector_tabs.select(3);
                        c_load = 1;
                    }

                        fx_step = fx_step + 1;
                        if (fx_step == 2)
                        {

                        $('url_title').value = data.title;
                        cat_hidden = data.hidden;
                        $('url_to_page').value = data.add_data.url;

                        if(cat_hidden == 0) {
                            $('url_nohiddenv').setProperty('checked','true');
                        }else{
                            $('url_hiddenv').setProperty('checked','true'); 
                        }
			
			url_newpage = data.add_data.newpage;
			
			if(url_newpage == 0) {
                            $('url_nonewpage').setProperty('checked','true');
                        }else{
                            $('url_newpage').setProperty('checked','true'); 
                        }

                        if (data.parent_id != 0) {
                            $('url_parent_id').getElements('option').each(function(option,i) {
                                if (option.value == data.parent_id)
                                {
                                    $('url_parent_id').options[i].selected = 'selected';
                                }
                                if (option.value == data.id)
                                {
                                   $('url_parent_id').options[i].disabled = 'disabled'; 
                                }
                                }); 
                        }
                        
                        $('url_image').value = data.item_image;
                       
                        roles = data.roles;                         
                        if (roles != false) {
                        roles.each(function(item, index){
                            $('url_roles').getElements('option').each(function(option,i2) {
                                if (option.value == item)
                                {
                                    $('url_roles').options[i2].selected = 'selected';
                                }
                                }); 
                        });
                        }
                        }

                    break;

                    case 'module':
                    if (c_load == 0){
                        selector_tabs.select(2);
                        c_load = 1;
                    }
                     
                        fx_step = fx_step + 1;
                        if (fx_step == 2)
                        {

                        $('module_name').set('text', data.add_data.mod_name);
                        $('module_title').value = data.title;
                        module_hidden = data.hidden;
                        $('module_method').value = data.add_data.method;

                        if(module_hidden == 0) {
                            $('mod_nohidden').setProperty('checked','true');
                        }else{
                            $('mod_hidden').setProperty('checked','true'); 
                        }
			
			mod_newpage = data.add_data.newpage;
			
			if(mod_newpage == 0) {
                            $('mod_nonewpage').setProperty('checked','true');
                        }else{
                            $('mod_newpage').setProperty('checked','true'); 
                        }

                        if (data.parent_id != 0) {
                            $('module_parent_id').getElements('option').each(function(option,i) {
                                if (option.value == data.parent_id)
                                {
                                    $('module_parent_id').options[i].selected = 'selected';
                                }
                                }); 
                        }
                        
                        $('mod_image').value = data.item_image;
                       
                        roles = data.roles;                         
                        if (roles != false) {
                        roles.each(function(item, index){
                            $('module_roles').getElements('option').each(function(option,i2) {
                                if (option.value == item)
                                {
                                    $('module_roles').options[i2].selected = 'selected';
                                }
                                }); 
                        });
                        }
                        }

                    break;
                }
            }
        }

    </script>
{/literal}
