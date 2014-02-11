<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Site Map", 'sitemap')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/sitemap/priorities" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'sitemap')}</span></a>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#sitemap_settings_form" data-submit><i class="icon-ok"></i>{lang("Save", 'sitemap')}</button>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#sitemap_settings_form" data-action="show_sitemap" data-submit><i class="icon-share"></i>{lang("Save and view", 'sitemap')}</button>
                <span class="btn-group">
                    <button type="button" class="btn btn-small btn-info dropdown-toggle" data-toggle="dropdown" style="margin-top: -5px;">
                        <i class="icon-white icon-list"></i>
                        {lang('Others', 'sitemap')}<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a style="text-decoration: none" class="pjax" href="/admin/components/init_window/sitemap/priorities">{lang('Priorities', 'sitemap')}</a></li>
                        <li><a style="text-decoration: none" class="pjax" href="/admin/components/init_window/sitemap/changefreq">{lang('Change frequency', 'sitemap')}</a></li>
                        <li><a style="text-decoration: none" class="pjax" href="/admin/components/init_window/sitemap/blockedUrls">{lang('Block urls', 'sitemap')}</a></li>
                        <li class="divider"></li>
                        <li><a style="text-decoration: none" href="{site_url('sitemap.xml')}" target="_blank">{lang("View Site Map", 'sitemap')}</a></li>
                        <li class="divider"></li>
                        <li><a style="text-decoration: none" class="pjax" href="/admin/components/init_window/sitemap/settings">{lang('Settings', 'sitemap')}</a></li>
                    </ul>
                </span>
            </div>
        </div>                            
    </div>
    <form action="/admin/components/cp/sitemap/settings" id="sitemap_settings_form" method="post" class="form-horizontal">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th>{lang("Settings", 'sitemap')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="inside_padd span10">

                            <div class="control-group" style="width: 560px; margin-bottom: 12px;">
                                <label class="control-label" for="comcount">{lang("Generate Site Map or use existing map", 'sitemap')}:</label>
                                <div class="controls number input-prepend" style="margin-top: -100px;">
                                    <select name="settings[generateXML]" style="width: 430px">
                                        <option value="1" {if $settings.generateXML}selected="selected"{/if}>{lang('Generate new', 'sitemap')}</option>
                                        <option value="0" {if !$settings.generateXML}selected="checked"{/if}>{lang('Use existing', 'sitemap')}</option>
                                    </select>

                                    <button type="button" onclick="SiteMap.saveSiteMap()" class="btn btn-small btn-success">
                                        {if $fileSiteMapData}
                                            <i class="icon-refresh"></i>
                                            {lang("Regenerate", 'sitemap')}
                                        {else:}
                                            <i class="icon-ok"></i>
                                            {lang("Generate", 'sitemap')}
                                        {/if}
                                    </button>
                                </div>
                            </div>

                            {if $fileSiteMapData}
                                <div style="float: right;margin-top: -40px;margin-right: 60px;margin-bottom: 20px;margin-left: -50px;padding-left: 60px;width: 500px;">
                                    <a href="{echo site_url('admin/components/init_window/sitemap/sitemapDownload')}">{lang('Saved Site Map', 'sitemap')}</a> ( <b>{lang('Created at', 'sitemap')}:</b> {echo date('Y-m-d  H:i', $fileSiteMapData['time'])}, <b>{lang('Size', 'sitemap')}:</b> {echo number_format($fileSiteMapData['size']/1024, 2)} {lang('Kb', 'sitemap')} )
                                </div>
                            {else:}
                                <div style="float: right;margin-top: -40px;margin-right: 60px;margin-bottom: 20px;margin-left: -50px;padding-left: 60px;width: 500px;">
                                    <span class="help-block">{lang('There is no saved Site Map.', 'sitemap')}</span>
                                </div>
                            {/if}

                            <div class="control-group">
                                <label class="control-label" for="comcount">{lang("Turn ON/OFF robots", 'sitemap')}:</label>
                                <div class="controls number">
                                    <select name="settings[robotsStatus]">
                                        <option value="1" {if $settings.robotsStatus}selected="selected"{/if}>{lang('ON', 'sitemap')}</option>
                                        <option value="0" {if !$settings.robotsStatus}selected="selected"{/if}>{lang('OFF', 'sitemap')}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="comcount">{lang("Send Site Map", 'sitemap')}:</label>
                                <div class="controls number">
                                    <select name="settings[sendSiteMap]">
                                        <option value="0" {if !$settings.sendSiteMap}selected="selected"{/if}>{lang('No', 'sitemap')}</option>
                                        <option value="1" {if $settings.sendSiteMap}selected="checked"{/if}>{lang('Yes', 'sitemap')}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="comcount">{lang("Send Site Map only when url is changed", 'sitemap')}:</label>
                                <div class="controls number">
                                    <select name="settings[sendWhenUrlChanged]">
                                        <option value="0" {if !$settings.sendWhenUrlChanged}selected="selected"{/if}>{lang('No', 'sitemap')}</option>
                                        <option value="1" {if $settings.sendWhenUrlChanged}selected="checked"{/if}>{lang('Yes', 'sitemap')}</option>
                                    </select>
                                </div>
                            </div>

                            {if $settings.lastSend}
                                <div class="control-group">
                                    <label class="control-label" for="comcount">{lang("Last send Site Map time", 'sitemap')}:</label>
                                    <div class="controls number">
                                        <input type="text" readonly="readonly" value="{echo date('Y-m-d  H:i:s', $settings.lastSend)}">
                                        <input type="hidden" name="settings[lastSend]" value="{echo $settings.lastSend}">
                                    </div>
                                </div>
                            {/if}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        {form_csrf()}
    </form>
</section>