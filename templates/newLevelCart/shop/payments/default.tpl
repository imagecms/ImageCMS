{$counter = true}
<div class="lineForm">
    <div class="lineForm">
        <select name="paymentMethodId" id="paymentMethod">
            {foreach $payments as $paymentMethod}
                <label>
                    <option
                        {if $counter}
                            checked="checked"
                            {$counter = false}
                        {/if}
                        
                        value="{echo $paymentMethod.payment_method_id}"
                        />
                    {var_dump($paymentMethod)}
                    {echo $paymentMethod->getName()}
                    </option>
                </label>
            {/foreach}
        </select>
    </div>
</div>