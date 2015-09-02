<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Main currency', 'payment_method_robokassa')} :</label>
    <div class="controls maincurrText">
        <span>{echo \Currency\Currency::create()->getMainCurrency()->getName()}</span>
        <span>({echo \Currency\Currency::create()->getMainCurrency()->getCode()})</span>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Currency payment service', 'payment_method_robokassa')} :</label> {/*}Валюта оплаты услуг{ */}
    <div class="controls">
        {foreach \Currency\Currency::create()->getCurrencies() as $currency}
            {if strtoupper($currency->getCode()) == 'RUR' || strtoupper($currency->getCode()) == 'RUB'}
                <label>
                    <input type="radio" name="payment_method_robokassa[merchant_currency]"
                           {if $data['merchant_currency']}
                               {if $data['merchant_currency'] == $currency->getId()}
                                   checked="checked"
                               {/if}    
                           {else:}
                               {if strtoupper($currency->getCode()) == 'RUR' || strtoupper($currency->getCode()) == 'RUB'}
                                   checked="checked"
                               {/if} 
                           {/if}
                           value="{echo $currency->getId()}"
                           />
                    <span>{echo $currency->getName()}({echo $currency->getCode()})</span>
                </label>
            {/if}
        {/foreach}
    </div>
</div>

<br/>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Login', 'payment_method_robokassa')}:</label>
    <div class="controls">
        <input type="text" name="payment_method_robokassa[login]" value="{echo $data['login']}"  />
    </div>
</div>          
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Password', 'payment_method_robokassa')} 1:</label>
    <div class="controls">
        <input type="text" name="payment_method_robokassa[password1]" value="{echo $data['password1']}"  />
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Password')} 2:</label>
    <div class="controls">
        <input type="text" name="payment_method_robokassa[password2]" value="{echo $data['password2']}"/>
    </div>
</div>        
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Merchant settings', 'payment_method_robokassa')}:</label>
    <div class="controls">
        Result URL: {echo site_url('payment_method_robokassa/callback')}<br/>
        Success URL: {echo shop_url('order/view/')}<br/>
        Fail URL: {echo shop_url('order/view/')}<br/><br/>
        <span class="help-block">{lang('The method of sending data for all requests: POST', 'main')}</span>
    </div>
</div>
