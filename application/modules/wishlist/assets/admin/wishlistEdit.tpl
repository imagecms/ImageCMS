    <div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Edit list', 'wishlist')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/cp/wishlist/userWL/{$user_id}#lists"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'wishlist')}</span>
                    </a>
                    <a class="btn btn-small pjax" href="{$BASE_URL}admin/components/cp/wishlist/settings">
                        <i class="icon-wrench"></i>
                        {lang('Settings', 'wishlist')}
                    </a>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <label>
                <span class="frame_form_field__icsi-css">
                    <div class="frameLabel__icsi-css error_text" name="error_text"></div>
                </span>
            </label>
            {foreach $wishlists as $key => $wishlist}
                <form method="POST" action="/admin/components/cp/wishlist/updateWL">
                    <table class="table  table-bordered table-hover table-condensed t-l_a content_big_td">
                        <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                        <thead>
                            <tr>
                                <th colspan="6">{lang('List', 'wishlist')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd span9">
                                        <div class="form-horizontal">
                                            <div class="control-group">
                                                <label class="control-label" for="banner_type">{lang('Name', 'wishlist')}:</label>
                                                <div class="controls">
                                                    <input type="text" value="{$wishlist[0][title]}" name="title" class="required"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="banner_type">{lang('List type', 'wishlist')}:</label>
                                                <div class="controls">
                                                    <select name="access">
                                                        <option {if $wishlist[0][access] == 'shared'}selected="selected"{/if} value="shared">{lang('shared', 'wishlist')}</option>
                                                        <option {if $wishlist[0][access] == 'private'}selected="selected"{/if} value="private">{lang('private', 'wishlist')}</option>
                                                        <option {if $wishlist[0][access] == 'public'}selected="selected"{/if} value="public">{lang('public', 'wishlist')}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="banner_type">{lang('Description','wishlist')}:</label>
                                                <div class="controls">
                                                    <textarea name="description">{$wishlist['0']['description']}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {if $wishlist[0][id] != null}
                        <table class="table  table-bordered table-hover table-condensed t-l_a">
                            <thead>
                                <tr>
                                    <td colspan="3">
                                    </td>
                                </tr>
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
                                        </td>
                                        <td>
                                            <a href="{shop_url('product/'.$w[url])}"
                                               title="{$w[name]}">
                                                {$w[name]}
                                            </a>
                                        </td>
                                        <td>
                                            <textarea name="comment[{echo $w[variant_id]}]">{$w[comment]}</textarea>
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    {/if}
                    {form_csrf()}
                    <input type="submit" class="btn btn-small btn-success" value="{lang('Save', 'wishlist')}"/>
                </form>
            {/foreach}
        </div>
    </section>
</div>

