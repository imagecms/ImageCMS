<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('User lists', 'wishlist')}: {echo $user[user_name]}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/cp/wishlist"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'admin')}</span>
                    </a>
                    <a class="btn btn-small pjax" href="{$BASE_URL}admin/components/cp/wishlist/settings">
                        <i class="icon-wrench"></i>
                        {lang('Settings', 'wishlist')}
                    </a>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="#user" class="btn btn-small active">{lang('User', 'wishlist')}</a>
                    <a href="#lists" class="btn btn-small">{lang('Lists', 'wishlist')}</a>
                    <a href="#create_list" class="btn btn-small">{lang('Create list', 'wishlist')}</a>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="user">
                    <table class="table table-striped table-bordered table-hover table-condensed t-l_a">
                        <thead>
                            <tr>
                                <th colspan="6">{lang('User', 'wishlist')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd span9">
                                        <label>
                                            <span class="frame_form_field__icsi-css">
                                                <div class="frameLabel__icsi-css error_text" name="error_text"></div>
                                            </span>
                                        </label>
                                        <div class="form-horizontal">
                                            <div class="control-group">
                                                {if $upload_errors}
                                                    <div class="alert alert-danger">
                                                        {foreach  $upload_errors as $error}
                                                            <p class="alert-link">{echo $error}</p>
                                                            <br>
                                                        {/foreach}
                                                    </div>
                                                {/if}
                                                <div class="controls">
                                                    <img src="{site_url('uploads/mod_wishlist/'.$user['user_image'])}"
                                                         class="img-polaroid"
                                                         alt='{lang('Ava', 'wishlist')}'
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
                                                    <input type="submit" value="{lang('Upload', 'wishlist')}" class="btn" />
                                                    {form_csrf()}
                                                    </form>
                                                </div>
                                                <div class="controls">
                                                    <form method="POST" action="/admin/components/cp/wishlist/deleteImage">
                                                        <input type="hidden" value="{echo $user[user_image]}" name="image"/>
                                                        <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                                                        <input type="submit" value="{lang('Delete image', 'wishlist')}" class="btn btn-danger btn-small"/>
                                                        {form_csrf()}
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <form method="POST" action="/admin/components/cp/wishlist/userUpdate">
                                            <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                                            <div class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang('Name', 'wishlist')}</label>
                                                    <div class="controls">
                                                        <input type="text" value="{echo $user[user_name]}" name="user_name"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang('Birthday', 'wishlist')}:</label>
                                                    <div class="controls">
                                                        <input type="text" id='datepicker' value="{echo date('Y-m-d', $user[user_birthday])}" name="user_birthday"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang('Description', 'wishlist')}:</label>
                                                    <div class="controls">
                                                        <textarea name="description">{echo $user[description]}</textarea>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <input type="submit" class="btn btn-small btn-success" value="{lang('Save', 'wishlist')}"/>
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
                                    <h5>{lang('List type', 'wishlist')}:
                                        {if $wishlist['0']['access'] == 'shared'}
                                            <i>
                                                {lang('shared', 'wishlist')}
                                            </i>
                                        {/if}
                                        {if $wishlist['0']['access'] == 'private'}
                                            <i>
                                                {lang('private', 'wishlist')}
                                            </i>
                                        {/if}
                                        {if $wishlist['0']['access'] == 'public'}
                                            <i>
                                                {lang('public', 'wishlist')}
                                            </i>
                                        {/if}
                                    </h5>
                                    <h5 style="margin-right: 10px;">{lang('Description', 'wishlist')}:
                                        <br>
                                        <i>{echo $wishlist[0][description]}</i>
                                    </h5>
                                </div>
                                <div class="pull-right" style="margin-top: 37px; margin-right: 20px ">
                                    <a class="btn btn-danger btn-small" href="/admin/components/cp/wishlist/deleteWL/{$wishlist[0][wish_list_id]}">
                                        <i class="icon-trash icon-white"></i>
                                        {lang('Delete', 'wishlist')}
                                    </a>
                                    <a class="btn btn-small" href="/admin/components/cp/wishlist/editWL/{$wishlist[0][wish_list_id]}/{echo $user[id]}">
                                        <i class="icon-edit"></i>
                                        {lang('Edit', 'wishlist')}
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
                                                <th>{lang('Unsubscribe', 'wishlist')}</th>
                                                <th>{lang('Product', 'wishlist')}</th>
                                                <th>{lang('Comment', 'wishlist')}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            {foreach $wishlist as $key => $w}
                                                <tr>
                                                    <td>{echo $key+1}</td>
                                                    <td>
                                                        <a href="/admin/components/cp/wishlist/deleteItem/{echo $w[variant_id]}/{echo $w[wish_list_id]}">{lang('Delete', 'wishlist')}</a>
                                                        <a href="/admin/components/cp/wishlist/renderPopup/{echo $w[variant_id]}/{echo $w[wish_list_id]}/{echo $user[id]}">{lang('Move', 'wishlist')}</a>
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
                                    {lang('Empty list', 'wishlist')}
                                </div>
                            {/if}

                        {/foreach}
                    {else:}
                        <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                            {lang('No lists', 'wishlist')}
                        </div>

                    {/if}
                </div>
                <div class="tab-pane" id="create_list">
                    <table class="table table-striped table-bordered table-hover table-condensed t-l_a">
                        <thead>
                            <tr>
                                <th colspan="6">{lang('Create list', 'wishlist')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd span9">

                                        <div id="notifies" >
                                            <!-- class="alert alert-error" -->
                                        </div>

                                        <form id="wishlistForm" class="form-horizontal">
                                            <input type="hidden" value="{echo $user[id]}" name="user_id"/>
                                            <div class="form-horizontal">
                                                <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang('Type', 'wishlist')}:</label>
                                                    <div class="controls">
                                                        <select name="wlTypes">
                                                            <option value="shared">{lang('shared', 'wishlist')}</option>
                                                            <option value="public">{lang('public', 'wishlist')}</option>
                                                            <option value="private">{lang('private', 'wishlist')}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang('List name', 'wishlist')}:</label>
                                                    <div class="controls">
                                                        <input type="text" required="required" class="wishListName" value="" name="wishListName"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="banner_type">{lang('Description','wishlist')}:</label>
                                                    <div class="controls">
                                                        <textarea name="wlDescription"></textarea>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <input id="createWishList" type="submit" value="{lang('Create list', 'wishlist')}" class="btn btn-small btn-success"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{$userId}" name="userId">
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