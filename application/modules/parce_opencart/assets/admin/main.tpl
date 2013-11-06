<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('OpenCart DB parser', 'parce_opencart')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Back', 'parce_opencart')}</span>
                </a>
                <button type="button"
                        class="btn btn-small btn-primary action_on formSubmit"
                        data-form="#parce_opencart_settings_form"
                        data-action="tomain">
                    <i class="icon-ok"></i>{lang('Run process', 'parce_opencart')}
                </button>
            </div>
        </div>
    </div>
    <form method="post" action="{site_url('admin/components/cp/parce_opencart/run_process')}" class="form-horizontal" id="parce_opencart_settings_form">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang('DB connections settings', 'parce_opencart')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">

                            <div class="control-group">
                                <label class="control-label" for="username">{lang('DB username', 'parce_opencart')}</label>
                                <div class="controls ">
                                    <input type = "text" name = "username" id = "username"class="textbox_short" value="root" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="password">{lang('DB password', 'parce_opencart')}</label>
                                <div class="controls ">
                                    <input type = "text" name = "password" id = "password" class="textbox_short" value=""/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="database">{lang('DB name', 'parce_opencart')}</label>
                                <div class="controls ">
                                    <input type = "text" name = "database" id = "database" class="textbox_short" value="opencart1" />
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