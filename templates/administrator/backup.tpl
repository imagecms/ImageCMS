<div class="container backup_container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Backup copying","admin")}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <!--<a href="/admin/dashboard" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back","admin")}</span></a>-->
                    <!--button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#saveSettings" data-action="edit" data-submit><i class="icon-ok icon-white"></i>{lang("Save","admin")}</button-->
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span3 m-t_10">
                <ul class="nav myTab nav-tabs nav-stacked">
                    <li><a href="#backup_list">{lang('List',"admin")}</a></li>
                    <li class="active"><a href="#backup_create">{lang('Create','admin')}</a></li>
                    <li><a href="#backup_settings">{lang('Settings','admin')}</a></li>  
                </ul>
            </div>
            <div class="span9 content_big_td">

                <div class="tab-content">
                    <div class="tab-pane" id="backup_list">

                        <table id="backups_list" class="table table-striped table-bordered table-hover table-condensed t-l_a">
                            <thead>
                            <th>{lang('File name', 'admin')}</th>
                            <th>{lang('Source', 'admin')}</th>
                            <th>{lang('Date', 'admin')}</th>
                            <th>{lang('Size', 'admin')}</th>
                            <!--th>{lang('Download', 'admin')}</th-->
                            <th>{lang('Delete', 'admin')}</th>
                            <th>{lang('Lock', 'admin')}</th>
                            </thead>
                            <tbody>
                                {if count($files) > 0}
                                    {foreach $files as $file}
                                        <tr>
                                            <td class="backup_filename">{$file.filename}</td>
                                            <td>{$file.prefix}</td>
                                            <td>{date("d-m-Y H:i:s", $file.timeUpdate)}</td>
                                            <td>{number_format(($file.size/1024/1024),2)} Mb</td>
                                            <!--td>
                                                <button class="backup_download btn btn-small"><i class="icon-download-alt"></i></button>
                                            </td-->
                                            <td>
                                                <button class="backup_delete btn btn-small{if $file.allowDelete == 0} disabled{/if}"><i class="icon-trash"></i></button>
                                            </td>
                                            <td>
                                                <button class="backup_lock file_action btn btn-small{if $file.locked == 1} active{/if} {if $file.allowDelete == 0} active disabled{/if}" data-toggle="button"><i class="icon-lock"></i></button>
                                            </td>
                                        </tr>
                                    {/foreach}
                                {else:}
                                    <tr>
                                        <td colspan='5' style='text-align:center;'>{lang('No files','admin')}</td>
                                    </tr> 
                                {/if}

                            </tbody>
                        </table>


                    </div>

                    <div class="tab-pane active" id="backup_create">
                        <table class="table table-striped table-bordered table-hover table-condensed t-l_a">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('Create', 'admin')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <form action="{$BASE_URL}admin/backup/create" method="post" id="createBackup">
                                            <div class="form-horizontal">
                                                <div class="inside_padd span9">
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
                                                            <div style="margin-top: 30px;">
                                                                <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#createBackup" data-submit><i class="icon-plus-sign icon-white"></i>{lang("Create","admin")}</button>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="backup_settings">
                        <table class="table table-striped table-bordered table-hover table-condensed t-l_a">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('Settings',"admin")}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span9">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="backup_del_status">{lang('Autocleaning', 'admin')}:</label>
                                                        <div class="controls">
                                                            <select class="backup_settings" name="backup_del_status" id="backup_del_status">
                                                                <option value="0"{if $backup_del_status == 0} selected="selected" {/if}>{lang('Off','admin')}</option>
                                                                <option value="1"{if $backup_del_status == 1} selected="selected" {/if}>{lang('On','admin')}</option>
                                                            </select>
                                                            <span class="help-block">
                                                                {lang('Warning! Files will be deleted automaticly on backup creating', 'admin')}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="backup_term">{lang('Delete after date', "admin")}:</label>
                                                        <div class="controls">
                                                            <select class="backup_settings" name="backup_term" id="backup_term">
                                                                <option value="6"{if $backup_term == 6} selected="selected" {/if}>6 {lang('month','admin')}</option>
                                                                <option value="2"{if $backup_term == 2} selected="selected" {/if}>2 {lang('month','admin')}</option>
                                                                <option value="1"{if $backup_term == 1} selected="selected" {/if}>1 {lang('month','admin')}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="backup_maxsize">{lang('Maximum backup size', 'admin')} (Mb):</label>
                                                        <div class="controls">
                                                            <input class="backup_settings" type="text" id="backup_maxsize" name="backup_maxsize" value="{$backup_maxsize}">
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <div class="controls">
                                                            <button class="btn" id="backup_save_settings">Сохранить</button>
                                                        </div>
                                                    </div>

                                                    <div id="backup_temp" style="display: none">
                                                        <form action="{$BASE_URL}admin/backup/download_file" method="post" target="_blank" id="download_file_form">
                                                            <input type="text" name="filename">
                                                        </form>
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
    </section>
</div>
