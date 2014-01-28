{$cart = \Cart\BaseCart::getInstance()->recountOriginTotalPrice()->recountTotalPrice()}
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
                    <span class="text-el">{lang('Корзина пуста','newLevel')}</span>
                </span>
            </span>
        </button>
    </div>
{else:}
    <div class="btn-bask pointer">
        <button type="button" class="btnBask">
            <span class="frame-icon">
                <span class="icon_cleaner"></span>
            </span>
            <span class="text-cleaner">
                <span class="helper"></span>
                <span>
                    <span class="text-el">{echo $count}</span>
                    <span class="text-el">&nbsp;</span>
                    <span class="text-el">{echo SStringHelper::Pluralize($count, array(lang('товар','newLevel'),lang('товара','newLevel'),lang('товаров','newLevel')))}</span>
                    <span class="divider text-el">&#8226;</span>
                    <span class="d_i-b">
                        <span class="text-el">{echo $price}</span>
                        <span class="text-el">&nbsp;<span class="curr">{$CS}</span></span>
                    </span>
                </span>
            </span>
        </button>
    </div>
{/if}