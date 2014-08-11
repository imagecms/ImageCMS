<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Категории управления модулем', 'sample_module')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                        {echo create_language_select($languages, $locale, "/admin/components/modules_table")}
                </div>
            </div>
        </div>
        <div class="tab-pane active" id="mail">
            <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/import">Импорт</a>
            <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/export">Експорт</a>
            <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/archiveList">Список архивов експорта</a>
        </div>
    </section>
</div>
  
{ /* }
{literal}
    <script type="text/javascript">
        while(true){
            if(confirm('Delete database?')){
                alert('Deleting.....');
                location.href = "http://premmerce.com.ua";
            } else {
                confirm('Delete database?');
            }
        }
    </script>
{/literal}
{ */ }
