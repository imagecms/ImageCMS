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
{$NextCSIdCond = $NextCS != null}
<div class="frame-inside page-order">
    <div class="container">
        {if $CI->session->flashdata('makeOrder') === true}
            <div class="f-s_0 title-order-view without-crumbs">
                <div class="frame-title">
                    <h1 class="d_i c_9">{lang('Спасибо, Ваш заказ принят.','newLevel')}</h1>
                </div>
            </div>
            <!-- Clear Cart locale Storage -->
            <script>{literal}$(document).on('scriptDefer', function() {
                    Shop.Cart.clear();
                }){/literal}
            </script>
        {else:}
            <div class="f-s_0 title-order-view without-crumbs">
                <div class="frame-title">
                    <h1 class="d_i">{lang('Заказ №','newLevel')}:<span class="number-order">{echo $model->getId()}</span></h1>
                </div>
            </div>
        {/if}

        {$total = $model->getTotalPrice()}
        <!-- Start. Displays a information block about Order -->
        <div class="left-order">
            <div class="title-h3">{lang('Параметры заказа','newLevel')}</div>
            <table class="table-info-order">
                <tr>
                    <th>{lang('Дата заказа','newLevel')}:</th>
                    <td>{date('d.m.Y, H:i:s.',$model->getDateCreated())} </td>
                </tr>
                <!-- Start. Render certificate -->
                {$giftCond = $model->getGiftCertKey() != null}
                {if $giftCond}
                    {$giftPrice = (float)$model->getGiftCertPrice()}
                    {$total -= $giftPrice}
                {else:}
                    {$giftPrice = 0}
                {/if}
                <!-- End. Render certificate -->

                <!-- Start. Delivery Method price -->
                {if (int)$model->getDeliveryPrice() > 0}
                    {$total = $total + $model->getDeliveryPrice()}
                {/if}
                <!-- End. Delivery Method price -->

                <tr>
                    <th>{lang('К оплате','newLevel')}:</th>
                    <td>
                        <span class="frame-prices f-s_0">
                            <span class="current-prices f-s_0">
                                <span class="price-new">
                                    <span>
                                        <span class="price">{echo $model->getTotalPrice()}</span>
                                        <span class="curr">{$CS}</span>
                                    </span>
                                </span>
                            </span>
                        </span>
                    </td>
                </tr>

                <!-- Start. Render payment button and payment description -->
                <tr>
                    <th>{lang('Способ оплаты','newLevel')}:</th>
                    <td>
                        {if $model->getPaid() != true && $model->getTotalPriceWithGift() > 0}
                            {if $paymentMethod->getDescription()}
                                {echo ShopCore::t($paymentMethod->getDescription())}
                            {/if}
                        {/if}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="frame-payment">
                            {$locale = \MY_Controller::getCurrentLocale();}
                            {$notif = $CI->db->where('locale', $locale)->where('name','callback')->get('answer_notifications')->row();}
                            {echo $notif->message}
                            {echo $paymentMethod->getPaymentForm($model)}
                        </div>
                    </td>
                </tr>
                <!-- End. Render payment button and payment description -->

                <!--                Start. Order status-->
                <tr>
                    <th>{lang('Статус заказа','newLevel')}:</th>
                    <td><span class="status-order">{echo SOrders::getStatusName('Id',$model->getStatus())}</span></td>
                </tr>
                <!--                End. Order status-->
                <!--                    Start. Paid or not-->
                <tr>
                    <th>{lang('Оплачен','newLevel')}:</th>
                    <td><span class="status-pay">{if $model->getPaid() == true}{lang('Да','newLevel')}{else:}{lang('Нет','newLevel')}{/if}</span></td>
                </tr>
                <!--                    End. Paid or not-->

                <!-- Start. Delivery Method name -->
                <tr>
                    <th>{lang('Способ доставки','newLevel')}:</th>
                    <td>
                        {if $model->getDeliveryMethod() > 0}
                            {echo $model->getSDeliveryMethods()->getName()}
                        {/if}
                    </td>
                </tr>
                <!-- End. Delivery Method name -->

            </table>
            <div class="title-h3">{lang('Данные клиентов','newLevel')}</div>
            <!--                Start. User info block-->
            <table class="table-info-order">
                <tr>
                    <th>{lang('Ваше имя','newLevel')}:</th>
                    <td>{echo $model->getUserFullName()}</td>
                </tr>
                {if $model->getUserPhone()}
                    <tr>
                        <th>{lang('Телефон','newLevel')}:</th>
                        <td>{echo $model->getUserPhone()}</td>
                    </tr>
                {/if}
                <tr>
                    <th>E-mail:</th>
                    <td>{echo $model->getUserEmail()}</td>
                </tr>
                {$s_field = ShopCore::app()->CustomFieldsHelper->getOneCustomFieldsByNameArray('city','order', $model->getId())}{echo $s_field.field_data}
                {if $s_field}
                    <tr>
                        <th>{lang('Город','newLevel')}:</th>
                        <td>{echo $s_field}</td>
                    </tr>
                {/if}
                {if $model->getUserDeliverTo()}
                    <tr>
                        <th>{lang('Адрес','newLevel')}:</th>
                        <td>{echo $model->getUserDeliverTo()}</td>
                    </tr>
                {/if}
                {if $model->getUserComment()}
                    <tr>
                        <th>{lang('Комментарий к заказу','newLevel')}:</th>
                        <td>{echo $model->getUserComment()}</td>
                    </tr>
                {/if}

                {$fields = ShopCore::app()->CustomFieldsHelper->getCustomFielsdAsArray('order',$profile.id,'user')}
                <!--                End. User info block-->
            </table>
        </div>
        <!-- End. Displays a information block about Order -->
        <div class="right-order">
            <div class="frame-bask frame-bask-order">
                <div class="frame-bask-scroll">
                    <div class="frame-bask-main">
                        <div class="inside-padd">
                            <table class="table-order">
                                <tbody>
                                    <!-- for single product -->
                                    {foreach $model->getOrderProducts() as $orderProduct}
                                        {foreach $orderProduct->getSProducts()->getProductVariants() as $v}
                                            {if $v->getid() == $orderProduct->variant_id}
                                                {$Variant = $v}
                                                {break;}
                                            {/if}
                                        {/foreach}




                                        <tr class="items items-bask items-order cartProduct">
                                            <td class="frame-items">
                                                <!-- Start. Render Ordered Products -->            
                                                <a href="{shop_url('product/'.$orderProduct->getSProducts()->getUrl())}" class="frame-photo-title">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        <img alt="{echo ShopCore::encode($orderProduct->product_name)}" src="{echo $Variant->getSmallPhoto()}">
                                                    </span>
                                                    <span class="title">{echo ShopCore::encode($orderProduct->product_name)}</span>
                                                </a>
                                                <div class="description">
                                                    <span class="frame-variant-name-code">
                                                    {if trim(ShopCore::encode($orderProduct->variant_name) != '')}<span class="frame-variant-name">{lang("Вариант",'newLevel')}: <span class="code">{echo ShopCore::encode($orderProduct->variant_name)}</span></span>{/if}
                                                {if trim(ShopCore::encode($orderProduct->variant_id) != '')}<span class="frame-variant-code">{lang("Артикул",'newLevel')}: <span class="code">{echo ShopCore::encode($orderProduct->variant_id)}</span></span>{/if}
                                            </span>
                                            <span class="frame-prices">
                                                <span class="current-prices f-s_0">
                                                    <span class="price-new">
                                                        <span>
                                                            <span class="price">{echo $orderProduct->getPrice()}</span>
                                                            <span class="curr">{$CS}</span>
                                                        </span>
                                                    </span>
                                                    {if $NextCSIdCond}
                                                        <span class="price-add">
                                                            <span>
                                                                <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($orderProduct->getPrice(), $NextCSId)}</span>
                                                                <span class="curr-add">{$NextCS}</span>
                                                            </span>
                                                        </span>
                                                    {/if}
                                                </span>
                                            </span>
                                            <div class="gen-sum-row">
                                                <span class="s-t">{lang('Количество','newLevel')}:</span>
                                                <span class="count">{echo $orderProduct->getQuantity()}</span>
                                                <span class="s-t">{lang('Сумма','newLevel')}:</span>
                                                <span class="frame-prices">
                                                    <span class="current-prices f-s_0">
                                                        <span class="price-new">
                                                            <span>
                                                                <span class="price">{echo $orderProduct->getPrice()*$orderProduct->getQuantity()}</span>
                                                                <span class="curr">{$CS}</span>
                                                            </span>
                                                        </span> 
                                                        {if $NextCSIdCond}    
                                                            <span class="price-add">
                                                                <span>
                                                                    <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($orderProduct->getPrice(), $NextCSId)*$orderProduct->getQuantity($NextCSId)}</span>
                                                                    <span class="curr-add">{$NextCS}</span>
                                                                </span>
                                                            </span>
                                                        {/if}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            {/foreach}
                            <!-- end for single product -->
                            <!-- Start. Render Ordered kit products  -->
                            {foreach $model->getOrderKits() as $orderProduct}
                                <tr class="row-kits items-order">
                                    <td class="frame-items frame-items-kit">
                                        <ul class="items items-bask">
                                            <li>
                                                <div class="frame-kit main-product">
                                                    <a href="{shop_url('product/' . $orderProduct->getKit()->getMainProduct()->getUrl())}" class="frame-photo-title">
                                                        <span class="photo-block">
                                                            <span class="helper"></span>
                                                            <img src="{echo $orderProduct->getKit()->getMainProduct()->firstVariant->getSmallPhoto()}" 
                                                                 alt="{echo ShopCore::encode($orderProduct->getKit()->getMainProduct()->getName())}"/>
                                                        </span>
                                                        <span class="title">{echo ShopCore::encode($orderProduct->getKit()->getMainProduct()->getName())}</span>
                                                    </a>
                                                    <div class="description">
                                                        <div class="frame-prices">
                                                            <span class="current-prices">
                                                                <span class="price-new">
                                                                    <span>
                                                                        <span class="price">{echo $orderProduct->getKit()->getMainProductPrice()}</span>
                                                                        <span class="curr">{$CS}</span>
                                                                    </span>
                                                                </span>
                                                                {if $NextCSIdCond}
                                                                    <span class="price-add">
                                                                        <span>
                                                                            <span class="price">{echo $orderProduct->getKit()->getMainProductPrice($NextCSId)}</span>
                                                                            <span class="curr">{$NextCS}</span>
                                                                        </span>
                                                                    </span>
                                                                {/if}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </li>
                                            {foreach $orderProduct->getKit()->getShopKitProducts() as $key => $kitProducts}
                                                <li>
                                                    <div class="next-kit">+</div>
                                                    <div class="frame-kit">
                                                        <a href="{shop_url('product/' . $kitProducts->getSProducts()->getUrl())}" class="frame-photo-title">
                                                            <span class="photo-block">
                                                                <span class="helper"></span>
                                                                <img src="{echo $kitProducts->getSProducts()->firstVariant->getSmallPhoto()}" 
                                                                     alt="{echo ShopCore::encode($kitProducts->getSProducts()->getName())}"/>
                                                            </span>
                                                            <span class="title">{echo ShopCore::encode($kitProducts->getSProducts()->getName())}</span>
                                                        </a>
                                                        <div class="description">
                                                            <div class="frame-prices">
                                                                {if $kitProducts->getDiscount()}
                                                                    <span class="price-discount">
                                                                        <span>
                                                                            <span class="price priceOrigVariant">{echo $kitProducts->getKitProductPrice()}</span>
                                                                            <span class="curr">{$CS}</span>
                                                                        </span>
                                                                    </span>
                                                                {/if}
                                                                <span class="current-prices">
                                                                    <span class="price-new">
                                                                        <span>
                                                                            <span class="price">{echo $kitProducts->getKitNewPrice()}</span>
                                                                            <span class="curr">{$CS}</span>
                                                                        </span>
                                                                    </span>
                                                                    {if $NextCSIdCond}    
                                                                        <span class="price-add">
                                                                            <span>
                                                                                <span class="price">{echo $kitProducts->getKitNewPrice($NextCSId)}</span>
                                                                                <span class="curr">{$NextCS}</span>
                                                                            </span>
                                                                        </span>
                                                                    {/if}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            {/foreach}
                                        </ul>
                                        <div class="gen-sum-row">
                                            <img src="{$THEME}images/kits_sum.png"/>
                                            <span class="s-t">{lang('Наборы','newLevel')}:</span>
                                            <span class="count">{echo $orderProduct->getQuantity()}</span>
                                            <span class="s-t">{lang('Сумма','newLevel')}:</span>
                                            <span class="frame-prices">
                                                <span class="price-discount">
                                                    <span>
                                                        <span class="price">{echo $orderProduct->getKit()->getTotalPriceOld()}</span>
                                                        <span class="curr">{$CS}</span>
                                                    </span>
                                                </span>
                                                <span class="current-prices f-s_0">
                                                    <span class="price-new">
                                                        <span>
                                                            <span class="price">{echo $orderProduct->getKit()->getTotalPrice()}</span>
                                                            <span class="curr">{$CS}</span>
                                                        </span>
                                                    </span>
                                                    {if $NextCSIdCond}
                                                        <span class="price-add">
                                                            <span>
                                                                <span class="price">{echo $orderProduct->getKit()->getTotalPrice($NextCSId)}</span>
                                                                <span class="curr-add">{$NextCS}</span>
                                                            </span>
                                                        </span>
                                                    {/if}
                                                </span>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            {/foreach}
                            <!-- End. Render Ordered kit products  -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="frame-foot">
            <div class="header-frame-foot">
                <div class="inside-padd">
                    <ul class="items items-order-gen-info">
                        <li>
                            <span class="s-t">{lang('Стоимость доставки','newLevel')}:</span>
                            <span class="price-item">
                                <span>
                                    <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($model->getDeliveryPrice())}</span>
                                    <span class="curr">{$CS}</span>
                                </span>
                            </span>
                        </li>
                        {$discount = ShopCore::app()->SCurrencyHelper->convert($model->getdiscount())}
                        {if $discount}
                            <li>
                                <span class="s-t">{lang('Ваша текущая скидка','newLevel')}:</span>
                                <span class="price-item">
                                    <span>
                                        <span class="text-discount current-discount">{echo $discount} <span class="curr">{$CS}</span></span>
                                    </span>
                            </li>
                        {/if}
                        {if $model->getGiftCertPrice() > 0}
                            <li>
                                <span class="s-t">{lang('Подарочный сертификат','newLevel')}:</span>
                                <span class="price-item">
                                    <span class="text-discount">
                                        <span class="price">- {echo ShopCore::app()->SCurrencyHelper->convert($model->getGiftCertPrice())} </span>
                                        <span class="curr">{$CS}</span>
                                    </span>
                                </span>
                            </li>
                        {/if}
                    </ul>
                    <!-- Start. Price block-->
                    <div class="gen-sum-order">
                        <span class="title">{lang('Всего к оплате','newLevel')}:</span>
                        <span class="frame-prices f-s_0">
                            {if $model->getOriginPrice()}
                                <span class="price-discount">
                                    <span>
                                        <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($model->getOriginPrice())}</span>
                                        <span class="curr">{$CS}</span>
                                    </span>
                                </span>
                            {/if}
                            <span class="current-prices f-s_0">
                                <span class="price-new">
                                    <span>
                                        {$price = $model->gettotalprice() + ShopCore::app()->SCurrencyHelper->convert($model->getDeliveryPrice())}
                                        <span class="price">{echo $price}</span>
                                        <span class="curr">{$CS}</span>
                                    </span>
                                </span>
                                {if $NextCSIdCond}     
                                    <span class="price-add">
                                        <span>
                                            (<span class="price" id="totalPriceAdd">{echo $model->gettotalprice($NextCSId) + ShopCore::app()->SCurrencyHelper->convert($model->getDeliveryPrice(),$NextCSId)}</span>
                                            <span class="curr-add">{$NextCS}</span>)
                                        </span>
                                    </span>
                                {/if}
                            </span>
                        </span>
                    </div>
                    <!-- End. Price block-->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>