<section class="mini-layout mod_stats">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Stats', 'mod_stats')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'admin')}</span></a>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        {include_tpl('../include/left_block')}
        <div class="clearfix span9 content-statistic">
            <form method="get" id="productFilterForm" class="head-product">
                {include_tpl('../include/top_form_product_info')}
                {if count($products)}
                    <table class="table table-striped table-bordered table-condensed content_big_td">
                        <thead>
                            <tr style="cursor: pointer;">
                                <th class="span1 productListOrder" data-column="Id">
                                    <span class="t-d_u">{lang('ID','admin')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'Id'}
                                        {if $_GET.order == 'ASC'}
                                            <span class="f-s_14">↑</span>
                                        {else:}
                                            <span class="f-s_14">↓</span>
                                        {/if}
                                    {/if}
                                </th>
                                <th class="span3 productListOrder" data-column="Name">
                                    <span class="t-d_u">{lang('Name','admin')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'Name'}
                                        {if $_GET.order == 'ASC'}
                                            <span class="f-s_14">↑</span>
                                        {else:}
                                            <span class="f-s_14">↓</span>
                                        {/if}
                                    {/if}
                                </th>
                                <th class="span2 productListOrder" data-column="CategoryId">
                                    <span class="t-d_u">{lang('Categories','admin')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'CategoryId'}
                                        {if $_GET.order == 'ASC'}
                                            <span class="f-s_14">↑</span>
                                        {else:}
                                            <span class="f-s_14">↓</span>
                                        {/if}
                                    {/if}
                                </th>
                                <th class="span1 productListOrder" data-column="AddedToCartCount">
                                    <span class="t-d_u">{lang('Count of purchases', 'mod_stats')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'AddedToCartCount'}
                                        {if $_GET.order == 'ASC'}
                                            <span class="f-s_14">↑</span>
                                        {else:}
                                            <span class="f-s_14">↓</span>
                                        {/if}
                                    {/if}
                                </th>
                                <th class="span1 productListOrder" data-column="Views">
                                    <span class="t-d_u">{lang('Views', 'admin')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'Views'}
                                        {if $_GET.order == 'ASC'}
                                            <span class="f-s_14">↑</span>
                                        {else:}
                                            <span class="f-s_14">↓</span>
                                        {/if}
                                    {/if}
                                </th>
                            </tr>
                            <tr class="head_body">
                                <td class="number">
                                    <div>
                                        <input name="filterID" type="text" value="{$_GET.filterID}"/>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="text" value="{$_GET.text}" maxlength="500"/>
                                </td>
                                <td>
                                    <select class="" name="CategoryId">
                                        <option value="0">{lang('All','admin')}</option>
                                        {foreach $categories as $category}
                                            {$selected = ''}
                                            {if $category->getId() == (int)$_GET.CategoryId}
                                                {$selected='selected="selected"'}
                                            {/if}
                                            <option value="{echo $category->getId()}" {$selected} >{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td colspan="2" style="background: white;">
                                    <button class="btn btn-small btn-primary" type="submit" id="productFilterButton" style="margin:4px; width: 170px;">
                                        {lang('OK','mod_stats')}
                                    </button>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $products as $p}
                                <tr data-id="{echo $p->getId()}" class="simple_tr">
                                    <td class="span1"><p>{echo $p->getId()}</p></td>
                                    <td class="share_alt span3">
                                        <a href="/shop/product/{echo $p->getUrl()}"
                                           target="_blank"
                                           class="go_to_site pull-right btn btn-small"
                                           data-rel="tooltip"
                                           data-placement="top"
                                           data-original-title="{lang('go to the website','admin')}">
                                            <i class="icon-share-alt"></i>
                                        </a>
                                        <a href="/admin/components/run/shop/products/edit/{echo $p->getId()}{$_SESSION['ref_url']}"
                                           class="pjax title"
                                           data-rel="tooltip"
                                           data-title="{lang('Editing','admin')}">
                                            {truncate(ShopCore::encode($p->getName()),100)}
                                        </a>
                                    </td>
                                    <td class="share_alt span2">
                                        <a href="/shop/category/{echo $p->getMainCategory()->getFullPath()}"
                                           target="_blank"
                                           class="go_to_site pull-right btn btn-small"
                                           data-rel="tooltip"
                                           data-placement="top"
                                           data-original-title="{lang('go to the website','admin')}">
                                            <i class="icon-share-alt"></i>
                                        </a>
                                        <a href="{$ADMIN_URL}categories/edit/{echo $p->getMainCategory()->getId()}"
                                           class="pjax"
                                           data-rel="tooltip"
                                           data-title="{lang('Editing','admin')}">
                                            {echo $p->getMainCategory()->getName()}
                                        </a>
                                    </td>
                                    <td class="span1">
                                        <p>
                                            {if $p->getAddedToCartCount() != null}
                                                {echo $p->getAddedToCartCount()}
                                            {else:}
                                                0
                                            {/if}
                                        </p>
                                    </td>
                                    <td class="span1">
                                        <p>
                                            {if $p->getViews() != null}
                                                {echo $p->getViews()}
                                            {else:}
                                                0
                                            {/if}
                                        </p>
                                    </td>

                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                {else:}
                    <div class="alert alert-info">
                        {lang('No results','mod_stats')}
                    </div>
                {/if}
                <div class="clearfix">
                    {if $pagination > ''}
                        {$pagination}
                    {/if}
                </div>

                <input type="hidden" name="orderMethod" value="{$_GET.orderMethod}"/>
                <input type="hidden" name="order" value="{$_GET.order}"/>
            </form>
        </div>
    </div>
</section>
