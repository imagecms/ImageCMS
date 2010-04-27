<div style="padding:5px;color:#73BACD;background-color:#73BACD;color:#fff">
    <h2>Редактировать Меню:</h2>
</div>
    <form action="{$SELF_URL}/update_menu/{$id}" method="post" id="form_edit_root_menu">
        <div class="form_text">Имя:</div>
        <div class="form_input"><input type="text" class="textbox" name="menu_name" value="{$name}" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">Название:</div>
        <div class="form_input"><input type="text" class="textbox" name="main_title" value="{$main_title}" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">Описание:</div>
        <div class="form_input"><input type="text" class="textbox" name="menu_desc" value="{$description}" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">Папка шаблона:</div>
        <div class="form_input"><input type="text" class="textbox" name="menu_tpl" value="{$tpl}" /></div>
        <div class="form_overflow"></div>

        <div class="form_text">Раскрывать меню, уровень:</div>
        <div class="form_input">
        	<input type="text" class="textbox" name="menu_expand_level" value="{$expand_level}" />        	
        </div>
        <div class="form_overflow"></div>


        <div class="form_text"></div>
        <div class="form_input">
            <input type="submit" value="Сохранить" class="button" onclick="ajax_me(this.form.id);" />
            <input type="submit" value="Отмена" class="button" onclick="MochaUI.closeWindow($('edit_menu_w')); return false;" />
        </div>
        <div class="form_overflow"></div>
    {form_csrf()}</form>