<form action='https://www.liqpay.com/?do=clickNbuy' method='POST' target='_blank'>
    <input type='hidden' name='operation_xml' value='{echo $xml_encoded}' />
    <input type='hidden' name='signature' value='{echo $lqsignature}' />
    <div class="btn-cart btn-cart-p">
        <input type='submit' value='{lang('Оплатить','boxVertical')}'/>
    </div>
</form>