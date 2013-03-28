{$total = ShopCore::app()->SCart->totalItems()}
<li class="cart {if $total}is_avail{/if} ">
    {if $total}
    <a href="{shop_url('cart')}" class="gray goCartData">
    <span class="icon-cart"></span>{lang("Basket")}
    </a> 
    {else:}
    <span class="icon-cart"></span>{lang("Basket")}
    
    {/if}
    ({$total})
</li>
