<form method="post" action="{site_url('admin/components/cp/gallery/update_album/' . $album.id )}" id="create_album_form" style="width:100%;">

   		<div class="form_text">{lang('amt_category')}:</div>
		<div class="form_input">
            <select name="category_id">
            {foreach $categories as $item}
                <option value="{$item.id}"  {if $item['id'] == $album['category_id'] }selected="selected"{/if} >{$item.name}</option>
            {/foreach}
            </select>
        </div>
		<div class="form_overflow"></div> 

        <div class="form_text">{lang('amt_name')}:</div>
		<div class="form_input"><input type="text" name="name" value="{htmlspecialchars($album.name)}" class="textbox_long" /></div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_description')}:</div>
		<div class="form_input"><textarea name="description" class="mceEditor">{htmlspecialchars($album.description)}</textarea></div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_position')}:</div>
		<div class="form_input"><input type="text" name="position" value="{$album.position}" class="textbox_long" /></div>
		<div class="form_overflow"></div> 

                <div class="form_text">{lang('amt_template_file')}:</div>
                <div class="form_input"><input type="text" name="tpl_file" value="{$album.tpl_file}" class="textbox_long" />.tpl
                <div class="lite">{lang('amt_by_default')} album.tpl</div></div>
                <div class="form_overflow"></div>

   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="{lang('amt_save')}" onclick="ajax_me('create_album_form');" /> 
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/category/{$album.category_id}'); return false;" style="padding:5px;">{lang('amt_cancel')}</a> 
        </div>
		<div class="form_overflow"></div> 


{form_csrf()}</form>

<form method="post" action="" style="width:100%;margin-top:50px;">

   		<div class="form_text"></div>
		<div class="form_input"><b>{lang('amt_album_delete')}</b></div>
		<div class="form_overflow"></div> 

   		<div class="form_text"></div>
		<div class="form_input">
            <label><input type="checkbox" value="1" name="delete_folder" id="delete_folder" /> {lang('amt_delete_all_images')}</label>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text"></div>
		<div class="form_input">
            <input type="button" name="button"  class="button_130" value="{lang('amt_delete')}" onclick="confirm_delete_album({$album.id}, '{str_replace(array("'",'"'), '', $album.name)}');" /> 
        </div>
		<div class="form_overflow"></div> 

{form_csrf()}</form>

{literal}
        <script type="text/javascript">
            function confirm_delete_album(id, name)
            {
                alertBox.confirm('<h1> </h1><p>Удалить альбом ' + name + '? </p>', {onComplete:
                function(returnvalue){
                if(returnvalue)
                {
                        del_fol = $('delete_folder').checked;

                        var req = new Request.HTML({
                           method: 'post',
                           url: base_url + 'admin/components/cp/gallery/delete_album/' + id,
                           onRequest: function() { },
                           onComplete: function(response) {
                                ajax_div('page', base_url + 'admin/components/cp/gallery');   
                            }
                        }).post({'album_id': id, 'delete_folder': del_fol });
                }
                }
                });
            }

            load_editor();
        </script>
{/literal}
