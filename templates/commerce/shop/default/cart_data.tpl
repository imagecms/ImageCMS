{$total = ShopCore::app()->SCart->totalItems()}
<li class="cart {if $total}is_avail{/if} "><a href="{shop_url('cart')}" class="js gray">Корзина</a> ({$total})</li>
{if $is_logged_in}
    <li class="login"><a href="{shop_url('profile')}" rel="nofollow" class="js gray">Личный кабинет</a></li>
{else:}
    <li class="login"><a href="{site_url('auth')}" rel="nofollow" class="js gray">Вход в магазин</a></li>
{/if}