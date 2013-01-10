{literal}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#uProfileInfo').validate({
                rules: {
                    name: {required: true},
                    address: {required: true},
                    userHouseNum: {required: true},
                    userFlatNum: {required: true},
                    email: {required: true,email: true},
                    phone: {required: true}}});

            $('#passwordChange').validate({
                rules: {
                    old_password: {required: true},
                    password: {minlength: 5,required: true},
                    confirm_new_password: {equalTo: "#password", required: true}}});
        });
    </script>
{/literal}
<div class="main_wrap p_bot">
    <h1>Личный кабинет:</h1>
    <form id="uProfileInfo" action="{shop_url('profile')}" method="post" name="editForm" class="new_user">
        <div class="profInfoLeft">
            <div class="box_title">Личные данные</div>
            <dl>
                <dt>Имя, фамилия:</dt>
                <dd>
                    <input type="text" name="name" value="{echo encode($profile->getName())}" />
                </dd>
            </dl>
            <dl>
                <dt>Email:</dt>
                <dd>
                    <input type="text" name="email" value="{echo encode($user.email)}" />
                </dd>
            </dl>
            <dl>
                <dt>Телефон:</dt>
                <dd>
                    <input type="text" name="phone" value="{echo encode($profile->getPhone())}" />
                </dd>
            </dl>
        </div>
        <div class="profInfoLeft">
            <div class="box_title">Адрес доставки</div>
            <dl>
                <dt>Город:</dt>
                <dd>
                    <input type="text" name="userCity" value="{echo encode($profile->getUserCity())}" />
                </dd>
            </dl>
            <dl>
                <dt>Улица:</dt>
                <dd>
                    <input type="text" name="address" value="{echo encode($profile->getAddress())}" />
                </dd>
            </dl>
            <dl>
                <dt>Номер дома:</dt>
                <dd>
                    <input class="shorBlock" type="text" name="userHouseNum" value="{echo encode($profile->getUserHousenum())}" />
                </dd>
            </dl>
            <dl>
                <dt>Квартира:</dt>
                <dd>
                    <input class="shorBlock" type="text" name="userFlatNum" value="{echo encode($profile->getUserFlatnum())}" />
                </dd>
            </dl>
        </div>
        {form_csrf()}
        <div class="pasChange">{$errors}</div>
        <input type="hidden" name="editInfo" value="true"/>
        <input type="submit" value="Сохранить" />
    </form>
    <form action="{shop_url('profile')}" method="post" name="passwordChange" id="passwordChange" class="passwordChange new_user">
        <div class="box_title">Сменить пароль</div>
        <dl>
            <dt>Старый пароль:</dt>
            <dd>
                <input type="password" name="old_password" />
            </dd>
        </dl>
        <dl>
            <dt>Новый пароль:</dt>
            <dd>
                <input type="password" name="password" id="password" />
            </dd>
        </dl>
        <dl>
            <dt>Подтверждение нового пароля:</dt>
            <dd>
                <input type="password" name="confirm_new_password" />
            </dd>
        </dl>
        {form_csrf()}
        <div class="pasChange">{$errorsPsw}</div>
        <input type="submit" value="Сменить пароль" />
        <input type="hidden" name="editPass" value="true"/>
    </form>
    <div class="clear"></div>

    {if $orders[0]}
        <div class="box_title">История заказов</div>
        <table class="orderHistory">
            <thead>
                <tr>
                    <td class="fringeLeft"></td>
                    <td>Номер</td>
                    <td>Оплата</td>
                    <td>Статус</td>
                    <td>Создан</td>
                    <td>Обновлен</td>
                    <td>Сумма заказа</td>
                    <td></td>
                    <td class="fringeRight"></td>
                </tr>
            </thead>
            <tbody>
                {foreach $orders as $order}
                    <tr>
                        <td class="fringeInside"></td>
                        <td>Заказ №{echo $order->getId()}</td>
                        <td>{if $order->getPaid()} Да {else:} Нет {/if}</td>
                        <td>{echo SOrders::getStatusName('Id', $order->getStatus())}</td>
                        <td>{date("d-m-Y H:i", $order->getDateCreated())}</td>
                        <td>{date("d-m-Y H:i", $order->getDateUpdated())}</td>
                        <td>{echo ShopCore::app()->SCurrencyHelper->convert($order->getTotalPrice())} {$CS}</td>
                        <td><a href="{shop_url('cart/view/' . $order->getKey())}">Просмотреть</a></td>
                        <td class="fringeInside"></td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {/if}
</div>