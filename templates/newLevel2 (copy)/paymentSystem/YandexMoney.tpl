<form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml"> 
 <input type="hidden" name="receiver" value="{$YandexMoney}"> 
 <input type="hidden" name="currency" value="{$ISOCode}">
 <input type="hidden" name="label" value="{$shp_order_key}"> 
 <input type="hidden" name="quickpay-form" value="shop"> 
 <input type="hidden" name="targets" value="транзакция {$inv_desc}"> 
 <input type="hidden" name="sum" value="{$out_summ}"  > 
 <input type="submit" name="submit-button" value="Оплатить">
</form>