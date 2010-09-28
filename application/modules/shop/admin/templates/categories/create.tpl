<div class="saPageHeader">
    <h2>Создание категории</h2>
</div>

<form method="post" action="{$ADMIN_URL}categories/create"  style="width:100%">

    <div class="form_text">{echo ShopCore::encode($model->getLabel('Name'))}:</div>
    <div class="form_input">
        <input type="text" name="Name" value="" class="textbox_long" /> <span class="required">*</span>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('Url')}:</div>
    <div class="form_input">
        <input type="text" name="Url" value="" class="textbox_long" /> 
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('ParentId')}:</div>
    <div class="form_input">
        <select name="ParentId" value="">
            <option value="0">Нет</option>
            {foreach $categories as $category}
                <option value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
            {/foreach}
        </select>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('Description')}:</div>
    <div class="form_input">
        <textarea class="mceEditor" name="Description" ></textarea>
    </div>
    <div class="form_overflow"></div>
    <div class="form_text">{echo $model->getLabel('MetaDesc')}:</div>
    <div class="form_input">
        <input type="text" name="MetaDesc" value="" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('MetaTitle')}:</div>
    <div class="form_input">
        <input type="text" name="MetaTitle" value="" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text"></div>
    <div class="form_input">
        <!-- <input type="submit" name="button" class="button_130" value="Создать" onclick="ajax_me(this.form);" /> -->
    </div>
    <div class="form_overflow"></div>    

{form_csrf()}

<div class="footer_panel" align="right"> 
   <input type="submit" id="footerButton" name="_add" value="Сохранить" class="active"  onclick="ajaxShopForm(this);" />
   <input type="submit" id="footerButton" name="_create" value="Сохранить и создать новую запись" onclick="ajaxShopForm(this);" />
   <input type="submit" id="footerButton" name="_edit" value="Сохранить и редактировать"  onclick="ajaxShopForm(this);" />
</div>

</form>

{literal}
<script type="text/javascript">
    load_editor();
</script>
{/literal}
