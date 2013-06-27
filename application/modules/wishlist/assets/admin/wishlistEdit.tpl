<div class="container">
    <section class="mini-layout">

        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang(edit_list)}: {echo $user[user_name]}</span>
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
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="6">{lang(list_)}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="form-horizontal">
                                            <div class="control-group">
                                                <label class="control-label" for="banner_type">{lang(name)}:</label>
                                                <div class="controls">
                                                    <input type="text" value="{$wishlist[0][title]}" name="title"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="banner_type">{lang(list_type)}:</label>
                                                <div class="controls">
                                                    <select name="access">
                                                        <option {if $wishlist[0][access] == 'shared'}selected="selected"{/if} value="shared">shared</option>
                                                        <option {if $wishlist[0][access] == 'private'}selected="selected"{/if} value="private">private</option>
                                                        <option {if $wishlist[0][access] == 'public'}selected="selected"{/if} value="public">public</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <a class="btn" href="/admin/components/cp/wishlist/deleteWL/{$wishlist[0][wish_list_id]}">{lang(delete)}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <input type="hidden" name="WLID" value="{echo $wishlist[0][wish_list_id]}">
                        <thead>
                            <tr>
                                <td colspan="3">
                                </td>
                            </tr>
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
                                        <a href="/wishlist/deleteItem/{echo $w[variant_id]}/{echo $w[wish_list_id]}">{lang(delete)}</a>
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
                    {form_csrf()}
                    <input type="submit" class="btn" value="{lang(save)}"/>
                </form>
            {/foreach}
        </div>
    </section>
</div>

