<div class="frame-inside page-wishlist-one-WL">
    <div class="container">
        {if $wishlist != 'empty'}
            <div class="left-wishlist">
                <ul class="items items-wish-data">
                    <li>
                        <div class="photo-block m-b_5">
                            <span class="helper"></span>
                            {if $user['user_image']!=''}
                                <img src="{site_url('uploads/mod_wishlist/'.$user['user_image'])}" alt='pic' data-src="{$THEME}{$colorScheme}/images/nophoto.png"/>
                            {else:}
                                <img src="{site_url('uploads/shop/nophoto/nophoto.jpg')}"/>
                            {/if}
                        </div>
                        <div class="description">
                            <h2 data-wishlist-name="user_name" class="title">{echo $user[user_name]}</h2>
                            <div class="date f-s_0">
                                <span class="day">{echo date("d", $user[user_birthday])}&nbsp;</span>
                                <span class="month">{echo month(date('n',$user.user_birthday))}&nbsp;</span>
                                <span class="year">{echo date("Y ", $user[user_birthday])}</span>
                            </div>
                            <div class="text">
                                <p data-wishlist-name="description">{echo $user[description]}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="right-wishlist">
                <div class="f-s_0 without-crumbs-side">
                    <div class="frame-title">
                        <h1 class="d_i">{$wishlist[0][title]}</h1>
                    </div>
                </div>
                <div class="text">
                    <p>{$wishlist[0][description]}</p>
                </div>
                {if $wishlist[0][variant_id]}
                    <div data-rel="list-item">
                        <ul class="items items-catalog items-wish-list">
                            {$CI->load->module('new_level')->OPI($wishlist, array('wishlist'=>true, 'otherlist'=>true), 'array_product_item')}
                        </ul>
                        {if $wishlist[0][variant_id]}
                            <div class="clearfix frame-gen-sum-buy">
                                {$price = 0}
                                {$i = 0}
                                {foreach $wishlist as $key => $p}
                                    {$price += $p.price;}
                                    {$i++}
                                {/foreach}
                                <div class="title-h3 f_l">{lang('Всего','newLevel')} <b class="countProdsWL">{echo $i}</b> {lang('товара на сумму','newLevel')} 
                                    <span class="frame-prices f-s_0">
                                        <span class="current-prices">
                                            <span class="price-new">
                                                <span>
                                                    <span class="price genPriceProdsWL">{round($price, $pricePrecision)}</span>
                                                    <span class="curr">{$CS}</span>
                                                </span>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                                <div class="btn-buy f_r">
                                    <button
                                        type="button"
                                        class="btnBuyWishList"
                                        >
                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                        <span class="text-el" data-cart="{lang('Просмотреть купленные товары','newLevel')}" data-buy="{lang('Купить все доступные товары','newLevel')}">{lang('Купить все доступные товары','newLevel')}</span>
                                    </button>
                                </div>
                            </div>
                        {/if}
                    </div>
                {else:}
                    <div class="msg layout-highlight layout-highlight-msg">
                        <div class="info">
                            <span class="icon_info"></span>
                            <span class="text-el">{lang('Список пуст','newLevel')}</span>
                        </div>
                    </div>
                {/if}
            </div>
        {else:}
            <div class="f-s_0 without-crumbs-side">
                <div class="frame-title">
                    <h1 class="d_i">{lang('Список желаний','newLevel')}</h1>
                </div>
            </div>
            <div class="msg layout-highlight layout-highlight-msg">
                <div class="info">
                    <span class="icon_info"></span>
                    <span class="text-el">{lang('Список Желания пуст','newLevel')}</span>
                </div>
            </div>
        {/if}
    </div>
</div>