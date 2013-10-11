<div class="groups-form">
    <div class="frame-label" for="giftcert">
        <span class="title">{lang('Promo код','newLevel')}</span>
        <div class="frame-form-field gift-success">
            {/*echo $gift->key*/}
            <ul class="items items-order-gen-info">
                <li>
                    <span class="s-t">{lang('Сумма:','newLevel')}</span>
                    <span class="price-item">
                        <span>
                            <span class="price">{echo $gift->value}</span>
                            <span class="curr">{$CS}</span>
                        </span>
                    </span>
                </li>
            </ul>
            <input type="hidden" name="giftkey" value="{echo $gift->key}"/>
        </div>
    </div>
</div>