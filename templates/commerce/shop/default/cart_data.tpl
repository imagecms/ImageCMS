{$total = ShopCore::app()->SCart->totalItems()}
<li class="cart {if $total}is_avail{/if} "><a href="{shop_url('cart')}" class="gray goCartData"><span class="icon-cart"></span>{lang('s_cart')}</a> ({$total})</li>
