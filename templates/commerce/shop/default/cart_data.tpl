        
        {if $is_logged_in}
            <a href="{shop_url('profile')}" class="items">Профиль</a>
        {else:}
            <a href="/auth" class="items">Авторизация</a>
        {/if}
        <a href="{shop_url('cart')}" class="items">
            {echo ShopCore::app()->SCart->totalItems()}
            {echo SStringHelper::Pluralize(ShopCore::app()->SCart->totalItems(), array('товар','товара','товаров'))}
        </a>
        <span class="prices">{echo ShopCore::app()->SCart->totalPrice()} {$CS} 
            <a href="{shop_url('cart')}" class="image"><img src="{$SHOP_THEME}style/images/myitems.jpg" width="22" height="18" border="0" alt="mycart" /></a>
        </span>

