<div class="container">
    <section class="mini-layout">

        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Списки пользователя: {echo $user[user_name]}</span>
            </div>                          
        </div>
        <div class="row-fluid">
            <label>
                <span class="frame_form_field__icsi-css">
                    <div class="frameLabel__icsi-css error_text" name="error_text"></div>
                </span>
            </label>
            <div>
                <img src="{site_url('./uploads/mod_wishlist/'.$user['user_image'])}" alt='Ава' width="{echo $settings[maxImageWidth]}"  height="{echo $settings[maxImageHeight]}"/>
            </div>
            {form_open_multipart('/wishlist/do_upload' , 'class ="btn btn-small"')}

            <input type="file" name="userfile" size="20"/>
            <input type="hidden" value="{echo $user[id]}" name="userID"/>

            <br /><br />
            {form_csrf()}
            <input type="submit" value="upload" class="btn" />

            </form>
            <form method="POST" action="/admin/components/cp/wishlist/userUpdate">
                <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                <input type="text" value="{echo $user[user_name]}" name="user_name"/>
                <input type="date" value="{echo date('Y-m-d', $user[user_birthday])}" name="user_birthday"/>
                <textarea name="description">{echo $user[description]}</textarea>
                <input type="submit" class="btn"/>
                {form_csrf()}
            </form>

            <br /><br />

            <form method="POST" action="/wishlist/createWishList">
                <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                <input type="text" value="" name="wishListName"/>
                <input type="submit" value="Создать новий список" class="btn"/>
                {form_csrf()}
            </form>


            {if count($wishlists)>0}
                {foreach $wishlists as $key => $wishlist}
                    <h4 class="title">{$wishlist[0][title]}</h4>
                    <a href="/admin/components/cp/wishlist/deleteWL/{$wishlist[0][wish_list_id]}">удалить</a>
                    <a href="/admin/components/cp/wishlist/editWL/{$wishlist[0][wish_list_id]}/{echo $user[id]}">редактировать</a>
                    <div class="wishListDescription" >{$wishlist[0][description]}</div>
                    {echo $wishlist[0][access]}
                    <form>                    
                        <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                        <table class="table table-striped table-bordered table-hover table-condensed products_table">
                            <thead>
                                {if $wishlist[0][variant_id]}
                                    <tr>
                                        <th>№</th>
                                        <th>Отписатся</th>
                                        <th>Товар</th>
                                        <th>Коментарий</th>
                                    </tr>
                                {else:}
                                    <tr>
                                        <th style="height: 20px"></th>
                                    </tr>
                                {/if}
                            </thead>
                            <tbody>
                                {if $wishlist[0][variant_id]}
                                    {foreach $wishlist as $key => $w}
                                        <tr>
                                            <td>{echo $key+1}</td>
                                            <td>
                                                <a href="/wishlist/deleteItem/{echo $w[variant_id]}/{echo $w[wish_list_id]}">удалить</a>
                                                <a href="/wishlist/renderPopup/{echo $w[variant_id]}/{echo $w[wish_list_id]}">Переместить</a>
                                            </td>
                                            <td>
                                                <a href="{shop_url('product/'.$w[url])}"
                                                   title="{$w[name]}">
                                                    {$w[name]}
                                                </a>
                                            </td>
                                            <td>
                                                {$w[comment]}
                                            </td>
                                        </tr>
                                    {/foreach}
                                {else:}
                                    <tr>
                                        <td >Список пуст</td>
                                    </tr>
                                {/if}
                            </tbody>
                        </table>
                        {form_csrf()}
                    </form>
                {/foreach}
            {else:}
                Список Желания пуст
            {/if}
        </div>
    </section>
</div>