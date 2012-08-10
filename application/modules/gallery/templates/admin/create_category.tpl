<div class="top-navigation">
    <div style="float:left;">
        <ul>
        <li>
            <p><b>{lang('amt_create_cat')}</b></p> 
        </li>
        </ul>
    </div>
</div>

<form method="post" action="{site_url('admin/components/cp/gallery/create_category')}" id="create_category_form" style="width:100%;">
   		<div class="form_text"></div>
		<div class="form_input"></div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_name')}:</div>
		<div class="form_input"><input type="text" name="name" value="" class="textbox_long" /></div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_description')}:</div>
		<div class="form_input"><textarea name="description" id="g_c_desc" class="mceEditor">{htmlspecialchars($category.description)}</textarea></div>
		<div class="form_overflow"></div> 

		<div class="form_text">{lang('amt_template_file')}:</div>
                <div class="form_input"><input type="text" name="tpl_file" value="{$album.tpl_file}" class="textbox_long" />.tpl
                <div class="lite">{lang('amt_by_default')}: album.tpl</div></div>
                <div class="form_overflow"></div>

   		<div class="form_text">{lang('amt_position')}:</div>
		<div class="form_input"><input type="text" name="position" value="" class="textbox_long" /></div>
		<div class="form_overflow"></div> 

   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="{lang('amt_to_create')}" onclick="ajax_me('create_category_form');" /> 
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery'); return false;" style="padding:5px;">{lang('amt_cancel')}</a> 
        </div>
		<div class="form_overflow"></div> 
{form_csrf()}</form>

{literal}
<script type="text/javascript">
    load_editor();
</script>
{/literal}
