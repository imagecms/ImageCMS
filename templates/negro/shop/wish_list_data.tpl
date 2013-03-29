{$count = ShopCore::app()->SWishList->totalItems()}

{if ShopCore::$ci->dx_auth->is_logged_in() === true}
    {if $count > 0}
        <span class="f-s_0" onclick="location='{shop_url('wish_list')}'"><span class="icon-wish_list"></span><span class="f-s_14 ref">В списке желаний</span></span> 
        <span class="f-s_14 c_68">{$count} {echo SStringHelper::Pluralize($count, array('товар','товара','товаров'))}</span>
    {else:}
        <span class="f-s_0"><span class="icon-wish_list"></span></span> 
        <span class="f-s_14 c_68">В списке желаний товаров нет</span>
    {/if}
{/if}