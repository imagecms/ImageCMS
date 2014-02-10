<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Site Map", 'sitemap')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'sitemap')}</span></a>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#sitemap_blockedUrls_form" data-submit><i class="icon-ok"></i>{lang("Save", 'sitemap')}</button>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#sitemap_blockedUrls_form" data-action="show_sitemap" data-submit><i class="icon-share"></i>{lang("Save and view", 'sitemap')}</button>
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
    <form action="/admin/components/cp/sitemap/blockedUrls" id="sitemap_blockedUrls_form" method="post" class="form-horizontal">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th>{lang('Do not show on Site Map', 'sitemap')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <br>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on" style="height: 17px;">{site_url()}</span>
                                    <input id="hide_url" onkeypress="var keycode = (event.keyCode ? event.keyCode : event.which);
                                            if (keycode == '13')
                                                SiteMap.addHidenUrl($(this));" class="span2" type="text" >
                                    <button type="button" onclick="SiteMap.addHidenUrl($(this))" class="btn btn-small btn-success"><i class="icon-plus"></i>{lang("Add", 'sitemap')}</button>
                                </div>
                                <span class="help-block"><b>{lang('Example:', 'sitemap')}</b></span>
                                <span class="help-block">- {lang('shop/product/1 - will blocked this url', 'sitemap')}</span>
                                <span class="help-block">- {lang('shop/product* - blocked all urls than starts with: shop/product', 'sitemap')}</span>
                                <span class="help-block">- {lang('*shop/product - blocked all urls than ends with: shop/product', 'sitemap')}</span>
                            </div> 
                        </div>
                        <br>
                        <div class="control-group addHidenUrlClone" style="display: none;">
                            <label class="control-label" for="url">Url</label>
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on" style="height: 17px;">{site_url()}</span>
                                    <input class="hide_url" class="span2" type="text" style="width: 335px;">
                                </div>
                            </div> 
                        </div>

                        {if $hide_urls}
                            {foreach $hide_urls as $url}
                                <div class="control-group">
                                    <label class="control-label" for="url">Url</label>
                                    <div class="controls">
                                        <div class="input-prepend">
                                            <span class="add-on" style="height: 17px;">{site_url()}</span>
                                            <input class="hide_url span2" name="hide_urls[]" type="text" value="{echo $url['url']}" style="width: 335px;">
                                            <button type="button" onclick="SiteMap.removeHidenUrl($(this))" class="btn btn-small btn-danger"><i class="icon-remove"></i>{lang("Remove", 'sitemap')}</button>
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