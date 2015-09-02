<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Main currency', 'payment_method_paypal')} :</label>
    <div class="controls maincurrText">
        <span>{echo \Currency\Currency::create()->getMainCurrency()->getName()}</span>
        <span>({echo \Currency\Currency::create()->getMainCurrency()->getCode()})</span>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Currency payment service', 'payment_method_paypal')} :</label> {/*}Валюта оплаты услуг{ */}
    <div class="controls">
        {foreach \Currency\Currency::create()->getCurrencies() as $currency}
            <label>
                <input type="radio" name="payment_method_paypal[merchant_currency]"
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
    <label class="control-label" for="inputRecCount">{lang('Markup', 'payment_method_paypal')} :</label>
    <div class="controls">
        <input type="text" onkeyup="checkLenghtStr('oldP', 3, 2, event.keyCode);" id="oldP" name="payment_method_paypal[merchant_markup]" value="{echo $data['merchant_markup']}"/> %
    </div>
</div>
{ */}
<br/>
<div class="control-group">
    <label class="control-label" for="merchant">{lang('Marchant', 'payment_method_paypal')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_paypal[merchant]" value="{echo $data['merchant']}"/>
    </div>
</div>
{/*}
<div class="control-group">
    <label class="control-label" for="server_url">{lang('Server url', 'payment_method_paypal')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_paypal[server_url]" value="{echo $data['server_url']}"/>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="return_url">{lang('Return url', 'payment_method_paypal')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_paypal[return_url]" value="{echo $data['return_url']}"/>
    </div>
</div>
{*/}
