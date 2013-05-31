{# Variables
# @var model
# @var editProductUrl
# @var jsCode
#}
<div class="content_head">
    {widget('path')}
</div>
<ul class="catalog tovar_frame">
    <li>
        <div class="top_frame_tov">
            <span class="figure"><img src="{echo $model->firstVariant->getMediumPhoto()}"/></span>
            <div class="descr">
                <span class="title">
                    {echo ShopCore::encode($model->getName())}
                </span>
                {if $model->firstVariant->getName()}
                    <span class="code_v">{lang('s_variant')}: {echo $model->firstVariant->getName()}</span>
                {/if}
                {if $model->firstVariant->number}
                    <span class="divider">/</span>
                    <span class="code">{lang('s_article')}: {echo $model->firstVariant->number}</span>
                {/if}
                <span class="d_b price">{echo $model->firstVariant->toCurrency()} {$CS}</span>
                <div class="but_buy">
                    <form method="POST" name="orderForm" action="{shop_url('cart/add')}">
                        <a href="{shop_url('cart')}" onclick="$(this).closest('form').submit();
                                return false;">
                            <span class="helper"></span>
                            <span class="v-a_m">{lang('s_buy')}</span>
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
    </li>
</ul>
{if count($model->getProductVariants())>1}
    <div class="check_filter h_f pointer" onclick="$(this).next().slideToggle();">
        <span class="helper"></span>
        <span class="v-a_m">
            <span class="check_other_variant icon"></span>
            <span class="title">Другие варианты товара</span>
        </span>
    </div>
{/if}
<ul class="catalog tovar_frame variants_product">
    {foreach $model->getProductVariants() as $key => $p}
        {if $key != 0}
            <li>
                <div class="top_frame_tov">
                    <span class="figure"><img src="{echo $p->getMediumPhoto()}"/></span>
                    <div class="descr">
                        <span class="title">
                            {echo ShopCore::encode($model->getName())}
                        </span>
                        {if $p->getName()}
                            <span class="code_v">{lang('s_variant')}: {echo $p->getName()}</span>
                        {/if}
                        {if $p->number}
                            <span class="divider">/</span>
                            <span class="code">{lang('s_article')}: {echo $p->number}</span>
                        {/if}
                        <span class="d_b price">{echo $p->toCurrency()} {$CS}</span>
                        <div class="but_buy">
                            <form method="POST" name="orderForm" action="{shop_url('cart/add')}">
                                <a href="{shop_url('cart')}" onclick="$(this).closest('form').submit();
                                return false;">
                                    <span class="helper"></span>
                                    <span class="v-a_m">{lang('s_buy')}</span>
                                </a>
                                <input type="hidden" name="productId" value="{echo $model->getId()}" />
                                <input type="hidden" name="variantId" value="{echo $p->getId()}" />
                                <input type="hidden" name="quantity" value="1" />
                                <input type="hidden" name="mobile" value="1" />
                                {form_csrf()}
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        {/if}
    {/foreach}
</ul>
<div class="text tovar_description">
    {if ShopCore::app()->SPropertiesRenderer->renderPropertiesArray($model)}
        <h2>{lang('s_properties')}</h2>
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
    {if $model->getFullDescription()}
        <h2>{lang('s_description')}</h2>
        {echo $model->getFullDescription()}
    {/if}
</div>