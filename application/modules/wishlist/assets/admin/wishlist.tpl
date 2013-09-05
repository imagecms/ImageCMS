<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang(user_lists)}: {echo $user[user_name]}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/cp/wishlist"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'wishlist')}</span>
                    </a>
                    <a class="btn btn-small pjax" href="{$BASE_URL}admin/components/cp/wishlist/settings">
                        <i class="icon-wrench"></i>
                        {lang(settings)}
                    </a>
                </div>
            </div>
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
                                                    <img src="{site_url('./uploads/mod_wishlist/'.$user['user_image'])}"
                                                         class="img-polaroid"
                                                         alt='{lang(ava)}'
                                                         width="{echo $settings[maxImageWidth]}"
                                                         height="{echo $settings[maxImageHeight]}"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    {form_open_multipart('/admin/components/cp/wishlist/do_upload')}
                                                    <input type="file"
                                                           name="file"
                                                           size="20"
                                                           accept="image/gif, image/jpeg, image/png, image/jpg"
                                                           style="position: relative!important; opacity: 2!important;"/>
                                                    <input type="hidden" value="{echo $user[id]}" name="userID"/>
                                                    <input type="submit" value="Загрузить" class="btn" />
                                                    {form_csrf()}
                                                    </form>
                                                </div>
                                                <div class="controls">
                                                    <form method="POST" action="/admin/components/cp/wishlist/deleteImage">
                                                        <input type="hidden" value="{echo $user[user_image]}" name="image"/>
                                                        <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                                                        <input type="submit" value="Удалить картинку" class="btn btn-danger btn-small"/>
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
                                                        <input type="text" id='datepicker' value="{echo date('Y-m-d', $user[user_birthday])}" name="user_birthday"/>
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
                                                        <input type="submit" class="btn btn-small btn-success" value="{lang(save)}"/>
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
                            <div class="frame_title clearfix" style="top: 179px; width: 1168px;">
                                <div class="pull-left">
                                    <h4 class="title">
                                        <b>{$wishlist[0][title]}</b>
                                    </h4>
                                    <h5>{lang(list_type)}:
                                        <i>{echo $wishlist[0][access]}</i>
                                    </h5>
                                    <h5 style="margin-right: 10px;">Описание:
                                        <br>
                                        <i>{echo $wishlist[0][description]}</i>
                                    </h5>
                                </div>
                                <div class="pull-right" style="margin-top: 37px; margin-right: 20px ">
                                    <a class="btn btn-danger btn-small" href="/admin/components/cp/wishlist/deleteWL/{$wishlist[0][wish_list_id]}">
                                        <i class="icon-trash icon-white"></i>
                                        {lang(delete)}
                                    </a>
                                    <a class="btn btn-small" href="/admin/components/cp/wishlist/editWL/{$wishlist[0][wish_list_id]}/{echo $user[id]}">
                                        <i class="icon-edit"></i>
                                        {lang(edit)}
                                    </a>
                                </div>
                            </div>
                            {if $wishlist[0][variant_id]}
                                <form>
                                    <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                                    <table class="table table-striped table-bordered table-hover table-condensed products_table">
                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>{lang(unsubscribe)}</th>
                                                <th>{lang(product)}</th>
                                                <th>{lang(comment)}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            {foreach $wishlist as $key => $w}
                                                <tr>
                                                    <td>{echo $key+1}</td>
                                                    <td>
                                                        <a href="/admin/components/cp/wishlist/deleteItem/{echo $w[variant_id]}/{echo $w[wish_list_id]}">{lang(delete)}</a>
                                                        <a href="/admin/components/cp/wishlist/renderPopup/{echo $w[variant_id]}/{echo $w[wish_list_id]}/{echo $user[id]}">{lang(move)}</a>
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
                            {else:}
                                <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                                    {lang(empty_list)}
                                </div>
                            {/if}

                        {/foreach}
                    {else:}
                        <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                            {lang(no_lists)}
                        </div>

                    {/if}
                </div>
                <div class="tab-pane" id="create_list">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="6">{lang(create_list)}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <form method="POST" action="/admin/components/cp/wishlist/createWishList">
                                            <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                                            <div class="form-horizontal">
                                                 <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang('Type')}:</label>
                                                    <div class="controls">
                                                        <select name="wlTypes">
                                                            <option value="shared">Shared</option>
                                                            <option value="public">Public</option>
                                                            <option value="private">Private</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang(list_name)}:</label>
                                                    <div class="controls">
                                                        <input type="text" value="" name="wishListName"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang('Description')}:</label>
                                                    <div class="controls">
                                                        <textarea name="wlDescription"></textarea>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <input type="submit" value="{lang(create_list)}" class="btn btn-small btn-success"/>
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
