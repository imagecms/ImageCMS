<div style="border:0px;font-size:13px;">
        <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <tr>
                <td width="100%" valign="top">
                    {lang("Choose a category", 'menu')}
                </td>
                <td valign="top">
                <div style="width:350px;" id="item_params">
                        <h3>{lang("Options", 'menu')}:</h3>
                </div>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <div id="category_list">{$cats_list}</div>
                </td>

               <td valign="top">
                    <!-- Link params -->
                   <input type="hidden" id="owner_id" value="{$insert_id}" />


                    <div class="field_text">{lang("Type", 'menu')}</div>
                    <div class="field_input" id="cat_type">
                        {lang("Categories", 'menu')}
                    </div>
                    <div class="form_overflow"></div>

                    <div class="field_text">{lang("ID", 'menu')}</div>
                    <div class="field_input" id="cat_id">
                        0
                    </div>
                    <div class="form_overflow"></div>


                    <div class="field_text">{lang("Title", 'menu')}</div>
                    <div class="field_input">
                        <input type="text" class="textbox" value="" name="cat_title"  id="cat_title" />
                    </div>

                    <div class="form_overflow"></div>

                    <div class="field_text">{lang("Parent", 'menu')}</div>
                    <div class="field_input">
                       	<select name="cat_parent_id" id="cat_parent_id">
                        <option value="0">{lang("No", 'menu')}</option>
                        {foreach $menu_result as $item}
                        <option  value="{$item.id}">{for $i=0; $i < $item['padding']; $i++}-{/for} {$item.title}</option>
                        {/foreach}
                        </select>
                    </div>

                    <div class="form_overflow"></div>


                    <div class="field_text">{lang("Position after", 'menu')}</div>
                    <div class="field_input">
                       	<select name="cat_position_after" id="cat_position_after">
                        <option value="0">{lang("No", 'menu')}</option>
                        <option value="first">{lang("First", 'menu')}</option>
                        {foreach $menu_result as $item}
                        <option  value="{$item.id}">{for $i=0; $i < $item['padding']; $i++}-{/for} {$item.title}</option>
                        {/foreach}
                        </select>
                    </div>
                    <div class="form_overflow"></div>
                    <div class="field_text">{lang("Image", 'menu')}</div>
                    <div class="field_input">
                        <input type="text" class="textbox" value="" name="cat_image"  id="cat_image" />
                        <img width="16" height="16" align="absmiddle" src="{$THEME}images/images.png" title="{lang("Select an image", 'menu')}" style="cursor: pointer;" onclick="tinyBrowserPopUp('image', 'cat_image');" />

                    </div>

                    <div class="field_text">{lang("Access level", 'menu')}</div>
                    <div class="field_input">
                        <select id="cat_roles" name="cat_roles[]" multiple="multiple">
                        <option value="0">{lang("All", 'menu')}</option>
                        {foreach $roles as $role}
                          <option value ="{$role.id}">{$role.alt_name}</option>
                        {/foreach}
                        </select>
                    </div>

                    <div class="form_overflow"></div>

                   <div class="field_text">
                        {lang('Hide', 'menu')}
                    </div>
                    <div class="field_input">
                       <input type="radio" name="cathidden_v" id="cat_hidden" onclick="cat_hidden = 1;"  /> {lang("Yes", 'menu')}
                       <input type="radio" name="cathidden_v" id="cat_nohidden"  onclick="cat_hidden = 0;"  checked="checked" /> {lang("No", 'menu')}
                    </div>

                    <div class="form_overflow"></div>

		    	            <div class="field_text">
                        {lang("Open in the new window", 'menu')}
                    </div>
                    <div class="field_input">
                       <input type="radio" name="catnew_page" id="cat_newpage"  onclick="cat_newpage = 1;" /> {lang("Yes", 'menu')}
                       <input type="radio" name="catnew_page" id="cat_nonewpage" onclick="cat_newpage = 0;"  checked="checked" /> {lang("No", 'menu')}
                    </div>

                    <div class="form_overflow"></div>

                    <div class="field_text"></div>
                    <div class="field_input">
                        <input type="button" value="{lang('Create', 'menu')}" id="cat_btn" class="button" onclick="insert_category(); return false;" />
                        <input type="button" value="{lang('Cancel', 'menu')}" class="button" onclick="MochaUI.closeWindow( $('createnewlink') ); return false;" />
                    </div>

                    <div class="form_overflow"></div>
                </td>
            </tr>
        </table>

</div>

{literal}
	<script type="text/javascript">
	//<![CDATA[
    var cat_hidden = 0;
    var cat_newpage = 0;

    function set_category_data(id)
    {
        item = $('cat_' + id);

        items = $('category_list').getElements('a');
        items.each(function(el,i){
                el.removeClass('clicked');
        });

        item.set('class', 'clicked');

        $('cat_id').set('html', id);
        $('cat_title').value = item.title;

        return false;
    }

    function insert_category()
    {
        id = $('cat_id').get('text');

        if (id == 0)
        {
            showMessage(lang('Error', 'menu'), lang('Choose category.', 'menu'));
            return false;
        }


        title = $('cat_title').value;

        if (title == '')
        {
            showMessage(lang('Error', 'menu'), lang('Enter title.', 'menu'));
            return false;
        }

        menu_id = $('owner_id').value;
        hidden = cat_hidden;
        parent_id = $('cat_parent_id').value;
        position_after = $('cat_position_after').value;
        item_image = $('cat_image').value;

        var roles = new Array();
        $('cat_roles').getSelected().each(function(el) {
             roles.include( el.value );
        });

        var req = new Request.HTML({
               method: 'post',
               url: base_url + 'admin/components/cp/menu/insert_menu_item/',
               onRequest: function() { },
               onComplete: function(response) { refresh_menu_list(menu_id);  }
            }).post({
                'menu_id': menu_id,
                'item_type': 'category',
                'item_id': id,
                'title': title,
                'hidden': hidden,
		        'newpage': cat_newpage,
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
		window.addEvent('domready', function() {
            if(menu_action == 'update')
            {
                $('cat_btn').value = 'Сохранить';
            }
    		});
	//]]>
	</script>
{/literal}
