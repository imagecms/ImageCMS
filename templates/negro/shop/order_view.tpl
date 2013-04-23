{#
/**
* @file Template. Displaying order view page;
* @partof main.tpl;
* Variables
*   $model : (object) instance of SOrders;
*    $model->getId() : return Order ID;
*    $model->getPaid() : return Order paid status;
*    $model->getSDeliveryMethods()->getName() : get Delivery method name;
*    $model->getOrderProducts() : return Ordered products list;
*    $model->getOrderKits() : return Ordered Kits list;
*    $model->getTotalPrice() : get aggregate ordered Products Price;
*    $model->getDeliveryPrice() : return delivery Price;
*    $model->getTotalPriceWithDelivery() : sum of Product and Delivery Prices;
*    $model->getTotalPriceWithGift() : difference of previous price (getTotalPriceWithDelivery) and gift certificate price;
* @updated 27 January 2013;
*/
#}

<div class="frame-inside">
    <div class="container">
        {if $CI->session->flashdata('makeOrder') === true}
            <div class="title_h2">Спасибо за ваш заказ!</div>
            <!-- Clear Cart locale Storage -->
            <script>{literal}$(document).ready(function() {
                    Shop.Cart.clear();
                }){/literal}
            </script>
        {else:}
            <div class="title_h2">Заказ №<span class="arial">{echo $model->getId()}</span></div>
        {/if}

        {$total = $model->getTotalPrice()}
        <!-- Start. Displays a information block about Order -->
        <div class="left-order">
            <div class="m-b_15">
                Дата заказа {date('d.m.Y, H:i:s.',$model->getDateCreated())} 
                {if (int)$model->getComulativ() > 0}
                    <br/>Скидка: <span class="text-discount">-{echo $model->getComulativ()}%</span>
                {/if}
                 <!-- Start. Render certificate -->
                {if $model->getGiftCertKey() != null}
                    <br/>Сертификат: <span class="text-discount">-{echo $model->getgiftCertPrice()} {$CS}</span>
                    {$total -= (float)$model->getgiftCertPrice()}
                {/if}
                 <!-- End. Render certificate -->
                  <!-- Start. Delivery Method price -->
                {if (int)$model->getDeliveryPrice() > 0}
                    <br/>Стоимость доставки: <span class="green">{echo round($model->getDeliveryPrice())} {$CS}</span>
                    {$total = $total + $model->getDeliveryPrice()}
                {/if}
                <!-- End. Delivery Method price -->
                <br/>Итого: <span class="green f-w_b">{echo $total} {$CS}</span>
                <!-- Start. Render payment button and payment description -->
                <br/>Способ оплаты:
                {if $model->getPaid() != true && $model->getTotalPriceWithGift() > 0}
                    {echo $paymentMethod->getPaymentForm($model)}
                            {if $paymentMethod->getDescription()}
                                <div class="m-t_10 infoOrder" style="font-style: italic">{echo ShopCore::t($paymentMethod->getDescription())}</div>
                            {/if}
                {/if}
                <!-- End. Render payment button and payment description -->
            </div>
            
            <div class="title_h3">Параметры заказа</div>
            <table class="table-info-order">
<!--                Start. Order status-->
                <tr>
                    <th>Статус заказа</th>
                    <td><span class="status-order">{echo SOrders::getStatusName('Id',$model->getStatus())}</span></td>
                </tr>
<!--                End. Order status-->
<!--                    Start. Paid or not-->
                <tr>
                    <th>Статус оплаты</th>
                    <td><span class="status-order">{if $model->getPaid() == true}Оплачен{else:}Неоплачен{/if}</span></td>
                </tr>
<!--                    End. Paid or not-->
                <tr>
                    <th></th>
                    <td></td>
                </tr>
                 <!-- Start. Delivery Method name -->
                <tr>
                    <th>Способ доставки</th>
                    <td>
                        {if $model->getDeliveryMethod() > 0}
                            {echo $model->getSDeliveryMethods()->getName()}
                        {/if}
                    </td>
                </tr>
                 <!-- End. Delivery Method name -->
                <tr>
                    <th></th>
                    <td></td>
                </tr>
<!--                Start. User info block-->
                <tr>
                    <th>Ваше имя:</th>
                    <td>{echo $model->getUserFullName()}</td>
                </tr>
                <tr>
                    <th>Телефон:</th>
                    <td>{echo $model->getUserPhone()}</td>
                </tr>
                <tr>
                    <th>E-mail:</th>
                    <td>{echo $model->getUserEmail()}</td>
                </tr>
                {if $model->getUserDeliverTo()}
                    <tr>
                        <th>Адрес:</th>
                        <td>{echo $model->getUserDeliverTo()}</td>
                    </tr>
                {/if}
                {if $model->getUserComment()}
                    <tr>
                        <th>Комментарий к заказу</th>
                        <td>{echo $model->getUserComment()}</td>
                    </tr>
                {/if}
<!--                End. User info block-->
            </table>
        </div>
        <!-- End. Displays a information block about Order -->
        <div class="right-order">
            <div class="frame-your-order">
                <div class="title_h3">Ваш заказ</div>
                {foreach $model->getSOrderProductss() as $orderProduct}
         <!-- Start. Render Ordered Products -->            
                        <ul class="items-complect item-order">
                            <li>
                                <a href="{shop_url('product/'.$orderProduct->getSProducts()->getUrl())}">
                                    <span class="photo-block">
                                        <span class="helper"></span>
                                        <img alt="{echo ShopCore::encode($orderProduct->product_name)} {echo ShopCore::encode($orderProduct->variant_name)}" src="{productImageUrl($orderProduct->getSProducts()->getSmallModImage())}">
                                    </span>
                                    <span class="title">{echo ShopCore::encode($orderProduct->product_name)} {echo ShopCore::encode($orderProduct->variant_name)}</span>
                                </a>
                                <div class="description">
                                    <div class="price-complect d_i-b">
                                        <div>{echo $orderProduct->getPrice()} <span class="cur">{$CS}</span></div>
                                    </div>
                                    х {echo $orderProduct->getQuantity()} шт.
                                </div>
                            </li>
                        </ul>
                {/foreach}
            <!-- End. Render Ordered Products -->
        <!-- Start. Render Ordered kit products  -->
                {foreach $model->getOrderKits() as $orderProduct}                        
                                    <ul class="items-complect items-complect-order-view">
                                        <li>
                                            <a href="{shop_url('product/' . $orderProduct->getKit()->getMainProduct()->getUrl())}">
                                                <span class="photo-block">
                                                    <span class="helper"></span>
                                                        <img src="{productImageUrl($orderProduct->getKit()->getMainProduct()->getSmallModImage())}" 
                                                                         alt="{echo ShopCore::encode($orderProduct->getKit()->getMainProduct()->getName())}"/>
                                                    </span>
                                                <span class="title">{echo ShopCore::encode($orderProduct->getKit()->getMainProduct()->getName())}</span>
                                            </a>
                                            <div class="description">
                                                <div class="price-complect d_i-b">
                                                    <div>{echo $orderProduct->getKit()->getMainProduct()->getFirstVariant()->getPrice()} <span class="cur">{$CS}</span></div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Start. Display kits products -->
                                        {foreach $orderProduct->getKit()->getShopKitProducts() as $key => $kitProducts}
                                            <li>
                                                <a href="{shop_url('product/' . $kitProducts->getSProducts()->getUrl())}">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                            <img src="{productImageUrl($kitProducts->getSProducts()->getSmallModImage())}" 
                                                                             alt="{echo ShopCore::encode($kitProducts->getSProducts()->getName())}"/>
                                                    </span>
                                                    <span class="title">{echo ShopCore::encode($kitProducts->getSProducts()->getName())}</span>
                                                </a>
                                                <div class="description">
                                                    <div class="price-complect d_i-b">
                                                        <div>{echo $kitProducts->getDiscountProductPrice()}<span class="cur">{$CS}</span></div>
                                                    </div>
                                                </div>
                                            </li>
                                        {/foreach}
                                        <li style="width:100% !important;margin-left:0;">
                                            <div class="t-a_c">
                                                <img src="{$THEME}/images/sum_arrow.png"/>
                                            </div>
                                            <span class="v-a_bl">Комплект ({echo $orderProduct->getQuantity()}  шт):</span>
                                            <div class="v-a_bl d_i-b">
                                                <div class="price-complect f-s_21 d_i-b"><div>{echo $orderProduct->getKit()->getTotalPrice()}<span class="cur">{$CS}</span></div></div>
                                            </div>
                                        </li>
                                    </ul>
                {/foreach}
<!--                Start. Price block-->
                <div class="m-b_15 t-a_r">
                    <div class="f-s_18 f-w_b">К оплате: <span class="price-order">
                            <span>{echo $total}<span class="cur">{$CS}</span></span><br/>
                            {if round($model->getDeliveryPrice())!= null}Доставка:<span> {echo round($model->getDeliveryPrice())}<span class="cur"> {$CS}</span></span>{/if}
                        </span>
                    </div>
                </div>
<!--                End. Price block-->
            </div>
        </div>
    </div>
</div>