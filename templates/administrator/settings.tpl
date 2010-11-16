<form action="{$BASE_URL}admin/settings/save" method="post" id="save_form" style="width:100%;">

<div id="settings_tabs">

<h4 title="Настройки">Настройки</h4>
<div>
	<div class="form_text">Название сайта:</div>
	<div class="form_input"><input type="text" name="title" value="{$site_title}" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">Краткое название сайта:</div>
	<div class="form_input"><input type="text" name="short_title" value="{$site_short_title}" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">Описание:</div>
	<div class="form_input"><input type="text" name="description" value="{$site_description}" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">Ключевые слова:</div>
	<div class="form_input"><input type="text" name="keywords" value="{$site_keywords}" class="textbox_long" /></div>
	<div class="form_overflow"></div>

	<div class="form_text">Тема Редактора:</div>
	<div class="form_input">
	<select name="editor_theme">
        {foreach $editor_themes as $theme => $v}
            <option value="{$theme}" {if $theme_selected == $theme } selected="selected" {/if} >{$v}</option>
        {/foreach}
	</select> <div class="lite">Изменения вступят в силу после перезагрузки панели управления</div>
	</div>
	<div class="form_overflow"></div>

	<div class="form_text">Шаблон:</div>

	<div class="form_input">
	<select name="template">
    {foreach $templates as $k => $v}
        <option value="{$k}" {if $template_selected == $k} selected="selected" {/if} >{$k}</option>
    {/foreach}
	</select>
	</div>
	<div class="form_overflow"></div>

	<div class="form_text">Отключение сайта:</div>
	<div class="form_input">
	<select name="site_offline">
     {foreach $work_values as $k => $v}
        <option value="{$k}" {if $site_offline == $k} selected="selected" {/if} >{$v}</option>
     {/foreach}
	</select>
	</div>
	<div class="form_overflow"></div>
</div>

<h4 title="Настройки">Главная страница</h4>
<div>
	<div class="form_text">Категория: <input type="radio" name="main_type" value="category" {if $main_type == "category"} checked="checked" {/if} /> </div>
	<div class="form_input">
		<select name="main_page_cat">
			{ $this->view("cats_select.tpl", $this->template_vars); }
		</select>
	</div>
	<div class="form_overflow"></div>

	<div class="form_text">Страница: <input type="radio" name="main_type" value="page" {if $main_type == "page"} checked="checked" {/if} /></div>
	<div class="form_input">
    	<input type="text" name="main_page_pid" class="textbox_long" style="width:100px" value="{$main_page_id}" /> - ID страницы
	</div>
	<div class="form_overflow"></div>

    <div class="form_text">Модуль: <input type="radio" name="main_type" value="module" {if $main_type == "module"} checked="checked" {/if} /></div>
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



<h4 title="SEO">Мета Теги</h4>
<div>

		<div class="form_text"></div>
		<div class="form_input"><b>Выводить в Meta Title:</b></div>
		<div class="form_overflow"></div>

		<div class="form_text">Название сайта</div>
		<div class="form_input">
		<select name="add_site_name">
		<option value="1" {if $add_site_name == "1"}selected="selected"{/if}>Да</option>
		<option value="0" {if $add_site_name == "0"}selected="selected"{/if} >Нет</option>
		</select>
		</div>

        <div class="form_overflow"></div>

		<div class="form_text">Название категории</div>
		<div class="form_input">
		<select name="add_site_name_to_cat">
		<option value="1" {if $add_site_name_to_cat == "1"}selected="selected"{/if}>Да</option>
		<option value="0" {if $add_site_name_to_cat == "0"}selected="selected"{/if}>Нет</option>
		</select>
		</div>

<div class="form_overflow"></div>

		<div class="form_text">Разделитель</div>
		<div class="form_input">
		<input type="text" value="{$delimiter}" name="delimiter" class="textbox_long" style="width:80px;" />
		</div>

        <div class="form_overflow"></div>

		<div class="form_text"></div>
		<div class="form_input"><b>Мета-теги страниц:</b></div>
		<div class="form_overflow"></div>

		<div class="form_text"><b>Meta Keywords</b><br/>Если не указаны:</div>
		<div class="form_input">
		<select name="create_keywords">
			<option value="auto" {if $create_keywords == "auto"}selected="selected"{/if}>Формировать атоматически</option>
			<option value="empty" {if $create_keywords == "empty"}selected="selected"{/if}>Оставить пустым</option>
		</select>
		</div>

        <div class="form_overflow"></div>

		<div class="form_text"><b>Meta Description</b><br/>Если не указано:</div>
		<div class="form_input">
		<select name="create_description">
			<option value="auto" {if $create_description == "auto"}selected="selected"{/if}>Формировать атоматически</option>
			<option value="empty" {if $create_description == "empty"}selected="selected"{/if}>Оставить пустым</option>
		</select>
		</div>



<div class="form_overflow"></div>


</div>

</div>

	<div class="form_text"></div>
	<div class="form_input">
	<input type="submit" name="button" class="button" value="Сохранить" onclick="ajax_me('save_form');" />
	</div>

{form_csrf()}</form>

{literal}
<script type="text/javascript">
		var settings_tabs = new SimpleTabs('settings_tabs', {
		selector: 'h4'
		});
</script>
{/literal}
