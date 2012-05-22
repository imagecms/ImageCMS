{$counter = 0}
{foreach $paymentMethods as $paymentMethod}
    <label><input type="radio"{if $counter == 0} checked="checked"{/if} name="met_buy" class="met_buy" value="{echo $paymentMethod->getId()}" />{echo $paymentMethod->getName()}</label>
    {$counter++}
{/foreach}