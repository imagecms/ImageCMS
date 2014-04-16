<form action="https://api.privatbank.ua/p24api/ishop" method="POST">
    <input type="hidden" name="amt" value="{$PAYMENT_AMOUNT}"/>
    <input type="hidden" name="ccy" value="{$CURRENCY}" />
    <input type="hidden" name="merchant" value="{$MERCHANT_ID}" />
    <input type="hidden" name="order" value="{$PAYMENT_NO}" />
    <input type="hidden" name="details" value="{$PAYMENT_DESC}" />
    <input type="hidden" name="ext_details" value="{$ADD_PAYMENT_DESC}" />
    <input type="hidden" name="pay_way" value="privat24" />
    <input type="hidden" name="return_url" value="{$SUCCESS_URL}" />
    <input type="hidden" name="server_url" value="{$RESULT_URL}" />
    <button type="submit" class="btn btn_buy psPay">Оплатить</button>
</form>
