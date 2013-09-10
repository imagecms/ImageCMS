<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="{$email}">
<input type="hidden" name="lc" value="RU">
<input type="hidden" name="item_name" value="{$inv_desc}">
<input type="hidden" name="item_number" value="{$inv_id}">
<input type="hidden" name="amount" value="{$out_summ}">
<input type="hidden" name="currency_code" value="{$ISOCode}">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="notify_url" value="{$notifyUrlrl}">
<input type="hidden" name="tax_rate" value="2.000">
<input type="hidden" name="shipping" value="5.00">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<input type="hidden" name="on0" value="asdda">asdda<input type="text" name="os0" maxlength="200">

<input type="image" src="https://www.paypalobjects.com/ru_RU/RU/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="{lang('PayPal - более безопасный и легкий способ оплаты через Интернет!','newLevel')}">
<img alt="" border="0" src="https://www.paypalobjects.com/ru_RU/i/scr/pixel.gif" width="1" height="1">
</form>