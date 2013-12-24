<div class="drop drop-style drop-edit-wishlist">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    {foreach $wishlists as $key => $wishlist}
        <div class="drop-header">
            <div class="title">{lang('Редактировать:', 'newLevel')} {echo $wishlist[0]['title']}</div>
        </div>
        <div class="drop-content">
            <div class="inside-padd">
                <div class="horizontal-form big-title">
                    <form method="POST" action="{site_url('/wishlist/updateWL')}">
                        <input type="hidden" name="WLID" value="{echo $wishlist['0']['wish_list_id']}">
                        <div class="frame-label">
                            <span class="title">{lang('Доступность:', 'newLevel')}</span>
                            <div class="frame-form-field check-public-drop">
                                <div class="lineForm">
                                    <select name="access" id="access">
                                        <option {if $wishlist['0']['access'] == 'shared'}selected="selected"{/if} value="shared">shared</option>
                                        <option {if $wishlist['0']['access'] == 'private'}selected="selected"{/if} value="private">private</option>
                                        <option {if $wishlist['0']['access'] == 'public'}selected="selected"{/if} value="public">public</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <label>
                            <span class="title">{lang('Название списка:', 'newLevel')}</span>
                            <span class="frame-form-field">
                                <input type="text" value="{$wishlist['0']['title']}" name="title"/>
                            </span>
                        </label>
                        <label>
                            <span class="title">{lang('Описание:', 'newLevel')}</span>
                            <span class="frame-form-field">
                                <textarea name="description">{$wishlist['0']['description']}</textarea>
                            </span>
                        </label>
                        {if $wishlist[0][variant_id]}
                            {foreach $wishlist as $key => $w}
                                <div class="frame-label">
                                    <div class="title">
                                        <div>{lang('Коментарий к:', 'newLevel')}</div>
                                        <a class="f-w_n t-o-e" href="{shop_url('product/'.$w[url])}" title="{$w[name]}">
                                            {$w[name]}
                                        </a>
                                    </div>
                                    <div class="frame-form-field">
                                        <textarea style="height: 45px;" name="comment[{echo $w[variant_id]}]">{$w[comment]}</textarea>
                                    </div>
                                </div>
                            {/foreach}
                        {/if}
                        <div class="frame-label">
                            <div class="title">&nbsp;</div>
                            <div class="frame-form-field">
                                <div class="btn-def">
                                    <input type="submit" value="{lang('Сохранить', 'newLevel')}"/>
                                </div>
                            </div>
                        </div>
                        {form_csrf()}
                    </form>
                </div>
            </div>
        </div>
    {/foreach}
</div>