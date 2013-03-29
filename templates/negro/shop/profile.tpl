{$month = array(1=>'Января', 2=>'Февраля', 3=>'Марта', 4=>'Апреля', 5=>'Мая', 6=>'Июня', 7=>'Июля', 8=>'Августа', 9=>'Сентября', 10=>'Октября', 11=>'Ноября', 12=>'Декабря')}
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
                    <li><span data-href="#first">Основные данные</span></li>
                    <li><span data-href="#second">Смена пароля</span></li>
                    {if count($orders) > 0}
                        <li><span data-href="#third">История заказов</span></li>
                    {/if}
                    {if count($goods_in_spy) > 0}
                        <li><span data-href="#fourth">Слежение за ценой</span></li>
                    {/if}
                </ul>
                <div class="frame-tabs-ref">

                    <div id="first">
                        <div class="clearfix">
                            <div class="horizontal-form w_350 f_l">
                                <form method="post" action="{shop_url('profile')}" id="profile_form">
                                    <input type="hidden" name="changeName" value="1"/>
                                    <div class="horizontal-form popup_container">
                                        {include_tpl('../../profile_data_popup')}
                                    </div>
                                    {form_csrf}
                                </form>
                            </div>
                            {if count(getComulativDiscountList()) > 0}
                                <div class="right-personal">    
                                    <div class="info-discount">
                                        {$discountCom = ShopCore::app()->SCart->rediscount()}
                                        {if count($discountCom) > 0}
                                            <div class="f-s_14 title">Ваша скидка</div>
                                            <div class="c_68 info-discount-count">Текущая накопительная скидка: <span class="text-discount f-s_14">{echo $discountCom->getDiscount()}%</span></div>
                                        {/if}
                                        <button type="button" class="d_l_b" data-drop=".drop-comulativ-discounts" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="top right">Просмотр таблицы скидок</button>
                                    </div>
                                </div>
                            {/if}
                        </div>
                    </div>

                    <div id="second">
                        <div class="horizontal-form w_350">
                            <form method="post" action="{shop_url('profile')}" id="newpass_form">
                                <input type="hidden" value="1" name="cangePassword" />
                                <div class="horizontal-form popup_container">
                                    {include_tpl('../../change_pass_popup')}
                                </div>
                                {form_csrf}
                            </form>
                        </div>
                    </div>

                    <div id="third">
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
                                        <td>
                                            <a rel="nofollow" target="_blank" href="{shop_url('cart/view/' . $order->getKey())}" data-rel="tooltip" data-title="Подробный просмотр заказа">{echo $order->getId()}</a>
                                        </td>
                                        <td>
                                            {date('d', $order->getDateCreated())} {$month[date('n', $order->getDateCreated())]} {date('Y', $order->getDateCreated())}
                                        </td>
                                        <td>
                                            <span class="green">{echo $order->getTotalPrice()} {$CS}</span>
                                        </td>
                                        <td>                            
                                            {echo SOrders::getStatusName('Id',$order->getStatus())}
                                        </td>
                                        <td>                            
                                            {if $order->getPaid() == true}
                                                Оплачен
                                            {else: }
                                                Не оплачен
                                            {/if}
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>

                    <div id="fourth">
                        <div class="spy_popup_container">
                            {include_tpl('product_spy_popup')}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>