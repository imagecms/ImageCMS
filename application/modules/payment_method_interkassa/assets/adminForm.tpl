<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Main currency', 'payment_method_interkassa')} :</label>
    <div class="controls maincurrText">
        <span>{echo \Currency\Currency::create()->getMainCurrency()->getName()}</span>
        <span>({echo \Currency\Currency::create()->getMainCurrency()->getCode()})</span>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Currency payment service', 'payment_method_interkassa')} :</label> {/*}Валюта оплаты услуг{ */}
    <div class="controls">
        {foreach \Currency\Currency::create()->getCurrencies() as $currency}
            <label>
                <input type="radio" name="payment_method_interkassa[merchant_currency]"
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
    <label class="control-label" for="inputRecCount">{lang('Markup', 'payment_method_interkassa')} :</label>
    <div class="controls">
        <input type="text" onkeyup="checkLenghtStr('oldP', 3, 2, event.keyCode);" id="oldP" name="payment_method_interkassa[merchant_markup]" value="{echo $data['merchant_markup']}"/> %
    </div>
</div>
{ */}
<br/>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Id cashbox', 'payment_method_interkassa')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_interkassa[merchant_id]" value="{echo $data['merchant_id']}"/>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Secret key', 'payment_method_interkassa')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_interkassa[merchant_sig]" value="{echo $data['merchant_sig']}"/>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Test secret key', 'payment_method_interkassa')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_interkassa[merchant_sig_test]" value="{echo $data['merchant_sig_test']}"/>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Test mode', 'payment_method_interkassa')} :</label>
    <div class="controls">
        <input type="checkbox" name="payment_method_interkassa[test_checkbox]" {if $data['test_checkbox']}checked='checked'{/if}/>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <p>{lang('Проверять подпись в форме запроса платежа: да', 'payment_method_interkassa')}</p>
        <p>{lang('Проверять уникальность платежей : да', 'payment_method_interkassa')}</p>
        <p>{lang('Алгоритм подписи: MD5', 'payment_method_interkassa')}</p>
        <br/>
        <p>{lang('URL успешной оплаты:', 'payment_method_interkassa')}</p>
        <p style="margin-left:50px">{lang('POST, разрешить переопределять в запросе', 'payment_method_interkassa')}</p>
        <p>{lang('URL неуспешной оплаты:', 'payment_method_interkassa')}</p>
        <p style="margin-left:50px">{lang('POST, разрешить переопределять в запросе', 'payment_method_interkassa')}</p>
        <p>{lang('URL ожидания проведения платежа:', 'payment_method_interkassa')}</p>
        <p style="margin-left:50px">{lang('POST, разрешить переопределять в запросе', 'payment_method_interkassa')}</p>
        <p>{lang('URL взаимодействия:', 'payment_method_interkassa')}</p>
        <p style="margin-left:50px">{lang('POST', 'payment_method_interkassa')},  {echo site_url('/payment_method_interkassa/callback')}</p>
    </div>				
</div>