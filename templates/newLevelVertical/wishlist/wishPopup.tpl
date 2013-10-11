<div class="drop drop-style drop-wishlist" id="wishListPopup">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            {lang('Выбор cписка  желаний','newLevel')}
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
                                            <input type="radio" name="wishlist" value="{$wish_list.id}" {if $key==0}checked="checked"{/if}>
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
                                    <input type="radio" name="wishlist" value="" data-link='[name="wishListName"]' {if count($wish_lists) == 0}checked="checked"{/if}>
                                </span>
                                <div class="name-count">
                                    <span class="text-el">{lang('Создать список','newLevel')}</span>
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
                            data-drop="#notification"
                            data-source="{if $wish_list_id}{site_url('/wishlist/wishlistApi/moveItem/'.$varId . '/' . $wish_list_id)}{else:}{site_url('/wishlist/wishlistApi/addItem/'.$varId)}{/if}"
                            data-type="json"
                            data-modal="true"
                            {if $wish_list_id}
                                data-callback="reload"
                            {else:}
                                data-callback="addToWL"
                                data-before="validateWishPopup"
                            {/if}
                            >
                            <span class="text-el">{if $wish_list_id}{lang('Переместить в список','newLevel')}{else:}{lang('Добавить в список','newLevel')}{/if}</span> 
                        </button>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>
