{$condBtn = $class != 'btn inWL'}
<div class="btn-wish {if !$condBtn}btn-wish-in{/if}">
    <button class="toWishlist" type="button" data-rel="tooltip" data-title="{lang('В список желаний','newLevel')}" {if $is_logged_in}data-drop="#wishListPopup" data-source="{site_url('/wishlist/renderPopup/'. $varId)}"{else:}data-drop="#notification" data-modal="true" data-overlayopacity="0" data-timeclosemodal="3000"{/if} {if !$condBtn}style="display: none;"{/if}>
        <span class="icon_wish"></span>
        <span class="text-el d_l">{lang('В список желания','newLevel')}</span>
    </button>
    <button class="inWishlist" type="button" data-rel="tooltip" data-title="{lang('В списке желаний','newLevel')}" {if $condBtn}style="display: none;"{/if}>
        <span class="icon_wish"></span>
        <span class="text-el d_l">{lang('В списке желания','newLevel')}</span>
    </button>
</div>
