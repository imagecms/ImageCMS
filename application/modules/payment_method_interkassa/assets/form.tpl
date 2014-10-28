<form id="paidForm" method="POST" action="https://www.liqpay.com/api/pay" 
      accept-charset="utf-8">
    <input type="hidden" name="public_key" value="{echo  $data['public_key']}"/>
    <input type="hidden" name="amount" value="{echo  $data['amount']}"/>
    <input type="hidden" name="currency" value="{echo  $data['currency']}"/>
    <input type="hidden" name="description" value="{echo  $data['description']}"/>
    <input type="hidden" name="order_id" value="{echo  $data['order_id']}"/>
    <input type="hidden" name="result_url" value="{echo  $data['result_url']}"/>
    <input type='hidden' name='server_url' value='{echo  $data['server_url']}'/>   
    <input type="hidden" name="type" value="buy"/>
    <input type="hidden" name="signature" value="{echo $signature}"/>
    <div class='btn-cart btn-cart-p'>
        <input type='submit' value='{lang('Оплатить','payment_method_liqpay')}'>
    </div>
</form>