<div class="frame-inside page-wishlist">
    <div class="container">
        {if $errors}
            {foreach $errors as $error}
                <div class="msg">
                    <div class="error">{$error}</div>
                </div>
            {/foreach}
        {/if}
        <ul class="items items-row items-wish-data">
            <li class="clearfix">
                <div class="frame-photo-title">
                    <form action="/wishlist/do_upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <input type="hidden" value="{echo $user[id]}" name="userID"/>
                        <div class="photo-block">
                            <span class="helper"></span>
                            <span id="wishlistphoto">
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
                                            data-source="/wishlist/wishlistApi/deleteImage"
                                            data-type="json"
                                            data-modal="true"
                                            data-overlayopacity= "0"
                                            data-drop="#notification"
                                            data-data='{literal}{"image": {/literal}"{echo $user[user_image]}"{literal}}{/literal}'
                                            data-callback="deleteImage"
                                            data-wishlist="delete_img"
                                            >
                                            <span class="icon_remove"></span>
                                        </button>
                                    </div>
                                {/if}
                            </div>
                            <div class="overlay"></div>
                        </div>
                        <span class="help-block f-s_11">Максимальный размер {echo $settings[maxImageWidth]}&times;{echo $settings[maxImageHeight]} пикселей</span>
                        <div class="btn-def">
                            <input type="submit" value="загрузить катринку" data-wishlist="do_upload" disabled="disabled"/>
                        </div>
                        {form_csrf()}
                    </form>
                </div>
                <div class="description">
                    <h2 data-wishlist-name="user_name">{echo $user[user_name]}</h2>
                    <div class="date f-s_0">
                        <span data-wishlist-name="user_birthday">{echo date('Y-m-d', $user[user_birthday])}</span>
                        {/*<span class="day">{echo date("d", $user[user_birthday])} </span>
                            <span class="month">{echo date("F", $user[user_birthday])} </span>
                            <span class="year">{echo date("Y ", $user[user_birthday])}</span>*/}
                    </div>
                    <div class="text">
                        <p data-wishlist-name="description">{echo $user[description]}</p>
                    </div>
                    <button type="button" data-drop=".form-data" data-place="inherit" data-overlayopacity= "0" class="d_l_1">Редактировать</button>
                    <div class="form-data drop horizontal-form">
                        <form>
                            <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                            <label>
                                <span class="title">ФИО:</span>
                                <span class="frame-form-field">
                                    <input type="text" value="{echo $user[user_name]}" name="user_name"/>
                                </span>
                            </label>
                            <label>
                                <span class="title">Дата рождения:</span>
                                <span class="frame-form-field">
                                    <input type="text" id='datepicker' value="{echo date('Y-m-d', $user[user_birthday])}" name="user_birthday"/>
                                </span>
                            </label>
                            <label>
                                <span class="title">Дополнительно:</span>
                                <span class="frame-form-field">
                                    <textarea name="description">{echo $user[description]}</textarea>
                                </span>
                            </label>
                            <div class="frame-label">
                                <span class="title">&nbsp;</span>
                                <div class="frame-form-field">
                                    <div class="btn-def">
                                        <button
                                            type="button"
                                            data-source="/wishlist/wishlistApi/userUpdate"
                                            data-type="json"
                                            data-modal="true"
                                            data-overlayopacity= "0"
                                            data-drop="#notification"
                                            onclick="serializeForm(this)"
                                            data-callback="changeDataWishlist"
                                            >
                                            <span class="text-el">Сохранить</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
        <div class="frame-button-add-wish-list">
            <div class="btn-cart">
                <button type="button" data-drop=".drop-add-wishlist" data-place="inherit" data-overlayopacity= "0">
                    <span class="icon_add_wish"></span>
                    <span class="text-el">Создать новый список</span>
                </button>
            </div>
            <span class="help-block">В список избранных вы можете отложить понравившиеся товары, также показать список друзьям</span>
        </div>
        <div class="drop drop-style-2 drop-add-wishlist">
            <div class="drop-header">
                <div class="title">Создание списка избранных товаров</div>
            </div>
            <div class="drop-content2">
                <div class="inside-padd">
                    <div class="horizontal-form">
                        <form method="POST" action="/wishlist/wishlistApi/createWishList">
                            <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                            <label>
                                <span class="title">Доступность:</span>
                                <span class="frame-form-field check-public">
                                    <span class="lineForm">
                                        <select name="wlTypes">
                                            <option value="shared">Shared</option>
                                            <option value="public">Public</option>
                                            <option value="private">Private</option>
                                        </select>
                                    </span>
                                </span>
                            </label>
                            <label>
                                <span class="title">Название списка:</span>
                                <span class="frame-form-field">
                                    <input type="text" value="" name="wishListName"/>
                                </span>
                            </label>
                            <label>
                                <span class="title">Описание:</span>
                                <span class="frame-form-field">
                                    <textarea name="wlDescription"></textarea>
                                </span>
                            </label>
                            <div class="frame-label">
                                <span class="title">&nbsp;</span>
                                <div class="frame-form-field">
                                    <div class="btn-def">
                                        <button
                                            class="btn"
                                            type="button"
                                            data-source="/wishlist/wishlistApi/createWishList"
                                            data-type="json"
                                            data-modal="true"
                                            data-overlayopacity= "0"
                                            onclick="serializeForm(this)"
                                            data-drop="#notification"
                                            data-callback="createWishList"
                                            >
                                            <span class="text-el">Создать новий список</span>
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
                <form method="post" action="/wishlist/deleteItemsByIds" >
                    <div class="drop-style-2 drop-wishlist-items">
                        <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                        <div class="drop-header clearfix">
                            <div class="f_l">
                                <b>Доступность:</b>
                                <span class="s_t">{echo $wishlist[0][access]}</span>
                            </div>
                            <div class="f_r">
                                {if $wishlist[0]['access'] == 'shared'}
                                    {echo $CI->load->module('share')->_make_share_form(site_url('wishlist/show/'.$wishlist[0]['hash']))}
                                {/if}
                            </div>
                        </div>
                        <div class="drop-content2">
                            <div class="inside-padd">
                                <h2>{$wishlist[0][title]}</h2>
                                <div class="text">
                                    {$wishlist[0][description]}
                                </div>
                                <button
                                    class="d_l_1"
                                    type="button"
                                    data-source="/wishlist/editWL/{$wishlist[0][wish_list_id]}"
                                    data-drop=".drop-edit-wishlist"
                                    data-always="true"
                                    >редактировать</button>

                                {if $wishlist[0][variant_id]}
                                    <tr>
                                        <th>Check</th>
                                        <th>№</th>
                                        <th>Отписатся</th>
                                        <th>Товар</th>
                                        <th>Коментарий</th>
                                    </tr>
                                {/if}
                                {if $wishlist[0][variant_id]}
                                    <ul class="items items-catalog">
                                        {$CI->load->module('new_level')->OPI($wishlist, array('wishlist'=>true), 'array_product_item')}
                                    </ul>
                                {else:}
                                    <div class="msg layout-highlight layout-highlight-msg">
                                        <div class="info">
                                            <span class="icon_info"></span>
                                            <span class="text-el">Список пуст</span>
                                        </div>
                                    </div>
                                {/if}
                                <a href="/wishlist/deleteWL/{$wishlist[0][wish_list_id]}"class="btn">удалить</a>
                            </div>
                        </div>
                        {form_csrf()}
                        {if $wishlist[0][variant_id]}
                            <input type="submit" class="btn btn-small" value="Удалить">
                        {/if}
                    </div>
                </form>
            {/foreach}
        {else:}
            Список Желания пуст
        {/if}
    </div>
</div>
<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>