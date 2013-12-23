{$count = ShopCore::app()->SCart->totalItems()}
<div class="btn-bask tiny-bask tinyBask{if $topCartCount != 0} pointer{/if}">
    <button>
        <span class="frame-icon">
            <span class="icon_cleaner"></span>
        </span>
        <span class="text-cleaner">
            <span class="js-empty empty" {if $count == 0}style="display: inline"{/if}>
                <span class="helper"></span>
                <span>
                    <span class="text-el topCartCount">{echo $count}</span>
                </span>
            </span>
            <span class="js-no-empty no-empty" {if $count != 0}style="display: inline"{/if}>
                <span class="helper"></span>
                <span>
                    <span class="t-d_n ref text-el">Корзина</span>
                    <span class="text-el topCartCount">{echo $count}</span>
                </span>
            </span>
        </span>
    </button>
</div>
