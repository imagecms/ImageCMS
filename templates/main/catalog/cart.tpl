<h1>Корзина</h1>

{if $order_completed}
    Спасибо. Ваш заказ оформлен.
    {return}
{/if}

{if !$items}
    Корзина пуста.
    {return}
{/if}

<table width="100%" cellpadding="0" cellspacing="5" border="0">
    <tr style="background-color:#DEDEDE;">
        <td width="30%"><b>Имя</b></td>
        <td><b>Стоимость</b></td>
        <td></td>
    </tr>
    
    {foreach $items as $item}
    {$page = get_page($item.id)}
    <tr>
        <td><a href="{site_url($page.full_url)}">{$item.name}</a></td>
        <td>{$item.price}$</td>
        <td align="right">
            <a href="{site_url('simple_cart/delete/' . $item.id )}">Удалить</a>
        </td>
    </tr>
    {/foreach}
</table>

<div align="right">
    <b>Всего: {cart_total_price()}$</b>
</div>

<p style="padding-top:25px;">
    <h3>Оформить заказ:</h3>
   
    {if validation_errors()}
        <div class="errors"> 
            {validation_errors()}
        </div>
    {/if}

    <form action="{site_url('simple_cart/order')}" method="post">

    <p>
        <label for="name">Ваше Имя</label>
        <input type="text" value="{set_value('name')}" class="text" name="name">
    </p>

    <p>
        <label for="email">E-Mail</label>
        <input type="text" value="{set_value('email')}" class="text" name="email">
    </p>

    <p>
        <label for="contacts">Адрес доставки</label>
        <textarea cols="45" rows="10" name="contacts">{set_value('contacts')}</textarea>
    </p>

    <p>
        <label>&nbsp;</label>
        <span class="help_text">Все поля обязятельны к заполнению.</span>
    </p>

    <p class="submit"><label>&nbsp;</label><input type="submit" value="{lang('lang_submit')}" /></p>

    {form_csrf()}
    </form>
</p>
