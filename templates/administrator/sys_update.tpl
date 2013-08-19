<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">івівівів</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/cp/wishlist"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('a_back')}</span>
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
                    dddd
                </div>
                <div class="tab-pane" id="restore">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th >Название</th>
                                <th >Размер</th>
                                <th >Восстановить</th>
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
                                        <h5><a href="{site_url('admin/sys_update/restore_db/' . $db_name)}">Восстановить</a></h5>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
