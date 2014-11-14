{$cart = \Cart\BaseCart::getInstance()}
{$count = $cart->getTotalItems()}
{$price = $cart->getTotalPrice()}
{$priceOrigin = $cart->getOriginTotalPrice()}

{if $count == 0}
    <div class="btn-bask">
        <button>
            <span class="icon_cleaner"></span>
            <span class="text-cleaner">
                <span class="text-el">{lang('Корзина','inTime')}</span>
            </span>
        </button>
    </div>
{else:}
    <div class="btn-bask pointer">
        <button type="button" class="btnBask">
            <span class="icon_cleaner"></span>
            <span class="text-cleaner">
                <span class="text-el">{lang('Корзина','inTime')}</span>
                <span class="text-el">&nbsp;</span>
                <span class="text-el">{echo $count}</span>
            </span>
        </button>
    </div>
{/if}