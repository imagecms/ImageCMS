<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Public key', 'payment_method_liqpay')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_liqpay[merchant_id]" value="{echo $data['merchant_id']}"/>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Private key', 'payment_method_liqpay')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_liqpay[merchant_sig]" value="{echo $data['merchant_sig']}" />
    </div>
</div>