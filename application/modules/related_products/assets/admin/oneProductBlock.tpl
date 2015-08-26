{if $product}
    <div class="item-related">
        <button class="btn deleteRelatedProduct" type="button" data-productId="{echo $product->getId()}">
            <i class="icon-trash"></i>
        </button>
        <a href="{echo site_url('admin/components/run/shop/products/edit')}/{echo $product->getId()}">
            <span class="photo-block">
                <span class="helper"></span>
                {if $product->getfirstvariant()->getSmallPhoto()}
                    <img src="{site_url($product->getfirstvariant()->getSmallPhoto())}">
                {else:}
                    <img src="{$THEME}images/select-picture.png" class="img-polaroid">
                {/if}
            </span>
            <span class="title">{echo $product->getName()}</span>
        </a>
        <div class="description">
            <div class="frame-price">
                <span class="price">{echo number_format($product->firstVariant->getPriceInMain(), 5, ".", "")}</span>
                <span class="curr">{echo ShopCore::app()->SCurrencyHelper->getSymbolById($product->firstVariant->getCurrency())}</span>
            </div>
        </div>
    </div>
{/if}