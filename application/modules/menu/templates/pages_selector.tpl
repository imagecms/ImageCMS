<div style="border:0px;font-size:13px;">
        <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
                <td width="100%" valign="top">
                    <div style="float:left;padding-right:10px;">
                 
                        Категории: 
                        <select id="category_sel">
                        <option value="0" onclick="load_pages(0,0); return false;">root</option>
                        {$cats}
                        </select>         

                        <select id="per_page" onchange="set_per_page(); return false;">
                            <option value="10" selected="selected">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="50">50</option>
                        </select>


                    </div> <div style="float:left;font-size:13px;" id="nav_links"></div>
                </td>
                <td valign="top">
                <div style="width:350px;" id="item_params">  
                        <h3>Параметры:</h3> 
                </div>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <div id="pages_list">
                    </div>
                </td>              
               
               <td valign="top">
                    <!-- Link params -->              
                    <input type="hidden" id="owner_id" value="{$insert_id}" /> 

                    <div class="field_text">Тип</div>
                    <div class="field_input" id="item_type">
                        Страница
                    </div>
                    <div class="form_overflow"></div>

                    <div class="field_text">ID</div>
                    <div class="field_input" id="item_id">
                        0
                    </div>
                    <div class="form_overflow"></div>
                    

                    <div class="field_text">Заголовок</div>
                    <div class="field_input">
                        <input type="text" class="textbox" value="" name="item_title"  id="item_title" />
                    </div>
                    
                    <div class="form_overflow"></div>                  

                    <div class="field_text">Родитель</div>
                    <div class="field_input">
                       	<select name="item_parent_id" id="item_parent_id">
                        <option value="0">Нет</option>
                        {foreach $menu_result as $item}
                        <option  value="{$item.id}">{for $i=0; $i <= $item['padding']; $i++ } -{/for} {$item.title}</option>
                        {/foreach}
                        </select> 
                    </div>

                    <div class="form_overflow"></div>


                    <div class="field_text">Позиция после</div>
                    <div class="field_input">
                       	<select name="position_after" id="position_after">
                        <option value="0">Нет</option>
                        <option value="first">Первый</option>
                        {foreach $menu_result as $item}
                        <option  value="{$item.id}">{for $i=0; $i <= $item['padding']; $i++ } -{/for} {$item.title}</option>        
                        {/foreach}
                        </select> 
                    </div>
                    <div class="form_overflow"></div>
                    
                    <div class="field_text">Изображение</div>
                    <div class="field_input">
                        <input type="text" class="textbox" value="" name="page_image"  id="page_image" />
                        <img width="16" height="16" align="absmiddle" src="{$THEME}/images/images.png" title="Выбрать Изображение" style="cursor: pointer;" onclick="tinyBrowserPopUp('image', 'page_image');" />
                    </div>
                    
                    <div class="form_overflow"></div>                        

                    <div class="field_text">Уровень доступа</div>
                    <div class="field_input">
                        <select id="item_roles" name="item_roles[]" multiple="multiple">
                        <option value="0">Все</option>
                        {foreach $roles as $role}
                          <option value ="{$role.id}">{$role.alt_name}</option>
                        {/foreach}
                        </select>
                    </div>

                    <div class="form_overflow"></div>

                   <div class="field_text">
                        Скрыть
                    </div>
                    <div class="field_input">
                       <input type="radio" name="hidden_v" id="page_hidden"  onclick="item_hidden = 1;" /> Да
                       <input type="radio" name="hidden_v" id="page_nohidden" onclick="item_hidden = 0;"  checked="checked" /> Нет
                    </div>
		    
		    <div class="form_overflow"></div>
		    
	            <div class="field_text">
                        Открывать в новом окне
                    </div>
                    <div class="field_input">
                       <input type="radio" name="new_page" id="page_newpage"  onclick="page_newpage = 1;" /> Да
                       <input type="radio" name="new_page" id="page_nonewpage" onclick="page_newpage = 0;"  checked="checked" /> Нет
                    </div>

                    <div class="form_overflow"></div>

                    <div class="field_text"></div>
                    <div class="field_input">
                        <input type="button" value="Создать" id="page_btn" class="button" onclick="insert_element(); return false;" />
                        <input type="button" value="Отмена" class="button" onclick="MochaUI.closeWindow( $('createnewlink') ); return false;" />
                    </div>

                    <div class="form_overflow"></div>                 
                </td>
            </tr>
        </table>

        <div style="position:absolute;bottom:40px;right:20px;">
        <form onsubmit="make_search(0); return false;">
            Поиск <input type="text" class="textbox" id="search_text" />
            <img src="{$THEME}/images/search.png" width="24" height="24" align="absmiddle" onclick="make_search(0); return false;" />  
        {form_csrf()}</form>
        </div>

	</div>

