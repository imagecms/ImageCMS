{# View wihsed products}

<h5>Список пожеланий {if $newData}({count($newData)}){/if}</h5>

<div class="spLine"></div>
{if !$newData}
    {echo ShopCore::t('Список пожеланий пуст')}
    {return}
{/if}
<table class="wishListTable" width="100%">
    <thead align="left">
        <th>{echo ShopCore::t('Фото')}</th>
        <th>{echo ShopCore::t('Название')}</th>
        <th>{echo ShopCore::t('Цена')}</th>
    </thead>
    <tbody>
    {$total = 0}
    {foreach $newData as $key=>$item}
    {$total += ShopCore::app()->SCurrencyHelper->convert($item.price)}
        <tr>
            <td style="width:90px;padding:2px;">
                <div style="width:90px;height:90px;overflow:hidden;">
                {if $item.model->getMainImage()}
                    <img src="{productImageUrl($item.model->getId() . '_main.jpg')}" border="0" alt="image" width="90" />
                {/if}
                </div>
            </td>
            <td>
                <a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.model->getName())}</a> {$item.variantName}
            </td>
            <td>{echo ShopCore::app()->SCurrencyHelper->convert($item.price)} {$CS}</td>
        </tr>
    {/foreach}
    </tbody>
    <tfoot>
        <td></td>
        <td></td>
        <td></td>
    </tfoot>
</table>

<div id="total">
    <span class="value" id="totalPriceText">
        {$total} {$CS}
    </span>
    <span class="label">
        {echo ShopCore::t('Итог')}
    </span>
</div>



