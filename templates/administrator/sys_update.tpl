<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Updation', 'admin')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/sys_update"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('back', 'admin')}</span>
                    </a>
                    <button onclick="Update.processBackup();"
                            class="btn btn-small btn-primary pjax">
                        <span class="icon-hdd"></span>
                        {lang('Create Backup', 'admin')}
                    </button>
                    {if $new_version}
                        <button onclick="Update.processUpdate();"
                                class="btn btn-small pjax btn-success">
                            <span class="icon-refresh"></span>
                            {lang('Update', 'admin')}
                        </button>
                    {/if}
                </div>
            </div>
        </div>

        {if $error}
            <div class="span3 pull-right"style="padding-top: 20px;">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    <h4>{lang('Error', 'admin')}!</h4>
                    {echo $error}
                </div>
            </div>
        {/if}

        <div class="progressDB" style="display: none;">
            <div class="progress progress-info progress-striped active">
                <div id='progres' class="bar"></div>
            </div>
        </div>

        <div class="row-fluid">
            {if $new_version}
                <div class="clearfix">
                    <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                        <a href="#update" class="btn btn-small active">{lang('Updation', 'admin')}</a>
                        <a href="#restore" class="btn btn-small">{lang('Restore', 'admin')}</a>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="update">
                        {if $diff_files and !$error}
                            <h4>{lang('Files that will be changed', 'admin')} ({echo $filesCount})</h4>
                            <form  action="{$ADMIN_URL}" method="post" id="update_form">
                                <table class="table  table-bordered table-hover table-condensed t-l_a">
                                    <thead>
                                        <tr>
                                            <th>
                                                {lang('File path', 'admin')}
                                            </th>
                                            <th>
                                                {lang('Control sum', 'admin')}
                                            </th>
                                            <th>
                                                {lang('Date of changes', 'admin')}
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
                                    {lang('Empty file list', 'admin')}.
                                </div>
                            {/if}
                        {/if}
                    </div>
                {/if}

                <div class="tab-pane" id="restore">
                    {if $restore_files}
                        <table class="table  table-bordered table-hover table-condensed t-l_a">
                            <thead>
                                <tr>
                                    <th >{lang('Name', 'admin')}</th>
                                    <th >
                                        {if $sort_by == 'size'}
                                            {if $order == 'asc'}
                                                <a class="pjax" href="/admin/sys_update/update/size/desc#restore">{lang('Size', 'admin')}(MB)</a>
                                                <span class="f-s_14">↓</span>
                                            {else:}
                                                <a class="pjax" href="/admin/sys_update/update/size/asc#restore">{lang('Size', 'admin')}(MB)</a>
                                                <span class="f-s_14">↑</span>
                                            {/if}
                                        {else:}
                                            <a class="pjax" href="/admin/sys_update/update/size/asc#restore">{lang('Size', 'admin')}(MB)</a>
                                        {/if}
                                    </th>
                                    <th>
                                        {if $sort_by == 'create_date'}
                                            {if $order == 'asc'}
                                                <a class="pjax" href="/admin/sys_update/update/create_date/desc#restore">{lang('Creation date', 'admin')}</a>
                                                <span class="f-s_14">↓</span>
                                            {else:}
                                                <a class="pjax" href="/admin/sys_update/update/create_date/asc#restore">{lang('Creation date', 'admin')}</a>
                                                <span class="f-s_14">↑</span>
                                            {/if}
                                        {else:}
                                            <a class="pjax" href=/update/create_date/asc#restore">{lang('Creation date', 'admin')}</a>
                                        {/if}
                                    <th>{lang('Restore', 'admin')}</th>
                                    <th>{lang('Deleting', 'admin')}</th>
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
                                            <button class="btn btn-small btn-success pjax"
                                                    type="button"
                                                    onclick="Update.restore('{ echo str_replace('\\', '/', BACKUPFOLDER . $file_inf.name)}')">
                                                <i class="icon-refresh"></i>
                                                {lang('Restore', 'admin')}
                                            </button>
                                        </td>
                                        <td class="span2">
                                            {if $file_inf['name'] != 'backup.zip'}
                                                <button class="btn btn-small btn-danger" type="button" onclick="Update.delete_backup('{echo $file_inf['name']}', $(this))">
                                                    <i class="icon-trash"></i>
                                                    {lang('Delete', 'admin')}
                                                </button>
                                            {/if}
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    {else:}
                        <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                            {lang('No recovery files.', 'admin')}
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </section>
</div>
