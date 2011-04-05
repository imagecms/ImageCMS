{include_tpl('profile_menu')}

<div class="products_list">

    {if $saved}
        <div style="background-color:#f5f5dc;">
            Изменения сохранены.
        </div>
        <br/>
    {/if}

<form action="{shop_url('profile/edit')}" method="post" name="editForm">
        <div class="fieldName">Имя, фамилия:</div>
        <div class="field">
            <input type="text" class="input" name="name" value="{echo encode($profile->getName())}">
        </div>
        <div class="clear"></div>

        <div class="fieldName">Email:</div>
        <div class="field">
            {echo encode($user.email)}            
        </div>
        <div class="clear"></div>

        <div class="fieldName">Телефон:</div>
        <div class="field">
            <input type="text" class="input" name="phone" value="{echo encode($profile->getPhone())}">
        </div>
        <div class="clear"></div>

        <div class="fieldName">Адрес доставки:</div>
        <div class="field">
            <input type="text" class="input" name="address" value="{echo encode($profile->getAddress())}">
        </div>
        <div class="clear"></div>

        <div id="buttons" style="padding:0px;">
            <a href="#" id="checkout" onClick="document.editForm.submit();">{echo ShopCore::t('Сохранить')}</a>
        </div>
        {form_csrf()}
</form>
</div>
