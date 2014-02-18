<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Integration settings with 1C', 'exchangeunfu')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/cp/exchangeunfu"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Back', 'exchangeunfu')}</span>
                </a>
                <button type="button"
                        class="btn btn-small btn-primary action_on formSubmit"
                        data-form="#exchange_settings_form"
                        data-action="tomain">
                    <i class="icon-ok"></i>{lang('Save', 'exchangeunfu')}
                </button>
            </div>
        </div>
    </div>
    <form method="post" action="{site_url('admin/components/cp/exchangeunfu/update_settings')}" class="form-horizontal" id="exchange_settings_form">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang('Integration settings with 1C', 'exchangeunfu')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">


                            <div class="control-group">
                                <label class="control-label" for="usepass">{lang('Use commpres', 'exchangeunfu')}:</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name = "1CSettings[usepassword]" {if $settings['usepassword']}checked="checked"{/if} id="usepass"/>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="login">{lang('Set up a login to access the server 1C', 'exchangeunfu')}:</label>
                                <div class="controls">
                                    <input type = "text" name = "1CSettings[login]" class="textbox_short" value="{$settings['login']}" id="login"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="pass">{lang('Server password', 'exchangeunfu')}:</label>
                                <div class="controls">
                                    <input type = "password" name = "1CSettings[password]" class="textbox_short" value="{$settings['password']}" id="pass"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="back">{lang('Database backup', 'exchangeunfu')}:</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input value="1" type = "checkbox" name = "1CSettings[backup]" {if $settings['backup']}checked="checked"{/if} id="back"/>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="status">{lang('Select order status', 'exchangeunfu')}:</label>
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
                                <label class="control-label" for="status_after">{lang('Status after treatment', 'exchangeunfu')}:</label>
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
                                       <div class="d_n">{lang('All errors will be written to the file', 'exchangeunfu')} error_log.txt</div>&nbsp;{lang('Debugging mode', 'exchangeunfu')}
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
                                    <div class="d_n">{lang('If you specify an email errors when incorrect password', 'exchangeunfu')}<br>
                                        {lang('and security  will be sent to administrator', 'exchangeunfu')}</div>&nbsp;
                                    {lang('Email Administrator for sending important safety mistakes', 'exchangeunfu')}
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