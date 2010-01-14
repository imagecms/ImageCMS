<div class="top-navigation">
    <ul>
        <li><p>Резервное копирование базы данных</p></li>
    </ul>
</div>

<form action="{$BASE_URL}admin/backup/create" method="post" id="backup_form" style="width:100%;">

<div class="form_text"></div>
<div class="form_input"><b>Параметры</b></div>
<div class="form_overflow"></div>

<div class="form_text"></div>
<div class="form_input">
    <label><input type="radio" name="save_type" value="local" checked="checked"/> Скопировать на локальный компьютер</label>
    <br/><br/>
    <label><input type="radio" name="save_type" value="server" /> Сохранить на сервере</label>
    <br/>
    <div class="lite" style="clear:both;">Файл будет сохранен в директории ./application/backups</div>

    <br/>
    <label><input type="radio" name="save_type" value="email" /> Выслать на почту</label>
    
    <br/>
    <input type="text" name="email" class="textbox_long" value="{$user.email}" />

    <br/><br/>

    <div style="clear:both;"> </div>

    <b>Формат файла:</b>
    <br /> 
    <label><input type="radio" name="file_type" value="gzip" checked="checked"/> gzip</label>
    <label><input type="radio" name="file_type" value="zip" /> zip</label>
    <label><input type="radio" name="file_type" value="txt" /> txt</label>

</div>
<div class="form_overflow"></div>

<div class="form_text"></div>
<div class="form_input">
    <input type="submit" name="button" class="button" value="Создать" onclick="ajax_me('backup_form');" />
</div>

</form>
