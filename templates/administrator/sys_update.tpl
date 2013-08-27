<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Обновление</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/sys_update"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('a_back')}</span>
                    </a>
                    <a href="/admin/sys_update/do_update"
                       class="btn btn-small pjax btn-success">
                        <i class="icon-refresh"></i>
                        Обновить
                    </a>
                    <a href="/admin/sys_update/backup"
                       class="btn btn-small btn-primary pjax">
                        <span class="icon-hdd"></span>
                        Создать BackUp
                    </a>
                    <button onclick="Update.processDB()"
                            class="btn">
                        <span class="icon-hdd"></span>
                        getQuerys
                    </button>
                </div>
            </div>
        </div>

        <div class="progress progress-info progress-striped active">
            <div id='progres' class="bar" style="width: 20%"></div>
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
                    {if $diff_files and !$error}
                        <h4>Файлы которые будут изменены ({echo $filesCount})</h4>
                        <form  action="{$ADMIN_URL}" method="post" id="update_form">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
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
                                            <td >
                                                <a onclick="Update.renderFile('{echo $file_path}', $(this))">
                                                    <span>{echo $file_path}</span>
                                                </a>
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
                        {if $error}
                            <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                                {echo $error}
                            </div>
                        {else:}
                            <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                                Список файлов пуст.
                            </div>
                        {/if}
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
                                                <a class="pjax" href="/admin/sys_update/index/size/desc#restore">Размер(MB)</a>
                                                <span class="f-s_14">↓</span>
                                            {else:}
                                                <a class="pjax" href="/admin/sys_update/index/size/asc#restore">Размер(MB)</a>
                                                <span class="f-s_14">↑</span>
                                            {/if}
                                        {else:}
                                            <a class="pjax" href="/admin/sys_update/index/size/asc#restore">Размер(MB)</a>
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
                                    <th class="span2">Удаление</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $restore_files as $file_inf}
                                    <tr>
                                        <td >
                                            {echo $file_inf['name']}
                                        </td>
                                        <td >
                                            {echo $file_inf['size']} mb.
                                        </td>
                                        <td>
                                            {echo date('Y-m-d h:m:s', $file_inf['create_date'])}
                                        </td>
                                        <td class="span2">
                                            <button class="btn btn-small btn-success"
                                                    type="button"
                                                    onclick="Update.restore('./application/backups/{echo $file_inf['name']}')">
                                                <i class="icon-refresh"></i>
                                                Востановить
                                            </button>
                                        </td>
                                        <td class="span2">
                                            {if $file_inf['name'] != 'backup.zip'}
                                                <button class="btn btn-small btn-danger" type="button" onclick="Update.delete_backup('{echo $file_inf['name']}', $(this))">
                                                    <i class="icon-trash"></i>
                                                    Удалить
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
