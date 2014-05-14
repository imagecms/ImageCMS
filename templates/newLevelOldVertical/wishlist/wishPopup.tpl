<div class="drop drop-style drop-wishlist" id="wishListPopup">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            {lang('Выбор cписка  желаний','newLevelVertical')}
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form">
                <form method="post" action="" onsubmit="return false;">
                    <div class="frame-radio">
                        {foreach $wish_lists as $key => $wish_list}
                            {if $wish_list_id}
                                {if  $wish_list_id!=$wish_list.id}
                                    <div class="frame-label">
                                        <span class="niceRadio b_n">
                                            <input type="radio" name="wishlist" value="{$wish_list.id}" {if count($wish_lists) > 1}checked="checked"{/if}>
                                        </span>
                                        <div class="name-count">
                                            <span class="text-el">{$wish_list.title}</span>
                                        </div>
                                    </div>
                                {/if}
                            {else:}
                                <div class="frame-label">
                                    <span class="niceRadio b_n">
                                        <input type="radio" name="wishlist" value="{$wish_list.id}" {if $key==0}checked="checked"{/if}>
                                    </span>
                                    <div class="name-count">
                                        <span class="text-el">{$wish_list.title}</span>
                                    </div>
                                </div>
                            {/if}
                        {/foreach}
                        {if count($wish_lists) < $max_lists_count}
                            <div class="frame-label">
                                <span class="niceRadio b_n">
                                    <input type="radio" name="wishlist" value="" data-link='[name="wishListName"]' {if count($wish_lists) == 1 && $wish_list_id || count($wish_lists) == 0 && !$wish_list_id}checked="checked"{/if}>
                                </span>
                                <div class="name-count">
                                    <span class="text-el">{lang('Создать список','newLevelVertical')}</span>
                                </div>
                            </div>
                        {/if}
                    </div>
                    {if count($wish_lists) < $max_lists_count}
                        <div class="frame-label">
                            <input type="text" name="wishListName" value="" class="wish_list_name">
                        </div>
                    {/if}
                    <div class="btn-def">
                        <button
                            type="submit"
                            onclick="serializeForm(this)"
                            data-id="{$varId}"
                            data-drop="#notification"
                            data-source="{if $wish_list_id}{site_url('/wishlist/wishlistApi/moveItem/'.$varId . '/' . $wish_list_id)}{else:}{site_url('/wishlist/wishlistApi/addItem/'.$varId)}{/if}"
                            data-type="json"
                            data-modal="true"
                            data-effect-on="fadeIn"
                            data-effect-off="fadeOut"
                            {if $wish_list_id}
                                data-after="WishListFront.reload"
                                data-start="WishListFront.validateWishPopup"
                            {else:}
                                data-after="WishListFront.addToWL"
                                data-start="WishListFront.validateWishPopup"
                            {/if}
                            >
                            <span class="text-el">{if $wish_list_id}{lang('Переместить в список','newLevelVertical')}{else:}{lang('Добавить в список','newLevelVertical')}{/if}</span> 
                        </button>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>
