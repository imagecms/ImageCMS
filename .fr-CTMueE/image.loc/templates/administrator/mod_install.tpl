<div id="mod-tabs-block">
	<h4>{lang("Description", "admin")}</h4>
    <div>
        {$module.description}

        <p style="padding:5px;">
            <b>{lang("Author", "admin")}:</b> {$module.author}
            <br />
            <b>{lang("Version", "admin")}:</b> {$module.version}
        </p>

        <div align="center" style="padding:5px;">
        {if $install_type == 'ftp'}
            <input type="button" value="{lang("Install","admin")}" class="button_silver" onclick="show_connection_block();" />
        {else:}
            <input type="button" value="{lang("Install","admin")}" class="button_silver" onclick="ajax_request('{$BASE_URL}admin/mod_search/connect_ftp/{$module.id}');" />
        {/if}
            
            <a href="{$module.file}" target="_blank">{lang("Download","admin")}</a>
        </div>

    </div>

    {if $module.faq != ''}
        <h4>FAQ</h4>
        <div>
            {$module.faq}
        </div>
    {/if}

</div>

<div id="connetction_form" style="display:none;">
{if $install_type == 'ftp'}
<form method="post" action="{$BASE_URL}admin/mod_search/connect_ftp/{$module.id}" id="connect_ftp_form" style="width:100%;" >
		<div class="form_text"></div>
		<div class="form_input">
            <h3>{lang("FTP connection settings","admin")} </h3>
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
            <span class="help-block">{lang("For example","admin")}: /domains/mysite/public_html/</span>
        </div>
		<div class="form_overflow"></div>

		<div class="form_text"></div>
		<div class="form_input">
               <input type="submit" value="{lang("Next","admin")}" class="button_silver" onclick="ajax_me('connect_ftp_form');" /> 
        </div>
		<div class="form_overflow"></div>
</form>
{/if}

</div>

{literal}
	<script type="text/javascript">
    
            function show_connection_block()
            {
                $('mod-tabs-block').setStyle('display', 'none');
                $('connetction_form').setStyle('display', 'block');
            }

            var mod_info_tabs = new SimpleTabs('mod-tabs-block', {
			selector: 'h4'
			});        

	</script>
{/literal}
