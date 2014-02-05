<div id="mySett" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">{lang("Settings", 'sendsms')}</h3>
    </div>
    <form method="post" action="/admin/components/init_window/sendsms/saveSettings/{$locale}" enctype="multipart/form-data" id="settingsForm">
        <div class="modal-body">
            <label class="">
                <span class="">
                    {lang('API key private','sendsms')}:
                </span>
                <input type="text" autocomplete="off" name='sms_key_private' value="{$settings.sms_key_private}" />
                <span class="">
                    {lang('API key public','sendsms')}:
                </span>
                <input type="text" autocomplete="off" name='sms_key_public' value="{$settings.sms_key_public}" />
                <span class="">
                    {lang('Company name','sendsms')}:
                </span>
                <input type="text" autocomplete="off" name='sms_company_name' value="{$settings.sms_company_name}" />
            </label>
        </div>
    </form>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">{lang("Close", 'sendsms')}</button>
        <button class="btn btn-primary formSubmit submitButton" 
                data-form="#settingsForm" 
                data-submit 
                data-dismiss="modal" 
                aria-hidden="true">{lang("Save settings", 'sendsms')}
        </button>
    </div>
</div>
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Send SMS','sendsms')}</span> 
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table" class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span> 
                    <span class="t-d_u">{lang("Go back", 'sendsms')}</span>
                </a>
                <a href="#mySett" role="button" class="btn btn-small" data-toggle="modal">
                    <i class="icon-wrench"></i>
                    {lang("Settings", 'sendsms')}
                </a>
                <button onclick="" type="button" class="btn btn-small btn-primary formSubmit submitButton" data-form="#createDiscountForm" data-submit>
                    <i class="icon-ok icon-white"></i>
                    {lang('Save','sendsms')}
                </button>
                {echo create_language_select($languages, $locale, "/admin/components/init_window/sendsms/trans")}
            </div>
        </div>
    </div>
    <form method="post" action="/admin/components/init_window/sendsms/save/{$locale}" enctype="multipart/form-data" id="createDiscountForm">
        <table class="table table-striped table-bordered table-condensed content_big_td module-cheep">
            <thead>
                <tr>
                    <th colspan="6">{lang('Balance','sendsms')}: {$balance}&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd discount-out">
                            <div class="form-horizontal">
                                <label class="">
                                    <span class="span4">
                                        <span data-title="Variables, can use to:" class="popover_ref" data-original-title="">
                                            <i class="icon-info-sign"></i>
                                        </span>
                                        <div class="d_n">
                                            <b>%id%</b> - {lang('Order ID','sendsms')}<br/>
                                            <b>%user_id%</b> - {lang('User ID','sendsms')}<br/>
                                            <b>%key%</b> - {lang('Order key','sendsms')}<br/>
                                            <b>%user_full_name%</b> - {lang('User name','sendsms')}<br/>
                                            <b>%user_email%</b> - {lang('User email','sendsms')}<br/>
                                            <b>%user_phone%</b> - {lang('User phone','sendsms')}<br/>
                                            <b>%user_deliver_to%</b> - {lang('Delivery address','sendsms')}<br/>
                                        </div>
                                        {lang('Order template','sendsms')}:
                                    </span>
                                    <span class="span8 discount-name">
                                        <input type="text" autocomplete="off" name='orderTemplate' value="{$template.orderTemplate}" />
                                    </span>
                                </label>
                                <label class="">
                                    <span class="span4">         
                                        {lang('Send order template','sendsms')}:
                                    </span>
                                    <span class="span8 discount-name">
                                        <input type="text" autocomplete="off" name='sendTemplate' value="{$template.sendTemplate}" />
                                    </span>
                                </label>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <div id="elFinder"></div>
</section>