{literal}
	<script type="text/javascript">
	//<![CDATA[
    var item_type = 'page';
    var item_hidden = 0;
    var page_newpage = 0;
   
    function insert_element()
    {
        id = $('item_id').get('text');

        if (id == 0)
        {
            showMessage('Ошибка','Выбирите страницу.');
            return false;
        }


        title = $('item_title').value;

        if (title == '')
        {
            showMessage('Ошибка','Введите заголовк.');
            return false;
        }

        menu_id = $('owner_id').value;
        hidden = item_hidden;
	newpage = page_newpage;
        parent_id = $('item_parent_id').value;
        position_after = $('position_after').value;
		item_image = $('page_image').value;

        var roles = new Array();
        $('item_roles').getSelected().each(function(el) {
             roles.include( el.value );
        });

        var req = new Request.HTML({
               method: 'post',
               url: base_url + 'admin/components/cp/menu/insert_menu_item/',
               onRequest: function() { },
               onComplete: function(response) { refresh_menu_list(menu_id); }
            }).post({
                'menu_id': menu_id,
                'item_type': item_type,
                'item_id': id,
                'title': title,
                'hidden': hidden,
		'newpage': newpage,
                'item_image': item_image,
                'roles': roles,
                'parent_id': parent_id,
                'position_after': position_after,
                'update_id': menu_update_id
                });

        if (menu_update_id > 0 && menu_action == 'update')
        {
            MochaUI.closeWindow($('createnewlink'));
        }
    }

    function refresh_menu_list(owner_id)
    {
       if ( $('menus_table') != null )
       {
           ajax_div('menus_table', base_url + 'admin/components/cp/menu/list_menu_items/' + owner_id );

            fx_block = $('menus_table');
            var el_tween = new Fx.Tween(fx_block);
            el_tween.start('background-color','#93D135','#FFFFFF');
       }
    }

    function set_item_data(id)
    {
        item = $('item_' + id);

        if(item_type == 'page')
        {
            $('item_title').value = item.get('rel');
            $('item_id').set('html',id);
        }

       items = $('pages_list').getElements('a');
       items.each(function(el,i){
                el.removeClass('clicked');
       });

       item.set('class', 'clicked'); 
    }

    function set_type(type)
    {
        switch(type)
        {
            case 'page':
                item_type = 'page';
            break;
        }
    }


    var block = $('pages_list');
    var nav_block = $('nav_links');
    var per_page = 10;
    var cp = 0;
    var search = '';

        // Search
        function make_search(cur_page)
        {
            search = $('search_text').value;
            per_page = $('per_page').value;

            if (search == '')
            {
                showMessage('Ошибка','Укажите текст для поиска.');
                return false;
            }

            // search request
            start_ajax();

            var request = new Request.JSON({
                url: base_url + 'admin/components/run/menu/search_pages/' + cur_page ,
                onComplete: function(jsonObj) {
                    cp = cur_page;
                    process_search_data(jsonObj); 
                        if (jsonObj != null && $('nav_link_' + cur_page) != null) 
                        {
                            $('nav_link_' + cur_page).setStyle('font-weight', 'bold'); 
                        }
                stop_ajax();
                }
            }).post({'per_page': per_page,'search': search});
            //end search request
        }
        
        // Process search result
        function process_search_data(data)
        {
			if (data == null)
			{
                //no pages in found
                $('pages_list').set('html','Совпадений не найдено.');
                $('nav_links').set('html',' ');
            }else{
                    
                $('pages_list').set('html', ' ');
                $('nav_links').set('html', ' ');

                pages = data.pages_list;
                pages.each(function(page,index) {

                    itm_num = index + 1 + ($('per_page').value * cp);

                    var PageLink = new Element('a', {
                        'href': '#',
                        'class': page.id,
                        'html': itm_num + '. ' + '<i>' + page.cat_name + '</i>' + page.title,
                        'id': 'item_' + page.id,
                        'rel': page.title,
                        'styles': {
                                'display': 'block',
                                'font-size': '13px',
                                'padding': '5px'
                                },
                        'events': {
                                'click': function(){
                                set_item_data(page.id); return false;
                                }
                        }
                    });
                
                    PageLink.inject(block);
                });

              
                create_nav_links(data.links);

              }         

        }
        // end search

        function create_nav_links(nav_count)
        {
               if(nav_count > 0)
               {
                   for(i=0;i < nav_count;i++)
                   {
                    var NavLink = new Element('a', {
                        'href': '#',
                        'html': i + 1 + ' ',
                        'id': 'nav_link_' + i,
                        'class': i,
                        'onclick': 'make_search('+ i + ');'
                        });
                
                   NavLink.inject(nav_block);
                   }
                }
        }

        function set_per_page()
        {
            per_page = $('per_page').value;
            load_pages($('category_sel').value,0);
        }

        function insert_data(data)
        {
			if (data == null)
			{
                //no pages in found
                $('pages_list').set('html','В категории нет страниц.');
                $('nav_links').set('html',' ');
            }else{
                    
                $('pages_list').set('html', ' ');
                $('nav_links').set('html', ' ');

                pages = data.pages_list;
                pages.each(function(page,index) {

                    page_number = index + 1 + ($('per_page').value * cp);

                    var PageLink = new Element('a', {
                        'href': '#',
                        'class': '',
                        'html': page_number + '. ' + page.title,
                        'rel': page.title,
                        'id': 'item_' + page.id,
                        'styles': {
                                'display': 'block',
                                'font-size': '13px',
                                'padding': '5px'
                                },
                        'events': {
                                'click': function(){
                                set_item_data(page.id); return false;
                                }
                        }
                    });
                
                    PageLink.inject(block);
                });

               nav_count = data.links;
               if(nav_count > 0)
               {
                   val = $('category_sel').value;
                   for(i=0;i < nav_count;i++)
                   {
                    var NavLink = new Element('a', {
                        'href': '#',
                        'html': i + 1 + ' ',
                        'id': 'nav_link_' + i,
                        'class': i,
                        'onclick': 'load_pages(' + val + ',' + i + '); return false;'
                        });
                
                   NavLink.inject(nav_block);
                   }
                }        
			}            
        }

        // load category pages
        function load_pages(id, cur_page)
        {
            start_ajax();

            var request = new Request.JSON({
                url: base_url + 'admin/components/run/menu/get_pages/' + id + '/' + cur_page ,
                onComplete: function(jsonObj) {
                    cp = cur_page;
                    insert_data(jsonObj); 
                        if (jsonObj != null && $('nav_link_' + cur_page) != null)
		                {
                            $('nav_link_' + cur_page).setStyle('font-weight', 'bold'); 
                        }
         
                    stop_ajax();
                }
            }).post({'per_page': per_page});
        }

		window.addEvent('domready', function() {
            if(menu_action == 'update')
            {
            $('page_btn').value = 'Сохранить'; 
            }

            load_pages($('category_sel').value,0);
    		});
	//]]>
	</script>
{/literal}
