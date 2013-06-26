<span class="title-h3">Способ доставки</span>&nbsp;&nbsp;<a href="{site_url('oplata')}">Подробнее</a>
<div class="frame-radio-but is_deliveries">
    {foreach $deliveryMethods as $m}
        <div for="input_dMethod_{echo $m->getId()}" class="frame-label">
            {if $m->getPrice() == 0 || $m->getFreeFrom() <= ShopCore::app()->SCart->totalPrice() && $m->getFreeFrom() > 0}
                {$mCur_price_val = 0}{$mCur_price_text = '(Бесплатно)'}
            {elseif $m->getPrice() < 0}
                {$mCur_price_val = -1}{$mCur_price_text = '(Согласно тарифам перевозчика)'}
            {else:}
                {$mCur_price_val = round($m->getPrice())}{$mCur_price_text = round($m->getPrice()) . " " . $CS}
            {/if}
			<div class="">
				<input id="input_dMethod_{echo $m->getId()}" name="deliveryMethodId" value="{echo $m->getId()}" data-freefrom="{echo $m->getFreeFrom()}" data-price="{$mCur_price_val}" type="radio" class="f_l" />
			</div>
            <div class="neigh-radio">
                {echo $m->getName()}
                <span class="green">
                    {$mCur_price_text}
                </span>
                {if $m->getDescription()}
                    <div class="help-block d_b">{echo $m->getDescription()}</div>
                {/if}
            </div>
        </div>
    {/foreach}
</div>