<form method="POST" action="{echo $data['url']}" target="_blank">
    <input type="hidden" value="{echo $data['pm']}"  name="pm">
    <input type="hidden" value="{echo $data['order_id']}"  name="order_id">
    <input type="hidden" value="{echo $data['price']}"  name="price">
    <div class='btn-cart btn-cart-p'>
        <input type='submit' value='{lang('Оплатить','payment_method_sberbank')}'>
    </div>
</form>