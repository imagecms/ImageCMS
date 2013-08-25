{$condBtn = $class != 'btn inWL'}
<div class="btn-wish {if !$condBtn}btn-wish-in{/if}">
    <button class="toWishlist" type="button" data-rel="tooltip" data-drop="#wishListPopup" data-source="{site_url('/wishlist/renderPopup/'. $varId)}" {if !$condBtn}style="display: none;"{/if}>
        <span class="icon_wish"></span>
        <span class="text-el d_l">В список желания</span>
    </button>
    <button class="inWishlist" type="button" data-rel="tooltip" {if $condBtn}style="display: none;"{/if}>
        <span class="icon_wish"></span>
        <span class="text-el d_l">В списке желания</span>
    </button>
</div>
