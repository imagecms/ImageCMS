{$count = ShopCore::app()->SWishList->totalItems()}

{if ShopCore::$ci->dx_auth->is_logged_in() === true}
    <div style="margin-top: 9px;" id="wishListData">
        {$cWL = ShopCore::app()->SWishList->totalItems()}
        <span class="f-s_0" onclick="location='{shop_url('wish_list')}'"><span class="icon-wish_list"></span><span class="f-s_14 ref">В списке желаний</span></span> 
        <span  id="wishListCount" class="f-s_14 c_68">{$cWL} </span>
        <span  id="wishListCount" class="f-s_14 c_68">{echo SStringHelper::Pluralize($count, array('товар','товара','товаров'))}</span>
    </div>
{/if}