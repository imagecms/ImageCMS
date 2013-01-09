{if sizeof($paymentMethods) > 0}
<div class="sp"></div>
<h5>Способ оплаты</h5>
<div class="spLine"></div>
<ul class="deliveryMethods">
    {$n=0}
    {foreach $paymentMethods as $paymentMethod}
    
    {if $n==0}
        {$checked = "checked"}
        {$activePaymentMethod = $paymentMethod->getId()}
        {$n++}
    {else:}
        {$checked = ''}
    {/if}
	<li>
		<h3>
            <label>
				 <input type="radio" onclick="changePaymentMethod(this.value);" {$checked} name="paymentMethod" value="{echo $paymentMethod->getId()}" />
				 
				 {echo ShopCore::encode($paymentMethod->getName())}
			</label>
		</h3>
        <div class="desc">{echo $paymentMethod->getDescription()}</div>
	</li>
    {/foreach}
</ul>
{/if}
<script type="text/javascript">
    changePaymentMethod({echo $activePaymentMethod});
</script>