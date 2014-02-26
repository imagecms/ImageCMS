<!-- Start. Remove block -->
<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Delete categories','admin')}</h3>
    </div>
    <div class="modal-body">
        <p>{lang('Really delete selected categories?','admin')}</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/init_window/mod_seoexpert/ajaxDeleteProductCategories')" >{lang('Delete','admin')}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin')}</a>
    </div>
</div>
<!-- End. Remove block -->


<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('SEO expert','mod_seoexpert')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$ADMIN_URL}/admin/components/init_window/mod_seoexpert#shop" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back','admin')}</span></a>
                <a class="btn btn-small btn-danger disabled action_on" id="del_in_search" onclick="delete_function.deleteFunction()"><i class="icon-trash icon-white"></i>{lang('Delete','admin')}</a>
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
                    <th class="t-a_c span1">
                        <span class="frame_label">
                            <span class="niceCheck b_n">
                                <input type="checkbox"/>
                            </span>
                        </span>
                    </th>
                    <th class="span10">{lang('Category','mod_seoexpert')}</th>
                    <th>{lang('Active','mod_seoexpert')}</th>
                    <th>{lang('Only for empty Meta-tags','mod_seoexpert')}</th>
                </tr>
            </thead>
            <tbody class="">
                {foreach $categories as $category}
                    <tr data-id="{echo $category['id']}" class="simple_tr">
                        <td class="t-a_c">
                            <span class="frame_label">
                                <span class="niceCheck b_n">
                                    <input type="checkbox" name="ids" value="{echo $category['id']}" data-id="{echo $category['id']}"/>
                                </span>
                            </span>
                        </td>
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