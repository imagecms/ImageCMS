<section class="mini-layout adminSitemap">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Site Map", 'sitemap')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'admin')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#sitemap_changefreq_form" data-submit><i class="icon-ok icon-white"></i>{lang("Save", 'sitemap')}</button>
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
    <form action="/admin/components/cp/sitemap/changefreq" id="sitemap_changefreq_form" method="post" class="form-horizontal m-t_10">
        <table class="table  table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th>{lang("Сhange frequency", 'sitemap')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="inside_padd">
                            <div class="control-group">
                                <label class="control-label">{lang("Main page", 'sitemap')}:</label>
                                <div class="controls">
                                    {form_dropdown('main_page_changefreq', $changefreq_options, $main_page_changefreq)}
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="sppri">{lang("Regular or usual pages", 'sitemap')}:</label>
                                <div class="controls">
                                    {form_dropdown('pages_changefreq', $changefreq_options, $pages_changefreq)}
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">{lang("Categories pages", 'sitemap')}:</label>
                                <div class="controls">
                                    {form_dropdown('categories_changefreq', $changefreq_options, $categories_changefreq)}
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="sppri">{lang('Sub categories pages', 'sitemap')}:</label>
                                <div class="controls">
                                    {form_dropdown('sub_categories_changefreq', $changefreq_options, $sub_categories_changefreq)}
                                </div>
                            </div>

                            {if SHOP_INSTALLED}

                                <div class="control-group">
                                    <label class="control-label" for="sppri">{lang('Products page', 'sitemap')}:</label>
                                    <div class="controls">
                                        {form_dropdown('product_changefreq', $changefreq_options, $product_changefreq)}
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">{lang("Products categories pages", 'sitemap')}:</label>
                                    <div class="controls">
                                        {form_dropdown('products_categories_changefreq', $changefreq_options, $products_categories_changefreq)}
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">{lang("Products sub categories pages", 'sitemap')}:</label>
                                    <div class="controls">
                                        {form_dropdown('products_sub_categories_changefreq', $changefreq_options, $products_sub_categories_changefreq)}
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="sppri">{lang('Brands pages', 'sitemap')}:</label>
                                    <div class="controls">
                                        {form_dropdown('brands_changefreq', $changefreq_options, $brands_changefreq)}
                                    </div>
                                </div>
                            {/if}
                            <div class="control-group">
                                <span class="control-label">&nbsp;</span>
                                <div class="controls">
                                    <a class="btn btn-default" href="{site_url('sitemap.xml')}" target="_blank">{lang("View code", 'sitemap')}</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        {form_csrf()}
    </form>
</section>