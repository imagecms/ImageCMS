{$total = ShopCore::app()->SCart->totalItems()}
<a href="{shop_url('cart')}" tabindex="3" class="frame_cleaner">
    <span class="icon cleaner_icon">{if $total > 0}<span class="count_cleaner"><span>{$total}</span></span>{/if}</span><br/>
    {lang('Корзина','commerce_mobiles')}
</a>
