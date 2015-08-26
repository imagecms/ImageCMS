<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Update settings', 'admin')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/sys_update"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Back', 'admin')}</span>
                </a>
                <button type="button"
                        class="btn btn-small btn-primary action_on formSubmit"
                        data-form="#sys_form"
                        data-action="tomain">
                    <i class="icon-ok"></i>{lang('Save', 'admin')}
                </button>
            </div>
        </div>
    </div>
    <form method="post" action="{$BASE_URL}admin/sys_update/properties" class="form-horizontal m-t_15" id="sys_form">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang('Settings', 'admin')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="control-group">
                                <label class="control-label">{lang('Your updation key', 'admin')}:</label>
                                <div class="controls">
                                    <textarea name="careKey" class="elRTE" rows="10" required>{echo $careKey}</textarea>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</section>