<form method="POST" action="{echo $data['URL']}" target="_blank">
    <input type="hidden" value="{echo $data['PM']}"  name="pm">
    <input type="hidden" value="{echo $data['order_id']}"  name="order_id">
    <input type="hidden" value="{echo $data['price']}"  name="price">
    <div class='btn-cart btn-cart-p'>
        <input type='submit' value='{lang('Оплатить','payment_method_liqpay')}'>
    </div>
</form>