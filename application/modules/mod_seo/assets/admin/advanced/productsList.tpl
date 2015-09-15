<!-- Start. Remove block -->
<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Delete categories','admin')}</h3>
    </div>
    <div class="modal-body">
        <p>{lang('Really delete selected categories?','mod_seo')}</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/init_window/mod_seo/ajaxDeleteProductCategories')" >{lang('Delete','admin')}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin')}</a>
    </div>
</div>
<!-- End. Remove block -->


<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('SEO expert','mod_seo')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$ADMIN_URL}/admin/components/init_window/mod_seo#shop" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back','mod_seo')}</span></a>
                <a class="btn btn-small btn-danger disabled action_on" id="del_in_search" onclick="delete_function.deleteFunction()"><i class="icon-trash"></i>{lang('Delete','admin')}</a>
                <a href="{$ADMIN_URL}/admin/components/init_window/mod_seo/productCategoryCreate" class="btn btn-small btn-success">
                    <i class="icon-plus icon-white"></i>{lang('Add new category','mod_seo')}
                </a>
            </div>
        </div>
    </div>
    {if $categoriesProducts}
        <table class="table  table-bordered table-hover table-condensed seoProductCategoriesTable">
            <thead>
                <tr>
                    <th class="t-a_c span1">
                        <span class="frame_label">
                            <span class="niceCheck b_n">
                                <input type="checkbox"/>
                            </span>
                        </span>
                    </th>
                    <th class="span10">{lang('Name category ','mod_seo')}</th>
                    <th>{lang('Active','mod_seo')}</th>
                    <th>{lang('Use only for empty metadata','mod_seo')}</th>
                </tr>
            </thead>
            <tbody class="">
                {foreach $categoriesProducts as $category}
                    <tr data-id="{echo $category['id']}" class="simple_tr">
                        <td class="t-a_c">
                            <span class="frame_label">
                                <span class="niceCheck b_n">
                                    <input type="checkbox" name="ids" value="{echo $category['id']}" data-id="{echo $category['id']}"/>
                                </span>
                            </span>
                        </td>
                        <td class="span8">
                            <a href="{site_url('/admin/components/init_window/mod_seo/productCategoryEdit')}/{$category['id']}"data-rel="tooltip"
                                       data-title="{lang('Editing','admin')}">
                                {$category['name']}
                            </a>
                        </td>
                        
                        <td>
                            <div class="frame_prod-on_off" data-rel="tooltip" 
                                                           data-placement="top" 
                                                           accesskey=""data-original-title="
                                                            {if !$category['active']}
                                                                {lang('Not show','mod_seo')}
                                                            {else:}
                                                                {lang('Show','mod_seo')}
                                                            {/if}">
                                <span class="prod-on_off{if !$category['active']} disable_tovar{/if} categorySeo" data-id="{echo $category['id']}"></span>
                                <input type="hidden" name="" value="{if $category['active']}1{else:}0{/if}" data-val-on="1" data-val-off="0">
                            </div>
                        </td>
                        <td>
                            <div class="frame_prod-on_off" 
                                        data-rel="tooltip" 
                                        data-placement="top" 
                                        data-original-title="{if $category['empty_meta']}{lang('Yes','admin')}{else:}{lang('No','admin')}{/if}">
                                <span class="prod-on_off{if !$category['empty_meta']} disable_tovar{/if} emptyMetaSeo" data-id="{echo $category['id']}"></span>
                                <input type="hidden" name="" value="{if $category['empty_meta']}1{else:}0{/if}" data-val-on="1" data-val-off="0">
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