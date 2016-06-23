<form id="paidForm" accept-charset="UTF-8" method="post" action="https://wl.walletone.com/checkout/checkout/Index">

    {foreach $fields as $name => $value}
        <input type="hidden" name="{$name}" value="{$value}"/>
    {/foreach}

    <div class='btn-cart btn-cart-p'>
        <input type='submit' value='{lang('Оплатить','payment_method_2checkout')}'>
    </div>


</form>