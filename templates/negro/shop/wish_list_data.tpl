{$count = ShopCore::app()->SWishList->totalItems()}
{if ShopCore::$ci->dx_auth->is_logged_in() === true}
    <div id="wishListData">
        <span class="f-s_0" onclick="location='{shop_url('wish_list')}'">
            <span class="icon-wish_list"></span>
            <span class="f-s_14 ref">Список желаний </span>
        </span> 
        <span  id="wishListCount" class="f-s_14 c_68">  ({$count}) </span>
    </div>
{/if}