<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Main currency', 'payment_method_oschadbank')} :</label>
    <div class="controls maincurrText">
        <span>{echo \Currency\Currency::create()->getMainCurrency()->getName()}</span>
        <span>({echo \Currency\Currency::create()->getMainCurrency()->getCode()})</span>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Currency payment service', 'payment_method_oschadbank')} :</label> {/*}Валюта оплаты услуг{ */}
    <div class="controls">
        {foreach \Currency\Currency::create()->getCurrencies() as $currency}
            <label>
                <input type="radio" name="payment_method_oschadbank[merchant_currency]"
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
    <label class="control-label" for="inputRecCount">{lang('Markup', 'payment_method_oschadbank')} :</label> 
    <div class="controls">
        <input type="text" onkeyup="checkLenghtStr('oldP', 3, 2, event.keyCode);" id="oldP" name="payment_method_oschadbank[merchant_markup]" value="{echo $data['merchant_markup']}"/> %
    </div>
</div>
{ */}
<br/>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo lang('Recipient', 'payment_method_oschadbank')}:</label>
    <div class="controls">
        <input type="text" name="payment_method_oschadbank[receiver]" value="{echo $data['receiver']}" />
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo lang('Identifier code', 'payment_method_oschadbank')}:</label>
    <div class="controls number">
        <input type="text" name="payment_method_oschadbank[code]" value="{echo $data['code']}" maxlength="10" />
        <span class="help-block">{echo lang('Integer. The maximum length of 10 characters.', 'payment_method_oschadbank')}</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo lang('Current account', 'payment_method_oschadbank')}:</label>
    <div class="controls number">
        <input type="text" name="payment_method_oschadbank[account]" value="{echo $data['account']}" maxlength="14" />
        <span class="help-block">{echo lang('Integer. The maximum length of 14 characters.', 'payment_method_oschadbank')}</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo lang('Bank MFI', 'payment_method_oschadbank')}:</label>
    <div class="controls number">
        <input type="text" name="payment_method_oschadbank[mfo]" value="{echo $data['mfo']}" maxlength="6" />
        <span class="help-block">{echo lang('Integer. The maximum length of 6 characters.', 'payment_method_oschadbank')}</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo lang('Money sign', 'payment_method_oschadbank')}:</label>
    <div class="controls">
        <input type="text" name="payment_method_oschadbank[banknote]" value="{echo $data['banknote']}"  />
        <span class="help-block">{echo lang('For example: руб, грн', 'payment_method_oschadbank')}</span>
    </div>
</div>