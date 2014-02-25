<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('SEO expert','mod_seoexpert')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$ADMIN_URL}/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back','mod_seoexpert')}</span></a>
                <button onclick="" type="button" class="btn btn-small btn-primary formSubmit submitButton" data-form="#createDiscountForm" data-submit>
                    <i class="icon-ok icon-white"></i>{lang('Save','mod_seoexpert')}
                </button>
                {echo create_language_select($languages, $locale, "/admin/components/init_window/mod_seoexpert/index")}
            </div>
        </div>
    </div>
    <form method="post" action="/admin/components/init_window/mod_seoexpert/save/{$locale}" enctype="multipart/form-data" id="createDiscountForm">
        <div class="content_big_td">
            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="#base" class="btn btn-small active">{lang('Base','mod_seoexpert')}</a>
                    <a href="#shop" class="btn btn-small">{lang('Shop','mod_seoexpert')}</a>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="base">




                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang('Meta tags',"admin")}
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
                                                            {lang('Whether to display the site name in the title page','admin')}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="control-group m-t_10">
                                                    <label class="control-label" for="add_site_name_to_cat">{lang('Category name',"admin")}:</label>
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
                                                            {lang('Whether to display the category name in the title page','admin')}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="control-group m-t_10">
                                                    <label class="control-label" for="delimiter">{lang('Separator',"admin")}:</label>
                                                    <div class="controls">
                                                        <input type="text" id="delimiter" value="{$baseSettings['delimiter']}" name="base[delimiter]" class="textbox_long" style="width:80px;" />
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


                    <table class="table table-striped table-bordered table-hover table-condensed">
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
                                                            <input type="text" id="titleNa" name="base[name]" value="{echo $baseSettings['name']}" />
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="short_titleS">{lang('Short site name', 'admin')}:</label>
                                                        <div class="controls">
                                                            <input type="text" id="short_titleS" name="base[short_name]" value="{echo $baseSettings['short_name']}" />
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="descriptionN">{lang('Description', 'admin')}:</label>
                                                        <div class="controls">
                                                            <input type="text" id="descriptionN" name="base[description]" value="{echo $baseSettings['description']}" />
                                                        </div>
                                                    </div>

                                                    <div class="control-group m-t_10">
                                                        <label class="control-label" for="keywordsss">{lang('Keywords', 'admin')}:</label>
                                                        <div class="controls">
                                                            <input type="text" id="keywordsss" name="base[keywords]" value="{echo $baseSettings['keywords']}" />
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
                    <table class="table table-striped table-bordered table-condensed content_big_td module-cheep">
                        <thead><tr><th colspan="6">&nbsp;</th></tr></thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd discount-out">
                                        <div class="form-horizontal">
                                            <div class="title-bonus-out"><div class="span4"></div><div class="span8 title-bonus">{lang('Product page','mod_seoexpert')} [{$locale}]</div></div>

                                            <label>
                                                <span class="span4">
                                                    <span data-title="{lang('Variables, can use to', 'mod_seoexpert')}:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - ID <br/>
                                                        <b>%name%</b> - {lang('Product name','mod_seoexpert')}<br/>
                                                        <b>%category%</b> - {lang('Category, which is assigned to the product','mod_seoexpert')}<br/>
                                                        <b>%brand%</b> - {lang('Brand, which is assigned to the product','mod_seoexpert')}<br/>
                                                        <b>%price%</b> - {lang('Product price','mod_seoexpert')}<br/>
                                                        <b>%CS%</b> - {lang('Main currency','mod_seoexpert')}<br/>
                                                        <b>%p_xxxx%</b> - {lang('Displays the value of the property, instead of xxxx - id properties','mod_seoexpert')}<br/>
                                                    </div>
                                                    Meta-title:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplate' value="{$settings.productTemplate}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="{lang('Variables, can use to', 'mod_seoexpert')}:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - {lang('Product ID','mod_seoexpert')} <br/>
                                                        <b>%name%</b> - {lang('Product name','mod_seoexpert')}<br/>
                                                        <b>%desc%</b> - {lang('Product description','mod_seoexpert')}<br/>
                                                        <b>%category%</b> - {lang('Category, which is assigned to the product','mod_seoexpert')}<br/>
                                                        <b>%brand%</b> - {lang('Brand, which is assigned to the product','mod_seoexpert')}<br/>
                                                        <b>%price%</b> - {lang('Product price','mod_seoexpert')}<br/>
                                                        <b>%CS%</b> - {lang('Main currency','mod_seoexpert')}<br/>
                                                        <b>%p_xxxx%</b> - {lang('Displays the value of the property, instead of xxxx - id properties','mod_seoexpert')}<br/>
                                                    </div>
                                                    Meta-description:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplateDesc' value="{$settings.productTemplateDesc}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    {lang('Description length','mod_seoexpert')}:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplateDescCount' value="{$settings.productTemplateDescCount}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="{lang('Variables, can use to', 'mod_seoexpert')}:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%name%</b> - {lang('Product name','mod_seoexpert')}<br/>
                                                        <b>%category%</b> - {lang('Category, which is assigned to the product','mod_seoexpert')}<br/>
                                                        <b>%brand%</b> - {lang('Brand, which is assigned to the product','mod_seoexpert')}<br/>
                                                        <b>%p_xxxx%</b> - {lang('Displays the value of the property, instead of xxxx - id properties','mod_seoexpert')}<br/>
                                                    </div>
                                                    Meta-keywords:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplateKey' value="{$settings.productTemplateKey}" /></span>
                                            </label>
                                            <div>
                                                <div class="frame_label no_connection">
                                                    <span class="span4">{lang('Active','mod_seoexpert')}:</span>
                                                    <span class="span1">
                                                        <span class="niceCheck b_n">
                                                            <input name="useProductPattern" {if $settings.useProductPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="frame_label no_connection">
                                                    <span class="span4">{lang('Use only for empty metadata','mod_seoexpert')}:</span>
                                                    <span class="span1">
                                                        <span class="niceCheck b_n">
                                                            <input name="useProductPatternForEmptyMeta"  {if $settings.useProductPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="clearfix">
                                                <span class="span4"></span>
                                                <div class="span3">
                                                    <a href="/admin/components/init_window/mod_seoexpert/productsCategories" class="t-d_n pjax btn btn-default">
                                                        {lang('Advanced','mod_seoexpert')}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd discount-out">
                                        <div class="form-horizontal">
                                            <div class="title-bonus-out"><div class="span4"></div><div class="span8 title-bonus">{lang('Category','mod_seoexpert')} [{$locale}]</div></div>

                                            <label class="">
                                                <span class="span4">
                                                    <span class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - {lang('Category ID','mod_seoexpert')}<br/>
                                                        <b>%name%</b> - {lang('Category name','mod_seoexpert')}<br/>
                                                        <b>%desc%</b> - {lang('Category description','mod_seoexpert')}<br/>
                                                        <b>%H1%</b> - {lang('field H1 of category','mod_seoexpert')}<br/>
                                                        <b>%brands%</b> - {lang('list of the top brands, separated by ','mod_seoexpert')}"," <br/>
                                                    </div>
                                                    Meta-title:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='categoryTemplate' value="{$settings.categoryTemplate}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="{lang('Variables, can use to', 'mod_seoexpert')}" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - {lang('Category ID','mod_seoexpert')}<br/>
                                                        <b>%name%</b> - {lang('Category name','mod_seoexpert')}<br/>
                                                        <b>%desc%</b> - {lang('Category description','mod_seoexpert')}<br/>
                                                        <b>%H1%</b> - {lang('field H1 of category','mod_seoexpert')}<br/>
                                                        <b>%brands%</b> - {lang('list of the top brands, separated by ','mod_seoexpert')}"," <br/>
                                                    </div>
                                                    Meta-description:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='categoryTemplateDesc' value="{$settings.categoryTemplateDesc}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    {lang('Description length','mod_seoexpert')}:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='categoryTemplateDescCount' value="{$settings.categoryTemplateDescCount}" /></span>
                                            </label>
                                            <label class="">
                                                <span class="span4">
                                                    {lang('Count of brands:','mod_seoexpert')}:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='categoryTemplateBrandsCount' value="{$settings.categoryTemplateBrandsCount}" /></span>
                                            </label>
                                            <label class="">
                                                <span class="span4">
                                                    <span class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - {lang('Category ID','mod_seoexpert')}<br/>
                                                        <b>%name%</b> - {lang('Category name','mod_seoexpert')}<br/>
                                                        <b>%desc%</b> - {lang('Category description','mod_seoexpert')}<br/>
                                                        <b>%H1%</b> - {lang('field H1 of category','mod_seoexpert')}<br/>
                                                        <b>%brands%</b> - {lang('list of the top brands, separated by ','mod_seoexpert')}"," <br/>
                                                    </div>
                                                    Meta-keywords:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='categoryTemplateKey' value="{$settings.categoryTemplateKey}" /></span>
                                            </label>
                                            <div>
                                                <div class="frame_label no_connection">
                                                    <span class="span4">{lang('Active','mod_seoexpert')}:</span>
                                                    <span class="span1">
                                                        <span class="niceCheck b_n">
                                                            <input name="useCategoryPattern"  {if $settings.useCategoryPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="frame_label no_connection">
                                                    <span class="span4">{lang('Use only for empty metadata','mod_seoexpert')}:</span>
                                                    <span class="span1">
                                                        <span class="niceCheck b_n">
                                                            <input name="useCategoryPatternForEmptyMeta"  {if $settings.useCategoryPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd discount-out">
                                        <div class="form-horizontal">
                                            <div class="title-bonus-out"><div class="span4"></div><div class="span8 title-bonus">{lang('Subcategory','mod_seoexpert')} [{$locale}]</div></div>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="{lang('Variables, can use to', 'mod_seoexpert')}:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - {lang('Category ID','mod_seoexpert')}<br/>
                                                        <b>%name%</b> - {lang('Category name','mod_seoexpert')}<br/>
                                                        <b>%desc%</b> - {lang('Category description','mod_seoexpert')}<br/>
                                                        <b>%H1%</b> - {lang('field H1 of category','mod_seoexpert')}<br/>
                                                        <b>%brands%</b> - {lang('list of the top brands, separated by ','mod_seoexpert')}"," <br/>
                                                    </div>
                                                    Meta-title:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='subcategoryTemplate' value="{$settings.subcategoryTemplate}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="{lang('Variables, can use to', 'mod_seoexpert')}:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - {lang('Category ID','mod_seoexpert')}<br/>
                                                        <b>%name%</b> - {lang('Category name','mod_seoexpert')}<br/>
                                                        <b>%desc%</b> - {lang('Category description','mod_seoexpert')}<br/>
                                                        <b>%H1%</b> - {lang('field H1 of category','mod_seoexpert')}<br/>
                                                        <b>%brands%</b> - {lang('list of the top brands, separated by ','mod_seoexpert')}"," <br/>
                                                    </div>
                                                    Meta-description:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='subcategoryTemplateDesc' value="{$settings.subcategoryTemplateDesc}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    {lang('Description length','mod_seoexpert')}:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='subcategoryTemplateDescCount' value="{$settings.subcategoryTemplateDescCount}" /></span>
                                            </label>
                                            <label class="">
                                                <span class="span4">
                                                    {lang('Count of brands:','mod_seoexpert')}:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='subcategoryTemplateBrandsCount' value="{$settings.subcategoryTemplateBrandsCount}" /></span>
                                            </label>
                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="{lang('Variables, can use to', 'mod_seoexpert')}:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - {lang('Category ID','mod_seoexpert')}<br/>
                                                        <b>%name%</b> - {lang('Category name','mod_seoexpert')}<br/>
                                                        <b>%desc%</b> - {lang('Category description','mod_seoexpert')}<br/>
                                                        <b>%H1%</b> - {lang('field H1 of category','mod_seoexpert')}<br/>
                                                        <b>%brands%</b> - {lang('list of the top brands, separated by ','mod_seoexpert')}"," <br/>
                                                    </div>
                                                    Meta-keywords:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='subcategoryTemplateKey' value="{$settings.subcategoryTemplateKey}" /></span>
                                            </label>

                                            <div>
                                                <div class="frame_label no_connection">
                                                    <span class="span4">{lang('Active','mod_seoexpert')}:</span>
                                                    <span class="span1">
                                                        <span class="niceCheck b_n">
                                                            <input name="usesubcategoryPattern"  {if $settings.usesubcategoryPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="frame_label no_connection">
                                                    <span class="span4">{lang('Use only for empty metadata','mod_seoexpert')}:</span>
                                                    <span class="span1">
                                                        <span class="niceCheck b_n">
                                                            <input name="usesubcategoryPatternForEmptyMeta"  {if $settings.usesubcategoryPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd discount-out">
                                        <div class="form-horizontal">
                                            <div class="title-bonus-out"><div class="span4"></div><div class="span8 title-bonus">{lang('Brands','mod_seoexpert')} [{$locale}]</div></div>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="{lang('Variables, can use to', 'mod_seoexpert')}:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - {lang('Brand ID','mod_seoexpert')} <br/>
                                                        <b>%name%</b> - {lang('Brand name','mod_seoexpert')}<br/>
                                                        <b>%desc%</b> - {lang('Brand description','mod_seoexpert')}<br/>
                                                    </div>
                                                    Meta-title:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='brandTemplate' value="{$settings.brandTemplate}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="{lang('Variables, can use to', 'mod_seoexpert')}:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - {lang('Brand ID','mod_seoexpert')} <br/>
                                                        <b>%name%</b> - {lang('Brand name','mod_seoexpert')}<br/>
                                                        <b>%desc%</b> - {lang('Brand description','mod_seoexpert')}<br/>
                                                    </div>
                                                    Meta-description:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='brandTemplateDesc' value="{$settings.brandTemplateDesc}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    {lang('Description length','mod_seoexpert')}:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='brandTemplateDescCount' value="{$settings.brandTemplateDescCount}" /></span>
                                            </label>
                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="{lang('Variables, can use to', 'mod_seoexpert')}:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>

                                                    <div class="d_n">
                                                        <b>%name%</b> - {lang('Brand name','mod_seoexpert')}<br/>
                                                    </div>
                                                    {lang('Meta-keywords', 'mod_seoexpert')}:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='brandTemplateKey' value="{$settings.brandTemplateKey}" /></span>
                                            </label>

                                            <div>
                                                <div class="frame_label no_connection">
                                                    <span class="span4">{lang('Active','mod_seoexpert')}:</span>
                                                    <span class="span1">
                                                        <span class="niceCheck b_n">
                                                            <input name="useBrandPattern"  {if $settings.useBrandPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="frame_label no_connection">
                                                    <span class="span4">{lang('Use only for empty metadata','mod_seoexpert')}:</span>
                                                    <span class="span1">
                                                        <span class="niceCheck b_n">
                                                            <input name="useBrandPatternForEmptyMeta"  {if $settings.useBrandPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd discount-out">
                                        <div class="form-horizontal">
                                            <div class="title-bonus-out"><div class="span4"></div><div class="span8 title-bonus">Поиск [{$locale}]</div></div>

                                            <label class="">
                                                <span class="span4">                                        
                                                    Meta-title:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='searchTemplate' value="{$settings.searchTemplate}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">                                        
                                                    Meta-description:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='searchTemplateDesc' value="{$settings.searchTemplateDesc}" /></span>
                                            </label>

                                            <label>
                                                <span class="span4">                                        
                                                    Meta-keywords:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='searchTemplateKey' value="{$settings.searchTemplateKey}" /></span>
                                            </label>

                                            <div>
                                                <div class="frame_label no_connection">
                                                    <span class="span4">{lang('Active','mod_seoexpert')}:</span>
                                                    <span class="span1">
                                                        <span class="niceCheck b_n">
                                                            <input name="useSearchPattern"  {if $settings.useSearchPattern == 1} checked="checked" {/if}value="1" type="checkbox"/>
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
            </div>
        </div>
    </form>
</section>