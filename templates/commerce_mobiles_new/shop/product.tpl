{# Variables
# @var model
# @var editProductUrl
# @var jsCode
#}
<div class="content_head">
    <div class="crumbs">{renderCategoryPathNoSeo($model->getMainCategory())}</div>
</div>
<ul class="catalog tovar_frame">
    {foreach $model->getProductVariants() as $p}
    <li>
        <div class="top_frame_tov">
            <span class="figure"><img src="{productImageUrl($p->getMainModimage())}"/></span>
            <div class="descr">
                <span class="title">
                    {echo ShopCore::encode($model->getName())}
                </span>
                {if $p->getName()}
                <span class="code_v">Вариант: {echo $p->getName()}</span>
                {/if}
                {if $p->number}
                <span class="divider">/</span>
                <span class="code">Артикул {echo $p->number}</span>
                {/if}
                <span class="d_b price">{echo $p->toCurrency()} {$CS}</span>
                <div class="but_buy">
                    <form method="POST" name="orderForm" action="{shop_url('cart/add')}">
                        <a href="{shop_url('cart')}" onclick="$(this).closest('form').submit();return false;">
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