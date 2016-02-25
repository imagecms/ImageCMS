<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang('Callback editing','admin')}</span>
        </div>

        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="{$ADMIN_URL}callbacks{echo $paginationBrand}" class="pjax t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Go back','admin')}</span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-action="edit" data-form="#editCallbackForm" data-submit><i class="icon-plus-sign icon-white"></i>{lang('Save','admin')}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-action="close" data-form="#editCallbackForm"><i class="icon-check"></i>{lang('Save and go back','admin')}</button>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
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
                            <form method="post" action="{$ADMIN_URL}callbacks/update/{echo $model->getId()}" class="form-horizontal span9" id="editCallbackForm">

                                <div class="control-group">
                                    <label class="control-label">
                                        {lang('Status','admin')}:
                                    </label>
                                    <div class="controls">
                                        <select name="StatusId">
                                            {foreach $statuses as $s}
                                                <option value="{echo $s->getId()}" {if $model->getStatusId() == $s->getId()}selected="selected" {/if}>{echo encode($s->getText())}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">
                                        {lang('ThemeId','admin')}:
                                    </label>
                                    <div class="controls">
                                        <select name="ThemeId">
                                            <option value="0" selected="selected">{lang('Does not have','admin')}</option>
                                            {foreach $themes as $t}
                                                <option {if $model->getThemeId() == $t->getId()} selected="selected" {/if} value="{echo $t->getId()}">{echo encode($t->getText())}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">
                                        {lang('User name','admin')}:
                                        <span class="must">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" name="Name" value="{echo ShopCore::encode($model->getName())}" class="required" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">
                                        {lang('Telephone','admin')}:
                                        <span class="must">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" name="Phone" value="{echo ShopCore::encode($model->getPhone())}" class="required " />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">
                                        {lang('Comment','admin')}:
                                    </label>
                                    <div class="controls">
                                        <textarea name="Comment">{echo ShopCore::encode($model->getComment())}</textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">
                                        {lang('Date of creation','admin')}:
                                    </label>
                                    <div class="controls">
                                        <input type="text" readonly="readonly" value="{echo date('H:i:s d-m-Y', $model->getDate())}">
                                    </div>
                                </div>

                                {form_csrf()}
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
