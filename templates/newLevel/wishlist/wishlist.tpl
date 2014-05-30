{$pricePrecision = ShopCore::app()->SSettings->pricePrecision}
<div class="frame-inside page-wishlist">
    <div class="container">
        <div class="f-s_0 title-cart without-crumbs">
            <div class="frame-title">
                <h1 class="title">{lang('Список желаний','newLevel')}</h1>
            </div>
        </div>
        {if $errors}
            {foreach $errors as $error}
                <div class="msg">
                    <div class="error">{$error}</div>
                </div>
            {/foreach}
        {/if}
        <ul class="tabs tabs-wishlist" data-cookie="wishlistTabs">
            <li {if $_COOKIE['wishlistTabs'] == "#list-products"}class="active"{/if}>
                <button type="button" data-href="#list-products">
                    <span class="text-el d_l_1">{lang('Список товаров','newLevel')}</span>
                </button>
            </li>
            <li {if $_COOKIE['wishlistTabs'] == "#data-users"}class="active"{/if}>
                <button type="button" data-href="#data-users">
                    <span class="text-el d_l_1">{lang('Дополнительные данные','newLevel')}</span>
                </button>
            </li>
        </ul>
        <div class="clearfix frame-tabs-ref">
            <div id="list-products" {if $_COOKIE['wishlistTabs'] == "#list-products"}style="display: block;"{/if}>
                <div class="frame-button-add-wish-list">
                    <div class="btn-cart">
                        <button type="button" data-drop=".drop-add-wishlist" data-place="inherit" data-overlay-opacity="0" data-effect-on="slideDown" data-effect-off="slideUp">
                            <span class="icon_add_wish"></span>
                            <span class="text-el">{lang('Создать новый список','newLevel')}</span>
                        </button>
                    </div>
                    <span class="help-block">{lang('В список избранных вы можете отложить понравившиеся товары, также показать список друзьям', 'newLevel')}</span>
                </div>
                <div class="drop drop-style-2 drop-add-wishlist">
                    <div class="drop-header">
                        <div class="title">{lang('Создание списка избранных товаров','newLevel')}</div>
                    </div>
                    <div class="drop-content2">
                        <div class="inside-padd">
                            <div class="horizontal-form big-title">
                                <form method="POST" action="{site_url('/wishlist/wishlistApi/createWishList')}">
                                    <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                                    <div class="frame-label">
                                        <span class="title">{lang('Доступность:','newLevel')}</span>
                                        <div class="frame-form-field check-public">
                                            <div class="lineForm">
                                                <select name="wlTypes" id="wlTypes">
                                                    <option value="shared">{lang('Коллективный', 'newLevel')}</option>
                                                    <option value="public">{lang('Публичный', 'newLevel')}</option>
                                                    <option value="private">{lang('Приватный', 'newLevel')}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <label>
                                        <span class="title">{lang('Название списка:','newLevel')}</span>
                                        <span class="frame-form-field">
                                            <input type="text" value="" name="wishListName"/>
                                        </span>
                                    </label>
                                    <label>
                                        <span class="title">{lang('Описание:','newLevel')}</span>
                                        <span class="frame-form-field">
                                            <textarea name="wlDescription"></textarea>
                                        </span>
                                    </label>
                                    <div class="frame-label">
                                        <span class="title">&nbsp;</span>
                                        <div class="frame-form-field">
                                            <div class="btn-def">
                                                <button
                                                    type="submit"
                                                    data-source="{site_url('/wishlist/wishlistApi/createWishList')}"
                                                    data-modal="true"

                                                    data-always="true"
                                                    onclick="serializeForm(this)"
                                                    data-drop="#notification"
                                                    data-effect-on="fadeIn"
                                                    data-effect-off="fadeOut"
                                                    data-after="WishListFront.createWishList"
                                                    >
                                                    <span class="text-el">{lang('Создать новый список','newLevel')}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    {form_csrf()}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {if count($wishlists)>0}
                    {foreach $wishlists as $key => $wishlist}
                        <div class="drop-style-2 drop-wishlist-items" data-rel="list-item">
                            <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                            <div class="drop-content2">
                                <div class="inside-padd">
                                    {if $wishlist[0][title]}
                                        <h2>{$wishlist[0][title]}</h2>
                                    {/if}
                                    {if $wishlist[0][description]}
                                        <div class="text">
                                            {$wishlist[0][description]}
                                        </div>
                                    {/if}
                                    {if $wishlist[0][variant_id]}
                                        <ul class="items items-catalog items-wish-list items-product">
                                            {getOPI($wishlist, array('opi_wishListPage' => true))}
                                        </ul>
                                    {else:}
                                        <div class="msg layout-highlight layout-highlight-msg">
                                            <div class="info">
                                                <span class="icon_info"></span>
                                                <span class="text-el">{lang('Список пуст','newLevel')}</span>
                                            </div>
                                        </div>
                                    {/if}
                                </div>
                            </div>
                            <div class="drop-footer2">
                                <div class="inside-padd clearfix">
                                    <div class="f_l">
                                        <div class="clearfix">
                                            <div class="funcs-buttons-wishlist f_l">
                                                <div class="btn-edit-WL">
                                                    <button
                                                        type="button"
                                                        data-source="{site_url('/wishlist/editWL/'.$wishlist[0][wish_list_id])}"
                                                        data-drop=".drop-edit-wishlist"
                                                        data-always="true"
                                                        >
                                                        <span class="d_l_1 text-el">{lang('Редактировать список','newLevel')}</span>
                                                    </button>
                                                </div>
                                                <div class="btn-remove-WL">
                                                    <button
                                                        type="button"
                                                        data-source="{site_url('/wishlist/wishlistApi/deleteWL/'.$wishlist[0][wish_list_id])}"

                                                        data-modal="true"

                                                        data-drop="#notification"
                                                        data-after="WishListFront.removeWL"
                                                        data-confirm="true"

                                                        data-effect-on="fadeIn"
                                                        data-effect-off="fadeOut"
                                                        >
                                                        <span class="icon_remove"></span>
                                                        <span class="text-el d_l_1">{lang('Удалить список','newLevel')}</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="f_l">
                                                <b>{lang('Доступность:','newLevel')}</b>
                                                {if $wishlist[0][access] == 'private'}
                                                    <span class="s_t">{lang('Приватный', 'newLevel')}</span>
                                                {/if}
                                                {if $wishlist[0][access] == 'public'}
                                                    <span class="s_t">{lang('Публичный', 'newLevel')}</span>
                                                {/if}
                                                {if $wishlist[0][access] == 'shared'}
                                                    <span class="s_t">{lang('Коллективный', 'newLevel')}</span>
                                                {/if}
                                            </div>
                                        </div>
                                        <div>
                                            {if $wishlist[0]['access'] == 'shared' || $wishlist[0]['access'] == 'public'}
                                                <div class="btn-form btn-send-wishlist">
                                                    <button type="button" data-drop=".drop-sendemail" title="{lang('Поделится с другом','newLevel')}" data-source="{echo site_url('wishlist/wishlistApi/renderEmail/' . $wishlist[0][wish_list_id])}">
                                                        <span class="icon_mail"></span>
                                                        <span class="text-el">{lang('Поделиться с другом', 'newLevel')}</span>
                                                    </button>
                                                </div>
                                            {/if}
                                            {if $wishlist[0]['access'] == 'shared'}
                                                {echo $CI->load->module('share')->_make_share_form(site_url('wishlist/show/'.$wishlist[0]['hash']))}
                                            {/if}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {form_csrf()}
                        </div>
                    {/foreach}
                {else:}
                    <div class="msg layout-highlight layout-highlight-msg">
                        <div class="info">
                            <span class="icon_info"></span>
                            <span class="text-el">{lang('Список Желания пуст','newLevel')}</span>
                        </div>
                    </div>
                {/if}
            </div>
            <div id="data-users" {if $_COOKIE['wishlistTabs'] == "#data-users"}style="display: block;"{/if}>
                <ul class="items items-wish-data left-wishlist-data">
                    <li class="clearfix">
                        <div class="frame-photo-title">
                            <form action="{site_url('/wishlist/do_upload')}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                <input type="hidden" value="{echo $user[id]}" name="userID"/>
                                <div class="photo-block m-b_5">
                                    <span class="helper"></span>
                                    <span id="wishlistphoto" data-width="{echo $settings[maxImageWidth]}" data-height="{echo $settings[maxImageHeight]}">
                                        {if $user['user_image']!=''}
                                            <img src="{site_url('uploads/mod_wishlist/'.$user['user_image'])}" alt='pic' data-src="{$THEME}{$colorScheme}/images/nophoto.png"/>
                                        {else:}
                                            <img src="{$THEME}{$colorScheme}/images/nophoto.png"/>
                                        {/if}
                                    </span>
                                    <div class="group-buttons f-s_0">
                                        <label class="btn-edit-photo-wishlist" for="img">
                                            <button type="button" class="p_r hidden">
                                                <span class="icon_edit"></span>
                                                <input id="img" data-wishlist="image" type="file" name="file" size="20" accept="image/gif, image/jpeg, image/png, image/jpg"/>
                                            </button>
                                        </label>
                                        {if $user['user_image']!=''}
                                            <div class="btn-remove-photo-wishlist">
                                                <button
                                                    type="button"
                                                    data-source="{site_url('/wishlist/wishlistApi/deleteImage')}"
                                                    data-modal="true"

                                                    data-drop="#notification"
                                                    data-data='{literal}{"image": {/literal}"{echo $user[user_image]}"{literal}}{/literal}'
                                                    data-after="WishListFront.deleteImage"
                                                    data-wishlist="delete_img"

                                                    data-effect-on="fadeIn"
                                                    data-effect-off="fadeOut"
                                                    >
                                                    <span class="icon_remove"></span>
                                                </button>
                                            </div>
                                        {/if}
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                                <div class="btn-def download-btn disabled">
                                    <input type="submit" value="{lang('загрузить катринку','newLevel')}" data-wishlist="do_upload" disabled="disabled"/>
                                </div>
                                {form_csrf()}
                            </form>
                        </div>
                    </li>
                </ul>
                <div class="right-wishlist-data">
                    {/*}<div class="btn-edit-WL">
                        <button type="button" data-drop=".form-data" data-place="inherit"  class="d_l_1">
                            <span class="text-el">{lang('Редактировать','newLevel')}</span>
                        </button>
                    </div>
                    { */}
                    <div class="form-data horizontal-form big-title">
                        <form>
                            <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                            <label>
                                <span class="title">{lang('ФИО:','newLevel')}</span>
                                <span class="frame-form-field">
                                    <input type="text" value="{echo $user[user_name]}" name="user_name"/>
                                </span>
                            </label>
                            <label>
                                <span class="title">{lang('Дата рождения:','newLevel')}</span>
                                <span class="frame-form-field">
                                    <input type="text" id='datepicker' onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" value="{if $user[user_birthday]}{echo date('Y-m-d', $user[user_birthday])}{/if}" name="user_birthday"/>
                                </span>
                            </label>
                            <label>
                                <span class="title">{lang('Дополнительно:','newLevel')}</span>
                                <span class="frame-form-field">
                                    <textarea name="description">{echo $user[description]}</textarea>
                                </span>
                            </label>
                            <div class="frame-label">
                                <span class="title">&nbsp;</span>
                                <div class="frame-form-field">
                                    <div class="btn-def">
                                        <button
                                            type="submit"
                                            data-source="{site_url('/wishlist/wishlistApi/userUpdate')}"
                                            data-modal="true"

                                            data-effect-on="fadeIn"
                                            data-effect-off="fadeOut"

                                            data-drop="#notification"
                                            onclick="serializeForm(this)"
                                            data-after="WishListFront.changeDataWishlist"
                                            >
                                            <span class="text-el">{lang('Сохранить','newLevel')}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>