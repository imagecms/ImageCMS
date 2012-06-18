<div class="main_body">
    <div class="content">
        <div class="center">
            <h1>Личный кабинет</h1>
            <div class="personal_info f_l">
                <div class="block_title_18"><span class="title_18">Мои данные</span></div>
                <ul>
                    <li>
                        <span>Ваше имя:</span>
                        <b>{echo encode($profile->getName())}</b>
                    </li>
                    <li>
                        <span>Электронный адрес:</span>
                        <b>{echo encode($user.email)}</b>
                    </li>
                    <li>
                        <span>Телефон:</span>
                        <b>{echo encode($profile->getPhone())}</b>
                    </li>
                    <li>
                        <span>Адрес для доставки:</span>
                        <b>{echo encode($profile->getAddress())}</b>
                    </li>
                </ul>
<!--                <a href="#" class="f_l w-s_n-w" id="change_info">Изменить личные данные</a>-->
                <a href="{shop_url('/cart')}" class="f_r w-s_n-w">Перейти в корзину</a>
                <div class="clear"></div>
                <a href="#" class="f_l w-s_n-w" id="change_password">Изменить пароль </a>
                <a href="{shop_url('wish_list')}" class="f_r w-s_n-w" style="width: 136px;">Посмотреть Wish List </a>
                
                <form action="{shop_url('profile')}" method="post" name="editFormpass">
                    <div style="clear: left;width: 50%;display: none;" id="change_password_fields">
                        <div class="fancy fancy_profile">
                            Старый пароль:
                            <input type="password" class="input" name="old_password">
                            <div class="clear"></div>
                            Новый пароль:
                            <input type="password" class="input" name="password">
                            <div class="clear"></div>
                            Подтверждение нового пароля:
                            <input type="password" class="input" name="confirm_new_password">
                            <div class="clear"></div>

                            <div id="buttons" style="padding:0px;width: 100%; float: left;">
                                <div class="p-t_19 c_b clearfix">
                                    <div class="buttons button_middle_blue f_r">
                                        <input type="hidden" value="1" name="cangePassword" />
                                        <a href="#" id="checkout" onClick="document.editFormpass.submit();">{echo ShopCore::t('Сохранить')}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {form_csrf()}
                    </div>
                </form>
                   
                        <form action="{shop_url('profile')}" method="post" name="editForm">
                             <div style="clear: left;width: 50%;" id="change_info_edit">
                                  <div class="fancy fancy_profile" style="width: 193px;">
                                       <h3>Изменить личные данные</h3>
                            Имя, фамилия:
                            <input type="text" class="input" value="{echo encode($profile->getName())}" name="name"/>
                            <div class="clear"></div>
                            Email:
                            <input type="text" value="{echo encode($user.email)}" name="email"/>
                            <div class="clear"></div>
                            Адрес доставки:
                            <input type="text" value="{echo encode($profile->getAddress())}" name="address"/>
                            <div class="clear"></div>
                            Телефон:
                            <input type="text" value="{echo encode($profile->getPhone())}" name="phone"/>
                           
                            <div class="clear"></div>
                            </div>
                         
                            <div id="buttons" style="padding:0px;width: 100%; float: left;">
                                 <div class="p-t_19 c_b clearfix"  style="width: 191px;">
                                <div class="buttons button_middle_blue f_r">
                                    
                            <input type="hidden" value="1" name="changeName"/>
                            <input type="submit" id="checkout"  value="Сохранить"/>
                             </div></div>
                          
                             </div>
                            </div>
                             {form_csrf()}
                            </div>
                    </form>

            <div class="history_order f_r">
                <div class="block_title_18"><span class="title_18">История заказов</span></div>

                В корзине:
                <span style="font-weight: bold;">
                    {echo ShopCore::app()->SCart->totalItems()}
                    {echo SStringHelper::Pluralize(ShopCore::app()->SCart->totalItems(), array('товар','товара','товаров'))}
                </span>
                <table cellspacing="0">
                    <colgroup>
                        <col span="1" width="79">
                        <col span="1" width="88">
                        <col span="1" width="70">
                        <col span="1" width="119">
                        <col span="1" width="119">
                        <col span="1" width="89">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Оплата</th>
                            <th>Статус</th>
                            <th>Созданный</th>
                            <th>Обновлено</th>
                            <th>Сумма</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {foreach $orders as $order}
                            <td><a rel="nofollow" href="{shop_url('cart/view/' . $order->getKey())}">{echo $order->getId()}</a></td>
                            <td>{if $order->getPaid()} Да {else:} Нет {/if}</td>
                            <td>{echo SOrders::getStatusName('Id', $order->getStatus())}</td>
                            <td>{date("d-m-Y H:i", $order->getDateCreated())}</td>
                            <td>{date("d-m-Y H:i", $order->getDateUpdated())}</td>
                            <td>{echo ShopCore::app()->SCurrencyHelper->convert($order->getTotalPrice())} {$CS}</td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="center">
            {$this->registerMeta('<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">')}
            <div  class="msg_form_edit">
                {if $errors}
                <div class="msg_form_edit_prof">
                    {echo $errors}
                </div>
                {/if}</div>
        </div>
    </div></div>



{literal}
<script>
    $("#change_password").click(function () {
        $("#change_password_fields").slideToggle("slow");
    });

    $("#change_info").click(function () {
        $("#change_info_edit").slideToggle("slow");
    });
</script>
{/literal}


