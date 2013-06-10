{$count = ShopCore::app()->SWishList->totalItems()}
{if ShopCore::$ci->dx_auth->is_logged_in() === true}
<div id="wishListData">
    <div class="wish-list-btn tiny-wish-list">
        <button onclick="location='{shop_url('wish_list')}'">
            <span class="icon_wish_list"></span>
            <span class="text-wish-list f-s_0">
                <span class="text-el">Список желаний (</span>
                <span class="empty f-s_0">
                    <span class="text-el wishListCount"></span>
                </span>
                <span class="no-empty f-s_0">
                    <span class="text-el wishListCount"></span>
                </span>
                <span class="text-el">)</span>
            </span>
        </button>
    </div>
</div>
{/if}