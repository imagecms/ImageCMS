<form id="paidForm" accept-charset="windows-1251"  name="pay" method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{echo $data['amount']}" /> <!-- Сумма -->
    <input type="hidden" name="LMI_PAYMENT_DESC" value="{echo $data['description']}" /><!-- Описание -->
    <input type="hidden" name="LMI_PAYMENT_NO" value="{echo $data['order_id']}" /><!-- уникальный номер (odrer_id) -->
    <input type="hidden" name="LMI_PAYEE_PURSE" value="{echo $data['merchant_purse']}" /><!-- Кошелек-->
    <input type='hidden' name='LMI_RESULT_URL' value="{echo $data['server_url']}" /><!-- Куда будет слаться статус-->
    <input type="hidden" name="LMI_SUCCESS_URL" value="{echo $data['result_url']}" /><!-- Редирект при оплате-->
    <input type="hidden" name="LMI_FAIL_URL" value="{echo $data['result_url']}" /><!-- Редирект при неоплате-->
    <div class='btn-cart btn-cart-p'>
        <input type='submit' value='{lang('Оплатить','payment_method_webmoney')}'>
    </div>
</form>