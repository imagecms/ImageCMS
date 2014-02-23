<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">SEO Эксперт</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$ADMIN_URL}/admin/components/init_window/mod_seoexpert#shop" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back','admin')}</span></a>
                <a href="{$ADMIN_URL}/admin/components/init_window/mod_seoexpert/productCategoryCreate" class="btn btn-small btn-success">
                    <i class="icon-plus icon-white"></i>{lang('Add new category','mod_seoexpert')}
                </a>
            </div>
        </div>
    </div>
    {if $categories}
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
                            <div class="frame_prod-on_off">
                                <span class="prod-on_off{if !$category['settings']['useProductPattern']} disable_tovar{/if}"></span>
                                <input type="hidden" name="" value="{if $category['settings']['useProductPattern']}1{else:}0{/if}" data-val-on="1" data-val-off="0">
                            </div>
                        </td>
                        <td>
                            <div class="frame_prod-on_off">
                                <span class="prod-on_off{if !$category['settings']['useProductPatternForEmptyMeta']} disable_tovar{/if}"></span>
                                <input type="hidden" name="" value="{if $category['settings']['useProductPatternForEmptyMeta']}1{else:}0{/if}" data-val-on="1" data-val-off="0">
                            </div>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else:}
        <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
            {lang('List is empty.','admin')}
        </div>
    {/if}
</section>