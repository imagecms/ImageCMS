                    {$total = ShopCore::app()->SCart->totalItems()}
                    <a href="{shop_url('cart')}" tabindex="2">
                        <span class="icon cleaner_icon"></span><br/>
                        Корзина{if $total > 0} ({$total}){/if}
                    </a>
