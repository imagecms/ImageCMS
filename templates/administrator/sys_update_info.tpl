<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Update information', 'admin')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <!--<a href="{$BASE_URL}admin"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Go back','admin')}</span>
                </a>-->
                <a href="{$BASE_URL}admin/sys_update/update"
                   class="btn btn-small btn-primary pjax">
                    <span class="icon-play"></span>
                    <span class="">{lang('BackUp and Update','admin')}</span>
                </a>
                {if SHOP_INSTALLED}
                    <a href="/admin/sys_update/properties"
                       class="btn btn-small">
                        <span class="icon-wrench"></span>
                        <span>{lang('Settings', 'admin')}</span>
                    </a>
                {/if}
            </div>
        </div>
    </div>
    {if $newRelise}
        <div class="row">
            <div class="span4">
                <form method="post" action="{$BASE_URL}admin/sys_update/update" class="form-horizontal m-t_15" id="sys_form">
                    <table class="table  table-bordered table-hover table-condensed t-l_a">
                        <tbody>
                            <tr>
                                <td>
                                    <label class="control-label">
                                        <strong>{lang('Current version', 'admin')}:</strong>
                                    </label>
                                    <div class="controls">
                                        <label name="{BUILD_ID}">{echo BUILD_ID}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label">
                                        <strong>{lang('New version', 'admin')}:</strong>
                                    </label>
                                    <div class="controls">
                                        <label name="{$build}">{echo $build}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label">
                                        <strong>{lang('Date of release', 'admin')}:</strong>
                                    </label>
                                    <div class="controls">
                                        <label name="{$date}">{echo $date}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label">
                                        <strong>{lang('Size', 'admin')}:</strong>
                                    </label>
                                    <div class="controls">
                                        <label name="{$size}">{echo $size} mb.</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    {else:}
        <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
            {lang('You have actual system version.', 'admin')}
        </div>
    {/if}
</section>