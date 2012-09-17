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
                                                    <label class="control-label" for="inputName">{lang('a_all_cache_file')}:</label>
                                                    <div class="controls">
                                                        <span class="filesCount">{echo $allFile}</span>                                                      
                                                    </div>
                                                </div>
                                                <div class="control-group m-t_10">
                                                    <label class="control-label" for="inputLocal">{lang('a_clean_old')}</label>
                                                    <div class="controls">                                                        
                                                        <button type="button" data-target="/admin/delete_cache" data-param="expried" id="delAll" class="btn btn-small clearCashe" ><i class="icon-trash" ></i> Очистить</button>
                                                    </div>
                                                </div>
                                                <div class="control-group m-t_10">
                                                    <label class="control-label" for="inputLocal">{lang('a_clean_all')}</label>
                                                    <div class="controls">                                                        
                                                        <button type="button" data-target="/admin/delete_cache" data-param="all" id="delAll" class="btn btn-small clearCashe" ><i class="icon-trash" ></i> Очистить</button>
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