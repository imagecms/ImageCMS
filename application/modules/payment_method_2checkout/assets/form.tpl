{/*} https://sandbox.2checkout.com/checkout/purchase //Тестовая { */}

<form id="paidForm" action="https://www.2checkout.com/checkout/purchase" method="post">
    <input type="hidden" name="sid" value="{echo $data['sid']}"/>
    <input type="hidden" name="mode" value="2CO"/>
    <input type="hidden" name="li_0_name" value="{echo $data['order_id']}"/>

    <input type="hidden" name="li_0_price" value="{echo $data['amount']}"/>
    <input type="hidden" name="x_receipt_link_url" value="{echo $data['server_url']}"/>
    <div class='btn-cart btn-cart-p'>
        <input type='submit' value='{lang('Оплатить','payment_method_2checkout')}'>
    </div>
</form>