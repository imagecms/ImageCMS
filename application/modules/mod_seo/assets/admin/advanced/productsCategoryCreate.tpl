<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Create meta-data for category','mod_seo')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$ADMIN_URL}/admin/components/init_window/mod_seo/productsCategories/{$locale}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back','mod_seo')}</span></a>
                <button onclick="" type="button" class="btn btn-small btn-primary formSubmit submitButton" data-form="#createDiscountForm" data-submit>
                    <i class="icon-ok icon-white"></i>{lang('Save','mod_seo')}
                </button>
                {//echo create_language_select($languages, $locale, "/admin/components/init_window/mod_seo/productCategoryCreate")}
            </div>
        </div>
    </div>
    <form method="post" action="/admin/components/init_window/mod_seo/productCategoryCreate/{$locale}" enctype="multipart/form-data" id="createDiscountForm">
        <table class="table  table-bordered table-condensed content_big_td module-cheep">
            <thead><tr><th colspan="6"><br/></th></tr></thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd discount-out">
                            <div class="form-horizontal">
                                <label class="">
                                    <span class="span4">
                                        {lang('Choose category','mod_seo')}: <span class="must">*</span>
                                    </span>
                                    <span class="span8 discount-name">
                                        <input id="autocomleteCategory" type="text" autocomplete="off" name='categoryNameTMP' value="{$_POST['categoryNameTMP']}" />
                                        <input id="autocomleteCategoryId" type="hidden" name='category_id' value="{$_POST['autocomleteCategoryId']}" />
                                    </span>
                                </label>
                                <hr/>
                                <label class="">
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
                                        <textarea name='productTemplate'>{$_POST['autocomleteCategoryId']}</textarea>
                                    </span>
                                </label>
                                <label class="">
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
                                        <textarea name='productTemplateDesc'>{$_POST['productTemplateDesc']}</textarea>
                                    </span>
                                </label>

                                <label class="">
                                    <span class="span4">
                                        {lang('Description length','mod_seo')}:
                                    </span>
                                    <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplateDescCount' value="{$_POST['productTemplateDescCount']}" /></span>
                                </label>

                                <label class="">
                                    <span class="span4">
                                        <span data-title="{lang('Переменные, которые можно использовать', 'mod_seo')}:" class="popover_ref" data-original-title="">
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
                                        <textarea name='productTemplateKey'>{$_POST['productTemplateKey']}</textarea>
                                    </span>
                                </label>

                                <div>
                                    <div class="frame_label no_connection">
                                        <span class="span4">{lang('Active','mod_seo')}:</span>
                                        <span class="span1">
                                            <span class="niceCheck b_n">
                                                <input name="useProductPattern"  {if $_POST['useProductPattern'] == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <div class="frame_label no_connection">
                                        <span class="span4">{lang('Use only for empty metadata','mod_seo')}:</span>
                                        <span class="span1">
                                            <span class="niceCheck b_n">
                                                <input name="useProductPatternForEmptyMeta"  {if $_POST['useProductPatternForEmptyMeta'] == 1} checked="checked" {/if}value="1" type="checkbox"/>
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
    </form>
</section>