<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">SEO Эксперт</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$ADMIN_URL}/admin/components/init_window/mod_seoexpert#shop" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back','admin')}</span></a>
                <a href="{$ADMIN_URL}/admin/components/init_window/mod_seoexpert/productCategoryCreate" class="btn btn-small btn-primary">
                    <i class="icon-ok icon-white"></i>{lang('Add new category','mod_seoexpert')}
                </a>
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
        <thead>
            <tr>
                <th class="span10">{lang('Category','mod_seoexpert')}</th>
                <th>{lang('Active','mod_seoexpert')}</th>
                <th>{lang('Only for empty Meta-tags','mod_seoexpert')}</th>
            </tr>
        </thead>
        <tbody class="">
            {foreach $categories as $category}
                <tr data-original-title="" >
                    <td class="span8">
                        <a href="productCategoryEdit/{$category['id']}">
                            {$category['name']}
                        </a>
                    </td>
                    <td>
                        <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top">
                            <!--<span class="prod-on_off {if $category['settings']['useProductPattern'] != 1}disable_tovar{/if}" style="{if $category['settings']['useProductPattern'] != 1}left: -28px;{/if}" {if $category['settings']['useProductPattern'] != 1}rel="true"{else:}rel="false"{/if}
                                  onclick="changeProductsSeoActive(this,{echo $category['id']});"></span>-->
                            {if $category['settings']['useProductPattern'] == 1}<b style="color:green;" class="icon-ok"></b>{else:}<b style="color:red;">X</b>{/if}
                        </div>
                    </td>
                    <td>
                        <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top">
                            <!--<span class="prod-on_off {if $category['settings']['useProductPatternForEmptyMeta'] != 1}disable_tovar{/if}" style="{if $category['settings']['useProductPatternForEmptyMeta'] != 1}left: -28px;{/if}" {if $category['settings']['useProductPatternForEmptyMeta'] != 1}rel="true"{else:}rel="false"{/if}
                                  onclick="changeProductsSeoOnlyForEmpty(this,{echo $category['id']});"></span>-->
                            {if $category['settings']['useProductPatternForEmptyMeta'] == 1}<b style="color:green;" class="icon-ok"></b>{else:}<b style="color:red;">X</b>{/if}
                        </div>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</section>