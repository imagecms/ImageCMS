{$pricePrecision = ShopCore::app()->SSettings->pricePrecision}
<div class="frame-inside page-wishlist">
    <div class="container">
        <div class="f-s_0 title-cart without-crumbs">
            <div class="frame-title">
                <h1 class="title">{lang('Список желаний','lightVertical')}</h1>
            </div>
        </div>
        {if $errors}
            {foreach $errors as $error}
                <div class="msg">
                    <div class="error">{$error}</div>
                </div>
            {/foreach}
        {/if}
        <div class="clearfix frame-tabs-ref">
            <div id="list-products" style="display: block;">
                <div class="frame-button-add-wish-list">
                    <div class="btn-cart">
                        <button type="button" data-drop=".drop-add-wishlist" data-place="inherit" data-overlay-opacity="0" data-effect-on="slideDown" data-effect-off="slideUp">
                            <span class="icon_add_wish"></span>
                            <span class="text-el">{lang('Создать новый список','lightVertical')}</span>
                        </button>
                    </div>
                    <span class="help-block">{lang('В список избранных вы можете отложить понравившиеся товары, также показать список друзьям', 'lightVertical')}</span>
                </div>
                <div class="drop drop-style-2 drop-add-wishlist">
                    <div class="drop-header">
                        <div class="title">{lang('Создание списка избранных товаров','lightVertical')}</div>
                    </div>
                    <div class="drop-content2">
                        <div class="inside-padd">
                            <div class="horizontal-form big-title">
                                <form method="POST" action="{site_url('/wishlist/wishlistApi/createWishList')}">
                                    <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                                    <div class="frame-label">
                                        <span class="title">{lang('Доступность:','lightVertical')}</span>
                                        <div class="frame-form-field check-public">
                                            <div class="lineForm">
                                                <select name="wlTypes" id="wlTypes">
                                                    <option value="shared">{lang('Коллективный', 'lightVertical')}</option>
                                                    <option value="public">{lang('Публичный', 'lightVertical')}</option>
                                                    <option value="private">{lang('Приватный', 'lightVertical')}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <label>
                                        <span class="title">{lang('Название списка:','lightVertical')}</span>
                                        <span class="frame-form-field">
                                            <input type="text" value="" name="wishListName"/>
                                        </span>
                                    </label>
                                    <label>
                                        <span class="title">{lang('Описание:','lightVertical')}</span>
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
                                                    <span class="text-el">{lang('Создать новый список','lightVertical')}</span>
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
                                        <ul class="items items-catalog items-wish-list">
                                            {getOPI($wishlist, array('opi_wishListPage' => true))}
                                        </ul>
                                    {else:}
                                        <div class="msg layout-highlight layout-highlight-msg">
                                            <div class="info">
                                                <span class="icon_info"></span>
                                                <span class="text-el">{lang('Список пуст','lightVertical')}</span>
                                            </div>
                                        </div>
                                    {/if}
                                </div>
                            </div>
                            <div class="drop-footer2">
                                <div class="inside-padd">
                                    <div class="funcs-buttons-wishlist d_i-b">
                                        <div class="btn-edit-WL">
                                            <button
                                                type="button"
                                                data-source="{site_url('/wishlist/editWL/'.$wishlist[0][wish_list_id])}"
                                                data-drop=".drop-edit-wishlist"
                                                data-always="true"
                                                >
                                                <span class="d_l_1 text-el">{lang('Редактировать список','lightVertical')}</span>
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
                                                <span class="text-el d_l_1">{lang('Удалить список','lightVertical')}</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d_i-b m-r_10">
                                        <b>{lang('Доступность:','lightVertical')}</b>
                                        {if $wishlist[0][access] == 'private'}
                                            <span class="s_t">{lang('Приватный', 'lightVertical')}</span>
                                        {/if}
                                        {if $wishlist[0][access] == 'public'}
                                            <span class="s_t">{lang('Публичный', 'lightVertical')}</span>
                                        {/if}
                                        {if $wishlist[0][access] == 'shared'}
                                            <span class="s_t">{lang('Коллективный', 'lightVertical')}</span>
                                        {/if}
                                    </div>
                                    {if $wishlist[0]['access'] == 'shared' || $wishlist[0]['access'] == 'public'}
                                        <div class="btn-form btn-send-wishlist d_i-b m-r_10">
                                            <button type="button" data-drop=".drop-sendemail" title="{lang('Поделится с другом','lightVertical')}" data-source="{echo site_url('wishlist/wishlistApi/renderEmail/' . $wishlist[0][wish_list_id])}">
                                                <span class="icon_mail"></span>
                                                <span class="text-el">{lang('Поделиться с другом')}</span>
                                            </button>
                                        </div>
                                    {/if}
                                    {if $wishlist[0]['access'] == 'shared'}
                                        <div class="d_i-b">
                                            {echo $CI->load->module('share')->_make_share_form(site_url('wishlist/show/'.$wishlist[0]['hash']))}
                                        </div>
                                    {/if}
                                </div>
                            </div>
                            {form_csrf()}
                        </div>
                    {/foreach}
                {else:}
                    <div class="msg layout-highlight layout-highlight-msg">
                        <div class="info">
                            <span class="icon_info"></span>
                            <span class="text-el">{lang('Список Желания пуст','lightVertical')}</span>
                        </div>
                    </div>
                {/if}
            </div>
        </div>
    </div>
</div>