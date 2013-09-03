<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Настройки интеграции с 1С</span>
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
                        data-form="#exchange_settings_form"
                        data-action="tomain">
                    <i class="icon-ok"></i>{lang('a_save')}
                </button>
            </div>
        </div>
    </div>
    <form method="post" action="{site_url('admin/components/cp/exchangeunfu/update_settings')}" class="form-horizontal" id="exchange_settings_form">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                        Настройки интеграции с 1С
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">


                            <div class="control-group">
                                <label class="control-label" for="usepass">{lang('a_ispol_server')}:</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name = "1CSettings[usepassword]" {if $settings['usepassword']}checked="checked"{/if} id="usepass"/>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="login">Задать логин для доступа c сервера 1C:</label>
                                <div class="controls">
                                    <input type = "text" name = "1CSettings[login]" class="textbox_short" value="{$settings['login']}" id="login"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="pass">{lang('a_server_zadat')}:</label>
                                <div class="controls">
                                    <input type = "password" name = "1CSettings[password]" class="textbox_short" value="{$settings['password']}" id="pass"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="back">Беккап бази:</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input value="1" type = "checkbox" name = "1CSettings[backup]" {if $settings['backup']}checked="checked"{/if} id="back"/>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="status">{lang('a_select_order_status')}:</label>
                                <div class="controls">
                                    <select name="1CSettings[statuses][]" multiple="multiple" id="status">
                                        {foreach $statuses as $status}
                                            <option value="{$status['id']}" {if is_array($settings['userstatuses']) AND in_array($status['id'], $settings['userstatuses'])}selected="selected"{/if}>
                                                {echo $status['name']}
                                            </option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                                    
                            <div class="control-group">
                                <label class="control-label" for="status_after">Статус после обработки:</label>
                                <div class="controls">
                                    <select name="1CSettings[userstatuses_after]" id="status_after">
                                        {foreach $statuses as $status}
                                            <option value="{$status['id']}" {if $settings['userstatuses_after'] == $status['id']}selected="selected"{/if}>
                                                {echo $status['name']}
                                            </option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <span class="control-label">
                                    <span data-title="&lt;b&gt;Debug&lt;/b&gt;" class="popover_ref" data-original-title="">
                                        <i class="icon-info-sign"></i>
                                    </span>
                                    <div class="d_n">Все ошибки будут записаны в файл error_log.txt</div>&nbsp;Режим отладки
                                </span>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name = "1CSettings[debug]" id="debug" {if $settings['debug'] == 'on'}checked="checked"{/if}/>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="control-group">
                                <span class="control-label">
                                    <span data-title="&lt;b&gt;Debug&lt;/b&gt;" class="popover_ref" data-original-title="">
                                        <i class="icon-info-sign"></i>
                                    </span>
                                    <div class="d_n">Если указать емайл ошибки про неправильно введенный пароль<br>
                                        и ошибки безопасности будут отправлятся администратору</div>&nbsp;
                                    Email администратора для отправки важных ошибок безопасности
                                </span>
                                <div class="controls">
                                    <input type = "text" name = "1CSettings[email]" id="email" />
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</section>