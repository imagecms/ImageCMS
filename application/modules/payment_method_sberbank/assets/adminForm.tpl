<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Main currency', 'payment_method_sberbank')} :</label>
    <div class="controls maincurrText">
        <span>{echo \Currency\Currency::create()->getMainCurrency()->getName()}</span>
        <span>({echo \Currency\Currency::create()->getMainCurrency()->getCode()})</span>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Currency payment service', 'payment_method_sberbank')} :</label> {/*}Валюта оплаты услуг{ */}
    <div class="controls">
        {foreach \Currency\Currency::create()->getCurrencies() as $currency}
            <label>
                <input type="radio" name="payment_method_sberbank[merchant_currency]"
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

<br/>

<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo  lang('Name of recipient', 'payment_method_sberbank') }:</label>
    <div class="controls">
        <input type="text" name="payment_method_sberbank[receiverName]" value="{echo  $data['receiverName'] }"  />
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo  lang('Recipient bank', 'payment_method_sberbank') }:</label>
    <div class="controls">
        <input type="text" name="payment_method_sberbank[bankName]" value="{echo  $data['bankName'] }"  />
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo  lang('TIN address', 'payment_method_sberbank') }:</label>
    <div class="controls">
        <input type="text" name="payment_method_sberbank[receiverInn]" value="{echo  $data['receiverInn'] }"/>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo  lang('Recipient account', 'payment_method_sberbank') }:</label>
    <div class="controls">
        <input type="text" name="payment_method_sberbank[account]" value="{echo  $data['account'] }" />
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo  lang('BIC', 'payment_method_sberbank') }:</label>
    <div class="controls">
        <input type="text" name="payment_method_sberbank[BIK]" value="{echo  $data['BIK'] }"/>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo  lang('Correspondent account', 'payment_method_sberbank') }:</label>
    <div class="controls">
        <input type="text" name="payment_method_sberbank[cor_account]" value="{echo  $data['cor_account'] }"  />
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo  lang('Bank notes', 'payment_method_sberbank') }:</label>
    <div class="controls">
        <input type="text" name="payment_method_sberbank[bankNote]" value="{echo  $data['bankNote'] }"  />
        <span class="help-block">{echo lang('For example: руб, грн', 'payment_method_sberbank')}</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputRecCount">{echo  lang('Kopeck', 'payment_method_sberbank') }:</label>
    <div class="controls">
        <input type="text" name="payment_method_sberbank[bankNote2]" value="{echo  $data['bankNote2'] }"/>
        <span class="help-block">{echo lang('For example: коп, копеек', 'payment_method_sberbank')}</span>
    </div>
</div>