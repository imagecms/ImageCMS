<div class="top-navigation">
    <ul>
        <li><p>Администрирование модуля Page ID</p></li>
    </ul>
</div>

<form action="{$BASE_URL}admin/components/cp/page_id/save_settings" method="post" id="page_id_form" style="width:100%;">

	<div class="form_text">Сообщение</div>
	<div class="form_input">
        <input type="text" name="message" value="" class="textbox_long" />
        <div class="lite">Это сообщение будет выводиться пользователю, если он не указал id страницы.</div>
    </div>
	<div class="form_overflow"></div>

	<div class="form_text"></div>
	<div class="form_input">
    	<input type="submit" name="button" class="button" value="Сохранить" onclick="ajax_me('page_id_form');" />
	</div>
</form>
