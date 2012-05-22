<div class="content">
    <div class="center">
        <h1>Сравнение товаров</h1>
        <div class="comparison_slider">
<!--            <div class="parameters_compr">
                <div class="title">Показаны:</div>
                <a class="active">Все параметры</a>
                <a href="#">Только отличия</a>
            </div>-->
            <div class="comparison_slider_left">
                {$data = ShopCore::app()->SPropertiesRenderer->renderProductsProperties($products)}
                {foreach $data[$products[0]->getId()] as $key=>$val}
                    <span><span>{$key}</span></span>
                {/foreach}
            </div>
            <div class="comparison_tovars">
                <ul class="comparison_slider_right">
                    {foreach $products as $product}
                    {$style = productInCart($cart_data, $product->getId(), $product->firstVariant->getId(), $product->firstVariant->getStock())}
                    <li class="list_desire">
                        <div class="frame_porivnjanja_tovar smallest_item">
                            <div class="photo_block">
                                <a href="{shop_url('product/' . $product->getUrl())}"><img height="70" src="{productImageUrl($product->getMainimage())}" alt="{echo ShopCore::encode($product->name)}" /></a>
                                <div class="clearfix">
                                    <div class="di_b star"><img src="{$SHOP_THEME}images/temp/STAR.png"></div>
                                    {if $product->totalComments()}<a href="{shop_url('product/'.$product->getId().'?cmn=on')}" class="d_b response">{echo $product->totalComments()} {echo SStringHelper::Pluralize($product->totalComments(), array('отзыв', 'отзывы', 'отзывов'))}</a>{/if}
                                </div>
                                <a class="delete_tovar" href="{shop_url('compare/remove/' . $product->getId())}"></a>
                            </div>
                            <div class="func_description">
                                <a href="{shop_url('product/' . $product->getUrl())}" class="title">{echo $product->getName()}</a>
                                <div class="buy">
                                    <div class="price f-s_14">{echo $product->firstVariant->toCurrency()} <sub>{$CS}</sub><span>{echo $product->firstVariant->toCurrency('Price', 1)} $</span></div>
                                    <div class="buttons {$style.class}">
                                        <a class="{$style.identif}" href="{$style.link}" data-varid="{echo $product->firstVariant->getId()}" data-prodid="{echo $product->getId()}" >{$style.message}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field_container_character">
                            {foreach $data[$product->id] as $key=>$val}
                                <span><span>{$val}</span></span>
                            {/foreach}
                        </div>
                    </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    </div>
</div>