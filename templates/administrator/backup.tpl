<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_backup_copy')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#createBackup" data-submit><i class="icon-plus-sign icon-white"></i>{lang('a_create')}</button>
            </div>
        </div>                            
    </div>
    <form action="{$BASE_URL}admin/backup/create" method="post" id="createBackup">
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
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="control-group m-t_10">
                                    <div class="control-label"></div>
                                    <div class="controls">
                                        <span class="frame_label no_connection">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="save_type" value="local" checked="checked" id="inputName"/>
                                            </span>
                                            {lang('a_local_copy')}
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="control-label"></div>
                                    <div class="controls">
                                        <span class="frame_label no_connection">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="save_type" value="server" /> 
                                            </span>
                                            {lang('a_save_on_server')}
                                        </span>
                                        <p class="help-block">{lang('a_save_path')} ./application/backups.</p>
                                    </div>
                                </div>

                                <div class="control-group m-t_10">
                                    <div class="control-label"></div>
                                    <div class="controls">
                                        <span class="frame_label no_connection">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="save_type" value="email" />
                                            </span>
                                            {lang('a_send_mail')}
                                        </span>
                                        <input type="text" name="email" class="input-large" value="{$user.email}" />
                                    </div>
                                </div>
                                <div class="control-group m-t_10">
                                    <label class="control-label" for="inputLocal">{lang('a_file_format')}:</label>
                                    <div class="controls">
                                        <span class="frame_label no_connection m-r_15">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="file_type" value="gzip" checked="checked"/>
                                            </span>
                                            gzip
                                        </span>
                                        <span class="frame_label no_connection m-r_15">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="file_type" value="zip" />
                                            </span>
                                            zip
                                        </span>
                                        <span class="frame_label no_connection">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="file_type" value="sql" />
                                            </span>
                                            sql
                                        </span>
                                    </div>
                                </div> 
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
</section>