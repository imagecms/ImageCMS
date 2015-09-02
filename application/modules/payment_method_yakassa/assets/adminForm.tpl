<div class="control-group">
    <label class="control-label">{lang('Внимание', 'payment_method_yakassa')} :</label>
    <div class="controls maincurrText">
        <span>{lang('Касса работает только если сайт работает по протоколу ssl.','payment_method_yakassa')}</span><br/>
        <span>{lang('То есть адрес сайта должен начинаться с https://','payment_method_yakassa')}</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label">checkURL:</label>
    <div class="controls">
        <span>{site_url('payment_method_yakassa/callback')}</span><br/>
    </div>
</div>
<div class="control-group">
    <label class="control-label">paymentAvisoURL:</label>
    <div class="controls">
        <span>{site_url('payment_method_yakassa/callback')}</span><br/>
    </div>
</div>
<div class="control-group">
    <label class="control-label">Success & Fail URLs:</label>
    <div class="controls">
        <span>{site_url('shop/profile/#history_order')}</span><br/>
    </div>
</div>
<br/>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Main currency', 'payment_method_yakassa')} :</label>
    <div class="controls">
        <span>{echo \Currency\Currency::create()->getMainCurrency()->getName()}</span>
        <span>({echo \Currency\Currency::create()->getMainCurrency()->getCode()})</span>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Currency payment service', 'payment_method_yakassa')} :</label> {/*}Валюта оплаты услуг{ */}
    <div class="controls">
        {foreach \Currency\Currency::create()->getCurrencies() as $currency}
            {if strtoupper($currency->getCode()) == 'RUR' || strtoupper($currency->getCode()) == 'RUB'}
                <label>
                    <input type="radio" name="payment_method_yakassa[merchant_currency]"
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
    <label class="control-label">{lang('shopid', 'payment_method_yakassa')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_yakassa[shopid]" value="{echo $data['shopid']}"/>
    </div>
</div>
<div class="control-group">
    <label class="control-label">{lang('scid', 'payment_method_yakassa')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_yakassa[scid]" value="{echo $data['scid']}" />
    </div>
</div>
<div class="control-group">
    <label class="control-label">{lang('Shop password', 'payment_method_yakassa')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_yakassa[password]" value="{echo $data['password']}" />
    </div>
</div>
<br>

<div class="control-group">
    <label class="control-label">{lang('Оплата из Яндекс.Денег', 'payment_method_yakassa')} :</label>
    <div class="controls">
        <input type="checkbox" name="payment_method_yakassa[PC]" {if $data['PC']} checked='checked'{/if}  value="1" />
    </div>
</div>

<div class="control-group">
    <label class="control-label">{lang('Оплата банковской картой', 'payment_method_yakassa')} :</label>
    <div class="controls">
        <input type="checkbox" name="payment_method_yakassa[AC]" {if $data['AC']} checked='checked'{/if} value="1" />
    </div>
</div>

<div class="control-group">
    <label class="control-label">{lang('Платеж со счета мобильного', 'payment_method_yakassa')} :</label>
    <div class="controls">
        <input type="checkbox" name="payment_method_yakassa[MC]" {if $data['MC']} checked='checked'{/if} value="1" />
    </div>
</div>

<div class="control-group">
    <label class="control-label">{lang('Оплата через WebMoney', 'payment_method_yakassa')} :</label>
    <div class="controls">
        <input type="checkbox" name="payment_method_yakassa[WM]" {if $data['WM']} checked='checked'{/if} value="1" />
    </div>
</div>

<div class="control-group">
    <label class="control-label">{lang('AlphaClick', 'payment_method_yakassa')} :</label>
    <div class="controls">
        <input type="checkbox" name="payment_method_yakassa[AB]" {if $data['AB']} checked='checked'{/if} value="1" />
    </div>
</div>

<div class="control-group">
    <label class="control-label">{lang('Sberbank Online', 'payment_method_yakassa')} :</label>
    <div class="controls">
        <input type="checkbox" name="payment_method_yakassa[SB]" {if $data['SB']} checked='checked'{/if} value="1" />
    </div>
</div>`

<br>
<div class="control-group">
    <label class="control-label">{lang('Тестовый режим', 'payment_method_yakassa')} :</label>
    <div class="controls">
        <input type="checkbox" name="payment_method_yakassa[test]" {if $data['test']} checked='checked'{/if} value="1" />
    </div>
</div>