<form id="paidForm" accept-charset="windows-1251"  name="pay" method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{echo $data['amount']}" /> 
    <input type="hidden" name="LMI_PAYMENT_DESC" value="{echo $data['description']}" />
    <input type="hidden" name="LMI_PAYMENT_NO" value="{echo $data['order_id']}" />
    <input type="hidden" name="LMI_PAYEE_PURSE" value="{echo $data['merchant_purse']}" />
    <input type='hidden' name='LMI_RESULT_URL' value="{echo $data['server_url']}" />
    <input type="hidden" name="LMI_SUCCESS_URL" value="{echo $data['result_url']}" />
    <input type="hidden" name="LMI_FAIL_URL" value="{echo $data['result_url']}" />
    <div class='btn-cart btn-cart-p'>
        <input type='submit' value='{lang('Оплатить','payment_method_webmoney')}'>
    </div>
</form>