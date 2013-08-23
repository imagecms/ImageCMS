<div class="drop drop-style drop-edit-wishlist">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    {foreach $wishlists as $key => $wishlist}
        <div class="drop-header">
            <div class="title">Редактировать: {echo $wishlist[0]['title']}</div>
        </div>
        <div class="drop-content">
            <div class="inside-padd">
                <div class="horizontal-form big-title">
                    <form method="POST" action="{site_url('/wishlist/updateWL')}">
                        <input type="hidden" name="WLID" value="{echo $wishlist['0']['wish_list_id']}">
                        <div class="frame-label">
                            <span class="title">Доступность:</span>
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
                            <span class="title">Название списка:</span>
                            <span class="frame-form-field">
                                <input type="text" value="{$wishlist['0']['title']}" name="title"/>
                            </span>
                        </label>
                        <label>
                            <span class="title">Описание:</span>
                            <span class="frame-form-field">
                                <textarea name="description">{$wishlist['0']['description']}</textarea>
                            </span>
                        </label>
                        <div class="frame-label">
                            <div class="title">&nbsp;</div>
                            <div class="frame-form-field">
                                <div class="btn-def">
                                    <input type="submit" value="Сохранить"/>
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