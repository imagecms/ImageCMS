<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Обновление</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/cp/wishlist"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('a_back')}</span>
                    </a>
                    <a class="btn btn-small pjax btn-success" href="/admin/pages/index">
                        <i class="icon-plus-sign icon-white"></i>
                        Обновить
                    </a>
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
                                        Дата
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
                                            <span>{echo $file_path}</span>
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
                    {else:}
                        <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                            Список файлов пуст.                           
                        </div>
                    {/if}
                </div>
                <div class="tab-pane" id="restore">
                    {if $files_dbs}
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th >Название</th>
                                    <th >Размер(байт)</th>
                                    <th >Восстановление</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $files_dbs as $db_name => $db_size}
                                    <tr>
                                        <td >
                                            <h5>{echo $db_name}</h5>
                                        </td>
                                        <td >
                                            <h5>{echo $db_size}</h5>
                                        </td>
                                        <td >
                                            <h5><a href="#" onclick="Update.restore_db('{echo $db_name}')">Восстановить</a></h5>
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
