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
                        value="{echo $paymentMethod->getId()}"
                        >
                        {echo $paymentMethod->getName()}
                    </option>
                </label>
            {/foreach}
        </select>
    </div>
</div>