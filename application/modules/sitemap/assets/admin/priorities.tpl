<section class="mini-layout adminSitemap" id="sitemapPriorities">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Site Map", 'sitemap')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'admin')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#sitemap_priorities_form" data-submit><i class="icon-ok icon-white"></i>{lang("Save", 'sitemap')}</button>
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
    <form action="/admin/components/cp/sitemap/priorities" id="sitemap_priorities_form" method="post" class="form-horizontal">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th>{lang("Priorities", 'sitemap')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="inside_padd span9">
                            <div class="control-group control-frame-group">
                                <label class="control-label">{lang("Main page", 'sitemap')}:</label>
                                <div class="controls">
                                    <div class="star">
                                        <div class="frameRate star-big">
                                            <div class="for_comment" style="width: {echo $main_page_priority * 100}%">
                                                <i>{echo $main_page_priority}</i>
                                            </div>
                                            <input name="main_page_priority" type="hidden" value="{echo $main_page_priority}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group control-frame-group">
                                <label class="control-label">{lang("Regular or usual pages", 'sitemap')}:</label>
                                <div class="controls">
                                    <div class="star">
                                        <div class="frameRate star-big">
                                            <div class="for_comment" style="width: {echo $pages_priority * 100}%">
                                                <i>{echo $pages_priority}</i>
                                            </div>
                                            <input name="pages_priority" type="hidden" value="{echo $pages_priority}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>  

                            <div class="control-group">
                                <label class="control-label">{lang("Categories pages", 'sitemap')}:</label>
                                <div class="controls">
                                    <div class="star">
                                        <div class="frameRate star-big">
                                            <div class="for_comment" style="width: {echo $cats_priority * 100}%">
                                                <i>{echo $cats_priority}</i>
                                            </div>
                                            <input name="cats_priority" type="hidden" value="{echo $cats_priority}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group control-frame-group">
                                <label class="control-label">{lang("Subcategories pages", 'sitemap')}:</label>
                                <div class="controls">
                                    <div class="star">
                                        <div class="frameRate star-big">
                                            <div class="for_comment" style="width: {echo $sub_cats_priority * 100}%">
                                                <i>{echo $sub_cats_priority}</i>
                                            </div>
                                            <input name="sub_cats_priority" type="hidden" value="{echo $sub_cats_priority}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {if SHOP_INSTALLED}
                                <div class="control-group">
                                    <label class="control-label">{lang("Products categories pages", 'sitemap')}:</label>
                                    <div class="controls">
                                        <div class="star">
                                            <div class="frameRate star-big">
                                                <div class="for_comment" style="width: {echo $products_categories_priority * 100}%">
                                                    <i>{echo $products_categories_priority}</i>
                                                </div>
                                                <input name="products_categories_priority" type="hidden" value="{echo $products_categories_priority}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="control-group control-frame-group">
                                    <label class="control-label">{lang("Products subcategories pages", 'sitemap')}:</label>
                                    <div class="controls">
                                        <div class="star">
                                            <div class="frameRate star-big">
                                                <div class="for_comment" style="width: {echo $products_sub_categories_priority * 100}%">
                                                    <i>{echo $products_sub_categories_priority}</i>
                                                </div>
                                                <input name="products_sub_categories_priority" type="hidden" value="{echo $products_sub_categories_priority}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="control-group control-frame-group">
                                    <label class="control-label">{lang("Products pages", 'sitemap')}:</label>
                                    <div class="controls">
                                        <div class="star">
                                            <div class="frameRate star-big">
                                                <div class="for_comment" style="width: {echo $products_priority * 100}%">
                                                    <i>{echo $products_priority}</i>
                                                </div>
                                                <input name="products_priority" type="hidden" value="{echo $products_priority}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="control-group control-frame-group">
                                    <label class="control-label">{lang("Brands pages", 'sitemap')}:</label>
                                    <div class="controls">
                                        <div class="star">
                                            <div class="frameRate star-big">
                                                <div class="for_comment" style="width: {echo $brands_priority * 100}%">
                                                    <i>{echo $brands_priority}</i>
                                                </div>
                                                <input name="brands_priority" type="hidden" value="{echo $brands_priority}"/>
                                            </div>
                                        </div>
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