<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Feedback settings")}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/modules_table/" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back")}</span></a>
                    <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#save" data-submit><i class="icon-ok icon-white"></i>{lang("Have been saved")}</button>
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
                                {lang("Properties")}
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
                                                <label class="control-label" for="email">{lang("E-Mail")}</label>
                                                <div class="controls">
                                                    <input type="text" class="textbox_long" name="email" id="email" value="{$settings.email}" />
                                                    <span class="help-block">{lang("Specify the e-mail address for mailing")}</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="message_max_len">{lang("Maximum message length")}</label>
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
