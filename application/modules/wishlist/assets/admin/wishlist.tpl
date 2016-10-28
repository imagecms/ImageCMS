<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('User lists', 'wishlist')}: {echo $user[user_name]}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/cp/wishlist"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'admin')}</span>
                    </a>
                    <a class="btn btn-small pjax" href="{$BASE_URL}admin/components/cp/wishlist/settings">
                        <i class="icon-wrench"></i>
                        {lang('Settings', 'wishlist')}
                    </a>
                </div>
            </div>
        </div>






        {if count($wishlists)>0}
            {foreach $wishlists as $key => $wishlist}
                <div class="m-t_15">
                    <table class="table  table-bordered table-hover table-condensed content_big_td stat-wish-out">
                        <thead>
                            <tr>
                                <th colspan="6">
                        <div class="clearfix">
                            <div class="pull-left stat-wish">

                                <span class="title">{$wishlist[0][title]}</span>
                                <span class="stat-wish-acces">
                                    {if $wishlist['0']['access'] == 'shared'}
                                        <span>
                                            ({lang('shared', 'wishlist')})
                                        </span>
                                    {/if}
                                    {if $wishlist['0']['access'] == 'private'}
                                        <span>
                                            ({lang('private', 'wishlist')})
                                        </span>
                                    {/if}
                                    {if $wishlist['0']['access'] == 'public'}
                                        <span>
                                            ({lang('public', 'wishlist')})
                                        </span>
                                    {/if}
                                </span>
                            </div>
                            <div class="pull-right f-s_0" style="">
                                <a class="btn" href="/admin/components/cp/wishlist/deleteWL/{$wishlist[0][wish_list_id]}">
                                    <i class="icon-trash"></i>
                                    {lang('Delete', 'wishlist')}
                                </a>
                                <a class="btn" href="/admin/components/cp/wishlist/editWL/{$wishlist[0][wish_list_id]}/{echo $user[id]}">
                                    <i class="icon-edit"></i>
                                    {lang('Edit', 'wishlist')}
                                </a>
                            </div>
                        </div>
                        </th>
                        </tr>
                        </thead>
                    </table>
                </div>

                <form style="margin-top: -21px;">
                    <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                    <table class="table  table-bordered table-hover table-condensed products_table products_table-wish">
                        <thead>
                            <tr>
                                <th style="width: 40px;">№</th>
                                <th style="width: 460px;">{lang('Product', 'wishlist')}</th>
                                <th>{lang('Comment', 'wishlist')}</th>
                                <th>{lang('Unsubscribe', 'wishlist')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {if $wishlist[0][variant_id]}
                                {foreach $wishlist as $key => $w}
                                    <tr>
                                        <td>{echo $key+1}</td>
                                        <td class="share_alt">
                                            <a href="/admin/components/run/shop/products/edit/{echo $w['product_id']}{$_SESSION['ref_url']}"
                                               class="title"
                                               data-rel="tooltip"
                                               data-title="{lang('Edit product','admin')}">
                                                <span class="text-el">{truncate(ShopCore::encode($w['name']),100)}</span>
                                            </a>

                                            <a href="/{echo $w['full_url']}"
                                               target="_blank"
                                               class="go_to_site pull-right btn btn-small"
                                               data-rel="tooltip"
                                               data-placement="top"
                                               data-original-title="{lang('Show on site','admin')}">
                                                <i class="icon-share-alt"></i>
                                            </a>


                                        </td>
                                        <td>
                                            {$w[comment]}
                                        </td>
                                        <td>
                                            <a class="btn m-r_10" href="/admin/components/cp/wishlist/deleteItem/{echo $w[variant_id]}/{echo $w[wish_list_id]}" data-rel="tooltip" data-placement="top" data-original-title="{lang('Delete', 'wishlist')}"><i class="icon-trash"></i></a>
                                            <a class="btn" href="/admin/components/cp/wishlist/renderPopup/{echo $w[variant_id]}/{echo $w[wish_list_id]}/{echo $user[id]}" data-rel="tooltip" data-placement="top" data-original-title="{lang('Move', 'wishlist')}"><i class="icon-refresh"></i></a>
                                        </td>
                                    </tr>
                                {/foreach}
                            {else:}
                                <tr>
                                    <td colspan="4">
                                        <div class="alert alert-info" style="">
                                            {lang('Empty list', 'wishlist')}
                                        </div>
                                    </td>
                                </tr>
                            {/if}
                        </tbody>
                    </table>
                    {form_csrf()}
                </form>

            {/foreach}
        {else:}
            <div class="alert alert-info" style="">
                {lang('No lists', 'wishlist')}
            </div>
        {/if}


    </section>
</div>