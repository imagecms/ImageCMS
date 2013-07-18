<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Настройки</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('a_back')}</span>
                    </a>
                    <button type="button"
                            class="btn btn-small btn-primary action_on formSubmit"
                            data-form="#wishlist_settings_form"
                            data-action="tomain">
                        <i class="icon-ok"></i>{lang('a_save')}
                    </button>
                </div>
            </div>
        </div>
        <form method="post" action="{site_url('admin/components/cp/email/update_settings')}" class="form-horizontal" id="wishlist_settings_form">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th colspan="6">
                            Настройки
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">

                                <div class="control-group">
                                    <label class="control-label" for="settings[from]">От кого</label>
                                    <div class="controls">
                                        <input type = "text" name = "settings[from]" class="textbox_short" value="{$settings['from']}" id="from"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="settings[from_email]">Email отправителя</label>
                                    <div class="controls">
                                        <input type = "email" name = "settings[from_email]" class="textbox_short" value="{$settings['from_email']}" id="from_email"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="settings[admin_email]">Email администратора</label>
                                    <div class="controls">
                                        <input type = "email" name = "settings[admin_email]" class="textbox_short" value="{$settings['admin_email']}" id="admin_email"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="settings[theme]">Тема письма</label>
                                    <div class="controls">
                                        <input type = "text" name = "settings[theme]" class="textbox_short" value="{$settings['theme']}" id="theme"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="settings[wraper_activ]">Использовать обгортку</label>
                                    <div class="controls">
                                        <span class="frame_label no_connection active">
                                            <span class="niceCheck" style="background-position: -46px -17px;">
                                                <input type = "checkbox" name = "settings[wraper_activ]" class="textbox_short wraper_activSettings" {if $settings['wraper_activ']}checked{/if}   id="wraper_activ"/>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group wraperControlGroup" {if !$settings['wraper_activ']} style="display: none" {/if}>
                                    <label class="control-label" for="settings[wraper]">Обгортка</label>
                                    <div class="controls">
                                        <textarea name='settings[wraper]' class="elRTE"  id="wraper">{$settings['wraper']}</textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="settings[protocol]">Протокол</label>
                                    <div class="controls">
                                        <select name = "settings[protocol]" class="protocolSettings">
                                            <option {if $settings['protocol'] == "SMTP"} selected {/if} value="SMTP" >SMTP</option>
                                            <option {if $settings['protocol'] == "sendmail"} selected {/if} value="sendmail">sendmail</option>
                                            <option {if $settings['protocol'] == "mail"} selected {/if} value="mail">mail</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group portControlGroup span4" {if $settings['protocol'] != "SMTP"} style="display: none"  {/if} >
                                    <label class="control-label" for="settings[port]">Протокол</label>
                                    <div class="controls ">
                                        <input type = "text" name = "settings[port]" class=" textbox_short portSettings" {if $settings['protocol'] != "SMTP"} value="0"   {else:} value="{$settings['port']}"  {/if} id="port"/>
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