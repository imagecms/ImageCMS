<div class="frame-label">
    <span class="title">{lang('Оплата:','lightVertical')}</span>
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