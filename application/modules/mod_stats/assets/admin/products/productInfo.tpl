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
        {include_tpl('../left_block')}
        <div class="clearfix span9">
            {include_tpl('../time_and_filter_block_without_groupby_and_with_product_for_productInfo')}

            {if $products}
                <table class="table table-striped table-bordered table-condensed content_big_td">

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
                <p style="text-align: center;">{lang('No results','mod_stats')}</p>
            {/if}
            <div class="clearfix">
                {if $pagination > ''}
                    {$pagination}
                {/if}
            </div>
        </div>
    </div>

</section>
