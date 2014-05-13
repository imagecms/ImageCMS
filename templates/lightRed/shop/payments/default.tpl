{if count($payments)}
    <div class="frame-label">
        <span class="title">{lang('Оплата:','lightRed')}</span>
        <div class="frame-form-field check-variant-payment">
            {$counter = true}
            <div class="lineForm">
                <select name="paymentMethodId" id="paymentMethod">
                    {foreach $payments as $paymentMethod}
                        <label>
                            <option
                                {if $counter}
                                    checked="checked"
                                    {$counter = false}
                                {/if}
                                value="{echo $paymentMethod->getId()}"
                                >
                                {echo $paymentMethod->getName()}
                            </option>
                        </label>
                    {/foreach}
                </select>
            </div>
        </div>
    </div>
{else:}
    <div class="frame-label">
        <span class="title">{lang('Оплата','lightRed')}:</span>
        <div class="frame-form-field" style="padding-top: 6px;">
            <div class="help-block">{lang('Нет способов оплаты','lightRed')}</div>
        </div>
    </div>
{/if}