<div class="frame-crumbs">
    <div class="container">
        {myCrumbs(0, " / ", "Просмотр заказа")}
    </div>
</div>
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

        <div class="left-order">
            <div class="m-b_15">
                Дата заказа {date('d.m.Y, H:i:s.',$model->getDateCreated())} 
                {if (int)$model->getComulativ() > 0}
                    <br/>Скидка: <span class="text-discount">-{echo $model->getComulativ()}%</span>
                {/if}
                {if $model->getGiftCertKey() != null}
                    <br/>Сертификат: <span class="text-discount">-{echo $model->getgiftCertPrice()} {$CS}</span>
                    {$total -= (float)$model->getgiftCertPrice()}
                {/if}
                {if (int)$model->getDeliveryPrice() > 0}
                    <br/>Стоимость доставки: <span class="green">{echo round_price($model->getDeliveryPrice())} {$CS}</span>
                    {$total = $total + $model->getDeliveryPrice()}
                {/if}
                {$total = round_price($total)}
                <br/>Итого: <span class="green f-w_b">{$total} {$CS}</span>
            </div>
            <div class="title_h3">Параметры заказа</div>
            <table class="table-info-order">
                <tr>
                    <th>Статус заказа</th>
                    <td><span class="status-order">{echo SOrders::getStatusName('Id',$model->getStatus())}</span></td>
                </tr>
                <tr>
                    <th>Статус оплаты</th>
                    <td><span class="status-order">{if $model->getPaid() == true}Оплачен{else:}Неоплачен{/if}</span></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Способ доставки</th>
                    <td>
                        {if $model->getDeliveryMethod() > 0}
                            {echo $model->getSDeliveryMethods()->getName()}
                        {/if}
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
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
            </table>
        </div>
        <div class="right-order">
            <div class="frame-your-order">
                <div class="title_h3">Ваш заказ</div>
                {foreach $model->getSOrderProductss() as $orderProduct}
                   
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
<!--                Kits-->
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
                <div class="m-b_15 t-a_r">
                    <div class="f-s_18 f-w_b">К оплате: <span class="price-order">
                            <span>{echo $model->getTotalPrice()} <span class="cur">{$CS}</span></span><br/>
                            {if round_price($model->getDeliveryPrice())!= null}+ Доставка:<span>{echo round_price($model->getDeliveryPrice())}<span class="cur"> {$CS}</span></span>{/if}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>