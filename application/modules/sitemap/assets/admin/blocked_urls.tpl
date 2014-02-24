<section class="mini-layout adminSitemap">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Site Map", 'sitemap')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/sitemap/priorities" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'sitemap')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#sitemap_blockedUrls_form" data-submit><i class="icon-ok icon-white"></i>{lang("Save", 'sitemap')}</button>
                <div class="p_r d-i_b v-a_m">
                    <button type="button" class="btn btn-small btn-info dropdown-toggle" data-toggle="dropdown">
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
                </div>
            </div>
        </div>                            
    </div>
    <form action="/admin/components/cp/sitemap/blockedUrls" id="sitemap_blockedUrls_form" method="post" class="form-horizontal">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th>{lang('Do not show on Site Map', 'sitemap')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <br/>
                        <div class="control-group">
                            <div class="controls">
                                <button type="button" class="icon-info-sign" data-toggle="popover" data-placement="right" data-title="{lang('Example:', 'sitemap')}" data-content="
                                        <span class='s-t'>{site_url()}</span>shop/product/123 - {lang('will blocked this url', 'sitemap')}<br/>
                                        <span class='s-t'>{site_url()}</span>shop/product*/123 - {lang('blocked all urls than starts with', 'sitemap')} shop/product<br/>
                                        <span class='s-t'>{site_url()}</span>*shop/product - {lang('blocked all urls than ends with', 'sitemap')} shop/product"
                                        ></button>
                                <div class="input-prepend">
                                    <span class="add-on" style="height: 17px;">{site_url()}</span>
                                    <input id="hide_url" onkeypress="var keycode = (event.keyCode ? event.keyCode : event.which);
                                            if (keycode == '13')
                                                SiteMap.addHidenUrl($(this));" class="span2" type="text" >
                                    <button type="button" onclick="SiteMap.addHidenUrl($(this))" class="btn btn-small btn-success"><i class="icon-plus icon-white"></i> {lang("Add", 'sitemap')}</button>
                                </div>
                            </div> 
                        </div>
                        <div class="control-group addHidenUrlClone" style="display: none;">
                            <label class="control-label">URL:</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on" style="height: 17px;">{site_url()}</span>
                                    <input class="hide_url" class="span2" type="text">
                                    <button type="button" onclick="SiteMap.removeHidenUrl($(this))" class="btn btn-small btn-default"><i class="icon-trash"></i></button>
                                </div>
                                <div>
                                    <span class="frame_label no_connection">
                                        <span class="niceCheck b_n"> 
                                            <input type="checkbox" class="robots_check" {if $url['robots_check']}checked="checked"{/if}>
                                        </span>
                                        <span>{lang('Add to robots', 'sitemap')}</span>
                                    </span>
                                </div> 
                            </div> 
                            <div class="control-group">
                                <span class="control-label">&nbsp;</span>
                                <div class="controls">
                                    <a class="btn btn-default" href="{site_url('sitemap.xml')}" target="_blank">{lang("Просмотреть код", 'sitemap')}</a>
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
                                            <input class="hide_url span2" name="hide_urls[]" type="text" value="{echo $url['url']}">
                                            <button type="button" onclick="SiteMap.removeHidenUrl($(this))" class="btn btn-small btn-default"><i class="icon-trash"></i></button>
                                        </div>
                                        <div>
                                            <span class="frame_label no_connection">
                                                <span class="niceCheck b_n"> 
                                                    <input type="checkbox" class="robots_check" name="robots_check[{echo ++$key}]" {if $url['robots_check']}checked="checked"{/if}>
                                                </span>
                                                <span>{lang('Add to robots', 'sitemap')}</span>
                                            </span>
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