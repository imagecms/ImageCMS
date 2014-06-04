{$cart = \Cart\BaseCart::getInstance()}
{$count = $cart->getTotalItems()}
{$price = $cart->getTotalPrice()}
{$priceOrigin = $cart->getOriginTotalPrice()}

{if $count == 0}
<div class="btn-bask mq-max mq-w-480 mq-block">
    <button>
        <span class="text-cleaner">
            <span class="helper"></span>
            <span>
                <span class="title text-el">{lang('Ваша корзина','newLevel')}</span>
                <span class="text-el c_9">{lang('Пока что пуста','newLevel')}</span>
            </span>
        </span>
        <span class="frame-icon">
            <span class="helper"></span>
            <span class="icon_cleaner"></span>
        </span>
    </button>
</div>

<div class="btn-bask mq-w-320 mq-block">
    <button type="button" class="btnBask p_r">
        <span class="icon_cleaner"></span>
        <span class="text-cleaner">
                <span class="text-el">0</span>
        </span>
    </button>
</div>

{else:}
<div class="btn-bask pointer mq-max mq-w-480 mq-block">
    <button type="button" class="btnBask">
        <span class="text-cleaner">
            <span class="helper"></span>
            <span>
                <span class="title text-el">{lang('Ваша корзина','newLevel')}</span>
                <span class="text-el">{echo $count}</span>
                <span class="text-el">&nbsp;</span>
                <span class="text-el">{echo SStringHelper::Pluralize($count, array(lang('товар','newLevel'),lang('товара','newLevel'),lang('товаров','newLevel')))}</span>
                <span class="text-el">&nbsp;</span>
                <span class="text-el">{lang('на','newLevel')}</span>
                <span class="text-el">&nbsp;</span>
                <span class="d_i-b">
                    <span class="text-el">{echo ShopCore::app()->SCurrencyHelper->convert($price)}</span>
                    <span class="text-el">&nbsp;<span class="curr">{$CS}</span></span>
                </span>
            </span>
        </span>
        <span class="frame-icon">
            <span class="helper"></span>
            <span class="icon_cleaner"></span>
        </span>
    </button>
</div>




<div class="btn-bask pointer mq-w-320 mq-block">
    <button type="button" class="btnBask p_r">
        <span class="icon_cleaner"></span>
        <span class="text-cleaner">
                <span class="text-el">{echo $count}</span>
        </span>
    </button>
</div>
{/if}