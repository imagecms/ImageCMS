{if $class != 'btn inWL'}
    {/*<form method="post" action="{site_url($href)}">
        <input type="submit"
               class="{$class}"
               id='{echo $varId}'
               value="{$value}"
               data-maxListsCount = '{$max_lists_count}'
               />
    </form>*/}
    <div class="variant_{echo $varId} variant btn-wish">
        <button class="toWishlist" type="button" data-rel="tooltip" data-drop="#wishListPopup" data-source="{site_url('/wishlist/renderPopup/'. $varId)}">
            <span class="icon_wish"></span>
            <span class="text-el d_l">Добавить в Список Желания</span>
        </button>
    </div>
{else:}
    <div class="variant_{echo $varId} variant btn-wish">
        <button class="inWishlist" type="button" data-rel="tooltip">
            <span class="icon_wish"></span>
            <span class="text-el d_l">Уже в Списке Желания</span>
        </button>
    </div>
{/if}
