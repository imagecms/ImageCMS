<div class="control-group">
    {$mainCurrency = \Currency\Currency::create()->getMainCurrency();}
    {$currencies = \Currency\Currency::create()->getCurrencies();}
    <label class="control-label" for="inputRecCount">{lang('Main currency', 'payment_method_walletone')} :</label>
    <div class="controls maincurrText">
        <span>{echo $mainCurrency->getName()}</span>
        <span>({echo $mainCurrency->getCode()})</span>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Currency payment service', 'payment_method_walletone')} :</label> {/*}Валюта оплаты услуг{ */}
    <div class="controls">
        {foreach $currencies as $currency}
            {if array_key_exists($currency->getCode(), $currencyCodes)}
            <label>
                <input type="radio" name="payment_method_walletone[merchant_currency]"
                       {if $data['merchant_currency']}
                           {if $data['merchant_currency'] == $currency->getId()}
                               checked="checked"
                           {/if}
                       {else:}
                           {if $mainCurrency->getId() == $currency->getId()}
                               checked="checked"
                           {/if}
                       {/if}
                       value="{echo $currency->getId()}"
                       />
                <span>{echo $currency->getName()}({echo $currency->getCode()}({echo $currencyCodes[$currency->getCode()]}))</span>
            </label>
            {/if}
        {/foreach}
    </div>
</div>

<br/>
<div class="control-group">
    <label class="control-label" for="sid">{lang('Merchant id', 'payment_method_walletone')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_walletone[merchant_id]" value="{echo $data['merchant_id']}"/>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="electronic_signature">{lang('Electronic signature', 'payment_method_walletone')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_walletone[electronic_signature]" value="{echo $data['electronic_signature']}"/>
    </div>
</div>


