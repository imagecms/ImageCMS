<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang('Editing callback status','admin')}</span>
        </div>

        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="{$ADMIN_URL}callbacks/statuses" class="pjax t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Go back','admin')}</span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-action="edit" data-form="#addCallbackStatusForm" data-submit><i class="icon-ok icon-white"></i>{lang('Save','admin')}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-action="close" data-form="#addCallbackStatusForm"><i class="icon-check"></i>{lang('Save and go back','admin')}</button>
                    {echo create_language_select($languages, $locale, '/admin/components/run/callbacks/updateStatus/'. $model->getId())}
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
                        <form method="post" class="form-horizontal span9" action="{$ADMIN_URL}callbacks/updateStatus/{echo $model->getId()}/{$locale}" id="addCallbackStatusForm">
                            <div class="control-group">
                                <label class="control-label" for="Text">
                                    {lang('Title','admin')}:<span class="must">*</span>
                                </label>
                                <div class="controls">
                                    <input type="text" name="Text" id="Text" value="{echo ShopCore::encode($model->getText())}" class="required"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="control-label"></div>
                                <div class="controls">
                                    <span class="frame_label no_connection">
                                        <input type="checkbox" name="IsDefault" id="IsDefault" value="1" {if $model->getIsDefault() == true} checked="checked" disabled="disabled"{/if}/>
                                        {lang('By default','admin')}
                                    </span>
                                    <div class="help-block"> {lang('Status set for all new requests. ','admin')}</div>
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