{$topCartCount = ShopCore::app()->SCart->totalItems()}
<div class="btn-bask tiny-bask">
    <button>
        <span class="frame-icon">
            <span class="icon_cleaner"></span>
        </span>
        <span class="text-cleaner bask">
            <span class="empty" {if $topCartCount == 0}style="display: inline"{/if}>
                <span class="helper"></span>
                <span>
                    <span class="text-el">{lang('Корзина пуста','newLevel')}</span>
                </span>
            </span>
            <span class="no-empty" {if $topCartCount != 0}style="display: inline"{/if}>
                <span class="helper"></span>
                <span>
                    <span class="text-el topCartCount">{echo $topCartCount}</span>
                    <span class="text-el">&nbsp;</span>
                    <span class="text-el plurProd">{echo SStringHelper::Pluralize(ShopCore::app()->SCart->totalItems(), array(lang('товар','newLevel'),lang('товара','newLevel'),lang('товаров','newLevel')))}</span>
                    <span class="divider text-el">&#8226;</span>
                    <span class="d_i-b">
                        <span class="text-el topCartTotalPrice">{echo str_replace(',', '.', ShopCore::app()->SCart->totalPrice())}</span>
                        <span class="text-el">&nbsp;<span class="curr">{$CS}</span></span>
                    </span>
                </span>
            </span>
        </span>
    </button>
</div>
