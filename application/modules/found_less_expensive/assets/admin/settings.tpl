<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Settings', 'found_less_expensive')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/cp/found_less_expensive" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'found_less_expensive')}</span></a>
                <button id="settingsSave" type="button" class="btn btn-small btn-primary action_on" data-submit><i class="icon-ok"></i>{lang('Save', 'found_less_expensive')}</button>
            </div>
        </div>                            
    </div>
    <form method="post" action="{site_url('admin/components/cp/found_less_expensive/update_settings')}" class="form-horizontal" id="settingsForm">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang('Properties', 'found_less_expensive')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd span9">
                            <div class="control-group m-t_10">
                                <label class="control-label">{lang('Mail to receive notifications', 'found_less_expensive')}:</label>
                                <div class="controls">
                                    <input type="text" value="{echo $settings['emailTo']}" name="emailTo" id="email"/> 
                                </div>
                            </div>
                            <div class="control-group m-t_10">
                                <label class="control-label">{lang('Mail to which send the notification', 'found_less_expensive')}:</label>
                                <div class="controls">
                                    <input type="text" value="{echo $settings['emailFrom']}" name="emailFrom" id="email"/> 
                                </div>
                            </div>
                            <div class="control-group m-t_10">
                                <label class="control-label">{lang('Message theme', 'found_less_expensive')}:</label>
                                <div class="controls">
                                    <input type="text" value="{echo $settings['emailSubject']}" name="emailSubject" id="email"/> 
                                </div>
                            </div>
                            <div class="control-group m-t_10">
                                <label class="control-label">{lang('Message template', 'found_less_expensive')}:</label>
                                <div class="controls">
                                    <textarea name="emailTemplate" style="height:150px;">{echo $settings['emailTemplate']} </textarea>
                                <span class="help-inline">
                                    <b>{lang('You can use following variables', 'found_less_expensive')}:</b><br>
                                    %linkPage% - {lang('page reference on which the notice was left', 'found_less_expensive')}<br>
                                    %linkProduct% - {lang('link to found cheaper product', 'found_less_expensive')}<br>
                                </span>
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
