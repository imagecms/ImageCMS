<div class="frame-inside page-wishlist">
    <div class="container">
        {if $errors}
            {foreach $errors as $error}
                <div class="msg">
                    <div class="error">{$error}</div>
                </div>
            {/foreach}
        {/if}
        <form action="/wishlist/wishlistApi/do_upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <input type="hidden" value="{echo $user[id]}" name="userID"/>
            <ul class="items items-row items-wish-data">
                <li class="clearfix">
                    <div class="frame-photo-title">
                        <div class="group-buttons f-s_0">
                            <div class="btn-edit-photo-wishlist">
                                <button class="p_r hidden" type="button">
                                    <span class="icon_edit"></span>
                                    <input type="file" name="file" size="20" accept="image/gif, image/jpeg, image/png, image/jpg"/>
                                </button>
                            </div>
                            <div class="btn-remove-photo-wishlist">
                                <button class="p_r hidden" type="button" data-url="/wishlist/wishlistApi/deleteImage" data-datas='{literal}{"image": {/literal}"{echo $user[user_image]}"{literal}}{/literal}' data-rel="post" data-callback="a()">
                                    <span class="icon_remove"></span>
                                </button>
                            </div>
                        </div>
                        <div class="photo-block">
                            <span class="helper"></span>
                            <span id="wishlistphoto">
                                <img src="{site_url('uploads/mod_wishlist/'.$user['user_image'])}" alt='pic' width="{echo $settings[maxImageWidth]}"  height="{echo $settings[maxImageHeight]}"/>
                            </span>
                        </div>
                        <div class="overlay"></div>
                    </div>
                    <div class="description">
                        <h2>{echo $user[user_name]}</h2>
                        <div class="date f-s_0">
                            <span class="day">{echo date("d", $user[user_birthday])} </span>
                            <span class="month">{echo date("F", $user[user_birthday])} </span>
                            <span class="year">{echo date("Y ", $user[user_birthday])}</span>
                        </div>
                        <div class="text">
                            <p>{echo $user[description]}</p>
                        </div>
                        <div class="btn-edit-data-wishlist">
                            <button type="button">
                                <span class="text-el d_l_1" data-drop=".form-data" data-place="inherit" data-overlayopacity= "0" data-effect-on="slideDown" data-effect-off="slideUp">Редактировать</span>
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
            <input type="submit" value="upload" class="v_h"/>
            {form_csrf()}
        </form>
        <div class="form-data drop">
            <form method="POST" action="/wishlist/userUpdate">
                <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                <input type="text" value="{echo $user[user_name]}" name="user_name"/>
                <input type="text" id='datepicker' value="{echo date('Y-m-d', $user[user_birthday])}" name="user_birthday"/>
                <textarea name="description">{echo $user[description]}</textarea>
                <input type="submit" class="btn"/>
                {form_csrf()}
            </form>
        </div>




        <br /><br />
        <form method="POST" action="/wishlist/createWishList">
            <input type="hidden" value="{echo $user[id]}" name="user_id"/>
            Типи списков
            <br>
            <select name="wlTypes">
                <option value="shared">Shared</option>
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
            <br>
            Название Списка
            <input type="text" value="" name="wishListName"/>
            Описание Списка
            <textarea name="wlDescription"></textarea>
            <input type="submit" value="Создать новий список" class="btn"/>
            {form_csrf()}
        </form>


        {if count($wishlists)>0}
            {foreach $wishlists as $key => $wishlist}
                <form method="post" action="/wishlist/deleteItemsByIds" >
                    <table class="table">
                        <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                        <thead>
                            <tr>
                                <td colspan="4">
                                    <h1 class="wishListTitle">{$wishlist[0][title]}</h1>
                                    Тип списка: <b>{echo $wishlist[0][access]}</b>
                                    <div class="wishListDescription" >{$wishlist[0][description]}</div>
                                    <a href="/wishlist/deleteWL/{$wishlist[0][wish_list_id]}"class="btn">удалить</a>
                                    <a href="/wishlist/editWL/{$wishlist[0][wish_list_id]}"class="btn">редактировать</a>
                                </td>
                            </tr>
                            {if $wishlist[0][variant_id]}
                                <tr>
                                    <th>Check</th>
                                    <th>№</th>
                                    <th>Отписатся</th>
                                    <th>Товар</th>
                                    <th>Коментарий</th>
                                </tr>
                            {/if}
                        </thead>
                        <tbody>
                            {if $wishlist[0][variant_id]}
                                {foreach $wishlist as $key => $w}
                                    <tr>
                                        <td><input type="checkbox" name="listItem[]" value="{$w['list_product_id']}" /></td>
                                        <td>{echo $key+1}</td>
                                        <td>
                                            <a href="/wishlist/deleteItem/{echo $w[variant_id]}/{echo $w[wish_list_id]}" class="btn">удалить</a>
                                            <a href="/wishlist/renderPopup/{echo $w[variant_id]}/{echo $w[wish_list_id]}/{echo $user[id]}"class="btn">Переместить</a>
                                        </td>
                                        <td>
                                            <a href="{shop_url('product/'.$w[url])}"
                                               title="{$w[name]}">
                                                <img src="{site_url('uploads/shop/products/medium/'.$w[image])}"/>
                                                <br>
                                                {$w[name]}
                                            </a>
                                        </td>
                                        <td>
                                            {$w[comment]}
                                        </td>
                                        {if $w['access'] == 'shared'}
                                            {echo $CI->load->module('share')->_make_share_form(site_url('wishlist/show/'.$w['hash']))}
                                        {/if}
                                    </tr>
                                {/foreach}
                            {else:}
                                <tr>
                                    <td colspan="4">Список пуст</td>
                                </tr>
                            {/if}
                        </tbody>
                    </table>
                    {form_csrf()}
                    {if $wishlist[0][variant_id]}
                        <input type="submit" class="btn btn-small" value="Удалить">
                    {/if}
                </form>
                <hr/>
            {/foreach}
        {else:}
            Список Желания пуст
        {/if}
    </div>
</div>

