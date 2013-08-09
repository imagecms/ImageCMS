<div class="drop drop-style drop-wishlist" id="wishListPopup">
    <button type="button" class="icon_times_drop" data-closed="closed-js"></button>
    <div class="drop-header">
        <div class="title">
            Вибирите cписок  желаний
        </div>
    </div>
    <div class="drop-content">
        <div class="inside-padd">
            <div class="horizontal-form">
                <form method="post" action="">
                    <div class="frame-radio">
                        {foreach $wish_lists as $wish_list}
                            <div class="frame-label">
                                <span class="niceRadio b_n">
                                    <input type="radio" name="wishlist" value="{$wish_list.id}">
                                </span>
                                <div class="name-count">
                                    <span class="text-el">{$wish_list.title}</span>
                                </div>
                            </div>
                        {/foreach}
                        <div class="frame-label">
                            <span class="niceRadio b_n">
                                <input type="radio" name="wishlist" value="" data-link='[name="wishListName"]' checked="checked">
                            </span>
                            <div class="name-count">
                                <span class="text-el">Создать список</span>
                            </div>
                        </div>
                    </div>
                    <div class="frame-label">
                        <input type="text" name="wishListName"  value="" class="wish_list_name">
                    </div>
                    <div class="btn-def">
                        <button type="button" data-drop="#notification" data-source="{if $wish_list_id}{site_url('/wishlist/wishlistApi/moveItem/'.$varId . '/' . $wish_list_id)}{else:}{site_url('/wishlist/wishlistApi/addItem/'.$varId)}{/if}" onclick="serializeForm(this)" data-type="json" data-notification="true" data-overlayopacity= "0">
                            <span class="text-el">{if $wish_list_id}Переместить в список{else:}Добавить в список{/if}</span> 
                        </button>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>
