<div id="mod-tabs-block">

	<h4>{lang('a_desc')}</h4>
    <div>
        {$module.description}

        <p style="padding:5px;">
            <b>{lang('a_author')}:</b> {$module.author}
            <br />
            <b>{lang('a_version')}:</b> {$module.version}
        </p>

        <div align="center" style="padding:5px;">
        {if $install_type == 'ftp'}
            <input type="button" value="{lang('a_install')}" class="button_silver" onclick="show_connection_block();" />
        {else:}
            <input type="button" value="{lang('a_install')}" class="button_silver" onclick="ajax_request('{$BASE_URL}admin/mod_search/connect_ftp/{$module.id}');" />
        {/if}
            
            <a href="{$module.file}" target="_blank">{lang('a_download')}</a>
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
            <h3>{lang('a_ftp_sett')} </h3>
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
            <span class="help-block">{lang('a_for_example')}: /domains/mysite/public_html/</span>
        </div>
		<div class="form_overflow"></div>

		<div class="form_text"></div>
		<div class="form_input">
               <input type="submit" value="{lang('a_forward')}" class="button_silver" onclick="ajax_me('connect_ftp_form');" /> 
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
