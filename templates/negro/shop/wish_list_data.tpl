{$count = ShopCore::app()->SWishList->totalItems()}
{if ShopCore::$ci->dx_auth->is_logged_in() === true}
    <div id="wishListData">
        <span class="f-s_0" onclick="location='{shop_url('wish_list')}'">
            <span class="icon_wish_list"></span>
            <span class="ref">Список желаний </span>
        </span> 
        <span  id="wishListCount">  ({$count}) </span>
    </div>
{/if}