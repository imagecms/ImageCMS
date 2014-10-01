<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Category management module', 'import_export')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'import_export')}</span></a>
                        {echo create_language_select($languages, $locale, "/admin/components/modules_table")}
                </div>
            </div>
        </div>
        <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
            <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/import" class="btn btn-small">{lang('Import', 'import_export')}</a>
            <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/export" class="btn btn-small">{lang('Export', 'import_export')}</a>
            <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/archiveList" class="btn btn-small">{lang('List archives exports', 'import_export')}</a>
        </div>
    </section>
</div>
