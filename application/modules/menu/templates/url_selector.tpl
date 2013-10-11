<div style="border:0px;font-size:13px;">
        <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
                <td width="100%" valign="top">
                    {lang("Specify or select a link to the page", "menu")}
                </td>
                <td valign="top">
                <div style="width:350px;" id="item_params">  
                        <h3>{lang("Options", "menu")}:</h3> 
                </div>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <div>
                        {lang("URL", "menu")}: <input type="text" class="textbox_long" id="url_to_page" style="width:350px;" value="" />
                    </div>
                </td>              
               
               <td valign="top">
                    <!-- Link params -->              
                   <input type="hidden" id="owner_id" value="{$insert_id}" /> 
                
                    <div class="field_text">{lang("Title", "menu")}</div>
                    <div class="field_input">
                        <input type="text" class="textbox" value="" name="url_title"  id="url_title" />
                    </div>
                    
                    <div class="form_overflow"></div>                  

                    <div class="field_text">{lang("Parent", "menu")}</div>
                    <div class="field_input">
                       	<select name="url_parent_id" id="url_parent_id">
                        <option value="0">{lang("No", "menu")}</option>
                        {foreach $menu_result as $item}
                            <option  value="{$item.id}">{for $i=0; $i < $item['padding']; $i++}-{/for} {$item.title}</option>  
                        {/foreach}
                        </select> 
                    </div>

                    <div class="form_overflow"></div>


                    <div class="field_text">{lang("Position after", "menu")}</div>
                    <div class="field_input">
                       	<select name="url_position_after" id="url_position_after">
                        <option value="0">{lang("No", "menu")}</option>
                        <option value="first">{lang("First", "menu")}</option>
                        {foreach $menu_result as $item}
                        <option  value="{$item.id}">{for $i=0; $i < $item['padding']; $i++ }-{/for} {$item.title}</option>  
                        {/foreach}
                        </select> 
                    </div>
                    <div class="form_overflow"></div>
                    

                    <div class="field_text">{lang("Image", "menu")}</div>
                    <div class="field_input">
                        <input type="text" class="textbox" value="" name="url_image"  id="url_image" />
                        <img width="16" height="16" align="absmiddle" src="{$THEME}/images/images.png" title="{lang("Select an image", "menu")}" style="cursor: pointer;" onclick="tinyBrowserPopUp('image', 'url_image');" />
                    </div>    
                                        

                    <div class="field_text">{lang("Access level", "menu")}</div>
                    <div class="field_input">
                        <select id="url_roles" name="url_roles[]" multiple="multiple">
                        <option value="0">{lang("All", "menu")}</option>
                        {foreach $roles as $role}
                          <option value ="{$role.id}">{$role.alt_name}</option>
                        {/foreach}
                        </select>
                    </div>

                    <div class="form_overflow"></div>

                   <div class="field_text">
                        {lang("Hide", "menu")}
                    </div>
                    <div class="field_input">
                       <input type="radio" name="hidden_v" id="url_hiddenv" onclick="url_hidden = 1;" /> {lang("Yes", "menu")}
                       <input type="radio" name="hidden_v" id="url_nohiddenv" onclick="url_hidden = 0;"  checked="checked" /> {lang("No", "menu")}
                    </div>

                    <div class="form_overflow"></div>

	            <div class="field_text">
                        {lang("Open in the new window", "menu")}
                    </div>
                    <div class="field_input">
			<input type="radio" name="urlnew_page" id="url_newpage"  onclick="url_newpage = 1;" /> {lang("Yes", "menu")}
		        <input type="radio" name="urlnew_page" id="url_nonewpage" onclick="url_newpage = 0;"  checked="checked" /> {lang("No", "menu")}
                     </div>

                    <div class="form_overflow"></div>

                    <div class="field_text"></div>
                    <div class="field_input">
                        <input type="button" value="{lang("Create", "menu")}" id="url_btn" class="button" onclick="insert_url(); return false;" />
                        <input type="button" value="{lang("Cancel", "menu")}" class="button" onclick="MochaUI.closeWindow( $('createnewlink') ); return false;" />
                    </div>

                    <div class="form_overflow"></div>                 
                </td>
            </tr>
        </table>

</div>

{literal}
	<script type="text/javascript">
	//<![CDATA[
    var url_hidden = 0;
    var url_newpage = 0;

    function insert_url()
    {
        url_title = $('url_title').value;
        url_menu_id = $('owner_id').value;
        url_hidden = url_hidden;
        url_parent_id = $('url_parent_id').value;
        url_position_after = $('url_position_after').value;
        url_page = $('url_to_page').value;
        item_image = $('url_image').value;

        if (url_title == '')
        {
            showMessage('Ошибка','Введите заголовк.');
            return false;
        }

        if (url_page == '')
        {
            showMessage('Ошибка','Введите URL.');
            return false;
        }

        var url_roles = new Array();
        $('url_roles').getSelected().each(function(el) {  
             url_roles.include( el.value );
        });  

        var req = new Request.HTML({
               method: 'post',
               url: base_url + 'admin/components/cp/menu/insert_menu_item/',
               onRequest: function() { },
               onComplete: function(response) { refresh_menu_list(url_menu_id);  }
            }).post({
                'menu_id': url_menu_id,
                'item_type': 'url',
                'title': url_title,
                'hidden': url_hidden,
		        'newpage': url_newpage,
                'item_image': item_image,
                'roles': url_roles,
                'parent_id': url_parent_id,
                'position_after': url_position_after,
                'url': url_page,
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
            $('url_btn').value = 'Сохранить'; 
            }
    		});
	//]]>
	</script>
{/literal}
