<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Install standart templates','cmsemail')}</h3>
    </div>
    <div class="modal-body">
        <h5>{lang('Do you really want to install standart templates?','cmsemail')}</h5>
        <h5 style="color:red">
            <b>{lang('All your changes in them will be removed!!','cmsemail')}</b>
        </h5>
        <!--<p>{lang(a_products_del_body_warning)}</p>-->
    </div>
    <div class="modal-footer">
        <a href="{site_url('admin/components/cp/cmsemail/import_templates')}" onclick="$('.modal').modal('hide');" class="btn btn-primary" >{lang('Install','cmsemail')}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','cmsemail')}</a>
    </div>
</div>
<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Settings', 'cmsemail')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/init_window/cmsemail"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'cmsemail')}</span>
                    </a>
                    <a href="#" onclick="$('.modal:not(.addNotificationMessage)').modal('show')" class="btn m-r_5" style="">{lang('Install', 'cmsemail')}</a>
                    <button type="button"
                            class="btn btn-small btn-primary action_on formSubmit"
                            data-form="#wishlist_settings_form"
                            data-action="tomain">
                        <i class="icon-ok"></i>{lang('Save', 'cmsemail')}
                    </button>
                    {echo create_language_select($languages, $locale, "/admin/components/cp/cmsemail/settings", FALSE)}
                </div>
            </div>
        </div>
        <form method="post" action="{site_url('admin/components/cp/cmsemail/update_settings')}/{echo $locale}" class="form-horizontal m-t_15" id="wishlist_settings_form">
            <table class="table  table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang('Settings', 'cmsemail')}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="control-group">
                                    <label class="control-label" for="settings[from]">{lang('From', 'cmsemail')}:</label>
                                    <div class="controls">
                                        <input type = "text" name = "settings[from]" required class="textbox_short required" value="{$settings['from']}" id="from"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="settings[from_email]">{lang('From email', 'cmsemail')}:</label>
                                    <div class="controls">
                                        <input type = "text" name = "settings[from_email]" required class="textbox_short required" value="{$settings['from_email']}" id="from_email"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="settings[admin_email]">{lang('Admin email', 'cmsemail')}:</label>
                                    <div class="controls">
                                        <input type = "text" name = "settings[admin_email]" required class="textbox_short required" value="{$settings['admin_email']}" id="admin_email"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="settings[theme]">{lang('Theme', 'cmsemail')}:</label>
                                    <div class="controls">
                                        <input type = "text" name = "settings[theme]" required class="textbox_short required" value="{$settings['theme']}" id="theme"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="settings[wraper_activ]">{lang('Use wraper', 'cmsemail')}:</label>
                                    <div class="controls">
                                        <span class="frame_label no_connection active">
                                            <span class="niceCheck" style="background-position: -46px -17px;">
                                                <input type = "checkbox" name = "settings[wraper_activ]" class="textbox_short wraper_activSettings" {if $settings['wraper_activ']}checked{/if}   id="wraper_activ"/>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group wraperControlGroup" {if !$settings['wraper_activ']} style="display: none" {/if}>
                                    <label class="control-label" for="settings[wraper]">{lang('Wraper', 'cmsemail')}:</label>
                                    <div class="controls">
                                        <textarea name='settings[wraper]' class="elRTE required" required  id="wraper">{$settings['wraper']}</textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="settings[mailpath]">{lang('Server path to sendmail', 'cmsemail')}:</label>
                                    <div class="controls">
                                        <input type = "text" name = "settings[mailpath]" class="textbox_short" value="{$settings['mailpath']}" id="mailpath"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="settings[protocol]">{lang('Protocol', 'cmsemail')}:</label>
                                    <div class="controls">
                                        <select name = "settings[protocol]" class="protocolSettings" id="protocol">
                                            <option {if $settings['protocol'] == "SMTP"} selected {/if} value="SMTP" >SMTP</option>
                                            <option {if $settings['protocol'] == "sendmail"} selected {/if} value="sendmail">sendmail</option>
                                            <option {if $settings['protocol'] == "mail"} selected {/if} value="mail">mail</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group portControlGroup span4" {if $settings['protocol'] != "SMTP"} style="display: none"  {/if} >
                                    <label class="control-label" for="settings[smtp_host]">{lang('Host', 'cmsemail')}:</label>
                                    <div class="controls ">
                                        <input type = "text" name = "settings[smtp_host]" class=""  value="{$settings['smtp_host']}"  id="smtp_host"/>
                                    </div>
                                    <br>
                                    <label class="control-label" for="settings[smtp_user]">{lang('User', 'cmsemail')}:</label>
                                    <div class="controls ">
                                        <input type = "text" name = "settings[smtp_user]" class=""  value="{$settings['smtp_user']}"  id="smtp_user"/>
                                    </div>
                                    <br>
                                    <label class="control-label" for="settings[smtp_pass]">{lang('Password', 'cmsemail')}:</label>
                                    <div class="controls ">
                                        <input type = "password" name = "settings[smtp_pass]" class=""  value="{$settings['smtp_pass']}"  id="smtp_pass"/>
                                    </div>
                                    <br>
                                    <label class="control-label" for="settings[port]">{lang('Port', 'cmsemail')}:</label>
                                    <div class="controls ">
                                        <input type = "text" name = "settings[port]" class="portSettings"  value="{$settings['port']}"  id="smtp_port"/>
                                    </div>
                                    <br>
                                    <label class="control-label" for="settings[encryption]">{lang('Encryption', 'cmsemail')}:</label>
                                    <div class="controls ">
                                        <input type = "text" name = "settings[encryption]" class="portSettings"  value="{$settings['encryption']}"  id="encryption"/>
                                    </div>
                                </div>

                                <br>

                                <div class="control-group" >
                                    <div class="controls ">
                                        <button type="button" class="btn" onclick="mailTest()" >
                                            <i class="icon-envelope"></i>
                                            {lang('Check email sending', 'cmsemail')}
                                        </button>
                                    </div>
                                    <br>
                                    <div class="controls ">
                                        <button type="button" class="btn delete_image mailTestResultsHide">
                                            <i class="icon-remove"></i>
                                        </button>
                                        <div class="mailTestResults">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            {form_csrf()}
        </form>
    </section>
</div>