{$condBtn = $class != 'btn inWL'}
<div class="btn-wish {if !$condBtn}btn-wish-in{/if}">
    <button class="toWishlist" type="button" data-rel="tooltip" {if $condBtn}data-drop="#wishListPopup"{else:}data-drop="#notification" data-modal="true"{/if} data-source="{site_url('/wishlist/renderPopup/'. $varId)}" {if !$condBtn}style="display: none;"{/if}>
        <span class="icon_wish"></span>
        <span class="text-el d_l">{lang('В список желания','newLevel')}</span>
    </button>
    <button class="inWishlist" type="button" data-rel="tooltip" {if $condBtn}style="display: none;"{/if}>
        <span class="icon_wish"></span>
        <span class="text-el d_l">{lang('В списке желания','newLevel')}</span>
    </button>
</div>
