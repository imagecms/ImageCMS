<form action="{$BASE_URL}admin/settings/save" method="post" id="save_form" style="width:100%;">

<div id="settings_tabs">

<h4 title="Настройки">{lang('a_sett')}</h4>
<div>
	<div class="form_text">{lang('a_site_title')}:</div>
	<div class="form_input"><input type="text" name="title" value="{$site_title}" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_short_title')}:</div>
	<div class="form_input"><input type="text" name="short_title" value="{$site_short_title}" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_desc')}:</div>
	<div class="form_input"><input type="text" name="description" value="{$site_description}" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_key_words')}:</div>
	<div class="form_input"><input type="text" name="keywords" value="{$site_keywords}" class="textbox_long" /></div>
	<div class="form_overflow"></div>
    
	<div class="form_text">{lang('a_google_id')}:</div>
	<div class="form_input"><input type="text" name="google_analytics_id" value="{$google_analytics_id}" class="textbox_long" />
            <div class="lite">Код должен быть в формате "ua-54545845"</div>
        </div>
	<div class="form_overflow"></div>
        
        <div class="form_text">G.Webmaster:</div>
	<div class="form_input"><input type="text" name="google_webmaster" value="{$google_webmaster}" class="textbox_long" /></div>
	<div class="form_overflow"></div>
        
        <div class="form_text">Я.Вэбмастер:</div>
	<div class="form_input"><input type="text" name="yandex_webmaster" value="{$yandex_webmaster}" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_editor_theme')}:</div>
	<div class="form_input">
	<select name="editor_theme">
        {foreach $editor_themes as $theme => $v}
            <option value="{$theme}" {if $theme_selected == $theme } selected="selected" {/if} >{$v}</option>
        {/foreach}
	</select> <div class="lite">{lang('a_after_reboot')}</div>
        
	</div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_tpl')}:</div>

	<div class="form_input">
	<select name="template">
    {foreach $templates as $k => $v}
        <option value="{$k}" {if $template_selected == $k} selected="selected" {/if} >{$k}</option>
    {/foreach}
	</select>
	</div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_site_shutdown')}:</div>
	<div class="form_input">
	<select name="site_offline">
     {foreach $work_values as $k => $v}
        <option value="{$k}" {if $site_offline == $k} selected="selected" {/if} >{$v}</option>
     {/foreach}
	</select>
	</div>
	<div class="form_overflow"></div>
</div>

<h4 title="Настройки">{lang('a_main_page')}</h4>
<div>
	<div class="form_text">{lang('a_category')}: <input type="radio" name="main_type" value="category" {if $main_type == "category"} checked="checked" {/if} /> </div>
	<div class="form_input">
		<select name="main_page_cat">
			{ $this->view("cats_select.tpl", $this->template_vars); }
		</select>
	</div>
	<div class="form_overflow"></div>

	<div class="form_text">{lang('a_page')}: <input type="radio" name="main_type" value="page" {if $main_type == "page"} checked="checked" {/if} /></div>
	<div class="form_input">
    	<input type="text" name="main_page_pid" class="textbox_long" style="width:100px" value="{$main_page_id}" /> - {lang('a_page_id')}
	</div>
	<div class="form_overflow"></div>

    <div class="form_text">{lang('a_module')}: <input type="radio" name="main_type" value="module" {if $main_type == "module"} checked="checked" {/if} /></div>
	<div class="form_input">
        <select name="main_page_module">
	        {foreach $modules as $m}
	            {$mData = modules::run('admin/components/get_module_info',$m['name'])}
	            {//if $mData['main_page'] === true}
	                <option {if $m['name'] == $main_page_module}selected="selected"{/if} value="{$m['name']}">{echo $mData['menu_name']}</option>
	            {///if}
	        {/foreach}
		</select>
	</div>
	<div class="form_overflow"></div>
</div>



<h4 title="SEO">{lang('a_meta_tags')}</h4>
<div>

		<div class="form_text"></div>
		<div class="form_input"><b>{lang('a_print_in_meta_tags')}:</b></div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang('a_site_title')}</div>
		<div class="form_input">
		<select name="add_site_name">
		<option value="1" {if $add_site_name == "1"}selected="selected"{/if}>{lang('a_yes')}</option>
		<option value="0" {if $add_site_name == "0"}selected="selected"{/if} >{lang('a_no')}</option>
		</select>
		</div>

        <div class="form_overflow"></div>

		<div class="form_text">{lang('a_cat_name')}</div>
		<div class="form_input">
		<select name="add_site_name_to_cat">
		<option value="1" {if $add_site_name_to_cat == "1"}selected="selected"{/if}>{lang('a_yes')}</option>
		<option value="0" {if $add_site_name_to_cat == "0"}selected="selected"{/if}>{lang('a_no')}</option>
		</select>
		</div>

<div class="form_overflow"></div>

		<div class="form_text">{lang('a_separator')}</div>
		<div class="form_input">
		<input type="text" value="{$delimiter}" name="delimiter" class="textbox_long" style="width:80px;" />
		</div>

        <div class="form_overflow"></div>

		<div class="form_text"></div>
		<div class="form_input"><b>{lang('a_page_meta_tags')}:</b></div>
		<div class="form_overflow"></div>

		<div class="form_text"><b>{lang('a_meta_keywords')}</b><br/>{lang('a_if_not_pointed')}:</div>
		<div class="form_input">
		<select name="create_keywords">
			<option value="auto" {if $create_keywords == "auto"}selected="selected"{/if}>{lang('a_auto_form')}</option>
			<option value="empty" {if $create_keywords == "empty"}selected="selected"{/if}>{lang('a_leave_empty')}</option>
		</select>
		</div>

        <div class="form_overflow"></div>

		<div class="form_text"><b>{lang('a_meta_description')}</b><br/>{lang('a_if_not_pointed1')}:</div>
		<div class="form_input">
		<select name="create_description">
			<option value="auto" {if $create_description == "auto"}selected="selected"{/if}>{lang('a_auto_form')}</option>
			<option value="empty" {if $create_description == "empty"}selected="selected"{/if}>{lang('a_leave_empty')}</option>
		</select>
		</div>



<div class="form_overflow"></div>


</div>

</div>

	<div class="form_text"></div>
	<div class="form_input">
	<input type="submit" name="button" class="button" value="{lang('a_save')}" onclick="ajax_me('save_form');" />
	</div>

{form_csrf()}</form>

{literal}
<script type="text/javascript">
		var settings_tabs = new SimpleTabs('settings_tabs', {
		selector: 'h4'
		});
</script>
{/literal}
