{$condBtn = $class != 'btn inWL'}
<div class="btnWish btn-wish {if !$condBtn}btn-wish-in{/if}">
    <button class="toWishlist" type="button" data-rel="tooltip" data-title="{lang('В список желаний','newLevel')}" {if $is_logged_in}data-drop="#wishListPopup" data-source="{site_url('/wishlist/renderPopup/'. $varId)}"{else:}data-drop=".drop-auth" data-place="noinherit" data-placement="bottom left" data-overlay-opacity="0"{/if} {if !$condBtn}style="display: none;"{/if}>
        <span class="helper"></span>
        <span>
        <span class="icon_wish"></span>
        <span class="text-el d_l">{lang('В список желания','newLevel')}</span>
        </span>
    </button>
    <button class="inWishlist" type="button" data-rel="tooltip" data-title="{lang('В списке желаний','newLevel')}" {if $condBtn}style="display: none;"{/if}>
        <span class="helper"></span>
        <span>
        <span class="icon_wish"></span>
        <span class="text-el d_l">{lang('В списке желания','newLevel')}</span>
        </span>
    </button>
</div>
