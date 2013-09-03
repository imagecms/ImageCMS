<form method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp" accept-charset="windows-1251">
    <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{$PAYMENT_AMOUNT}">
    <input type="hidden" name="LMI_PAYMENT_NO" value="{$PAYMENT_NO}">
    <input type="hidden" name="LMI_PAYMENT_DESC" value="{$PAYMENT_DESC}">
    <input type="hidden" name="LMI_PAYEE_PURSE" value="{$PAYEE_PURSE}">
    <input type="hidden" name="LMI_RESULT_URL" value="{$RESULT_URL}">
    <input type="hidden" name="LMI_SUCCESS_URL" value="{$SUCCESS_URL}">
    <input type="hidden" name="LMI_FAIL_URL" value="{$FAIL_URL}">
    {$PAYBUTTON}
</form>