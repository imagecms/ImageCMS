<div class="top-navigation">
    <ul>
        <li><p>Обновление системы.</p></li>
    </ul>
</div>

<div style="clear:both;"></div>

<div id="notice_error" style="min-width:600px;width:600px;margin-top:15px;">
    <b>Внимание:</b> перед началом обновления сделайте резервную копию файлов и базы данных.
</div>

<form method="post" action="{$BASE_URL}admin/sys_upgrade/make_upgrade" id="make_upgrade_form" style="width:100%;" >
		<div class="form_text"></div>
		<div class="form_input">
            <h3>Параметры подключения к FTP </h3>
        </div>
		<div class="form_overflow"></div>

		<div class="form_text">Хост</div>
		<div class="form_input"><input type="text" name="host" value="localhost" class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">Порт</div>
		<div class="form_input"><input type="text" name="port" value="21"  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">Логин</div>
		<div class="form_input"><input type="text" name="login" value=""  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">Пароль</div>
		<div class="form_input"><input type="text" name="password" value=""  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">Путь к корневой директории</div>
		<div class="form_input">
            <input type="text" name="root_folder" value=""  class="textbox_long" />
            <br />
            <span class="lite">Например: /domains/mysite/public_html/</span>
        </div>
		<div class="form_overflow"></div>

		<div class="form_text"></div>
		<div class="form_input">
               <input type="submit" value="Обновить" class="button_silver" onclick="ajax_me('make_upgrade_form');" /> 
        </div>
		<div class="form_overflow"></div>
</form>
