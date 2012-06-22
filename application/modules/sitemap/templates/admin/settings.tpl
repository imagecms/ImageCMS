<div class="top-navigation">
        <div style="float:left;">
            <ul>
            <li>
                <p>Настройки карты сайта</p>
            </li>
            </ul>
        </div>
</div>
<div style="clear:both;"></div>

<form method="post" action="{site_url('admin/components/cp/sitemap/update_settings')}" id="sitemap_settings_form" style="width:100%;">
      	<div class="form_text"></div>
		<div class="form_input">
            <b>Приоритеты (priority)</b>
        </div>
        <div class="form_overflow"></div> 
        
      	<div class="form_text">Главная страница</div>
		<div class="form_input"><input type="text" class="textbox_long" name="main_page_priority" value="{$settings.main_page_priority}" /></div>
        <div class="form_overflow"></div>

      	<div class="form_text">Категории</div>
		<div class="form_input"><input type="text" class="textbox_long" name="cats_priority" value="{$settings.cats_priority}" /></div>
        <div class="form_overflow"></div>

      	<div class="form_text">Обычные страницы</div>
		<div class="form_input"><input type="text" class="textbox_long" name="pages_priority" value="{$settings.pages_priority}" /></div>
        <div class="form_overflow"></div>

      	<div class="form_text"></div>
		<div class="form_input">
            <b>Частота изменения страниц (changefreq)</b>
        </div>
        <div class="form_overflow"></div> 

      	<div class="form_text">Главная страница</div>
		<div class="form_input">
            {form_dropdown('main_page_changefreq', $changefreq_options, $settings.main_page_changefreq)}
        </div>
        <div class="form_overflow"></div>
        
      	<div class="form_text">Другие страницы</div>
		<div class="form_input">
            {form_dropdown('pages_changefreq', $changefreq_options, $settings.pages_changefreq)}
        </div>
        <div class="form_overflow"></div>   
        
   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="Сохранить" onclick="ajax_me('sitemap_settings_form');" />
        </div>
		<div class="form_overflow"></div> 
</form>
