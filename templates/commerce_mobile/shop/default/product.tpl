{# Variables
# @var model
# @var editProductUrl
# @var jsCode
#}
        <div class="content_head">
            <div class="crumbs">{renderCategoryPath($model->getMainCategory())}
                <h1>{echo ShopCore::encode($model->getName())}</h1></div>
        </div>
        <ul class="catalog tovar_frame">
            <li>
                <div class="top_frame_tov">
                    <span class="figure"><img src="{productImageUrl($model->getMainImage())}"/></span>
                    <div class="descr">
                        <span class="d_b price">{echo $model->firstVariant->toCurrency()} {$CS}</span>
                        <div class="but_buy">
                            <form method="POST" name="orderForm" action="{shop_url('cart/add')}">
                            <a href="{shop_url('cart')}" onclick="orderForm.submit();return false;">
                                <span class="helper"></span>
                                <!--<span class="v-a_m">Купить</span>-->
                                <span class="v-a_m">Оформить заказ</span>
                            </a>
                                <input type="hidden" name="productId" value="{echo $model->getId()}" />
                                <input type="hidden" name="variantId" value="{echo $model->firstVariant->getId()}" />
                                <input type="hidden" name="quantity" value="1" />
                                <input type="hidden" name="mobile" value="1" />
                                {form_csrf()}
                           </form>
                        </div>
                    </div>
                </div>
                <div class="text">
                    
                {if ShopCore::app()->SPropertiesRenderer->renderPropertiesArray($model)}
                    <dl>
                    {$props = ShopCore::app()->SPropertiesRenderer->renderPropertiesArray($model)}
                    {foreach $props as $property_key => $property_val}
                        <dt>{$property_key}:</dt>
                        <dd>
                            {$property_val}
                        </dd>
                    {/foreach}
                    </dl>
                {/if}
                    <br>
                    {echo $model->getFullDescription()}
                </div>
            </li>
        </ul>