<div class="frame-inside">
    {if count($items) > 0}
        <form method="post" action="{shop_url('cart')}" id="makeOrderForm">
            <div class="container">
                <h1>Оформление заказа</h1>
                <div class="frame-cleaner-main left_order">
                </div>
                <div class="">
                    <div id="orderDetails">
                    </div>
                    <div class="clearfix horizontal-form">
                        <div class="box-ordering1">
                            <div class="title_h3">Данные получателя</div>
                            {if validation_errors()}
                                <div class="msg">
                                    <div class="error">
                                        {validation_errors()}
                                    </div>
                                </div>
                            {/if}
                            <div class="control-group">
                                <label class="control-label" for="order_name">Имя:</label>
                                <div class="controls">
                                    <span class="must">*</span>
                                    <input id="order_name" class="required" name="userInfo[fullName]" value="{$profile.name}" type="text" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="order_phone">Телефон:</label>
                                <div class="controls">
                                    <span class="must">*</span>
                                    <input id="order_phone" class="required" type="text" name="userInfo[phone]" value="{echo $profile.phone}" type="text"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="order_email">Email:</label>
                                <div class="controls">
                                    <span class="must">*</span>
                                    <input id="order_email" class="required email" name="userInfo[email]" value="{$profile.email}" type="text"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="order_city">Город:</label>
                                <div class="controls">
                                    <input id="order_city" name="userInfo[city]" value="{echo $profile.city}" type="text"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="order_address">Адрес:</label>
                                <div class="controls">
                                    <input id="order_address" name="userInfo[deliverTo]" value="{echo $profile.address}" type="text"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label">&nbsp;</div>
                                <div class="controls">
                                    <button class="d_l_b m-b_10" type="button" data-drop='[name="userInfo[commentText]"]' data-effect-on="slideDown" data-effect-off="slideUp" data-duration="300" data-place="inherit">Комментарии к заказу</button>
                                    <textarea name="userInfo[commentText]" class="d_n_"></textarea>
                                </div>
                            </div>
                                <!--        User custom fields      -->
                                {echo ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPattern($pattern)->getCustomFields('user')->asHtml()}
                                        <!--        Order custom fields      -->

                               {if $orderCustomFields = ShopCore::app()->CustomFieldsHelper->setRequiredHtml('<span class="must">*</span>')->setPattern($pattern)->getCustomFields('order')->asHtml()}
                                   <div class="groups_form">
                                       {$orderCustomFields}
                                   </div>
                               {/if}
                        </div>
                        <div class="box-ordering2">
                            <div class="control-group delivery_popup_container">
                                {include_tpl('cart_delivery_methods')}
                            </div>
                        </div>
                        <div class="box-ordering3">
                            {if count($paymentMethods)}
                                <div class="frame-label">
                                    <span class="title">Способ оплаты</span>
                                    <div class="frame-form-field">
                                        <div class="row-fluid">
                                            <div class="lineForm pmDiv">
                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {/if}
                        </div>
                    </div>
                </div>
                <hr/>
                <div>
                    <div class="clearfix frame-footer-order">
                    {if ShopCore::app()->SSettings->usegifts == 1} 
                        <div class="f_l footer-order">
                            <div class="cert_drop_container clearfix m-b_15"></div>
                            <div class="d_i-b v-a_m">
                                <div class="d_i-b v-a_b">
                                    <input type="text" name="giftcert" placeholder="Введите номер сертификата"/>
                                    <input type="hidden" value="0" name="checkCert">
                                </div>
                                <div class="btn-def2 v-a_b">
                                    <button type="button" id="applyGiftCert" class="c_3 giftCertCheck">ОК</button>
                                </div>
                            </div>
                        </div>
                    {/if}
                        <div class="f_r t-a_r">
                            <div class="totalWithDiscount d_n">
                                <div>Скидка: <span class="f-s_14"><span class="text-discount">0%</span></span></div>
                                <div>
                                    Сумма покупок: 
                                    <span class="old-price f-s_14">
                                        <span class="totalProductPrice">0</span> <span class="cur">{$CS}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="m-t_10">
                                <div>Стоимость доставки:
                                    <span class="price-order f-s_14">
                                        <span><span id="deliveryPrice">0</span></span>
                                    </span>
                                </div>
                                <span id="giftCertSpan" style="display:none;">Сертификат: 
                                    <span class="price-order f-s_14">
                                        <span><span id="giftCertPrice">0</span></span>
                                    </span>
                                </span>
                                <div class="f-s_18">Итого к оплате:
                                    <span class="price-order">
                                        <span><span id="fullPrice">0</span> <span class="cur">{$CS}</span></span>
                                    </span>
                                </div>
                            </div>
                            <div class="btn-order-product m-t_10">
                                <input type="submit" value="Оформить заказ"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="makeOrder" value="1" />
            {form_csrf()}
        </form>
        <div class="container d_n" id="no_products">
            <div class="title_h2">В корзине нет товаров</div>
        </div>
    {else:}
        <div class="container">
            <div class="title_h2">В корзине нет товаров</div>
        </div>
    {/if}
</div>


