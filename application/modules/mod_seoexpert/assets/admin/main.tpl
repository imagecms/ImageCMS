<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">SEO Эксперт</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$ADMIN_URL}/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back','admin')}</span></a>
                <button onclick="" type="button" class="btn btn-small btn-primary formSubmit submitButton" data-form="#createDiscountForm" data-submit>
                    <i class="icon-ok icon-white"></i>Сохранить
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
                                                    <label class="control-label" for="add_site_name">{lang('Site name',"admin")}:</label>
                                                    <div class="controls">
                                                        <select name="base[add_site_name]" id="add_site_name">
                                                            <option value="1" {if $baseSettings['add_site_name'] == "1"}selected="selected"{/if}>{lang('Yes',"admin")}</option>
                                                            <option value="0" {if $baseSettings['add_site_name'] == "0"}selected="selected"{/if} >{lang('No',"admin")}</option>
                                                        </select>
                                                        <span class="help-block">
                                                            {lang('Whether to display the site name in the title page','admin')}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="control-group m-t_10">
                                                    <label class="control-label" for="add_site_name_to_cat">{lang('Category name',"admin")}:</label>
                                                    <div class="controls">
                                                        <select name="base[add_site_name_to_cat]" id="add_site_name_to_cat">
                                                            <option value="1" {if $baseSettings['add_site_name_to_cat'] == "1"}selected="selected"{/if}>{lang("Yes","admin")}</option>
                                                            <option value="0" {if $baseSettings['add_site_name_to_cat'] == "0"}selected="selected"{/if}>{lang("No","admin")}</option>
                                                        </select>
                                                        <span class="help-block">
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
                                            <div class="title-bonus-out"><div class="span4"></div><div class="span8 title-bonus">Страница продукта [{$locale}]</div></div>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="Variables, can use to:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - ID наименования<br/>
                                                        <b>%name%</b> - название продукта<br/>
                                                        <b>%category%</b> - категория, которой присвоен продукт<br/>
                                                        <b>%brand%</b> - бренд, которому присвоен продукт<br/>
                                                        <b>%price%</b> - стоимость продукта<br/>
                                                        <b>%CS%</b> - основная валюта витрины<br/>
                                                        <b>%p_xxxx%</b> - виведет значение свойства, вместе xxxx - id свойства <br/>
                                                    </div>
                                                    Meta-title шаблон:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplate' value="{$settings.productTemplate}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="Variables, can use to:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - ID наименования<br/>
                                                        <b>%name%</b> - название продукта<br/>
                                                        <b>%desc%</b> - описание продукта<br/>
                                                        <b>%category%</b> - категория, которой присвоен продукт<br/>
                                                        <b>%brand%</b> - бренд, которому присвоен продукт<br/>
                                                        <b>%price%</b> - стоимость продукта<br/>
                                                        <b>%CS%</b> - основная валюта витрины<br/>
                                                        <b>%p_xxxx%</b> - виведет значение свойства, вместе xxxx - id свойства <br/>
                                                    </div>
                                                    Meta-description шаблон:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplateDesc' value="{$settings.productTemplateDesc}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    Длина описания:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplateDescCount' value="{$settings.productTemplateDescCount}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="Переменные, которые можно использовать:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%name%</b> - название продукта<br/>
                                                        <b>%category%</b> - категория, которой присвоен продукт<br/>
                                                        <b>%brand%</b> - бренд, которому присвоен продукт<br/>
                                                        <b>%p_xxxx%</b> - виведет значение свойства, вместе xxxx - id свойства <br/>
                                                    </div>
                                                    Meta-keywords шаблон:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplateKey' value="{$settings.productTemplateKey}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">Активный:</span>
                                                <span style="width: 16px;" class="span1"><input name="useProductPattern"  {if $settings.useProductPattern == 1} checked="checked" {/if}value="1" type="checkbox"/></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">Использовать только для пустых метаданных:</span>
                                                <span style="width: 16px;" class="span1"><input name="useProductPatternForEmptyMeta"  {if $settings.useProductPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/></span>
                                            </label>


                                            <div class="clearfix">
                                                <div class="pull-right">
                                                    <div class="d-i_b">
                                                        <a href="/admin/components/init_window/mod_seoexpert/productsCategories" class="t-d_n pjax">
                                                            <span class="t-d_u">{lang('Advanced','mod_seoexpert')}</span>
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
                                            <div class="title-bonus-out"><div class="span4"></div><div class="span8 title-bonus">Категория [{$locale}]</div></div>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="Переменные, которые можно использовать" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - ID категории<br/>
                                                        <b>%name%</b> - название категории<br/>
                                                        <b>%desc%</b> - описание категории<br/>
                                                        <b>%H1%</b> - поле H1 категории<br/>
                                                        <b>%brands%</b> - список топ брендов, через запятую <br/>
                                                    </div>
                                                    Meta-title pattern:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='categoryTemplate' value="{$settings.categoryTemplate}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="Переменные, которые можно использовать" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - ID категории<br/>
                                                        <b>%name%</b> - название категории<br/>
                                                        <b>%desc%</b> - описание категории<br/>
                                                        <b>%H1%</b> - поле H1 категории<br/>
                                                        <b>%brands%</b> - список топ брендов, через запятую <br/>
                                                    </div>
                                                    Meta-description шаблон:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='categoryTemplateDesc' value="{$settings.categoryTemplateDesc}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    Длина описания:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='categoryTemplateDescCount' value="{$settings.categoryTemplateDescCount}" /></span>
                                            </label>
                                            <label class="">
                                                <span class="span4">
                                                    Количество брендов:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='categoryTemplateBrandsCount' value="{$settings.categoryTemplateBrandsCount}" /></span>
                                            </label>
                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="Переменные, которые можно использовать:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - ID категории<br/>
                                                        <b>%name%</b> - название категории<br/>
                                                        <b>%desc%</b> - описание категории<br/>
                                                        <b>%H1%</b> - поле H1 категории<br/>
                                                        <b>%brands%</b> - список топ брендов, через запятую <br/>
                                                    </div>
                                                    Meta-keywords шаблон:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='categoryTemplateKey' value="{$settings.categoryTemplateKey}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">Активный:</span>
                                                <span style="width: 16px;" class="span1"><input name="useCategoryPattern"  {if $settings.useCategoryPattern == 1} checked="checked" {/if}value="1" type="checkbox"/></span>
                                            </label>

                                            <label class=""><span class="span4">Использовать только для пустых метаданных:</span>
                                                <span style="width: 16px;" class="span1"><input name="useCategoryPatternForEmptyMeta"  {if $settings.useCategoryPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/></span>
                                            </label>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd discount-out">
                                        <div class="form-horizontal">
                                            <div class="title-bonus-out"><div class="span4"></div><div class="span8 title-bonus">Подкатегория [{$locale}]</div></div>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="Переменные, которые можно использовать:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - ID категории<br/>
                                                        <b>%name%</b> - название категории<br/>
                                                        <b>%desc%</b> - описание категории<br/>
                                                        <b>%H1%</b> - поле H1 категории<br/>
                                                        <b>%brands%</b> - список топ брендов, через запятую <br/>
                                                    </div>
                                                    Meta-title pattern:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='subcategoryTemplate' value="{$settings.subcategoryTemplate}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="Переменные, которые можно использовать" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - ID категории<br/>
                                                        <b>%name%</b> - название категории<br/>
                                                        <b>%desc%</b> - описание категории<br/>
                                                        <b>%H1%</b> - поле H1 категории<br/>
                                                        <b>%brands%</b> - список топ брендов, через запятую <br/>
                                                    </div>
                                                    Meta-description шаблон:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='subcategoryTemplateDesc' value="{$settings.subcategoryTemplateDesc}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    Длина описания:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='subcategoryTemplateDescCount' value="{$settings.subcategoryTemplateDescCount}" /></span>
                                            </label>
                                            <label class="">
                                                <span class="span4">
                                                    Количество брендов:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='subcategoryTemplateBrandsCount' value="{$settings.subcategoryTemplateBrandsCount}" /></span>
                                            </label>
                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="Переменные, которые можно использовать:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - ID категории<br/>
                                                        <b>%name%</b> - название категории<br/>
                                                        <b>%desc%</b> - описание категории<br/>
                                                        <b>%H1%</b> - поле H1 категории<br/>
                                                        <b>%brands%</b> - список топ брендов, через запятую <br/>
                                                    </div>
                                                    Meta-keywords шаблон:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='subcategoryTemplateKey' value="{$settings.subcategoryTemplateKey}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">Активный:</span>
                                                <span style="width: 16px;" class="span1"><input name="usesubcategoryPattern"  {if $settings.usesubcategoryPattern == 1} checked="checked" {/if}value="1" type="checkbox"/></span>
                                            </label>

                                            <label class=""><span class="span4">Использовать только для пустых метаданных:</span>
                                                <span style="width: 16px;" class="span1"><input name="usesubcategoryPatternForEmptyMeta"  {if $settings.usesubcategoryPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/></span>
                                            </label>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd discount-out">
                                        <div class="form-horizontal">
                                            <div class="title-bonus-out"><div class="span4"></div><div class="span8 title-bonus">Бренды [{$locale}]</div></div>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="Переменные, которые можно использовать" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - ID бренда<br/>
                                                        <b>%name%</b> - название бренда<br/>
                                                        <b>%desc%</b> - описание бренда<br/>
                                                    </div>
                                                    Meta-title pattern:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='brandTemplate' value="{$settings.brandTemplate}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="Переменные, которые можно использовать" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%ID%</b> - ID бренда<br/>
                                                        <b>%name%</b> - название бренда<br/>
                                                        <b>%desc%</b> - описание бренда<br/>
                                                    </div>
                                                    Meta-description шаблон:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='brandTemplateDesc' value="{$settings.brandTemplateDesc}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">
                                                    Длина описания:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='brandTemplateDescCount' value="{$settings.brandTemplateDescCount}" /></span>
                                            </label>
                                            <label class="">
                                                <span class="span4">
                                                    <span data-title="Переменные, которые можно использовать:" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">
                                                        <b>%name%</b> - название бренда<br/>
                                                    </div>
                                                    Meta-keywords шаблон:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='brandTemplateKey' value="{$settings.brandTemplateKey}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">Активный:</span>
                                                <span style="width: 16px;" class="span1"><input name="useBrandPattern"  {if $settings.useBrandPattern == 1} checked="checked" {/if}value="1" type="checkbox"/></span>
                                            </label>

                                            <label class=""><span class="span4">Использовать только для пустых метаданных:</span>
                                                <span style="width: 16px;" class="span1"><input name="useBrandPatternForEmptyMeta"  {if $settings.useBrandPatternForEmptyMeta == 1} checked="checked" {/if}value="1" type="checkbox"/></span>
                                            </label>

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
                                                    Meta-title pattern:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='searchTemplate' value="{$settings.searchTemplate}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">                                        
                                                    Meta-description шаблон:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='searchTemplateDesc' value="{$settings.searchTemplateDesc}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">                                        
                                                    Meta-keywords шаблон:
                                                </span>
                                                <span class="span8 discount-name"><input type="text" autocomplete="off" name='searchTemplateKey' value="{$settings.searchTemplateKey}" /></span>
                                            </label>

                                            <label class="">
                                                <span class="span4">Активный:</span>
                                                <span style="width: 16px;" class="span1"><input name="useSearchPattern"  {if $settings.useSearchPattern == 1} checked="checked" {/if}value="1" type="checkbox"/></span>
                                            </label>

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