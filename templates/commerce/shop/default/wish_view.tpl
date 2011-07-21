{# View wihsed products}

<h5>Пожелание № {echo $model->getId()}</h5>
    {if $CI->session->flashdata('makeWish') === true}
    <div style="padding:10px;background-color:#f5f5dc;">
        Ваше пожелание отправлено адресату на e-mail.
    </div>
    {/if}
<br />
{if ShopCore::$ci->dx_auth->is_logged_in() && ShopCore::$ci->dx_auth->get_user_id() == $model->getUserId()}<div class="right" title="Удалить этот WishList"><span class="label"><a href="{shop_url('wish_list/delete_wish/' . $model->getKey())}">Удалить</a></span></div> {/if}
<br />
<div class="spLine"></div>

<table class="wishListTable" width="100%">
    <thead align="left">
        <th>{echo ShopCore::t('Фото')}</th>
        <th>{echo ShopCore::t('Название')}</th>
        <th>{echo ShopCore::t('Цена')}</th>
    </thead>
    <tbody>
    {foreach $model->getSWishProductss() as $item}
    {$product = $item->getSProducts()}
    {$total += $variants[$item->getVariantId()]->toCurrency()}
        <tr>
            <td style="width:90px;padding:2px;">
                <div style="width:90px;height:90px;overflow:hidden;">
                {if $product->getMainImage()}
                    <img src="{productImageUrl($product->getId() . '_main.jpg')}" border="0" alt="image" width="90" />
                {/if}
                </div>
            </td>
            <td>
                <a href="{shop_url('product/' . $product->getUrl())}">{echo ShopCore::encode($product->getName())}</a> {echo $variants[$item->getVariantId()]->getName()}
            </td>
            <td>{echo $variants[$item->getVariantId()]->toCurrency()} {$CS}</td>
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
            {echo $total} {$CS}
    </span>
    <span class="label">
        {echo ShopCore::t('Итог')}
    </span>
</div>



