<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Настройки интеграции с 1С</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back")}</span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#exchange_settings_form" data-action="tomain"><i class="icon-ok"></i>{lang("Have been saved")}</button>
            </div>
        </div>                            
    </div>
    <form method="post" action="{site_url('admin/components/cp/exchange/update_settings')}" class="form-horizontal" id="exchange_settings_form">
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
                                <label class="control-label" for="zip">{lang(" Use zip compaction , if available")}:</label>
                                <div class="controls">
                                    <select name = "1CSettings[zip]" id="zip">
                                        <option value = "yes" disabled>{lang("Yes")}</option>
                                        <option value = "no">{lang("No")}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="size">{lang(" Size of the single file download (in bites)")}:</label>
                                <div class="controls">
                                    <input type = "text" name = "1CSettings[filesize]" value = "{$settings['filesize']}" id="size"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="address">{lang("Server 1C IP address")}:</label>
                                <div class="controls">
                                    <input type = "text" name = "1CSettings[validIP]" value = "{$settings['validIP']}" id="address"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="usepass">{lang("Use the password for access from 1C server")}:</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name = "1CSettings[usepassword]" {if $settings['usepassword']}checked="checked"{/if} id="usepass"/>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="pass">{lang(" Set  a password for  access from 1C server ")}:</label>
                                <div class="controls">
                                    <input type = "password" name = "1CSettings[password]" class="textbox_short" value="{$settings['password']}" id="pass"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="status">{lang("Select order statuses for import")}:</label>
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
                                <label class="control-label" for="autores">Запускать ресайз изображений автоматически?</label>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type = "checkbox" name = "1CSettings[autoresize]" id="autores" {if $settings['autoresize'] == 'on'}checked="checked"{/if}/>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Ручной запуск ресайза</label>
                                <div class="controls">
                                    <a class="btn runResize"><i class="icon-play"></i>&nbsp;Запустить</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</section>