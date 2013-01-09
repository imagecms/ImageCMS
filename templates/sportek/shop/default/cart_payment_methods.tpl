<select class="b_width" name="paymentMethodId">    
    {foreach $paymentMethods as $paymentMethod}
    <option value="{echo $paymentMethod->getId()}">{echo $paymentMethod->getName()}</option>
    {/foreach}
</select>