<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang('Creating a status callback','admin')}</span>
        </div>

        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="{$ADMIN_URL}callbacks/statuses" class="pjax t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Go back','admin')}</span></a>
                <button type="button" class="btn btn-small btn-success action_on formSubmit" data-action="new" data-form="#addCallbackStatusForm" data-submit><i class="icon-plus-sign icon-white"></i>{lang('Create','admin')}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-action="exit" data-form="#addCallbackStatusForm"><i class="icon-check"></i>{lang('Create and exit','admin')}</button>
            </div>
        </div>
    </div>
    <table class="table  table-bordered table-hover table-condensed content_big_td m-t_10">
        <thead>
            <tr>
                <th colspan="6">
                    {lang('Information','admin')}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="inside_padd span9">
                        <form method="post" class="form-horizontal span9" action="{$ADMIN_URL}callbacks/createStatus" id="addCallbackStatusForm">
                            <div class="control-group">
                                <label class="control-label" for="Text">
                                    {lang('Title','admin')}:
                                    <span class="must">*</span>
                                </label>
                                <div class="controls">
                                    <input type="text" name="Text" id="Text" class="required" />
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"></div>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" name="IsDefault" id="IsDefault" value="1" />
                                        </span>
                                        {lang('By default','admin')}
                                    </span>
                                    <span class="help-block"> {lang('Status set for all new requests. ','admin')}</span>
                                </div>
                            </div>
                            {form_csrf()}
                        </form>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</section>
