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
                        <h1 class="title">{$wishlist[0][title]}</h1>
                    </div>
                </div>
                <div class="text">
                    <p>{$wishlist[0][description]}</p>
                </div>
                {if $wishlist[0][variant_id]}
                    <div data-rel="list-item">
                        <ul class="items items-catalog items-wish-list items-product">
                            {$CI->load->module('new_level')->OPI($wishlist, array('opi_wishListPage' => true, 'opi_otherlist'=>true))}
                        </ul>
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
                    <h1 class="title">{lang('Список желаний','newLevel')}</h1>
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