<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Purse', 'payment_method_webmoney')} :</label>
    <div class="controls">
        <input type="text" name="payment_method_webmoney[merchant_purse]" value="{echo $data['merchant_purse']}"/>
    </div>
    <div class="controls">{lang('Currency purse should match the main site currency (UAH - WMU, RUR - WMR)','payment_method_webmoney')}</div>
</div>
<div class="control-group">
    <label class="control-label" for="inputRecCount">{lang('Private key', 'payment_method_webmoney')} (Secret key):</label>
    <div class="controls">
        <input type="text" name="payment_method_webmoney[merchant_sig]" value="{echo $data['merchant_sig']}" />
    </div>
</div>
    <div class="control-group">
                <div class="controls">
                    <p>{lang('Настройки', 'payment_method_webmoney')}: <a href='http://merchant.webmoney.ru'>http://merchant.webmoney.ru</a></p>
                    <p>{lang('Позволять использовать URL, передаваемые в форме: да', 'payment_method_webmoney')}</p>
                    <p>{lang('Метод формирования контрольной подписи: SHA256', 'payment_method_webmoney')}</p>
                    <p>{lang('Тестовый/Рабочий режимы: рабочий', 'payment_method_webmoney')}</p>
                    <p>{lang('Success URL: POST', 'payment_method_webmoney')}</p>
                    <p>{lang('Fail URL: POST', 'payment_method_webmoney')}</p>
                </div>				
    </div>