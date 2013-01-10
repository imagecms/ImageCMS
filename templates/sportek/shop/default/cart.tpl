<div class=" p_bot">
    <h1 class="big_marg">Оформление заказа</h1>

    {if !$items}
    {echo ShopCore::t('Корзина пуста')}
    {else:}
    <div class="goods_left big_marg">
        <h2>Каталог товаров</h2>
        <ul class="bottom_border">

            {$totalAmount = 0}
            {foreach $items as $key=>$item}
            {if $item.instance == 'SProducts'}
            <li class="product_thumb">
                <div class="image2">
                    <a href="{shop_url('product/' . $item.model->getUrl())}">
                        {if $item.variants->Mainimage}
                        <img src="{productImageUrl($item.variants->Smallimage)}" width="96" />
                        {else:}
                        <img src="{productImageUrl($item.model->getSmallImage())}" width="96" />
                        {/if}
                    </a>
                </div>
                <div class="description2">
                    <a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.variantName)}</a>
                    <div>
                        <b>Количество:</b> <span>{$item.quantity}</span>
                    </div>
                    <div>
                        {$totalAmount += $item.price}
                        <b>{echo ShopCore::app()->SCurrencyHelper->convert($item.price)}</b>
                        <span>{$CS}</span>
                    </div>
                </div>
            </li>
            {else:}
            <li class="product_thumb" style="border: 1px solid #FFAB2E;border-radius: 5px; margin-bottom: 5px; padding-bottom: 5px;">
                <div class="image2">
                    <a href="{shop_url('product/' . $item.model->getSProducts()->getUrl())}">
                        <img src="{productImageUrl($item.model->getSProducts()->getSmallImage())}" width="96" />
                    </a>
                </div>
                <div class="description2">
                    <a href="{shop_url('product/' . $item.model->getSProducts()->getUrl())}">
                        {echo ShopCore::encode($item.model->getSProducts()->name)}</a>                    
                    <div>
                        <b>{echo ShopCore::app()->SCurrencyHelper->convert($item.model->getSProducts()->getFirstVariant()->price)}</b>
                        <span>{$CS}</span>
                    </div>
                </div>
                <div class="clear andPlus"></div>
                {foreach $item.model->getShopKitProducts() as $element}
                    <div class="image2">
                        <a href="{shop_url('product/' . $element->getSProducts()->getUrl())}">
                            <img src="{productImageUrl($element->getSProducts()->getSmallImage())}" width="96" />
                        </a>
                    </div>
                    <div class="description2">
                        <a href="{shop_url('product/' . $element->getSProducts()->getUrl())}">
                            {echo ShopCore::encode($element->getSProducts()->name)}</a>
                        <div style="text-decoration: line-through; color: grey;">
                            <b style="color: grey;">{echo ShopCore::app()->SCurrencyHelper->convert($element->getSProducts()->getFirstVariant()->price)}</b>
                            <span>{$CS}</span>
                        </div>
                        <div>
                            {$priceWithDiscount = $element->getSProducts()->getFirstVariant()->price - ($element->getSProducts()->getFirstVariant()->price * $element->discount / 100)}
                            <b>{echo ShopCore::app()->SCurrencyHelper->convert($priceWithDiscount)}</b>
                            <span>{$CS}</span>
                        </div>
                        <div><b>Количество:</b> <span>{$item.quantity}</span></div>
                    </div>
                <div style="margin-top: 10px; clear: both;text-align: right; font-size: 14px;">
                    {$totalAmount += ($item.model->getSProducts()->getFirstVariant()->price + $priceWithDiscount) * $item.quantity }
                    <b>{echo ShopCore::app()->SCurrencyHelper->convert(($item.model->getSProducts()->getFirstVariant()->price + $priceWithDiscount) * $item.quantity)}</b> {$CS}
                </div>
                {/foreach}
            </li>                        
            {/if}
            {/foreach}
        </ul>
        <div class="block_price cartSummary"><span class="textSummary">Итог: </span>
            <span class="price_product">{echo ShopCore::app()->SCurrencyHelper->convert($totalAmount)}</span>
            <span class="grn">{$CS}</span>
        </div>
        <div class="change">
            <span class="callFB">Редактировать</span>
        </div>
    </div>


    <div class="good_desc">
        <div class="nomar-top tabs">
            {if $_SESSION['DX_user_id'] == null}
            <ul class="tabNavigation">
                <li><a href="outwell2.html#first"  class="selected">Новый покупатель</a></li>
                <li><a href="outwell2.html#second">Я уже зарегистрирован</a></li>
            </ul>
            {/if}
            <div id="first" class="form_inside {if $_SESSION['DX_user_id'] != null}marTopPlus{/if}">
                <form action="{shop_url('cart')}" method="post" name="orderForm" class="block new_user orderForm" id="order_info_form">
                    <div>
                        <dl>
                            <dt>Имя:<span>*</span></dt>
                            <dd>
                                <input type="text" class="b_width required" name="userInfo[fullName]" value="{$profile.name}" />
                                <em class="b_width">Укажите свое имя либо имя человека, который будет получать заказ</em>
                            </dd>
                        </dl>
                        <dl>
                            <dt>Контактный телефон:<span>*</span></dt>
                            <dd>
                                <input type="text" class="m_width required" name="userInfo[phone]" value="{$profile.phone}" />
                                <em class="m_width">Например:  (067) 123-45-67</em>
                            </dd>
                        </dl>
                        <!--                        <dl>
                                                    <dd class="notdt">
                                                        <select class="s_width">
                                                            <option>мобильный</option>
                                                            <option>не мобильный =)</option>
                                                        </select>
                                                    </dd>-->
                        </dl>
                    </div>
                    <div class="ie_bug">
                        <dl>
                            <dt>E-Mail:</dt>
                            <dd>
                                <input type="text" class="b_width required email" name="userInfo[email]" value="{$profile.email}" />
                                <em class="b_width">Для отслеживания состояния заказа</em>
                            </dd>
                        </dl>
                        <dl>
                            <dd class="notdt">
                                <label><input type="checkbox"/>Я хочу получать рaссылку о новинках магазина</label>
                            </dd>
                        </dl>
                    </div>
                    <hr/>
                    <span>Адрес доставки</span>
                    <div>
                        <dl class="both">
                            <dt>Город:</dt>
                            <dd>
                                <input type="text" class="b_width" name="userInfo[city]" value="{$profile.city}" />
                            </dd>
                        </dl>

                        <dl class="both">
                            <dt>Улица:</dt>
                            <dd>
                                <input type="text" class="b_width" name="userInfo[deliverTo]" value="{$profile.address}" />
                            </dd>
                        </dl>
                        <div>
                            <dl class="both">
                                <dt>Номер дома:</dt>
                                <dd>
                                    <input type="text" class="s_width" name="userInfo[housenum]" value="{$profile.houseNum}" />
                                </dd>
                            </dl>
                            <dl class="right">
                                <dt>Квартира:</dt>
                                <dd>
                                    <input type="text" class="s_width" name="userInfo[flatnum]"  value="{$profile.flatNum}"/>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div>
                        <dl class="small_padd">
                            <dt>Дополнительная информация:</dt>
                            <dd>
                                <textarea name="adress_add_info"></textarea>
                                <em>Район, метро, лифт, этаж, домофон...</em>
                            </dd>
                        </dl>
                    </div>
                    <hr/>
                    <div class="small_padd">
                        <dl>
                            <dt>Способ доставки: <a href="{site_url('delivery')}" class="js">детали</a></dt>
                            <dd id="deliveryMethods">
                                <select class="b_width" name="deliveryMethodId">
                                    {foreach $deliveryMethods as $deliveryMethod}
                                    <option value="{echo $deliveryMethod->getId()}">{echo $deliveryMethod->getName()}</option>
                                    {/foreach}
                                </select>
                            </dd>
                        </dl>
                        <dl>
                            <dt>Способ оплаты: <a href="{site_url('payment')}" class="js">детали</a></dt>
                            <dd id="paymentMethods">
                                <select class="b_width" name="paymentMethodId">
                                    {foreach $paymentMethods as $paymentMethod}
                                    <option value="{echo $paymentMethod->getId()}">{echo $paymentMethod->getName()}</option>
                                    {/foreach}
                                </select>
                            </dd>
                        </dl>
                    </div>
                    <hr/>
                    <div class="small_padd b_width">
                        <dl>
                            <dt>Комментарии к заказу:</dt>
                            <dd>
                                <textarea name="userInfo[commentText]"></textarea>
                                <em>Здесь Вы можете указать свои пожелания относительно обработки Вашего заказа, способа доставки, оплаты или другие замечания. Максимальное количество символов - 2000.</em>
                            </dd>
                        </dl>
                    </div>
                    <input type="hidden" name="makeOrder" value="1" />
                    <input type="submit" class="b_o" value="Сделать заказ" />
                    {form_csrf()}
                </form>
            </div>
            <div id="second" class="not_tblock order_login big_marg">
                <form action="{site_url('auth')}" method="post" class="new_user commentForm callback_form" id="loginFormOrder">
                    <dl>
                        <dt>Имя пользователя<span>*</span></dt>
                        <dd><input type="text" name="username" class="required" value="" /></dd>
                    </dl>
                    <dl>
                        <dt>Пароль<span>*</span></dt>
                        <dd><input type="password" name="password" class="required" value="" /></dd>
                    </dl>
                    <dl>
                        <dt class="userError"></dt>
                    </dl>

                    <div class="button"><input type="submit" value="Войти" /></div>
                    {form_csrf()}
                </form>
                <div class="auth_links">
                    <a href="{site_url($modules.auth . '/forgot_password')}">{lang('lang_forgot_password')}</a>
                    &nbsp;
                    <a href="{site_url($modules.auth . '/register')}">{lang('lang_register')}</a>
                </div>
            </div>
        </div>
    </div>
    {/if}
</div>