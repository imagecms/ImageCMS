<ul class="delivery-payment_product clearfix">
    <li>
        <span class="icon-delivery"></span>
        <div>
            <div class="title">Доставка</div>
            <ul>
                {foreach $delivery_methods as $dm}
                    <li>{echo $dm->getName()} 
                        <span class="green">
                            {if (int)$dm->getPrice() == 0}
                                (Бесплатно)
                            {elseif $dm->getPrice() < 0}
                                <br />(Стоимость согласно тарифам перевозчика)
                            {else:}
                                ({echo $dm->getPrice()} {$CS})
                            {/if}
                        </span>
                    </li>
                {/foreach}
            </ul>
        </div>
    </li>
    <li>
        <span class="icon-payment"></span>
        <div>
            <div class="title">Оплата</div>
            <ul>
                {foreach $payments_methods as $pm}
                    <li>{echo $pm->getName()}</li>
                {/foreach}
            </ul>
        </div>
    </li>
</ul>