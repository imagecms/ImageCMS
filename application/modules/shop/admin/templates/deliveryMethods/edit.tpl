<div class="saPageHeader">
    <h2>Редактирование Способа Доставки</h2>
</div>

<form method="post" action="{$ADMIN_URL}/deliverymethods/edit/{echo $model->getId()}"  style="width:100%">

    <div class="form_text">{echo $model->getLabel('Name')}:</div>
    <div class="form_input">
        <input type="text" name="Name" value="{echo ShopCore::encode($model->getName())}" class="textbox_long" /> <span class="required">*</span> 
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('Description')}:</div>
    <div class="form_input">
        <textarea class="mceEditor" name="Description" >{echo ShopCore::encode($model->getDescription())}</textarea>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('Price')}:</div>
    <div class="form_input">
        <input type="text" name="Price" value="{echo ShopCore::encode($model->getPrice())}" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('FreeFrom')}:</div>
    <div class="form_input">
        <input type="text" name="FreeFrom" value="{echo ShopCore::encode($model->getFreeFrom())}" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"></div>
    <div class="form_input">
        <label><input type="checkbox" name="Enabled" value="1" {if $model->getEnabled() == true} checked="checked" {/if} /> {echo $model->getLabel('Enabled')}</label>
    </div>
    <div class="form_overflow"></div>

    <div class="footer_panel" align="right"> 
       <input type="submit" id="footerButton" name="_add" value="Сохранить" class="active" onClick="ajaxShopForm(this);" />
       <input type="submit" id="footerButton" name="_create" value="Сохранить и создать новую запись"  onClick="ajaxShopForm(this);" />
       <input type="submit" id="footerButton" name="_edit" value="Сохранить и редактировать"  onClick="ajaxShopForm(this);" />
    </div>

{form_csrf()}
</form>

{literal}
<script type="text/javascript">
    load_editor();
</script>
{/literal}
