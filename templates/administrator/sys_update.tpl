<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Обновление</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('a_back')}</span>
                    </a>
                    <button type="button" class="btn btn-small action_on formSubmit btn-success" data-form="#update_form" data-submit>
                        <i class="icon-refresh"></i>
                        Обновить
                    </button>
                    <button onclick="$.post('/admin/sys_update/backup');
                            location.reload();"
                            class="btn btn-small btn-primary">
                        <span class="icon-hdd"></span>
                        Создать BackUp
                    </button>
                    {if SHOP_INSTALLED}
                        <a href="/admin/sys_update/properties"
                           class="btn btn-small">
                            <span class="icon-wrench"></span>
                            <span>Настройки</span>
                        </a>
                    {/if}
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="#update" class="btn btn-small active">Обновление</a>
                    <a href="#restore" class="btn btn-small">Восстановление</a>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="update">
                    <h4>Файлы которые будут изменены</h4>
                    {if $diff_files}
                        <form  action="{$ADMIN_URL}" method="post"  id="update_form">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th class="span1">
                                            <span class="frame_label">
                                                <span class="niceCheck" style="background-position: -46px 0px;">
                                                    <input type="checkbox">
                                                </span>
                                            </span>
                                        </th>
                                        <th>
                                            Путь к файлу
                                        </th>
                                        <th>
                                            Контрольная сумма
                                        </th>
                                        <th>
                                            Дата изменения
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {foreach $diff_files as $file_path => $md5}
                                        <tr>
                                            <td class="span1">
                                                <span class="frame_label">
                                                    <span class="niceCheck" style="background-position: -46px 0px;">
                                                        <input type="checkbox" name="files_md5" value="{echo $md5}">
                                                    </span>
                                                </span>
                                            </td>
                                            <td >
                                                <a onclick="Update.renderFile('{echo $file_path}', $(this))"><span>{echo $file_path}</span></a>
                                            </td>
                                            <td >
                                                <span>{echo $md5}</span>
                                            </td>
                                            <td>
                                                {echo date('Y-m-d  h:m:s',$diff_files_dates[$file_path])}
                                            </td>
                                        </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </form>
                    {else:}
                        <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                            Список файлов пуст.
                        </div>
                    {/if}
                </div>
                <div class="tab-pane" id="restore">
                    {if $restore_files}
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th >Название</th>
                                    <th >
                                        {if $sort_by == 'size'}
                                            {if $order == 'asc'}
                                                <a class="pjax" href="/admin/sys_update/index/size/desc#restore">Размер(байт)</a>
                                                <span class="f-s_14">↓</span>
                                            {else:}
                                                <a class="pjax" href="/admin/sys_update/index/size/asc#restore">Размер(байт)</a>
                                                <span class="f-s_14">↑</span>
                                            {/if}
                                        {else:}
                                            <a class="pjax" href="/admin/sys_update/index/size/asc#restore">Размер(байт)</a>
                                        {/if}
                                    </th>
                                    <th >
                                        {if $sort_by == 'create_date'}
                                            {if $order == 'asc'}
                                                <a class="pjax" href="/admin/sys_update/index/create_date/desc#restore">Дата создания</a>
                                                <span class="f-s_14">↓</span>
                                            {else:}
                                                <a class="pjax" href="/admin/sys_update/index/create_date/asc#restore">Дата создания</a>
                                                <span class="f-s_14">↑</span>
                                            {/if}
                                        {else:}
                                            <a class="pjax" href="/admin/sys_update/index/create_date/asc#restore">Дата создания</a>
                                        {/if}
                                    <th class="span2">Восстановление</th>
                                    <th class="span1">Удаление</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $restore_files as $file_inf}
                                    <tr>
                                        <td >
                                            {echo $file_inf['name']}
                                        </td>
                                        <td >
                                            {echo $file_inf['size']}
                                        </td>
                                        <td>
                                            {echo date('Y-m-d h:m:s', $file_inf['create_date'])}
                                        </td>
                                        <td class="span2">
                                            <button class="btn my_btn_s btn-small btn-success" type="button" onclick="Update.restore('./application/backups/{echo $file_inf['name']}')">
                                                <i class="icon-refresh"></i>
                                            </button>
                                        </td>
                                        <td class="span1">
                                            {if $file_inf['name'] != 'backup.zip'}
                                                <button class="btn my_btn_s btn-small btn-danger" type="button" onclick="Update.delete_backup('{echo $file_inf['name']}', $(this))">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            {/if}
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    {else:}
                        <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                            Нет файлов восстановления.
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </section>
</div>
