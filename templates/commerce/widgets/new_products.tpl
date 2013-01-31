{if count(getPromoBlock($productsType, $productsCount))>0}
<div class="box_title"><span class="f-s_24">{$title}</span></div>
        <div class="featured carusel_frame carousel_js">
            <div class="carusel">
                <ul>
                    {foreach $products as $hotProduct}
                        {$discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)}
                        {$style = productInCart($cart_data, $hotProduct->getId(), $hotProduct->firstVariant->getId(), $hotProduct->firstVariant->getStock())}
                        <li {if $hotProduct->firstvariant->getstock()==0}class="not_avail"{/if}>
                            <div class="small_item">
                                <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="img">
                                    <span>
                                        <img src="{productImageUrl($hotProduct->getMainModimage())}" alt="{echo ShopCore::encode($hotProduct->getName())}" />
                                    </span>
                                </a>
                                <div class="info">
                                    <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                                    <div class="buy">
                                        <div class="price f-s_16">
                                            {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                {$prOne = $hotProduct->firstvariant->getPrice()}
                                                {$prTwo = $hotProduct->firstvariant->getPrice()}
                                                {$prThree = $prOne - $prTwo / 100 * $discount}
                                                <del class="price price-c_red f-s_12 price-c_9">{echo $hotProduct->firstvariant->getPrice()} {$CS}</del><br /> 
                                            {else:}
                                                {$prThree = $hotProduct->firstvariant->getPrice()}
                                            {/if}
                                            {echo $prThree} 
                                            <sub>{$CS}</sub>
                                        </div>
                                        <div class="{$style.class} buttons">
                                            <span class="{$style.identif}" data-varid="{echo $hotProduct->firstVariant->getId()}" data-prodid="{echo $hotProduct->getId()}">{$style.message}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
            <button class="prev"></button>
            <button class="next"></button>
        </div> 
{/if}
                <!-- featured -->