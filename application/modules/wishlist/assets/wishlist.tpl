<article class="container">
    <form name="pictureForm" method="post" autocomplete="off" enctype="multipart/form-data">
        <div>
            <span>Upload Picture :</span>
            <input type="file" name="picture" id="picture" onchange="return ajaxFileUpload(this);" />
            <span id="picture_error"></span>
            <div id="picture_preview"></div>

            <!-- iframe used for ajax file upload-->
            <!-- debug: change it to style="display:block" -->
            <iframe name="upload_iframe" id="upload_iframe" style="display:none;"></iframe>
            <!-- iframe used for ajax file upload-->
        </div>
    </form>
    <label>
        <span class="frame_form_field__icsi-css">
            <div class="frameLabel__icsi-css error_text" name="error_text"></div>
        </span>
    </label>
    {if count($wishlists)>0}
        {foreach $wishlists as $key => $wishlist}
            <form method="POST" action="/wishlist/wishlistFront/deleteWL">
                <table class="table">
                    <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                    <thead>
                        <tr>
                            <td colspan="3">
                                <h1 class="wishListTitle">{$wishlist[0][title]}</h1>
                                <div class="wishListDescription" >{$wishlist[0][description]}</div>
                                <a href="/wishlist/wishlistFront/deleteWL/{$wishlist[0][wish_list_id]}">редактировать</a>
                                <a href="/wishlist/wishlistFront/editWL/{$wishlist[0][wish_list_id]}">редактировать</a>
                                <select>
                                    <option>shared</option>
                                    <option>private</option>
                                    <option>public</option>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <th>№</th>
                            <th>Отписатся</th>
                            <th>Товар</th>
                            <th>Коментарий</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $wishlist as $key => $w}
                            <tr>
                                <td>{echo $key+1}</td>
                                <td>
                                    <a href="/wishlist/wishlistFront/deleteItem/{echo $w[variant_id]}/{echo $w[wish_list_id]}">удалить</a>
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
                    </tbody>
                </table>
                {form_csrf()}
            </form>
        {/foreach}
    {else:}
        Список Желания пуст
    {/if}
</article>

