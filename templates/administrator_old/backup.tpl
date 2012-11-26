<div class="top-navigation">
    <ul>
        <li><p>{lang('a_backup_copy')}</p></li>
    </ul>
</div>

<form action="{$BASE_URL}admin/backup/create" method="post" id="backup_form" style="width:100%;">

<div class="form_text"></div>
<div class="form_input"><b>{lang('a_param')}</b></div>
<div class="form_overflow"></div>

<div class="form_text"></div>
<div class="form_input">
    <label><input type="radio" name="save_type" value="local" checked="checked"/> {lang('a_local_copy')}</label>
    <br/><br/>
    <label><input type="radio" name="save_type" value="server" /> {lang('a_save_on_server')}</label>
    <br/>
    <div class="lite" style="clear:both;">{lang('a_save_path')} ./application/backups</div>

    <br/>
    <label><input type="radio" name="save_type" value="email" /> {lang('a_send_mail')}</label>
    
    <br/>
    <input type="text" name="email" class="textbox_long" value="{$user.email}" />

    <br/><br/>

    <div style="clear:both;"> </div>

    <b>{lang('a_file_format')}:</b>
    <br /> 
    <label><input type="radio" name="file_type" value="gzip" checked="checked"/> gzip</label>
    <label><input type="radio" name="file_type" value="zip" /> zip</label>
    <label><input type="radio" name="file_type" value="txt" /> txt</label>

</div>
<div class="form_overflow"></div>

<div class="form_text"></div>
<div class="form_input">
    <input type="submit" name="button" class="button" value="{lang('a_create')}" onclick="ajax_me('backup_form');" />
</div>

</form>
