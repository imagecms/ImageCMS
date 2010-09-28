<div class="saPageHeader">
    <h2>Редактирование категории ID: {$modelArray.Id}</h2>
</div>

<form method="post" action="{$ADMIN_URL}categories/edit/{$modelArray.Id}"  style="width:100%">

    <div class="form_text">{echo $model->getLabel('Name')}:</div>
    <div class="form_input">
        <input type="text" name="Name" value="{echo ShopCore::encode($modelArray.Name)}" class="textbox_long" /> <span class="required">*</span>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('Url')}:</div>
    <div class="form_input">
        <input type="text" name="Url" value="{$modelArray.Url}" class="textbox_long" /> 
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('ParentId')}:</div>
    <div class="form_input">
        <select name="ParentId" value="">
            <option value="0">Нет</option>
            {foreach $categories as $category}
                <option 
                {if $category->getId()==$modelArray.Id}
                    disabled="disabled"
                {/if}
                {if $category->getId()==$modelArray.ParentId}
                    selected="selected"
                {/if}
                value="{echo $category->getId()}"> {str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
            {/foreach}
        </select>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('Description')}:</div>
    <div class="form_input">
        <textarea class="mceEditor" name="Description" >{htmlspecialchars($modelArray.Description)}</textarea>
    </div>
    <div class="form_overflow"></div>
    <div class="form_text">{echo $model->getLabel('MetaDesc')}:</div>
    <div class="form_input">
        <input type="text" name="MetaDesc" value="{$modelArray.MetaDesc}" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('MetaTitle')}:</div>
    <div class="form_input">
        <input type="text" name="MetaTitle" value="{$modelArray.MetaTitle}" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>
{form_csrf()}

<div class="footer_panel" align="right"> 
   <input type="submit" id="footerButton" name="_add" value="Сохранить" class="active"  onclick="ajaxShopForm(this);" />
   <input type="submit" id="footerButton" name="_create" value="Сохранить и создать новую запись" onclick="ajaxShopForm(this);" />
   <input type="submit" id="footerButton" name="_edit" value="Сохранить и редактировать"  onclick="ajaxShopForm(this);" />
</div>

</form>

<script type="text/javascript">
    load_editor();
</script>
