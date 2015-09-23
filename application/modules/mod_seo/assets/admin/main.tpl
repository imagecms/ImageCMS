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
                                                    <span class="help-block">
                                                        {lang('If not given or specified',"admin")}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="create_description">{lang('Meta Description',"admin")}:</label>
                                                <div class="controls">
                                                    <select name="base[create_description]" id="create_description">
                                                        <option value="auto" {if $baseSettings['create_description'] == "auto"}selected="selected"{/if}>{lang('Auto formation',"admin")}</option>
                                                        <option value="empty" {if $baseSettings['create_description'] == "empty"}selected="selected"{/if}>{lang('Leave empty',"admin")}</option>
                                                    </select>
                                                    <span class="help-block">
                                                        {lang('If not specified',"admin")}
                                                    </span>
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
                <table class="table  table-bordered table-condensed content_big_td module-cheep content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">{lang('Product page','mod_seo')} [{$locale}]</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd discount-out">
                                    <div class="form-horizontal">

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%ID%</b> - ID <br/>
                                                    <b>%name%</b> - {lang('Product name','mod_seo')}<br/>
                                                    <b>%category%</b> - {lang('Category, which is assigned to the product','mod_seo')}<br/>
                                                    <b>%brand%</b> - {lang('Brand, which is assigned to the product','mod_seo')}<br/>
                                                    <b>%price%</b> - {lang('Product price','mod_seo')}<br/>
                                                    <b>%CS%</b> - {lang('Main currency','mod_seo')}<br/>
                                                    <b>%p_xxxx%</b> - {lang('Displays the value of the property, instead of xxxx - id properties','mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with category name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                                                    {lang('Example','mod_seo')}:<br/>
                                                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                                                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                                                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                                                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                                                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                                                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                                                    <b>%name[1..6][t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-title:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='productTemplate'>{$settings.productTemplate}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%ID%</b> - {lang('Product ID','mod_seo')} <br/>
                                                    <b>%name%</b> - {lang('Product name','mod_seo')}<br/>
                                                    <b>%desc%</b> - {lang('Product description','mod_seo')}<br/>
                                                    <b>%category%</b> - {lang('Category, which is assigned to the product','mod_seo')}<br/>
                                                    <b>%brand%</b> - {lang('Brand, which is assigned to the product','mod_seo')}<br/>
                                                    <b>%price%</b> - {lang('Product price','mod_seo')}<br/>
                                                    <b>%CS%</b> - {lang('Main currency','mod_seo')}<br/>
                                                    <b>%p_xxxx%</b> - {lang('Displays the value of the property, instead of xxxx - id properties','mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with category name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                                                    {lang('Example','mod_seo')}:<br/>
                                                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                                                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                                                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                                                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                                                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                                                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                                                    <b>%name[1..6][t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-description:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='productTemplateDesc'>{$settings.productTemplateDesc}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                {lang('Description length','mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <input class="input-mini" maxlength="3" type="text" autocomplete="off" name='productTemplateDescCount' value="{$settings.productTemplateDescCount}" />
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%name%</b> - {lang('Product name','mod_seo')}<br/>
                                                    <b>%category%</b> - {lang('Category, which is assigned to the product','mod_seo')}<br/>
                                                    <b>%brand%</b> - {lang('Brand, which is assigned to the product','mod_seo')}<br/>
                                                    <b>%p_xxxx%</b> - {lang('Displays the value of the property, instead of xxxx - id properties','mod_seo')}<br/>
                                                </div>
                                                Meta-keywords:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='productTemplateKey'>{$settings.productTemplateKey}</textarea>
                                            </span>
                                        </label>
                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Active','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="useProductPattern" {if $settings.useProductPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Use only for empty metadata','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="useProductPatternForEmptyMeta"  {if $settings.useProductPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="clearfix">
                                            <span class="span4"></span>
                                            <div class="span5">
                                                <a href="/admin/components/init_window/mod_seo/productsCategories" class="t-d_n pjax btn btn-default">
                                                    {lang('Advanced','mod_seo')}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table  table-bordered table-condensed content_big_td module-cheep content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">{lang('Category','mod_seo')} [{$locale}]</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd discount-out">
                                    <div class="form-horizontal">
                                        <label class="control-group">
                                            <span class="span4">
                                                <span class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%ID%</b> - {lang('Category ID','mod_seo')}<br/>
                                                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                                                    <b>%desc%</b> - {lang('Category description','mod_seo')}<br/>
                                                    <b>%H1%</b> - {lang('field H1 of category','mod_seo')}<br/>
                                                    <b>%brands%</b> - {lang('list of the top brands, separated by ','mod_seo')}"," <br/>
                                                    <b>%pagenumber%</b> - {lang("Display on pagination pages template from field 'Unique pagination pages'",'mod_seo')}<br/>
                                                    <b>%maxPrice%</b> - {lang("Minimal price in category",'mod_seo')}<br/>
                                                    <b>%minPrice%</b> - {lang("Maximal price in category",'mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with category name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                                                    {lang('Example','mod_seo')}:<br/>
                                                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                                                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                                                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                                                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                                                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                                                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                                                    <b>%name[1..6][t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-title:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='categoryTemplate'>{$settings.categoryTemplate}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%ID%</b> - {lang('Category ID','mod_seo')}<br/>
                                                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                                                    <b>%desc%</b> - {lang('Category description','mod_seo')}<br/>
                                                    <b>%H1%</b> - {lang('field H1 of category','mod_seo')}<br/>
                                                    <b>%brands%</b> - {lang('list of the top brands, separated by ','mod_seo')}"," <br/>
                                                    <b>%pagenumber%</b> - {lang("Display on pagination pages template from field 'Unique pagination pages'",'mod_seo')}<br/>
                                                    <b>%maxPrice%</b> - {lang("Minimal price in category",'mod_seo')}<br/>
                                                    <b>%minPrice%</b> - {lang("Maximal price in category",'mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with category name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                                                    {lang('Example','mod_seo')}:<br/>
                                                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                                                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                                                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                                                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                                                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                                                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                                                    <b>%name[1..6][t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-description:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='categoryTemplateDesc'>{$settings.categoryTemplateDesc}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                {lang('Description length','mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <input class="input-mini" maxlength="3" type="text" autocomplete="off" name='categoryTemplateDescCount' value="{$settings.categoryTemplateDescCount}" />
                                            </span>
                                        </label>
                                        <label class="control-group">
                                            <span class="span4">
                                                {lang('Count of brands:','mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <input class="input-mini" maxlength="3" type="text" autocomplete="off" name='categoryTemplateBrandsCount' value="{$settings.categoryTemplateBrandsCount}" />
                                            </span>
                                        </label>
                                        <label class="control-group">
                                            <span class="span4">
                                                <span class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%ID%</b> - {lang('Category ID','mod_seo')}<br/>
                                                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                                                    <b>%desc%</b> - {lang('Category description','mod_seo')}<br/>
                                                    <b>%H1%</b> - {lang('field H1 of category','mod_seo')}<br/>
                                                    <b>%brands%</b> - {lang('list of the top brands, separated by ','mod_seo')}"," <br/>
                                                    <b>%pagenumber%</b> - {lang("Display on pagination pages template from field 'Unique pagination pages'",'mod_seo')}<br/>
                                                </div>
                                                Meta-keywords:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='categoryTemplateKey'>{$settings.categoryTemplateKey}</textarea>
                                            </span>
                                        </label>
                                        <label class="control-group">
                                            <span class="span4">
                                                <span class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%number%</b> - {lang('Page number','mod_seo')}<br/>
                                                </div>
                                                {lang('Unique pagination pages','mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='categoryTemplatePaginationTemplate'>{$settings.categoryTemplatePaginationTemplate}</textarea>
                                            </span>
                                        </label>
                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Active','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="useCategoryPattern"  {if $settings.useCategoryPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Use only for empty metadata','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="useCategoryPatternForEmptyMeta"  {if $settings.useCategoryPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table  table-bordered table-condensed content_big_td module-cheep content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">{lang('Subcategory','mod_seo')} [{$locale}]</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd discount-out">
                                    <div class="form-horizontal">
                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%ID%</b> - {lang('Category ID','mod_seo')}<br/>
                                                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                                                    <b>%desc%</b> - {lang('Category description','mod_seo')}<br/>
                                                    <b>%H1%</b> - {lang('field H1 of category','mod_seo')}<br/>
                                                    <b>%brands%</b> - {lang('list of the top brands, separated by ','mod_seo')}"," <br/>
                                                    <b>%pagenumber%</b> - {lang("Display on pagination pages template from field 'Unique pagination pages'",'mod_seo')}<br/>
                                                    <b>%maxPrice%</b> - {lang("Minimal price in category",'mod_seo')}<br/>
                                                    <b>%minPrice%</b> - {lang("Maximal price in category",'mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with category name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                                                    {lang('Example','mod_seo')}:<br/>
                                                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                                                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                                                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                                                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                                                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                                                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                                                    <b>%name[1..6][t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-title:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='subcategoryTemplate'>{$settings.subcategoryTemplate}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%ID%</b> - {lang('Category ID','mod_seo')}<br/>
                                                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                                                    <b>%desc%</b> - {lang('Category description','mod_seo')}<br/>
                                                    <b>%H1%</b> - {lang('field H1 of category','mod_seo')}<br/>
                                                    <b>%brands%</b> - {lang('list of the top brands, separated by ','mod_seo')}"," <br/>
                                                    <b>%pagenumber%</b> - {lang("Display on pagination pages template from field 'Unique pagination pages'",'mod_seo')}<br/>
                                                    <b>%maxPrice%</b> - {lang("Minimal price in category",'mod_seo')}<br/>
                                                    <b>%minPrice%</b> - {lang("Maximal price in category",'mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with category name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                                                    {lang('Example','mod_seo')}:<br/>
                                                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                                                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                                                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                                                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                                                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                                                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                                                    <b>%name[1..6][t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-description:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='subcategoryTemplateDesc'>{$settings.subcategoryTemplateDesc}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                {lang('Description length','mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <input class="input-mini" maxlength="3" type="text" autocomplete="off" name='subcategoryTemplateDescCount' value="{$settings.subcategoryTemplateDescCount}" />
                                            </span>
                                        </label>
                                        <label class="control-group">
                                            <span class="span4">
                                                {lang('Count of brands:','mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <input class="input-mini" maxlength="3" type="text" autocomplete="off" name='subcategoryTemplateBrandsCount' value="{$settings.subcategoryTemplateBrandsCount}" />
                                            </span>
                                        </label>
                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%ID%</b> - {lang('Category ID','mod_seo')}<br/>
                                                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                                                    <b>%desc%</b> - {lang('Category description','mod_seo')}<br/>
                                                    <b>%H1%</b> - {lang('field H1 of category','mod_seo')}<br/>
                                                    <b>%brands%</b> - {lang('list of the top brands, separated by ','mod_seo')}"," <br/>
                                                    <b>%pagenumber%</b> - {lang("Display on pagination pages template from field 'Unique pagination pages'",'mod_seo')}<br/>
                                                </div>
                                                Meta-keywords:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='subcategoryTemplateKey'>{$settings.subcategoryTemplateKey}</textarea>
                                            </span>
                                        </label>
                                        <label class="control-group">
                                            <span class="span4">
                                                <span class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%number%</b> - {lang('Page number','mod_seo')}<br/>
                                                </div>
                                                {lang('Unique pagination pages','mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='subcategoryTemplatePaginationTemplate'>{$settings.subcategoryTemplatePaginationTemplate}</textarea>
                                            </span>
                                        </label>
                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Active','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="usesubcategoryPattern"  {if $settings.usesubcategoryPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Use only for empty metadata','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="usesubcategoryPatternForEmptyMeta"  {if $settings.usesubcategoryPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table  table-bordered table-condensed content_big_td module-cheep content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">{lang('Brands','mod_seo')} [{$locale}]</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd discount-out">
                                    <div class="form-horizontal">
                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%ID%</b> - {lang('Brand ID','mod_seo')} <br/>
                                                    <b>%name%</b> - {lang('Brand name','mod_seo')}<br/>
                                                    <b>%desc%</b> - {lang('Brand description','mod_seo')}<br/>
                                                    <b>%pagenumber%</b> - {lang("Display on pagination pages template from field 'Unique pagination pages'",'mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with category name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>%name[t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-title:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='brandTemplate'>{$settings.brandTemplate}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%ID%</b> - {lang('Brand ID','mod_seo')} <br/>
                                                    <b>%name%</b> - {lang('Brand name','mod_seo')}<br/>
                                                    <b>%desc%</b> - {lang('Brand description','mod_seo')}<br/>
                                                    <b>%pagenumber%</b> - {lang("Display on pagination pages template from field 'Unique pagination pages'",'mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with category name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>%name[t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-description:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='brandTemplateDesc'>{$settings.brandTemplateDesc}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                <span class="popover_ref" data-original-title="" data-title="{lang('Variables, can use to', 'mod_seo')}:">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%number%</b> - {lang('Page number','mod_seo')}<br/>
                                                </div>
                                                {lang('Unique pagination pages','mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='brandPaginationTemplate'>{$settings.brandPaginationTemplate}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                {lang('Description length','mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <input class="input-mini" maxlength="3" type="text" autocomplete="off" name='brandTemplateDescCount' value="{$settings.brandTemplateDescCount}" />
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>

                                                <div class="d_n">
                                                    <b>%name%</b> - {lang('Brand name','mod_seo')}<br/>
                                                    <b>%pagenumber%</b> - {lang("Display on pagination pages template from field 'Unique pagination pages'",'mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with category name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>%name[t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                {lang('Meta-keywords', 'mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='brandTemplateKey'>{$settings.brandTemplateKey}</textarea>
                                            </span>
                                        </label>

                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Active','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="useBrandPattern" {if $settings.useBrandPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Use only for empty metadata','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="useBrandPatternForEmptyMeta" {if $settings.useBrandPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                {include_tpl('table_brands_list.tpl')}

                <table class="table  table-bordered table-condensed content_big_td module-cheep content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">{lang('Search', 'mod_seo')} [{$locale}]</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd discount-out">
                                    <div class="form-horizontal">
                                        <label class="control-group">
                                            <span class="span4">
                                                Meta-title:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='searchTemplate'>{$settings.searchTemplate}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                Meta-description:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='searchTemplateDesc'>{$settings.searchTemplateDesc}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                Meta-keywords:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='searchTemplateKey'>{$settings.searchTemplateKey}</textarea>
                                            </span>
                                        </label>

                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Active','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="useSearchPattern" {if $settings.useSearchPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {/* additions */}
            <div class="tab-pane" id="content">
                {/*
////////////////////////////////////////////////////////////////////////////////
*/}
                <table class="table  table-bordered table-condensed content_big_td module-cheep content_big_td">

                    <thead>
                        <tr>
                            <th colspan="6">{lang('Page','mod_seo')} [{$locale}]</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd discount-out">
                                    <div class="form-horizontal">

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%name%</b> - {lang('Page name','mod_seo')}<br/>
                                                    <b>%category%</b> - {lang('Category, which is assigned to the page','mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with page name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                                                    {lang('Example','mod_seo')}:<br/>
                                                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                                                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                                                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                                                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                                                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                                                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                                                    <b>%name[1..6][t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-title:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='pageTemplateTitle'>{$settings.pageTemplateTitle}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%name%</b> - {lang('Page name','mod_seo')}<br/>
                                                    <b>%desc%</b> - {lang('Page description','mod_seo')}<br/>
                                                    <b>%category%</b> - {lang('Category, which is assigned to the page','mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with page name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                                                    {lang('Example','mod_seo')}:<br/>
                                                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                                                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                                                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                                                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                                                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                                                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                                                    <b>%name[1..6][t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-description:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='pageTemplateDesc'>{$settings.pageTemplateDesc}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                {lang('Description length','mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <input class="input-mini" maxlength="3" type="text" autocomplete="off" name='pageTemplateDescCount' value="{$settings.pageTemplateDescCount}" />
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%name%</b> - {lang('Page name','mod_seo')}<br/>
                                                    <b>%category%</b> - {lang('Category, which is assigned to the page','mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with page name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                                                    {lang('Example','mod_seo')}:<br/>
                                                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                                                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                                                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                                                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                                                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                                                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                                                    <b>%name[1..6][t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-keywords:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='pageTemplateKey'>{$settings.pageTemplateKey}</textarea>
                                            </span>
                                        </label>
                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Active','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="usePagePattern" {if $settings.usePagePattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Use only for empty metadata','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="usePagePatternForEmptyMeta"  {if $settings.usePagePatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {/*
------------------------------////////////////////////////////////////////////////////////////////////////////
*/}
                <table class="table  table-bordered table-condensed content_big_td module-cheep content_big_td">

                    <thead>
                        <tr>
                            <th colspan="6">{lang('Page Category','mod_seo')} [{$locale}]</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd discount-out">
                                    <div class="form-horizontal">

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                                                    <b>%pagenumber%</b> - {lang("Display on pagination pages template from field 'Unique pagination pages'",'mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with category name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                                                    {lang('Example','mod_seo')}:<br/>
                                                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                                                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                                                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                                                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                                                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                                                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                                                    <b>%name[1..6][t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-title:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='pageCategoryTemplateTitle'>{$settings.pageCategoryTemplateTitle}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                                                    <b>%desc%</b> - {lang('Category description','mod_seo')}<br/>
                                                    <b>%pagenumber%</b> - {lang("Display on pagination pages template from field 'Unique pagination pages'",'mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with category name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                                                    {lang('Example','mod_seo')}:<br/>
                                                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                                                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                                                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                                                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                                                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                                                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                                                    <b>%name[1..6][t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-description:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='pageCategoryTemplateDesc'>{$settings.pageCategoryTemplateDesc}</textarea>
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                {lang('Description length','mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <input class="input-mini" maxlength="3" type="text" autocomplete="off" name='pageCategoryTemplateDescCount' value="{$settings.pageCategoryTemplateDescCount}" />
                                            </span>
                                        </label>

                                        <label class="control-group">
                                            <span class="span4">
                                                <span data-title="{lang('Variables, can use to', 'mod_seo')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                                                    <b>%pagenumber%</b> - {lang("Display on pagination pages template from field 'Unique pagination pages'",'mod_seo')}<br/>
                                                    <br/>
                                                    {lang('Additional params for using with category name','mod_seo')}:<br/>
                                                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                                                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                                                    {lang('Example','mod_seo')}:<br/>
                                                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                                                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                                                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                                                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                                                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                                                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                                                    <b>%name[1..6][t]%</b> - {lang('Совместное использование', 'mod_seo')} <br/>
                                                </div>
                                                Meta-keywords:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='pageCategoryTemplateKey'>{$settings.pageCategoryTemplateKey}</textarea>
                                            </span>
                                        </label>
                                        <label class="control-group">
                                            <span class="span4">
                                                <span class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">
                                                    <b>%number%</b> - {lang('Page number','mod_seo')}<br/>
                                                </div>
                                                {lang('Unique pagination pages','mod_seo')}:
                                            </span>
                                            <span class="span8 discount-name">
                                                <textarea name='pageCategoryTemplatePaginationTemplate'>{$settings.pageCategoryTemplatePaginationTemplate}</textarea>
                                            </span>
                                        </label>
                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Active','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="usePageCategoryPattern" {if $settings.usePageCategoryPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="frame_label no_connection">
                                                <span class="span4">{lang('Use only for empty metadata','mod_seo')}:</span>
                                                <span class="span1">
                                                    <span class="niceCheck b_n v-a_t">
                                                        <input class="span4" name="usePageCategoryPatternForEmptyMeta"  {if $settings.usePageCategoryPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {/*
////////////////////////////////////////////////////////////////////////////////
*/}
            </div>
            {/* additions */}

            {$exernalTabs->renderTabsContent()}
        </div>
    </form>
</section>