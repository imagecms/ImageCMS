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
                    <button type="button" class="btn btn-small formSubmit" data-form="#sample_module_settings" data-action="back"><i class="icon-edit"></i>{lang("Save and go back", 'sample_module')}</button>
                        {echo create_language_select($languages, $locale, "/admin/components/modules_table")}
                </div>
            </div>
        </div>
        <div class="tab-pane active" id="mail">
            <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/import">Import</a>
            <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/export">Export</a>
        </div>
    </section>
</div>
