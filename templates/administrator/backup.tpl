<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Backup copying","admin")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#createBackup" data-submit><i class="icon-plus-sign icon-white"></i>{lang("Create","admin")}</button>
            </div>
        </div>                            
    </div>
    <form action="{$BASE_URL}admin/backup/create" method="post" id="createBackup">
        <div class="form-horizontal">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang("Properties","admin")}
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
                                            {lang("Copy to the local computer","admin")}
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
                                            {lang("Save on the server","admin")}
                                        </span>
                                        <p class="help-block">{lang("File will be saved in the directory","admin")} ./application/backups.</p>
                                    </div>
                                </div>

                                <div class="control-group m-t_10">
                                    <div class="control-label"></div>
                                    <div class="controls">
                                        <span class="frame_label no_connection">
                                            <span class="niceRadio b_n">
                                                <input type="radio" name="save_type" value="email" />
                                            </span>
                                            {lang("Send email","admin")}
                                        </span>
                                        <input type="text" name="email" class="input-large" value="{$user.email}" />
                                    </div>
                                </div>
                                <div class="control-group m-t_10">
                                    <label class="control-label" for="inputLocal">{lang("File format","admin")}:</label>
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