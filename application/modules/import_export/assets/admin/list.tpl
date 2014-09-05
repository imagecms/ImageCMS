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
    <div class="tab-content">
        <div class="tab-pane active" id="exportcsv">    
            <table class="table  table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="18">{lang('Archive List','import_export')}</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $files as $str}
                        <tr>
                            <td colspan="6">
                                {echo $str}
                            </td>
                            <td colspan="6">
                                <a href="{$BASE_URL}admin/components/init_window/import_export/downloadZIP/{echo $str}">Скачать</a>
                            </td>
                            <td colspan="6">
                                <a href="{$BASE_URL}admin/components/init_window/import_export/deleteArchive/{echo $str}">Удалить</a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>     
        </div>
    </div>
</section>