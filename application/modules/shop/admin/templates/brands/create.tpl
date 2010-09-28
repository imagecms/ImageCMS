<!-- Create brand form -->
<div class="saPageHeader">
    <h2>Создание Бренда</h2>
</div>

<form method="post" action="{$ADMIN_URL}brands/create"  style="width:100%">

    <div class="form_text">{echo $model->getLabel('Name')}:</div>
    <div class="form_input">
        <input type="text" name="Name" value="" class="textbox_long" /> <span class="required">*</span> 
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('Url')}:</div>
    <div class="form_input">
        <input type="text" name="Url" value="" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('Description')}:</div>
    <div class="form_input">
        <textarea name="Description" value="" class="mceEditor" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('MetaTitle')}:</div>
    <div class="form_input">
        <input type="text" name="MetaTitle" value="" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('MetaDescription')}:</div>
    <div class="form_input">
        <input type="text" name="MetaDescription" value="" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('MetaKeywords')}:</div>
    <div class="form_input">
        <input type="text" name="MetaKeywords" value="" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>

<div class="footer_panel" align="right"> 
   <input type="submit" id="footerButton" name="_add" value="Сохранить" class="active" onClick="ajaxShopForm(this);" />
   <input type="submit" id="footerButton" name="_create" value="Сохранить и создать новую запись"  onClick="ajaxShopForm(this);" />
   <input type="submit" id="footerButton" name="_edit" value="Сохранить и редактировать"  onClick="ajaxShopForm(this);" />
</div>

{form_csrf()}
</form>

<script type="text/javascript">
    load_editor();
</script>
