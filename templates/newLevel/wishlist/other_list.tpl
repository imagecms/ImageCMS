<div class="frame-inside page-wishlist-one-WL">
    <div class="container">
        {if $wishlist != 'empty'}
            <div class="left-wishlist">
                <div class="photo-block m-b_5">
                    <span class="helper"></span>
                    {if $user['user_image']!=''}
                        <img src="{site_url('uploads/mod_wishlist/'.$user['user_image'])}" alt='pic' data-src="{$THEME}{$colorScheme}/images/nophoto.png"/>
                    {else:}
                        <img src="{site_url('uploads/shop/nophoto/nophoto.jpg')}"/>
                    {/if}
                </div>
                <div class="description">
                    <h2 data-wishlist-name="user_name">{echo $user[user_name]}</h2>
                    <div class="date f-s_0">
                        <span data-wishlist-name="user_birthday">{echo date('Y-m-d', $user['user_birthday'])}</span>
                        {/*<span class="day">{echo date("d", $user[user_birthday])} </span>
                            <span class="month">{echo date("F", $user[user_birthday])} </span>
                            <span class="year">{echo date("Y ", $user[user_birthday])}</span>*/}
                    </div>
                    <div class="text">
                        <p data-wishlist-name="description">{echo $user[description]}</p>
                    </div>
                </div>
            </div>
            <div class="right-wishlist">
                <div class="f-s_0 title-cart without-crumbs-side">
                    <div class="frame-title">
                        <h1 class="d_i">{$wishlist[0][title]}</h1>
                    </div>
                </div>
                <div class="text">
                    <p>{$wishlist[0][description]}</p>
                </div>
                {if $wishlist[0][variant_id]}
                    <ul class="items items-catalog items-wish-list">
                        {$CI->load->module('new_level')->OPI($wishlist, array('wishlist'=>true, 'otherlist'=>true), 'array_product_item')}
                    </ul>
                {else:}
                    <div class="msg layout-highlight layout-highlight-msg">
                        <div class="info">
                            <span class="icon_info"></span>
                            <span class="text-el">Список пуст</span>
                        </div>
                    </div>
                {/if}
            </div>
        {/if}
    </div>
</div>