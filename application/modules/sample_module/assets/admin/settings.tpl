<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Notification about new comments', 'sample_module')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                    <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#sample_module_settings"><i class="icon-ok"></i>{lang("Save", 'sample_module')}</button>
                    <button type="button" class="btn btn-small formSubmit" data-form="#sample_module_settings" data-action="back"><i class="icon-check"></i>{lang("Save and go back", 'sample_module')}</button>
                        {echo create_language_select($languages, $locale, "/admin/components/modules_table")}
                </div>
            </div>
        </div>
        <div class="tab-pane active" id="mail">
            <table class="table  table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang("Properties", 'sample_module')}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <div class="row-fluid">
                                        <form id="sample_module_settings" method="post" action="{$BASE_URL}admin/components/cp/sample_module/updateSettings">
                                            <div class="control-group">
                                                <label class="control-label" for="mailTo">{lang('Administrator E-mail','sample_module')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="mailTo" id="mailTo" value="{$mailTo}"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="useEmailNotification">{lang('Notify by E-mail','sample_module')}:</label>
                                                <div class="controls">
                                                    <select name="useEmailNotification">
                                                        <option {if $useEmailNotification == 'TRUE'}selected="selected"{/if} value="TRUE">{lang('Yes', 'sample_module')}</option>
                                                        <option {if $useEmailNotification == 'FALSE'}selected="selected"{/if}value="FALSE">{lang('No', 'sample_module')}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="key">{lang('Secret key', 'sample_module')}:</label>
                                                <div class="controls">
                                                    <input type="text" name="key" id="key" value="{$key}"/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
