<form action='https://merchant.roboxchange.com/Index.aspx' method='POST'>
    <input type='hidden' name='MrchLogin' value='{$mrh_login}'>
    <input type='hidden' name='OutSum' value='{$out_summ}'>
    <input type='hidden' name='InvId' value='{$inv_id}'>
    <input type='hidden' name='Desc' value='{$inv_desc}'>
    <input type='hidden' name='SignatureValue' value='{$crc}'>
    <input type='hidden' name='Shp_orderKey' value='{$shp_order_key}'>
    <input type='hidden' name='Shp_pmId' value='{$shp_payment_id}'>
    <input type='hidden' name='IncCurrLabel' value='{$in_curr}'>
    <input type='hidden' name='Culture' value='{$culture}'>
    <button type="submit" class="btn btn_buy psPay">Оплатить</button>
</form>