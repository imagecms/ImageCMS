<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('SEO expert','mod_seo')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$ADMIN_URL}/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back','mod_seo')}</span></a>
                <button onclick="" type="button" class="btn btn-small btn-primary formSubmit submitButton" data-form="#createDiscountForm" data-submit>
                    <i class="icon-ok icon-white"></i>{lang('Save','mod_seo')}
                </button>
                {echo create_language_select($languages, $locale, "/admin/components/init_window/mod_seo/index")}
            </div>
        </div>
    </div>
    <form method="post" action="/admin/components/init_window/mod_seo/save/{$locale}" enctype="multipart/form-data" id="createDiscountForm">
        <div class="clearfix">
            <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                <a href="#base" class="btn btn-small active">{lang('Base','mod_seo')}</a>
                {if SHOP_INSTALLED}
                    <a href="#shop" class="btn btn-small">{lang('Shop','mod_seo')}</a>
                {/if}
                <a href="#content" class="btn btn-small">{lang('Content','mod_seo')}</a>
                {$exernalTabs->renderTabsButtons()}
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="base">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('Meta tags',"mod_seo")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="form-horizontal">
                                        <div class="row-fluid">

                                            <div class="control-group m-t_10">
                                                <label class="control-label">{lang('Site name',"admin")}:</label>
                                                <div class="controls">
                                                    <div>
                                                        <span class="frame_label no_connection m-r_15">
                                                            <span class="niceRadio b_n">
                                                                <input type="radio" {if $baseSettings['add_site_name'] == "1"}checked="checked"{/if} name="base[add_site_name]" value="1"/>
                                                            </span>
                                                            {lang('Yes',"admin")}
                                                        </span>
                                                        <span class="frame_label no_connection">
                                                            <span class="niceRadio b_n">
                                                                <input type="radio" {if $baseSettings['add_site_name'] == "0"}checked="checked"{/if} name="base[add_site_name]" value="0"/>
                                                            </span>
                                                            {lang('No',"admin")}
                                                        </span>
                                                    </div>
                                                    <span class="help-block s-t">
                                                        {lang('Whether to display the site name in the title page','mod_seo')}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="add_site_name_to_cat">{lang('Add the name of the category page',"mod_seo")}:</label>
                                                <div class="controls">
                                                    <div>
                                                        <span class="frame_label no_connection m-r_15">
                                                            <span class="niceRadio b_n">
                                                                <input type="radio" {if $baseSettings['add_site_name_to_cat'] == "1"}checked="checked"{/if} name="base[add_site_name_to_cat]" value="1"/>
                                                            </span>
                                                            {lang('Yes',"admin")}
                                                        </span>
                                                        <span class="frame_label no_connection">
                                                            <span class="niceRadio b_n">
                                                                <input type="radio" {if $baseSettings['add_site_name_to_cat'] == "0"}checked="checked"{/if} name="base[add_site_name_to_cat]" value="0"/>
                                                            </span>
                                                            {lang('No',"admin")}
                                                        </span>
                                                    </div>
                                                    <span class="help-block s-t">
                                                        {lang('Will added the category name in the page title page','mod_seo')}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="delimiter">{lang('Separator',"mod_seo")}:</label>
                                                <div class="controls">
                                                    <input class="span4" type="text" id="delimiter" value="{$baseSettings['delimiter']}" name="base[delimiter]" class="textbox_long" style="width:80px;" />
                                                </div>
                                            </div>

                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="create_keywords">{lang('Meta Keywords',"admin")}:</label>
                                                <div class="controls">
                                                    <select name="base[create_keywords]" id="create_keywords">
                                                        <option value="auto" {if $baseSettings['create_keywords'] == "auto"}selected="selected"{/if}>{lang('Auto formation',"admin")}</option>
                                                        <option value="empty" {if $baseSettings['create_keywords'] == "empty"}selected="selected"{/if}>{lang('Leave empty',"admin")}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="create_description">{lang('Meta Description',"admin")}:</label>
                                                <div class="controls">
                                                    <select name="base[create_description]" id="create_description">
                                                        <option value="auto" {if $baseSettings['create_description'] == "auto"}selected="selected"{/if}>{lang('Auto formation',"admin")}</option>
                                                        <option value="empty" {if $baseSettings['create_description'] == "empty"}selected="selected"{/if}>{lang('Leave empty',"admin")}</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('Enter Meta Tags','admin')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="form-horizontal">
                                        <div class="lan" >
                                            <div class="row-fluid">
                                                <div class="control-group m-t_10">
                                                    <label class="control-label" for="titleNa">{lang('Site name', 'admin')}:</label>
                                                    <div class="controls">
                                                        <input class="span4" type="text" id="titleNa" name="base[name]" value="{echo $baseSettings['name']}" />
                                                    </div>
                                                </div>

                                                <div class="control-group m-t_10">
                                                    <label class="control-label" for="short_titleS">{lang('Short site name', 'admin')}:</label>
                                                    <div class="controls">
                                                        <input class="span4" type="text" id="short_titleS" name="base[short_name]" value="{echo $baseSettings['short_name']}" />
                                                    </div>
                                                </div>

                                                <div class="control-group m-t_10">
                                                    <label class="control-label" for="descriptionN">{lang('Description', 'admin')}:</label>
                                                    <div class="controls">
                                                        <input class="span4" type="text" id="descriptionN" name="base[description]" value="{echo $baseSettings['description']}" />
                                                    </div>
                                                </div>

                                                <div class="control-group m-t_10">
                                                    <label class="control-label" for="keywordsss">{lang('Keywords', 'admin')}:</label>
                                                    <div class="controls">
                                                        <input class="span4" type="text" id="keywordsss" name="base[keywords]" value="{echo $baseSettings['keywords']}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {form_csrf()}
            </div>
            <div class="tab-pane" id="shop">

                <div class="row">
                    <div class="span3 m-t_10">
                        <ul class="nav myTab nav-tabs nav-stacked">
                            <li class="active"><a href="#product_page">{lang('Product page','mod_seo')}</a></li>
                            <li><a href="#categories">{lang('Category','mod_seo')}</a></li>
                            <li><a href="#sub_categories">{lang('Subcategory','mod_seo')}</a></li>
                            <li><a href="#brands">{lang('Brands','mod_seo')}</a></li>
                            <li><a href="#brands_list">{lang('Brands list' , 'mod_seo')}</a></li>
                            <li><a href="#search">{lang('Search' , 'mod_seo')}</a></li>
                            <li><a href="#bestsellers">{lang('All hits, actions, hots' , 'mod_seo')}</a></li>
                            <li><a href="#all_actions">{lang('All actions' , 'mod_seo')}</a></li>
                            <li><a href="#all_hots">{lang('All hots' , 'mod_seo')}</a></li>
                            <li><a href="#all_hits">{lang('All hits' , 'mod_seo')}</a></li>
                        </ul>
                    </div>
                    <div class="span9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="product_page">
                                 {include_tpl('include/product_page.tpl')}
                            </div>
                            <div class="tab-pane" id="categories">
                                {include_tpl('include/categories.tpl')}
                            </div>
                            <div class="tab-pane" id="sub_categories">
                                {include_tpl('include/sub_categories.tpl')}
                            </div>
                            <div class="tab-pane" id="brands">
                                {include_tpl('include/brands.tpl')}
                            </div>
                            <div class="tab-pane" id="brands_list">
                                {include_tpl('include/table_brands_list.tpl')}
                            </div>
                            <div class="tab-pane" id="search">
                                {include_tpl('include/search.tpl')}
                            </div>

                            <!------------ Actions , Hist , Hot ------------------------------------------------------->
                            <div class="tab-pane" id="bestsellers">
                                {include_tpl('include/bestseller.tpl')}
                            </div>

                            <div class="tab-pane" id="all_actions">
                                {include_tpl('include/actions.tpl')}
                            </div>

                            <div class="tab-pane" id="all_hots">
                                {include_tpl('include/hots.tpl')}
                            </div>

                            <div class="tab-pane" id="all_hits">
                                {include_tpl('include/hits.tpl')}
                            </div>
                            <!------------------- END  ---------------------------------------------------------------->
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="content">
                <div class="row">
                    <div class="span3 m-t_10">
                        <ul class="nav myTab nav-tabs nav-stacked">
                            <li class="active"><a href="#pages">{lang('Page','mod_seo')}</a></li>
                            <li><a href="#categories_pages">{lang('Page Category','mod_seo')}</a></li>
                            <li><a href="#gallery">{lang('Gallery' , 'mod_seo')}</a></li>
                            <li><a href="#gallery_category">{lang('Gallery category' , 'mod_seo')}</a></li>
                            <li><a href="#gallery_album">{lang('Gallery album' , 'mod_seo')}</a></li>
                        </ul>
                    </div>
                    <div class="span9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="pages">
                                {include_tpl('include/pages.tpl')}
                            </div>
                            <div class="tab-pane" id="categories_pages">
                                {include_tpl('include/categories_pages.tpl')}
                            </div>
                            <div class="tab-pane" id="gallery">
                                {include_tpl('include/gallery.tpl')}
                            </div>
                            <div class="tab-pane" id="gallery_category">
                                {include_tpl('include/gallery_category.tpl')}
                            </div>
                            <div class="tab-pane" id="gallery_album">
                                {include_tpl('include/gallery_album.tpl')}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            {/* additions */}

            {$exernalTabs->renderTabsContent()}
        </div>
    </form>
</section>