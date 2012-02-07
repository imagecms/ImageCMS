{$this->registerMeta('<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">')}

<div style="float: left; width: 50%;margin: 20px 0 0 20px;">
{if $errors}
    <div style="background-color:#f5f5dc;">
        {echo $errors}
    </div>
    <br/>
{/if}
<div style="font-size: 25px;margin-bottom: 20px;">Личный кабинет:</div>
<form action="{shop_url('profile')}" method="post" name="editForm">
        
        <div style="float: left; width: 50%;">
            <div style="font-size: 12px;padding-top:3px;font-weight: bold;">Имя, фамилия:</div>
            <div style="font-size: 14px;">
                <input type="text" class="input" name="name" value="{echo encode($profile->getName())}">
            </div>
            <div class="clear"></div> 
            
            <div style="font-size: 12px;padding-top:3px;font-weight: bold;">Email:</div>
            <div style="font-size: 14px;">
                <input type="text" class="input" name="email" value="{echo encode($user.email)}">            
            </div>
            <div class="clear"></div>

        </div>
    
        <div style="float: left; width: 50%;">
            <div style="font-size: 12px;padding-top:3px;font-weight: bold;">Адрес доставки:</div>
            <div style="font-size: 14px;">
                <input type="text" class="input" name="address" value="{echo encode($profile->getAddress())}">
            </div>
            <div class="clear"></div>
            
            <div style="font-size: 12px;padding-top:3px;font-weight: bold;">Телефон:</div>
            <div style="font-size: 14px;">
                <input type="text" class="input" name="phone" value="{echo encode($profile->getPhone())}">
            </div>
            <div class="clear"></div>
        </div>
    
        <div style="float: left; width: 100%;">
            <a href="#" class="items" id="change_password">Сменить пароль</a>
        </div>
    
        <div style="float: left; width: 50%;display: none;" id="change_password_fields">
            <div style="font-size: 12px;padding-top:3px;font-weight: bold;">Старый пароль:</div>
            <div style="font-size: 14px;">
                <input type="password" class="input" name="old_password">
            </div>
            <div class="clear"></div>

            <div style="font-size: 12px;padding-top:3px;font-weight: bold;">Новый пароль:</div>
            <div style="font-size: 14px;">
                <input type="password" class="input" name="password">
            </div>
            <div class="clear"></div>

            <div style="font-size: 12px;padding-top:3px;font-weight: bold;">Подтверждение нового пароля:</div>
            <div style="font-size: 14px;">
                <input type="password" class="input" name="confirm_new_password">
            </div>
            <div class="clear"></div>
        </div>    
        {form_csrf()}
</form>
</div>

<div style="float: left; width: 100%;margin: 20px 0 0 20px;">    
    <div style="font-size: 25px;margin-bottom: 20px;">Информация по клиенту:</div>
    
    <div style="float:left;padding-top:3px; width: 350px;">Выполнено 
    <span style="font-weight: bold;">{$totalDone}</span> {echo SStringHelper::Pluralize($totalDone, array('заказ','заказа','заказов'))} на сумму: 
    <span style="font-weight: bold;">
        {$totalDonePrice} {$CS}    
    </span></div>
        <div style="padding: 3px 0 3px 25px;float:left;"><a href="#orders_history_list" id="orders_history">История заказов &#8595;</a></div>
    <div class="clear"></div>

    <div style="float:left;padding-top:3px;width: 350px;">В корзине:
    <span style="font-weight: bold;">
            {echo ShopCore::app()->SCart->totalItems()}
            {echo SStringHelper::Pluralize(ShopCore::app()->SCart->totalItems(), array('товар','товара','товаров'))}
    </span></div>
    <div style="padding: 3px 0 3px 25px;float:left;"><a href="{shop_url('cart')}" rel="nofollow" class="items">Просмотреть</a></div>
    <div class="clear"></div>
    
    <div style="float:left;padding-top:3px;width: 350px;">В списке желаний:
    <span style="font-weight: bold;">
            {echo ShopCore::app()->SWishList->totalItems()}
            {echo SStringHelper::Pluralize(ShopCore::app()->SWishList->totalItems(), array('товар','товара','товаров'))}
    </span></div>
    <div style="padding: 3px 0 3px 25px;float:left;"><a href="{shop_url('wish_list')}" class="items">Просмотреть</a></div>
    <div class="clear"></div>
</div>

<div style="display: none;float: left; width: 100%;margin: 20px 0 0 20px;" id="orders_history_list">
    <table width="100%">
        <thead>
            <tr>
                <td style="width:15px;">ID</td>
                <td>Статус</td>
                <td>Оплачен</td>
                <td>Создан</td>
                <td>Обновлен</td>
                <td>Сумма заказа</td>
                <td></td>
            </tr>
        </thead>

        {foreach $orders as $order}
        <tr style="font-size:13px;">
            <td style="width:50px;">{echo $order->getId()}</td>
            <td>{echo SOrders::getStatusName('Id', $order->getStatus())}</td>
            <td>{if $order->getPaid()} Да {else:} Нет {/if}</td>
            <td>{date("d-m-Y H:i", $order->getDateCreated())}</td>
            <td>{date("d-m-Y H:i", $order->getDateUpdated())}</td>
            <td>{echo ShopCore::app()->SCurrencyHelper->convert($order->getTotalPrice())} {$CS}</td>
            <td><a rel="nofollow" href="{shop_url('cart/view/' . $order->getKey())}">Просмотреть</a></td>
        </tr>
        {/foreach}
    </table>
</div>

<div id="buttons" style="padding:0px;width: 100%; float: left;">
    <a href="#" id="checkout" onClick="document.editForm.submit();">{echo ShopCore::t('Сохранить')}</a>
</div>

<div style="float: left; width: 100%;">
    <a href="/auth/logout">Выход</a>
</div>

{literal}
<script>
$("#orders_history").click(function () {
    $("#orders_history_list").toggle("slow");
}); 

$("#change_password").click(function () {
    $("#change_password_fields").toggle("slow");
});
</script>
{/literal}