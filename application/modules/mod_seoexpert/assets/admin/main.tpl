<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">СЕО Експерт для магазину</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <!-- <a href="/admin/components/init_window/mod_discount{echo $filterQuery}" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a> -->
                <button onclick="" type="button" class="btn btn-small btn-primary formSubmit submitButton" data-form="#createDiscountForm" data-submit>
                    <i class="icon-ok icon-white"></i>Сохранить
                </button>
                {echo create_language_select($languages, $locale, "/admin/components/init_window/mod_seoexpert/translit")}
            </div>
        </div>
    </div>
    <form method="post" action="/admin/components/init_window/mod_seoexpert/save/{$locale}" enctype="multipart/form-data" id="createDiscountForm">
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
                                            <b>%price%</b> - стоимость продукта<br/>
                                            <b>%CS%</b> - основная валюта витрины<br/>
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
                                            <b>%price%</b> - стоимость продукта<br/>
                                            <b>%CS%</b> - основная валюта витрины<br/>
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
                                            <b>%H1%</b> - поле H1 категории<br/>
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
                                        <span data-title="Переменные, которые можно использовать:" class="popover_ref" data-original-title="">
                                            <i class="icon-info-sign"></i>
                                        </span>
                                        <div class="d_n">
                                            <b>%name%</b> - название категории<br/>
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
    </form>
    <div id="elFinder"></div>
</section>