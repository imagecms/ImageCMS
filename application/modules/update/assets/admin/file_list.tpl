
<div class="container">


    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Файлы обновления</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">

                    <a href="/admin/components/init_window/update" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                    <a href="/admin/components/init_window/update/file_create" class="btn btn-small btn-success pjax"><i class="icon-plus-sign icon-white"></i>Добавить новое обновления</a>
                    <button type="button" class="btn btn-small btn-danger disabled action_on" id="banner_del" onclick="DeleteFile()"><i class="icon-trash icon-white"></i>Удалить обновления</button>
                </div>
            </div>
        </div>

        <form method="get" id="form_list" action="" >
            <div class="tab-content">
                <div class="row-fluid">

                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr class="top_tr">
                                <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" />
                                        </span>
                                    </span>
                                </th>
                                <th class="span1">{lang('a_ID')}</th>
                                <th class="span3"><a href="build_id">Build Id</a></th>
                                <th class="span3"><a href="version">Version</a></th>
                                <th class="span3">путь к хеш суммам</th>
                                <th class="span3">путь к архива</th>
                                <input type="hidden" name="order" value="{echo $_GET['order']}">
                            </tr>
                            <tr class="head_body">
                                <td></td>
                                <td></td>
                                <td>
                                    <div>
                                        <input name="build" type="text" value="{echo $_GET['build']}" >
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <input name="version" type="text" value="{echo $_GET['version']}" >
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        {if count($file) > 0}
                            <tbody class="">
                                {foreach $file as $f}
                                    <tr>
                                        <td class="t-a_c span1">
                                            <span class="frame_label">
                                                <span class="niceCheck b_n">
                                                    <input type="checkbox" name="ids" value="{echo $f['id']}"/>
                                                </span>
                                            </span>
                                        </td>
                                        <td><p>{echo $f['id']}</p></td>
                                        <td>
                                            {/*}<a class="pjax" href="/admin/components/init_window/update/file_edit/{echo $f['id']}" >{echo $f['build_id']}</a>{ */}
                                            {echo $f['build_id']}
                                        </td>

                                        <td>
                                            {/*}<a class="pjax" href="/admin/components/init_window/update/file_edit/{echo $f['id']}" >{echo $f['version']}</a>{ */}
                                            {echo $f['version']}

                                        </td>
                                        <td>
                                            {echo $f['path_hash']}
                                        </td>
                                        <td>
                                            {echo $f['path_zip']}
                                        </td>

                                        </div>
                                        </td>
                                    </tr>
                                {/foreach}

                            </tbody>
                        {else:}
                            <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                                Нет файлов обновления в базе
                            </div>
                        {/if}
                    </table>

                </div>
            </div>
        </form>
    </section>
</div>

