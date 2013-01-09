{literal}<script type="text/javascript">$(document).ready(function() {$('.showCart').click(function(){$.fancybox({'href': '/shop/cart'});return false;})});</script>{/literal}

{$total_items = ShopCore::app()->SCart->totalItems() .' '. SStringHelper::Pluralize(ShopCore::app()->SCart->totalItems(), array('товар','товара','товаров'))}
{if $total_items > 0}
{$total_price = ShopCore::app()->SCart->totalPrice() .' '. $CS}
<div class="title"><a class="showCart" href="#">Моя корзина</a></div>
<div class="info">{$total_items} на <span>{$total_price}</span></div>
<div class="button_y"><a rel="nofollow" href="{shop_url('cart')}">Оформить заказ</a></div>
{else:}
<div class="title">Моя корзина</div>
<div class="info">Ваша корзина пуста</div>
<div class="button_y"><a rel="nofollow" href="{shop_url('cart')}">Оформить заказ</a></div>
{/if}