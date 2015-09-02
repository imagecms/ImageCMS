<form method="POST"
      {if $data['settings']['test']}
          action="https://demomoney.yandex.ru/eshop.xml"
      {else:}
          action="https://money.yandex.ru/eshop.xml"
      {/if}
      id="paidForm">
    {if $payments}
        <select id="paidFormSelect" name="paymentType">
            {if $data['settings']['PC']}
                <option value="PC" selected="selected">Оплата из Яндекс.Денег</option>
            {/if}
            {if $data['settings']['AC']}
                <option value="AC" selected="selected">Оплата банковской картой</option>
            {/if}
            {if $data['settings']['MC']}
                <option value="MC" selected="selected">Платеж со счета мобильного</option>
            {/if}
            {if $data['settings']['WM']}
                <option value="WM" selected="selected">Оплата через WebMoney</option>
            {/if}
            {if $data['settings']['AB']}
                <option value="AB" selected="selected">AlphaClick</option>
            {/if}
            {if $data['settings']['SB']}
                <option value="SB" selected="selected">Sberbank Online</option>
            {/if}
        </select>
    {else:}
        <input type="hidden" name="paymentType" value="PC">
    {/if}
    <input type="hidden" name="shopid" value="{echo $data['shopid']}">
    <input type="hidden" name="scid" value="{echo $data['scid']}">
    <input type="hidden" name="shopSuccessURL" value="{echo $data['result_url']}" >
    <input type="hidden" name="shopFailURL" value="{echo $data['result_url']}" >
    <input type="hidden" name="orderNumber" value="{echo $data['order_id']}">
    <input type="hidden" name="sum" value="{echo $data['amount']}">
    <input type="hidden" name="customerNumber" value="{echo $data['customerNumber']}" >
    <input type="hidden" name="paymentKey" value="{echo $data['paymentKey']}" >
    <div class='btn-cart btn-cart-p'>
        <input type='submit' value='{lang('Оплатить','payment_method_yakassa')}'>
    </div>
</form>
