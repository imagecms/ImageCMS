{var_dump($payments)}
{$counter = true}
<div class="lineForm">
    <div class="lineForm">
        <select name="paymentMethodId" id="paymentMethod">
            {foreach $paymentMethods as $paymentMethod}
                <label>
                    <option
                        {$pay_id = $paymentMethod->getId()}
                        {if $counter} checked="checked"
                            {$counter = false}
                        {/if}
                        value="{echo $pay_id}"
                        />
                    {echo $paymentMethod->getName()}
                    </option>
                </label>
            {/foreach}
        </select>
    </div>
</div>