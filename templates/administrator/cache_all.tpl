<form action="{$BASE_URL}admin/backup/create" method="post">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_backup_copy')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="#" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                    <button type="button" class="btn btn-small action_on" value="{lang('a_create')}" onclick="ajax_me('backup_form');"><i class="icon-ok"></i>{lang('a_create')}</button>     

                </div>
            </div>                            
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="modules">
                <div class="row-fluid">
                    <div class="form-horizontal">
                        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        Папка кэш
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group m-t_10">
                                                    <label class="control-label" for="inputName">Всего файлов кеширования:</label>
                                                    <div class="controls">
                                                        <span>{echo $allFile}</span>                                                      
                                                    </div>
                                                </div>
                                                <div class="control-group m-t_10">
                                                    <label class="control-label" for="inputName">Удалить из root:</label>
                                                    <div class="controls">
                                                        <input type="radio" name="del" value="root" checked="checked" id="inputName"/>
                                                    </div>
                                                </div>


                                                <div class="control-group m-t_10">
                                                    <label class="control-label" for="inputLocal">{lang('a_clean_all')}:</label>
                                                    <div class="controls">
                                                        <a id="delAll" href="javascript:delete_cache('all')">222</a>


                                                        <button type="button" href="javascript:delete_cache('all')" id="delAll" class="btn btn-small"  ><i class="icon-trash" ></i>Удалить</button>




                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="tab-pane"></div>
        </div>
    </section>
</form>