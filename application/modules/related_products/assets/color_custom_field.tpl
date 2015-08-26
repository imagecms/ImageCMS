<div class="horizontal-carousel">
    <div class="frame-thumbs carousel-js-css">
        {/*carousel-js-css*/}
        <div class="content-carousel">
            <h5 style="margin-top: 10px; text-align: center;">{lang('Related products', 'related_products')}</h5>
            <ul class="items-thumbs items">
                {foreach $related_products as $product}
                    <li>
                        <a href="{echo shop_url('product/' . $product->getUrl())}" title="{echo ShopCore::encode($product->getName())}" class="cloud-zoom-gallery">
                            <span class="photo-block" style="background-color: {echo $product->customFields['color']['field_data']};"></span>
                        </a>
                    </li>
                {/foreach}
            </ul>
        </div>
        <div class="group-button-carousel">
            <button type="button" class="prev arrow">
                <span class="icon_arrow_p"></span>
            </button>
            <button type="button" class="next arrow">
                <span class="icon_arrow_n"></span>
            </button>
        </div>
    </div>
</div>