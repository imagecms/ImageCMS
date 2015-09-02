<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Main currency', 'payment_method_liqpay')} :</label>
    <div class="controls maincurrText">
        <span>{echo \Currency\Currency::create()->getMainCurrency()->getName()}</span>
        <span>({echo \Currency\Currency::create()->getMainCurrency()->getCode()})</span>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Currency payment service', 'payment_method_liqpay')} :</label> {/*}Валюта оплаты услуг{ */}
    <div class="controls">
        {foreach \Currency\Currency::create()->getCurrencies() as $currency}
            <label>
                <input type="radio" name="payment_method_liqpay[merchant_currency]"
                       {if $data['merchant_currency']}
                           {if $data['merchant_currency'] == $currency->getId()}
                               checked="checked"
                           {/if}    
                       {else:}
                           {if \Currency\Currency::create()->getMainCurrency()->getId() == $currency->getId()}
                               checked="checked"
                           {/if} 
                       {/if}
                       value="{echo $currency->getId()}"
                       />
                <span>{echo $currency->getName()}({echo $currency->getCode()})</span>
            </label>


        {/foreach}
    </div>
</div>
{/*}
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Markup', 'payment_method_liqpay')} :</label>
    <div class="controls">
        <input type="text" onkeyup="checkLenghtStr('oldP', 3, 2, event.keyCode);" id="oldP" name="payment_method_liqpay[merchant_markup]" value="{echo $data['merchant_markup']}"/> %
    </div>
</div>
{ */}
<br/>
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