{$cart = \Cart\BaseCart::getInstance()}
{$count = $cart->getTotalItems()}
{$price = $cart->getTotalPrice()}
{$priceOrigin = $cart->getOriginTotalPrice()}

{if $count == 0}
    <div class="btn-bask">
        <button>
            <span class="frame-icon">
                <span class="icon_cleaner"></span>
            </span>
            <span class="text-cleaner">
                <span class="helper"></span>
                <span>
                    <span class="text-el topCartCount">{echo $count}</span>
                </span>
            </span>
        </button>
    </div>
{else:}
    <div class="btn-bask pointer">
        <button class="btnBask">
            <span class="frame-icon">
                <span class="icon_cleaner"></span>
            </span>
            <span class="text-cleaner">
                <span class="helper"></span>
                <span>
                    <span class="ref text-el">{lang('Корзина')}</span>
                    <span class="text-el topCartCount">{echo $count}</span>
                </span>
            </span>
        </button>
    </div>
{/if}