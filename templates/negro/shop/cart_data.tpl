{$count = ShopCore::app()->SCart->totalItems();}
{$total = ShopCore::app()->SCart->totalPrice();}
{if $count > 0}
    <div class="btn btn-cleaner v-a_t c_d goCart">
        <span>
            <span class="icon-bask"></span>
            <span class="text_el">Kорзина ({$count})</span>
        </span>
    </div>
{else:}
    <div class="btn btn-cleaner v-a_t c_d disabled" data-title="Вы пока не добавили товар в корзину">
        <span>
            <span class="icon-bask"></span>
            <span class="text_el">Ваша корзина пуста</span>
        </span>
    </div>
{/if}
