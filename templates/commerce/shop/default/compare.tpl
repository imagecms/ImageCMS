
{include_tpl ('sidebar')}

<div class="products_list">

      <div id="titleExt">
        <h5 class="left">Сравнение товаров</h5>
        <div class="sp"></div>
      </div>

    <br/>

{if $products->count() == 0}
    Список товаров для сравнения пустой.
{else:}
    <table border="0" cellpadding="3" cellspacing="3" style="font-size:12px;">
        {# Row 0 - Name #}
        <tr valign="top">
            {foreach $products as $p}
                <td>
                    <a href="{shop_url('product/' . $p->getUrl())}">{echo $p->getName()}</a>
                </td>
            {/foreach}
        </tr>

        {# Row 1 - Image #}
        <tr valign="top">
            {foreach $products as $p}
                <td>
                    {if $p->getSmallImage()}
                        <img src="/uploads/shop/{echo $p->getSmallImage()}" alt="{echo $p->getName()}">
                    {/if}
                    <br/> <a href="{shop_url('compare/remove/' . $p->getId())}">Удалить</a>
                </td>
            {/foreach}
        </tr>

        {#Row 2 - Cusom fields data #}
        <tr valign="top">
            {foreach $products as $p}
            <td>
                {$data = ShopCore::app()->SPropertiesRenderer->renderPropertiesArray($p)}
                {foreach $data as $key=>$val}
                    <strong>{$key}</strong> - {$val}<br/>
                {/foreach}
            </td>
            {/foreach}
        </tr>

        {#Row 3 - Description #}
        <tr valign="top">
            {foreach $products as $p}
                <td>{echo $p->getFullDescription()}</td>
            {/foreach}
        </tr>

        {#Row 3 - Add to cart buttons #}
        <tr valign="top">
            {foreach $products as $p}
                <td>
                    <form action="{shop_url('cart/add')}" name="productForm" method="post">

                    {if $p->countProductVariants() > 1}
                    <div style="padding-bottom:20px;">
                    Варианты товара:<br/>
                        <select name="variantId">
                        {foreach $p->getProductVariants() as $variant}
                            <option value="{echo $variant->getId()}">{echo ShopCore::encode($variant->getName())} - {echo $variant->toCurrency()} {$CS}</option>
                        {/foreach}
                        </select>
                    </div>
                    {else:}
                        <input type="hidden" name="variantId" value="{echo $p->firstVariant->getId()}" />

                        <div style="padding-bottom:20px;">
                            <span class="priceLight">{echo $p->firstVariant->toCurrency()} {$CS}</span><br/>
                        </div>
                    {/if}

                    <input type="hidden" name="productId" value="{echo $p->getId()}" />
                    <input type="hidden" name="quantity" value="1" />

                    <input type="submit" value="{echo ShopCore::t('ДОБАВИТЬ В КОРЗИНУ')}"/>
                    {form_csrf()}
                    </form>
                </td>
            {/foreach}
        </tr>
    </table>
{/if}

</div>