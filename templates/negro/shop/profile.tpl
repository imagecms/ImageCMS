<div class="frame-crumbs">
    <div class="container">
        {myCrumbs(0, " / ", "Личный кабинет")}
    </div>
</div>
 <div class="frame-inside">
    <div class="container">
        <h1>{echo encode($profile->getName())}, добро пожаловать!</h1>
        <div class="clearfix item-product">
            <div class="left-personal f-s_0">
                <ul class="tabs tabs-data">
                    <li><span data-href="#my_data">{lang('s_profile_me')}</span></li>
                    <li><span data-href="#change_pass">{lang('s_profile_me_change_password')}</span></li>
                    {if count($orders) > 0}
                        <li><span data-href="#history_order">История заказов</span></li>
                    {/if}
                    {if count($goods_in_spy) > 0}
                        <li><span data-href="#wait_tov">Слежение за ценой</span></li>
                    {/if}
                </ul>
                <div class="frame-tabs-ref">

                    <div id="my_data">
                        <div class="clearfix">
                            <div class="horizontal-form w_350 f_l">
                                {include_tpl('../profile_data_popup')}
                            </div>
                            {//$discount = ShopCore::app()->SDiscountsManager->getActive();}
                            {/*if count(getComulativDiscountList()) > 0}
                                <div class="right-personal">    
                                    <div class="info-discount">
                                        {if count($discountCom) > 0}
                                            <div class="f-s_14 title">Ваша скидка</div>
                                            <div class="c_68 info-discount-count">Текущая накопительная скидка: <span class="text-discount f-s_14">{echo $discountCom->getDiscount()}%</span></div>
                                        {/if}
                                    </div>
                                </div>
                            {/if*/}
                        </div>
                    </div>
                    <div id="change_pass">
                        <div class="horizontal-form w_350">
                                    {include_tpl('../change_pass_popup')}
                        </div>
                    </div>
                    <div id="history_order">
                        <table class="characteristic">
                            <thead>
                                <tr>
                                    <th>№ Заказа</th>
                                    <th>Время покупки</th>
                                    <th>Сумма покупки</th>
                                    <th>Статус заказа</th>
                                    <th>Статус оплаты</th>
                                </tr>
                            </thead>
                            <tbody>
                            {foreach $orders as $order}
                                <tr>
                                    <td><a rel="nofollow" href="{shop_url('cart/view/' . $order->getKey())}">{echo $order->getId()}</a></td>
                                    <td>{date("d-m-Y H:i", $order->getDateCreated())}</td>
                                    <td>
                                        <span class="green">
                                           {echo ShopCore::app()->SCurrencyHelper->convert($order->getTotalPrice())} {$CS}</td>
                                        </span>
                                    <td>{echo $order->getSOrderStatuses()->getName()}</td>
                                    <td>{if $order->getPaid()} Оплачен {else:} Не оплачен{/if}</td>
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                    <div id="wait_tov">
                        <div class="spy_popup_container">
                            {include_tpl('product_spy_popup')}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>