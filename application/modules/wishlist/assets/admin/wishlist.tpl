<div class="container">
    <section class="mini-layout">


        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
<<<<<<< HEAD
                <span class="title">Списки пользователя: {echo $user[user_name]}</span>
            </div>
=======
                <span class="title">{lang(user_lists)}: {echo $user[user_name]}</span>
            </div>                          
>>>>>>> d2dd66ed33a175d3ce31c2f47941200e9e873d7a
        </div>
        <div class="row-fluid">

            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="#user" class="btn btn-small active">{lang(user)}</a>
                    <a href="#lists" class="btn btn-small">{lang(lists)}</a>
                    <a href="#create_list" class="btn btn-small">{lang(create_list)}</a>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="user">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="6">{lang(user)}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <label>
                                            <span class="frame_form_field__icsi-css">
                                                <div class="frameLabel__icsi-css error_text" name="error_text"></div>
                                            </span>
                                        </label>
                                        <div class="form-horizontal">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <img src="{site_url('./uploads/mod_wishlist/'.$user['user_image'])}" class="img-polaroid" alt='Ава' width="{echo $settings[maxImageWidth]}"  height="{echo $settings[maxImageHeight]}"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    {form_open_multipart('/wishlist/do_upload')}
                                                    <input type="file"  name="userfile" size="20"  accept="image/gif, image/jpeg, image/png, image/jpg" style="position: relative!important; opacity: 2!important;"/>
                                                    <input type="hidden" value="{echo $user[id]}" name="userID"/>
                                                    <input type="submit" value="upload" class="btn" />
                                                    {form_csrf()}
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <form method="POST" action="/admin/components/cp/wishlist/userUpdate">
                                            <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                                            <div class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang(name)}</label>
                                                    <div class="controls">
                                                        <input type="text" value="{echo $user[user_name]}" name="user_name"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang(birthday)}:</label>
                                                    <div class="controls">
                                                        <input type="date" value="{echo date('Y-m-d', $user[user_birthday])}" name="user_birthday"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang(last)}:</label>
                                                    <div class="controls">
                                                        <textarea name="description">{echo $user[description]}</textarea>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <input type="submit" class="btn" value="{lang()}Сохранить"/>
                                                    </div>
                                                </div>
                                            </div>
                                            {form_csrf()}
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="lists">
                    {if count($wishlists)>0}
                        {foreach $wishlists as $key => $wishlist}
                            <h4 class="title">{$wishlist[0][title]}</h4>
                            <lable>Тип списка: <b>{echo $wishlist[0][access]}</b></lable>
                            <br>
                            <a href="/admin/components/cp/wishlist/deleteWL/{$wishlist[0][wish_list_id]}">{lang()}удалить</a>
                            <a href="/admin/components/cp/wishlist/editWL/{$wishlist[0][wish_list_id]}/{echo $user[id]}">{lang()}редактировать</a>
                            <div class="wishListDescription" >
                                {$wishlist[0][description]}
                            </div>
                            <form>
                                <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                                <table class="table table-striped table-bordered table-hover table-condensed products_table">
                                    <thead>
                                        {if $wishlist[0][variant_id]}
                                            <tr>
                                                <th>№</th>
                                                <th>{lang()}Отписатся</th>
                                                <th>{lang()}Товар</th>
                                                <th>{lang()}Коментарий</th>
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
                                                        <a href="/wishlist/deleteItem/{echo $w[variant_id]}/{echo $w[wish_list_id]}">{lang()}удалить</a>
                                                        <a href="/wishlist/renderPopup/{echo $w[variant_id]}/{echo $w[wish_list_id]}">{lang()}Переместить</a>
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
                                                <td >{lang()}Список пуст</td>
                                            </tr>
                                        {/if}
                                    </tbody>
                                </table>
                                {form_csrf()}
                            </form>
                        {/foreach}
                    {else:}
                       {lang()} Список Желания пуст
                    {/if}
                </div>
                <div class="tab-pane" id="create_list">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="6">{lang()}Создать список</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <form method="POST" action="/wishlist/createWishList">
                                            <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                                            <div class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang()}Название списка:</label>
                                                    <div class="controls">
                                                        <input type="text" value="" name="wishListName"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <input type="submit" value="{lang()}Создать новий список" class="btn"/>
                                                    </div>
                                                </div>
                                            </div>
                                            {form_csrf()}
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
