<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="title">{lang('a_sys_info')}</span>
            </div>
        </div>
        <div class="row-fluid">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <tbody>
                    <tr>
                        <td class="span2">{lang('a_server_load')}:</td>
                        <td>
                            {if function_exists('sys_getloadavg') AND is_array(sys_getloadavg())}
                                {$load_averages = sys_getloadavg()}
                                {$server_load = $load_averages[0].' '.$load_averages[1].' '.$load_averages[2]}
                            {/if} 
                        </td>
                    </tr>
                    <tr>
                        <td class="span2">
                           {lang('a_server')} 
                        </td>
                        <td>
                            {lang('a_os')}:<span style="padding-left:3px;"><?php echo PHP_OS ?></span><br />
                            PHP:<span style="padding-left:3px;"><?php echo PHP_VERSION ?></span> 
                            <a href="/admin/sys_info/phpinfo" class="pjax"> phpinfo</a>
                        </td>
                    </tr>
                    {if $db_version}
                        <tr>
                            <td class="span2">
                                {lang('a_db')}
                            </td>
                            <td>
                                {lang('a_version')}: {$db_version}<br/>
                                {lang('a_period')}: {$db_rows}<br/>
                                {lang('a_size')}: {$db_size}
                            </td>
                        </tr>
                    {/if}
                    <tr>
                        <td class="span2">{lang('a_write_perm')}</td>
                        <td>
                            {foreach $folders as $k => $v}
                                {if $v == TRUE}
                                    {$color='green'}
                                {else:}
                                    {$color='#E25B5B'}
                                {/if}
                                <span style="color:{$color};">{$k}</span><br />
                            {/foreach}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>    
    </section>
</div>
