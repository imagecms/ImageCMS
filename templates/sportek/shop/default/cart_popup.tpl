{$recount = ($_SERVER.HTTP_REFERER == shop_url('cart'))}
{if count($items) > 0}
<h1>Корзина</h1>
<form action="{shop_url('cart')}" method="post" name="cartForm" id="cart_popup">
    <input type="hidden" name="recount" value="1">
    <table class="cleaner">
        <colgroup span="1" width="32px"/>
        <colgroup span="1" width="103px"/>
        <colgroup span="1" width="206px"/>
        <colgroup span="1" width="160px"/>
        <colgroup span="1" width="168px"/>
        <thead>
            <tr>
                <td colspan="3">Товар</td>
                <td>Количество</td>
                <td class="lasttd">Сумма</td>
            </tr>
        </thead>
        <tbody>
            {foreach $items as $key=>$item}
                
                
               
            {if $item.instance == 'SProducts'}
            <tr>
                <td class="first_child"><a href="{shop_url('cart/delete/' . $key)}">&times;</a></td>
                <td >
                    
                    {$imgpath = $_SERVER['DOCUMENT_ROOT']."/uploads/shop/".strval($item.productId)."_vS".strval($item.variantId).".jpg"}
               
                    {if file_exists($imgpath)}                        
                      <a href="{shop_url('product/' . $item.model->getUrl())}">
                      <img src="/uploads/shop/{$item.productId}_vS{$item.variantId}.jpg"  width="100" /></a>
                    {else:}
                        <a href="{shop_url('product/' . $item.model->getUrl())}">
                        <img src="{productImageUrl($item.model->getSmallImage())}" width="100" /></a>
                    {/if}
                   
                </td>
                <td class="cleaner_title">
                    <a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.variantName)}</a><div>{echo ShopCore::app()->SCurrencyHelper->convert($item.price)} {$CS}</div>
                </td>
                <td class="big_padding">
                    <input type="text" size="3" name="products[{$key}]" value="{$item.quantity}" id="count" />
                </td>
                <td class="flo_left">
                    <span>{echo ShopCore::app()->SCurrencyHelper->convert($item.totalAmount)} <span>{$CS}</span></span>
                </td>
            </tr>
            {else:}
            <tr style="border-bottom: none;">
                <td rowspan="2" class="first_child"><a href="{shop_url('cart/delete/' . $key)}">&times;</a></td>
                <td >
                    <a href="{shop_url('product/' . $item.model->getSProducts()->getUrl())}">
                        <img src="{productImageUrl($item.model->getSProducts()->getSmallImage())}" width="96" />
                    </a>
                </td>
                <td class="cleaner_title">
                    <a href="{shop_url('product/' . $item.model->getSProducts()->getUrl())}">
                        {echo ShopCore::encode($item.model->getSProducts()->name)}</a>
                    <div>{echo ShopCore::app()->SCurrencyHelper->convert($item.model->getSProducts()->getFirstVariant()->price)} {$CS}</div>
                </td>
                <td rowspan="2" class="big_padding kitIncart">
                    <input type="text" size="3" name="products[{$key}]" value="{$item.quantity}" id="count" />
                </td>
                <td rowspan="2" class="flo_left">
                    <span>{echo ShopCore::app()->SCurrencyHelper->convert($item.totalAmount)} <span>{$CS}</span></span>
                </td>
            </tr>
            <tr>
                {foreach $item.model->getShopKitProducts() as $element}
                <td >
                    <a href="{shop_url('product/' . $element->getSProducts()->getUrl())}">
                    <img src="{productImageUrl($element->getSProducts()->getSmallImage())}" width="96" />
                    </a>
                </td>
                <td class="cleaner_title">
                    <a href="{shop_url('product/' . $item.model->getSProducts()->getUrl())}">
                        {echo ShopCore::encode($item.model->getSProducts()->name)}
                    </a>                    
                    {$priceWithDiscount = $element->getSProducts()->getFirstVariant()->price - ($element->getSProducts()->getFirstVariant()->price * $element->discount / 100)}
                    <div>
                        <b class="gray_line_through">{echo ShopCore::app()->SCurrencyHelper->convert($element->getSProducts()->getFirstVariant()->price)} {$CS}</b>
                        {echo ShopCore::app()->SCurrencyHelper->convert($priceWithDiscount)} {$CS}</div>
                </td>
                
                {/foreach}
            </tr>
            {/if}
            
           
            {/foreach}
        </tbody>
        <tfoot>
            <tr>
                {if !$recount}
                <td colspan="3"><a href="{shop_url('cart')}" class="b_o">Оформить заказ</a></td>
                {else:}
                <td colspan="3"><a href="{shop_url('cart')}" class="b_o">Применить</a></td>
                {/if}
                <td class="sum">Итог:</td>
                <td><span>{echo ShopCore::app()->SCart->totalPrice()} <span>{$CS}</span></span></td>
            </tr>
        </tfoot>
    </table>
</form>
{else:}
<h1 style="width: 500px">Корзина пуста</h1>
{/if}