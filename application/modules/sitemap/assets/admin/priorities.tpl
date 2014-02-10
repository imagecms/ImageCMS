<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Site Map", 'sitemap')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'sitemap')}</span></a>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#sitemap_priorities_form" data-submit><i class="icon-ok"></i>{lang("Save", 'sitemap')}</button>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#sitemap_priorities_form" data-action="show_sitemap" data-submit><i class="icon-share"></i>{lang("Save and view", 'sitemap')}</button>
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
    <form action="/admin/components/cp/sitemap/priorities" id="sitemap_priorities_form" method="post" class="form-horizontal">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th>{lang("Priorities", 'sitemap')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="inside_padd span9">
                            <div class="control-group">
                                <label class="control-label" for="comcount">{lang("Main page", 'sitemap')}:</label>
                                <div class="controls number">
                                    <input type="text" id="comcount" name="main_page_priority" value="{$main_page_priority}" />
                                    <span class="help-block">{lang('Value must be in range from 0.1(not important) to 1(important)', 'sitemap')}</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="sppri">{lang("Regular or usual pages", 'sitemap')}:</label>
                                <div class="controls number">
                                    <input type="text" id="sppri" name="pages_priority" value="{$pages_priority}" />
                                    <span class="help-block">{lang('Value must be in range from 0.1(not important) to 1(important)', 'sitemap')}</span>
                                </div>
                            </div>  

                            <div class="control-group">
                                <label class="control-label" for="symcount">{lang("Categories", 'sitemap')}:</label>
                                <div class="controls number">
                                    <input type="text" id="symcount" name="cats_priority" value="{$cats_priority}" />
                                    <span class="help-block">{lang('Value must be in range from 0.1(not important) to 1(important)', 'sitemap')}</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="subcat">{lang("Sub categories", 'sitemap')}:</label>
                                <div class="controls number">
                                    <input type="text" id="subcat" name="sub_cats_priority" value="{$sub_cats_priority}" />
                                    <span class="help-block">{lang('Value must be in range from 0.1(not important) to 1(important)', 'sitemap')}</span>
                                </div>
                            </div>

                            {if SHOP_INSTALLED}
                                <div class="control-group">
                                    <label class="control-label" for="products_categories_pr">{lang("Products categories", 'sitemap')}:</label>
                                    <div class="controls number">
                                        <input type="text" id="products_categories_pr" name="products_categories_priority" value="{$products_categories_priority}" />
                                        <span class="help-block">{lang('Value must be in range from 0.1(not important) to 1(important)', 'sitemap')}</span>
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <label class="control-label" for="products_sub_categories_pr">{lang("Products sub-categories", 'sitemap')}:</label>
                                    <div class="controls number">
                                        <input type="text" id="products_sub_categories_pr" name="products_sub_categories_priority" value="{$products_sub_categories_priority}" />
                                        <span class="help-block">{lang('Value must be in range from 0.1(not important) to 1(important)', 'sitemap')}</span>
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <label class="control-label" for="products_pr">{lang("Products", 'sitemap')}:</label>
                                    <div class="controls number">
                                        <input type="text" id="products_pr" name="products_priority" value="{$products_priority}" />
                                        <span class="help-block">{lang('Value must be in range from 0.1(not important) to 1(important)', 'sitemap')}</span>
                                    </div>
                                </div> 

                                <div class="control-group">
                                    <label class="control-label" for="brands_pr">{lang("Brands", 'sitemap')}:</label>
                                    <div class="controls number">
                                        <input type="text" id="brands_pr" name="brands_priority" value="{$brands_priority}" />
                                        <span class="help-block">{lang('Value must be in range from 0.1(not important) to 1(important)', 'sitemap')}</span>
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