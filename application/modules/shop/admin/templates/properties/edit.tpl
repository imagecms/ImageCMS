<div class="saPageHeader" style="width:100%;">
    <h2>Редактирование свойства: {echo ShopCore::encode($model->getName())}</h2>
</div>


<form method="post" action="{$ADMIN_URL}properties/edit/{echo $model->getId()}"  style="width:100%">

    <div class="form_text">{echo $model->getLabel('Name')}:</div>
    <div class="form_input">
        <input type="text" name="Name" value="{echo ShopCore::encode($model->getName())}" class="textbox_long" /> <span class="required">*</span> 
    </div>
    <div class="form_overflow"></div>


    <div class="form_text"> </div>
    <div class="form_input">
        <label><input type="checkbox" {if $model->getActive() == true}checked="checked"{/if} value="1" name="Active" />{echo $model->getLabel('Active')}</label>
        <br/>
        <label><input type="checkbox" {if $model->getShowInCompare() == true}checked="checked"{/if} value="1" name="ShowInCompare" />{echo $model->getLabel('ShowInCompare')}</label>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('UseInCategories')}:</div>
    <div class="form_input">
        <select name="UseInCategories[]" multiple="multiple" style="width:285px;height:150px;">
            {foreach $categories as $category}
                {$selected=""}
                {if in_array($category->getId(), $propertyCategories)}
                    {$selected="selected='selected'"}
                {/if}

                <option {$selected} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
            {/foreach}
        </select>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('Data')}:</div>
    <div class="form_input">
        <textarea name="Data" >{echo ShopCore::encode($model->asText())}</textarea>
    </div>
    <div class="form_overflow"></div>

    <div class="footer_panel" align="right"> 
       <input type="submit" id="footerButton" name="_add" value="Сохранить" class="active" onClick="ajaxShopForm(this);" />
       <input type="submit" id="footerButton" name="_create" value="Сохранить и создать новую запись"  onClick="ajaxShopForm(this);" />
       <input type="submit" id="footerButton" name="_edit" value="Сохранить и редактировать"  onClick="ajaxShopForm(this);" />
    </div>

{form_csrf()}
</form>
