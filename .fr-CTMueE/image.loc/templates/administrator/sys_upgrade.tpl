<div class="top-navigation">
    <ul>
        <li><p>{lang("System update","admin")}.</p></li>
    </ul>
</div>

<div style="clear:both;"></div>

<div id="notice_error" style="min-width:600px;width:600px;margin-top:15px;">
    <b>{lang("Attention","admin")}:</b> {lang("Make a database backup copy before updating ","admin")}
</div>

<form method="post" action="{$BASE_URL}admin/sys_upgrade/make_upgrade" id="make_upgrade_form" style="width:100%;" >
		<div class="form_text"></div>
		<div class="form_input">
            <h3>{lang("FTP connection settings","admin")}</h3>
        </div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang("Hostname","admin")}</div>
		<div class="form_input"><input type="text" name="host" value="localhost" class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang("Port","admin")}</div>
		<div class="form_input"><input type="text" name="port" value="21"  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang("login","admin")}</div>
		<div class="form_input"><input type="text" name="login" value=""  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang("Password","admin")}</div>
		<div class="form_input"><input type="text" name="password" value=""  class="textbox_long" /></div>
		<div class="form_overflow"></div>

		<div class="form_text">{lang("Path to the root directory","admin")}</div>
		<div class="form_input">
            <input type="text" name="root_folder" value=""  class="textbox_long" />
            <br />
            <span class="help-block">{lang("For example:", 'admin')} /domains/mysite/public_html/</span>
        </div>
		<div class="form_overflow"></div>

		<div class="form_text"></div>
		<div class="form_input">
               <input type="submit" value="{lang("Update","admin")}" class="button_silver" onclick="ajax_me('make_upgrade_form');" /> 
        </div>
		<div class="form_overflow"></div>
</form>
