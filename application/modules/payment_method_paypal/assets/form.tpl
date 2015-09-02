{/*} https://www.sandbox.paypal.com/cgi-bin/webscr //TeST { */}

<form id="paidForm" method="post" action= "https://www.paypal.com/cgi-bin/webscr">
    <input type="hidden" name="cmd" value="_xclick"/>
    <input type="hidden" name="business" value="{echo $data['marchant']}"/>
    <input type="hidden" name="item_name" value="{echo $data['description']}"/>
    <input type="hidden" name="item_number" value="{echo $data['order_id']}"/>
    <input type="hidden" name="amount" value="{echo $data['amount']}"/>
    <input type="hidden" name="no_shipping" value="1"/>
    <input type="hidden" name="notify_url" value="{echo $data['server_url']}"/>
    <input type="hidden" name="return" value="{echo $data['result_url']}"/>
    <input type="hidden" name="currency_code" value="{echo $data['currency']}"/>
    <div class='btn-cart btn-cart-p'>
        <input type='submit' value='{lang("Оплатить","payment_method_paypal")}'>
    </div>
</form>