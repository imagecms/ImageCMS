<div style="border:0px;font-size:13px;">
        <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
                <td width="100%" valign="top">
                    Выбeрите Модуль
                </td>
                <td valign="top">
                <div style="width:350px;" id="item_params">  
                        <h3>Параметры:</h3> 
                </div>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <div id="module_list">
                        {foreach $modules as $module}
                            <a href="#" onclick="set_module_data('{$module.name}'); return false;" id="module_{$module.name}" title="{$module.description}" style="display:block;font-size:13px;padding:5px;">{$module.menu_name}</a>
                        {/foreach}
                    </div>
                </td>              
               
               <td valign="top">
                    <!-- Link params -->              
                   <input type="hidden" id="owner_id" value="{$insert_id}" /> 

                    <div class="field_text">Тип</div>
                    <div class="field_input" id="module_type">
                        Модуль
                    </div>
                    <div class="form_overflow"></div>

                    <div class="field_text">Имя</div>
                    <div class="field_input" id="module_name"></div>
                    <div class="form_overflow"></div>
                    

                    <div class="field_text">Заголовок</div>
                    <div class="field_input">
                        <input type="text" class="textbox" value="" name="module_title"  id="module_title" />
                    </div>
                    <div class="form_overflow"></div>                  

                    <div class="field_text">Функция</div>
                    <div class="field_input">
                        <input type="text" class="textbox" value="" name="module_method"  id="module_method" />
                        <br/>
                        func_name/param1/param2
                    </div>
                    <div class="form_overflow"></div>   

                    <div class="field_text">Родитель</div>
                    <div class="field_input">
                       	<select name="module_parent_id" id="module_parent_id">
                        <option value="0">Нет</option>
                        {foreach $menu_result as $item}
                        <option  value="{$item.id}">{ for $i=0; $i < $item['padding']; $i++ }-{/for} {$item.title}</option>  
                        {/foreach}
                        </select> 
                    </div>

                    <div class="form_overflow"></div>


                    <div class="field_text">Позиция после</div>
                    <div class="field_input">
                       	<select name="module_position_after" id="module_position_after">
                        <option value="0">Нет</option>
                        <option value="first">Первый</option>
                        {foreach $menu_result as $item}
                        <option  value="{$item.id}">{for $i=0; $i < $item['padding']; $i++ }-{/for} {$item.title}</option>  
                        {/foreach}
                        </select> 
                    </div>
                    <div class="form_overflow"></div>
                    
                    
                    <div class="field_text">Изображение</div>
                    <div class="field_input">
                        <input type="text" class="textbox" value="" name="mod_image"  id="mod_image" />
                        <img width="16" height="16" align="absmiddle" src="{$THEME}/images/images.png" title="Выбрать Изображение" style="cursor: pointer;" onclick="tinyBrowserPopUp('image', 'mod_image');" />
                    </div>                    


                    <div class="field_text">Уровень доступа</div>
                    <div class="field_input">
                        <select id="module_roles" name="module_roles[]" multiple="multiple">
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
                       <input type="radio" name="modhidden_v" id="mod_hidden" onclick="module_hidden = 1;" /> Да
                       <input type="radio" name="modhidden_v" id="mod_nohidden"  onclick="module_hidden = 0;"  checked="checked" /> Нет
                    </div>

                    <div class="form_overflow"></div>
		    
		    <div class="field_text">
                        Открывать в новом окне
                    </div>
                    <div class="field_input">
                       <input type="radio" name="modnew_page" id="mod_newpage"  onclick="mod_newpage = 1;" /> Да
                       <input type="radio" name="modnew_page" id="mod_nonewpage" onclick="mod_newpage = 0;"  checked="checked" /> Нет
                    </div>

                    <div class="form_overflow"></div>

                    <div class="field_text"></div>
                    <div class="field_input">
                        <input type="button" value="Создать" id="mod_btn" class="button" onclick="insert_module(); return false;" />
                        <input type="button" value="Отмена" class="button" onclick="MochaUI.closeWindow( $('createnewlink') ); return false;" />
                    </div>

                    <div class="form_overflow"></div>                 
                </td>
            </tr>
        </table>

</div>

{literal}
	<script type="text/javascript">
	//<![CDATA[
    var module_hidden = 0;
    var mod_newpage = 0;
    
    function set_module_data(name)
    {
        item = $('module_' + name);

        items = $('module_list').getElements('a');
        items.each(function(el,i){
                el.removeClass('clicked');
        });

        item.set('class', 'clicked'); 

        $('module_name').set('html', name);
        $('module_title').value = item.get('html');

        return false;
    }

    function insert_module()
    {
        mod_name = $('module_name').get('text');

        if (mod_name == '')
        {
            showMessage('Ошибка','Выбирите модуль.');
            return false;
        }


        mod_title = $('module_title').value;

        if (mod_title == '')
        {
            showMessage('Ошибка','Введите заголовк.');
            return false;
        }

        mod_method = $('module_method').value;
        mod_menu_id = $('owner_id').value;
        mod_hidden = module_hidden;
        mod_parent_id = $('module_parent_id').value;
        mod_position_after = $('module_position_after').value;
        item_image = $('mod_image').value;

        var mod_roles = new Array();
        $('module_roles').getSelected().each(function(el) {  
             mod_roles.include( el.value );
        });  

        var req = new Request.HTML({
               method: 'post',
               url: base_url + 'admin/components/cp/menu/insert_menu_item/',
               onRequest: function() { },
               onComplete: function(response) { refresh_menu_list(mod_menu_id);  }
            }).post({
                'menu_id': mod_menu_id,
                'item_type': 'module',
                'item_id': mod_name,
                'method': mod_method,
                'title': mod_title,
                'hidden': mod_hidden,
		'newpage' : mod_newpage,
                'item_image': item_image,
                'roles': mod_roles,
                'parent_id': mod_parent_id,
                'position_after': mod_position_after,
                'update_id': menu_update_id
                });

        if (menu_update_id > 0 && menu_action == 'update')
        {
            MochaUI.closeWindow($('createnewlink'));
        }

    }

		window.addEvent('domready', function() {
            if(menu_action == 'update')
            {
            $('mod_btn').value = 'Сохранить'; 
            }
    		});

	//]]>
	</script>
{/literal}
