<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_backup_copy')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="#" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#createBackup"><i class="icon-ok"></i>{lang('a_create')}</button>     
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
                                    {lang('a_param')}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action="{$BASE_URL}admin/backup/create" method="post" id="createBackup"> 
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="inputName">{lang('a_local_copy')}:</label>
                                                <div class="controls">
                                                    <input type="radio" name="save_type" value="local" checked="checked" id="inputName"/>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="inputDesc">{lang('a_save_on_server')}</label>
                                                <div class="controls">
                                                    <input type="radio" name="save_type" value="server" /> 
                                                    <p class="help-block">{lang('a_save_path')} ./application/backups.</p>
                                                </div>
                                            </div>

                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="inputLocal">{lang('a_send_mail')}:</label>
                                                <div class="controls">

                                                    <input type="radio" name="save_type" value="email" />                                                                                <input type="text" name="email" class="input-small" value="{$user.email}" />

                                                </div>
                                            </div>

                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="inputLocal">{lang('a_file_format')}:</label>
                                                <div class="controls">
                                                    <input type="radio" name="file_type" value="gzip" checked="checked"/> gzip                                                                               <input type="radio" name="file_type" value="zip" /> zip
                                                    <input type="radio" name="file_type" value="txt" /> txt                                                                
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