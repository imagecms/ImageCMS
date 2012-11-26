<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('amt_feedback_settings')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/modules_table/" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                    <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#save" data-submit><i class="icon-ok icon-white"></i>{lang('a_save')}</button>
                </div>
            </div>                            
        </div>               
        <div class="tab-content">
            <!-----------------------------------------------------SETTINGS-------------------------------------------------------------->
            <div class="tab-pane active" id="mail">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('a_param')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span9">
                                    <div class="form-horizontal">
                                        <form id="save" method="post" action="{site_url('admin/components/cp/feedback/settings/update')}">
                                            <div class="control-group">
                                                <label class="control-label" for="email">{lang('amt_email')}</label>
                                                <div class="controls">
                                                    <input type="text" class="textbox_long" name="email" id="email" value="{$settings.email}" />
                                                    <span class="help-block">{lang('amt_select_email')}</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="message_max_len">{lang('amt_max_message_length')}</label>
                                                <div class="controls">
                                                    <input type="text" class="textbox_long" name="message_max_len" id="message_max_len" value="{$settings.message_max_len}" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
