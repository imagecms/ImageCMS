<div class="top-navigation">
    <ul>
        <li><p>{lang('a_sys_update')}.</p></li>
    </ul>
</div>

<div style="clear:both;"></div>

<div id="notice_error" style="min-width:600px;width:600px;margin-top:15px;">
    <b>{lang('a_atten')}:</b> {lang('a_make_backup')}
</div>

<form method="post" action="{$BASE_URL}admin/sys_upgrade/make_upgrade" id="make_upgrade_form" style="width:100%;" >
		<div class="form_text"></div>
		<div class="form_input">
            <h3>{lang('a_ftp_sett')}</h3>
        </div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang('a_host')}</div>
		<div class="form_input"><input type="text" name="host" value="localhost" class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang('a_port')}</div>
		<div class="form_input"><input type="text" name="port" value="21"  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang('a_login')}</div>
		<div class="form_input"><input type="text" name="login" value=""  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang('a_pass')}</div>
		<div class="form_input"><input type="text" name="password" value=""  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang('a_root_path')}</div>
		<div class="form_input">
            <input type="text" name="root_folder" value=""  class="textbox_long" />
            <br />
            <span class="help-block">{lang('a_example_path')}</span>
        </div>
		<div class="form_overflow"></div>

		<div class="form_text"></div>
		<div class="form_input">
               <input type="submit" value="{lang('a_refresh')}" class="button_silver" onclick="ajax_me('make_upgrade_form');" /> 
        </div>
		<div class="form_overflow"></div>
</form>
