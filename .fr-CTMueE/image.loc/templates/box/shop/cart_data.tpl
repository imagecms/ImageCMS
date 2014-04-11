{$cart = \Cart\BaseCart::getInstance()->recountOriginTotalPrice()->recountTotalPrice()}
{$count = $cart->getTotalItems()}
{$price = $cart->getTotalPrice()}
{$priceOrigin = $cart->getOriginTotalPrice()}

{if $count == 0}
    <div class="btn-bask">
        <button>
            <span class="icon_cleaner"></span>
            <span class="text-cleaner">
                <span class="text-el">{lang('Корзина пуста','newLevel')}</span>
            </span>
        </button>
    </div>
{else:}
    <div class="btn-bask pointer">
        <button type="button" class="btnBask">
            <span class="icon_cleaner"></span>
            <span class="text-cleaner">
                <span class="text-el">{echo $count}</span>
                <span class="text-el">&nbsp;</span>
                <span class="text-el">{echo SStringHelper::Pluralize($count, array(lang('товар','newLevel'),lang('товара','newLevel'),lang('товаров','newLevel')))}</span>
                <span class="d_i-b">
                    <span class="text-el">&nbsp;&nbsp;{echo $price}</span>
                    <span class="text-el">&nbsp;<span class="curr">{$CS}</span></span>
                </span>
            </span>
        </button>
    </div>
{/if}