<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Import-Export CSV/XLS','import_export')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/init_window/import_export" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'import_export')}</span></a>
                    {echo create_language_select($languages, $locale, "/admin/components/modules_table")}
            </div>
        </div>
    </div>
    <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
        <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/import" class="btn btn-small pjax">{lang('Import', 'import_export')}</a>
        <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/export" class="btn btn-small pjax">{lang('Export', 'import_export')}</a>
        <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/archiveList" class="btn btn-small pjax active">{lang('List archives exports', 'import_export')}</a>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="exportcsv">
            <table class="table  table-bordered table-hover table-condensed content_big_td t-l_a">
                <thead>
                    <tr>
                        <th colspan="3">{lang('Archive List','import_export')}</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $files as $str}
                        <tr>
                            <td>
                                {echo $str}
                            </td>
                            <td>
                                <a href="{$BASE_URL}admin/components/init_window/import_export/downloadZIP/{echo $str}">{lang('Download', 'import_export')}Скачать</a>
                            </td>
                            <td>
                                <a href="{$BASE_URL}admin/components/init_window/import_export/deleteArchive/{echo $str}">{lang('Delete', 'import_export')}Удалить</a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>     
        </div>
    </div>
</section>