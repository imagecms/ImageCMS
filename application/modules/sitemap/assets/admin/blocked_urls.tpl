<section class="mini-layout adminSitemap">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Site Map", 'sitemap')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#sitemap_blockedUrls_form" data-submit><i class="icon-ok icon-white"></i>{lang("Save", 'sitemap')}</button>
                <div class="p_r d-i_b v-a_m">
                    <button type="button" class="btn btn-small btn-info dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-list"></i>
                        {lang('Others', 'sitemap')}<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="right:0;left:auto;">
                        <li><a style="text-decoration: none" class="" href="/admin/components/init_window/sitemap/priorities">{lang('Priorities', 'sitemap')}</a></li>
                        <li><a style="text-decoration: none" class="" href="/admin/components/init_window/sitemap/changefreq">{lang('Change frequency', 'sitemap')}</a></li>
                        <li><a style="text-decoration: none" class="" href="/admin/components/init_window/sitemap/blockedUrls">{lang('Block urls', 'sitemap')}</a></li>
                        <li class="divider"></li>
                        <li><a style="text-decoration: none" href="{site_url('sitemap.xml')}" target="_blank">{lang("View Site Map", 'sitemap')}</a></li>
                        <li class="divider"></li>
                        <li><a style="text-decoration: none" class="" href="/admin/components/init_window/sitemap/settings">{lang('Settings', 'sitemap')}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form action="/admin/components/cp/sitemap/blockedUrls" id="sitemap_blockedUrls_form" method="post" class="form-horizontal m-t_10">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th>{lang('Do not show on Site Map', 'sitemap')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <br/>
                        <div class="control-group">
                            <label class="control-label">
                                <span data-title="{lang('Example:', 'sitemap')}" class="popover_ref" data-original-title="">
                                    <i class="icon-info-sign" style="margin-left: -20px"></i>
                                    URL:
                                </span>
                                <div class="d_n">
                                    <b><span class='s-t'>{site_url()}</span>shop/product/123</b> - {lang('will blocked this url', 'sitemap')}<br/>
                                    <b><span class='s-t'>{site_url()}</span>shop/product*</b> - {lang('blocked all urls than starts with', 'sitemap')} shop/product<br/>
                                    <b><span class='s-t'>{site_url()}</span>*shop/product</b> - {lang('blocked all urls than ends with', 'sitemap')} shop/product<br/>
                                </div>
                            </label>
                            <div class="controls">
                                <div class="input-prepend span7">
                                    <span class="add-on" style="height: 17px;">{site_url()}</span>
                                    <input id="hide_url" onkeypress="var keycode = (event.keyCode ? event.keyCode : event.which);
                                            if (keycode == '13')
                                                SiteMap.addHidenUrl($(this));" class="span5 m-r_15" type="text" >

                                </div>
                            </div>
                            <div class="controls m-t_15">
                                <button type="button" onclick="SiteMap.addHidenUrl($(this))" class="btn btn-small"><i class="icon-plus"></i> {lang("Add", 'sitemap')}</button>
                            </div>
                        </div>
                        <div class="control-group addHidenUrlClone" style="display: none;">
                            <label class="control-label">URL:</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on" style="height: 17px;">{site_url()}</span>
                                    <input class="hide_url m-r_15" type="text">
                                    <button type="button" onclick="SiteMap.removeHidenUrl($(this))" class="btn btn-small btn-default"><i class="icon-trash"></i></button>
                                </div>
                            </div>
                        </div>

                        {if $hide_urls}
                            {foreach $hide_urls as $key => $url}
                                <div class="control-group">
                                    <label class="control-label">URL:</label>
                                    <div class="controls">
                                        <div class="input-prepend">
                                            <span class="add-on" style="height: 17px;">{site_url()}</span>
                                            <input class="hide_url m-r_15" name="hide_urls[]" type="text" value="{echo $url['url']}">
                                            <button type="button" onclick="SiteMap.removeHidenUrl($(this))" class="btn btn-small btn-default"><i class="icon-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            {/foreach}
                        {/if}
                    </td>
                </tr>
            </tbody>
        </table>
        {form_csrf()}
    </form>
</section>