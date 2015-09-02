<form id="paidForm" name="payment" method="post" action="https://sci.interkassa.com/" accept-charset="UTF-8">
    <input type="hidden" name="ik_co_id" value="{echo $data['ik_co_id']}" /> <!-- ид кассы -->
    <input type="hidden" name="ik_pm_no" value="{echo $data['ik_pm_no']}" /> <!-- ид  -->
    <input type="hidden" name="ik_am" value="{echo $data['ik_am']}" /><!-- Сумма платежа  -->
    <input type="hidden" name="ik_desc" value="{echo $data['ik_desc']}" /><!-- Описание  -->
    <input type="hidden" name="ik_cur" value="{echo $data['ik_cur']}" /><!-- Валюта  -->
    <input type="hidden" name="ik_suc_u" value="{echo $data['ik_suc_u']}" /><!-- ссылка success  -->
    <input type="hidden" name="ik_pnd_u" value="{echo $data['ik_pnd_u']}" /><!-- ожидания  -->
    <input type="hidden" name="ik_fal_u" value="{echo $data['ik_fal_u']}" /><!-- ошибка  -->
    <input type="hidden" name="ik_sign" value="{echo $signature}" /><!-- ошибка  -->
    <div class='btn-cart btn-cart-p'>
        <input type='submit' value='{lang('Оплатить','payment_method_interkassa')}'>
    </div>
</form>