<!-- Create new product form -->
<form method="post" action="{$ADMIN_URL}products/edit/{echo $model->getId()}"  enctype="multipart/form-data" style="width:100%" id="image_upload_form">

<input type="hidden" name="redirect" value="{echo ShopCore::$_GET['redirect']}"/>

<div class="saPageHeader" style="width: 100%; ">
    <h2>Редактирование Товара: {echo ShopCore::encode($model->getName())}</h2>
</div>

    <div class="form_text"> </div>
    <div class="form_input variantsTableContainer">
        <table cellpadding="4">
            <thead>
                <th width="17px;"> </th>
                <th>{echo ShopCore::encode($model->getLabel('Name'))} <span class="required">*</span></th>
                <th>{echo ShopCore::encode($model->getLabel('Price'))} <span class="required">*</span></th>
                <th>{echo ShopCore::encode($model->getLabel('Number'))}</th>
                <th>{echo ShopCore::encode($model->getLabel('Stock'))}</th>
                <th></th>
            </thead>
            <tbody >
            <tr>
                <td></td>
                <td><input type="text" name="Name" value="{echo ShopCore::encode($model->getName())}" class="textbox_long" /></td>
                <td><input type="text" name="Price" value="{echo ShopCore::encode($model->getPrice())}" class="textbox_short" /></td>
                <td><input type="text" name="Number" value="{echo ShopCore::encode($model->getNumber())}" class="textbox_short" /></td>
                <td><input type="text" name="Stock" value="{echo ShopCore::encode($model->getStock())}" class="textbox_short" /></td>
                <td>
                    <img src="{$THEME}/images/plus2.png" style="cursor:pointer;" title="Добавить вариант" onclick="cloneVariant();"/>
                </td>
            </tr>
            </tbody>

            <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>


        <table cellpadding="4" id="variantsTable">
            <tbody id="variantsBlock">
            {if $model->countProductVariants() > 0}
                {$i=0}
                {foreach $model->getProductVariants() as $v}
            <tr id="ProductVariantRow_{$i}">
                <td><img src="{$SHOP_THEME}images/drag_arrow.png" class="drager" /></td>
                <td><input type="text" name="variants[Name][]" value="{echo $v->getName()}" class="textbox_long" /></td>
                <td><input type="text" name="variants[Price][]" value="{echo $v->getPrice()}" class="textbox_short" /></td>
                <td><input type="text" name="variants[Number][]" value="{echo $v->getNumber()}" class="textbox_short" /></td>
                <td><input type="text" name="variants[Stock][]" value="{echo $v->getStock()}" class="textbox_short" /></td>
                <td><img src="{$THEME}/images/minus.png" class="deleter" onClick="$('ProductVariantRow_{$i}').dispose();" style="cursor:pointer;" title="Удалить вариант"/></td>
            </tr>
                {$i++}
                {/foreach}
            {/if}

            </tbody>

            <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>

    </div>
    <div class="form_overflow"></div>

    <div class="form_text"> </div>
    <div class="form_input">
        <label><input type="checkbox" name="Active" value="1" {if $model->getActive() == true}checked="checked"{/if} /> {echo $model->getLabel('Active')}</label>
        <label><input type="checkbox" name="Hit"  value="1"  {if $model->getHit() == true}checked="checked"{/if} /> {echo $model->getLabel('Hit')}</label>
    </div>
    <div class="form_overflow"></div>

<!-- Left block with brand and categories list -->
<div style="float:left;clear:left;width:480px;">
    <div class="form_text">{echo $model->getLabel('Brand')}</div>
    <div class="form_input">
        <select name="BrandId" style="width:285px;">
            <option value="">Не указан</option>
            {foreach SBrandsQuery::create()->orderByName()->find() as $brand}
                <option {if $model->getBrandId() == $brand->getId()} selected="selcted" {/if} value="{echo $brand->getId()}">{echo ShopCore::encode($brand->getName())}</option>
            {/foreach}
        </select>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('CategoryId')}:</div>
    <div class="form_input">
        <select name="CategoryId" style="width:285px;" onChange="shopLoadProperiesByCategory(this, {echo $model->getId()});">
            {foreach $categories as $category}
                <option  {if $model->getCategoryId() == $category->getId()}selected="selected"{/if} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
            {/foreach}
        </select>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('Categories')}:</div>
    <div class="form_input">
        <select name="Categories[]" multiple="multiple" style="width:285px;height:129px;">
            {foreach $categories as $category}
                {$selected=""}
                {if in_array($category->getId(), $productCategories) && $category->getId() != $model->getCategoryId()}
                    {$selected="selected='selected'"}
                {/if}

                <option {$selected} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
            {/foreach}
        </select>
    </div>
    <div class="form_overflow"></div>
</div>

<!-- Right block with main images -->
<div class="rightBlockWithImages">

    <div style="width:400px;">
        <div class="imageBoxStripe" style="">
            <table border="0" cellspacing="0" cellpadding="0" height="90px" width="90px">
                <tr>
                    <td>

                        {if $model->getMainImage() == true}
                        <a href="/uploads/shop/{echo $model->getId()}_main.jpg?{rand(1,9999)}" class="boxed" rel="{literal}{handler:'image'}{/literal}">
                            <img src="/uploads/shop/{echo $model->getId()}_main.jpg?{rand(1,9999)}" style="cursor:pointer;" width="90px" />
                        </a>
                        {/if}
                    </td>
                </tr>
            </table>
        </div>
        
       <span style="font-weight:bold;padding-left:5px;">Основное изображение</span><br/>
       <div style="height:16px;width:125px;float:left;text-align: center; overflow: hidden;" class="button_silver_130">
       <div style="color:#fff;" id="mainImageName">Выбрать файл</div>
       <input type="file" onchange="$('mainImageName').set('html',document.getElementById('mainPhoto').value);" id="mainPhoto" name="mainPhoto" size="1" />
       </div> 

        <input type="text" name="" value="http://" class="textbox_long" style="margin-left:5px;margin-top:5px;" />  
        <div style="margin-left:10px;margin-top:5px;">
            <label><input type="checkbox" checked="checked" value="1" name="autoCreateSmallImage" /> Создать маленькое изображение</label>
        </div>
    </div>

    <div style="clear:both;height:11px;"></div>

    <div style="width:400px;">
       <div class="imageBoxStripe">
            <table border="0" cellspacing="0" cellpadding="0" height="90px" width="90px">
                <tr>
                    <td>
                        {if $model->getMainImage() == true} 
                        <a href="/uploads/shop/{echo $model->getId()}_small.jpg?{rand(1,9999)}" class="boxed" rel="{literal}{handler:'image'}{/literal}">
                            <img src="/uploads/shop/{echo $model->getId()}_small.jpg?{rand(1,9999)}" style="cursor:pointer;" width="90px" onClick="preview_shop_image('{echo $model->getId()}_small.jpg');" />
                            </a>
                        {/if} 
                    </td>
                </tr>
            </table> 
       </div>
   
       <span style="font-weight:bold;padding-left:5px;">Маленькое изображение</span><br/>
       <div style="height:16px;width:125px;float:left;text-align: center; overflow: hidden;" class="button_silver_130">
       <div style="color:#fff;" id="smallImageName">Выбрать файл</div>
       <input type="file" name="smallPhoto" onchange="$('smallImageName').set('html',document.getElementById('smallPhoto').value);" size="1" id="smallPhoto"/>
       </div>

        <input type="text" name="" value="http://" class="textbox_long" style="margin-left:5px;margin-top:5px;" /> 

    </div>

</div>

    <div style="clear:both;"> </div>
 
    <div class="form_text">{echo $model->getLabel('ShortDescription')}:</div>
    <div class="form_input">
        <textarea class="mceEditor" name="ShortDescription" >{echo $model->getShortDescription()}</textarea>
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('FullDescription')}:</div>
    <div class="form_input">
        <textarea class="mceEditor" name="FullDescription" >{echo $model->getFullDescription()}</textarea>
    </div>
    <div class="form_overflow"></div>

    <div id="productPropertiesContainer">
    {if ($firstCategory = array_shift($categories)) instanceof SCategory}
        {echo ShopCore::app()->SPropertiesRenderer->renderAdmin($firstCategory->getId(), $model)}
    {/if}
    </div>

   <div class="form_text">{echo $model->getLabel('Url')}:</div>
    <div class="form_input">
        <input type="text" name="Url" value="{echo $model->getUrl()}" class="textbox_long" /> 
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('RelatedProducts')}:</div>
    <div class="form_input">
        <input type="text" name="RelatedProducts" value="{echo $model->getRelatedProducts()}" class="textbox_long" /> 
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('MetaTitle')}:</div>
    <div class="form_input">
        <input type="text" name="MetaTitle" value="{echo $model->getMetaTitle()}" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('MetaDescription')}:</div>
    <div class="form_input">
        <input type="text" name="MetaDescription" value="{echo $model->getMetaDescription()}" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>

    <div class="form_text">{echo $model->getLabel('MetaKeywords')}:</div>
    <div class="form_input">
        <input type="text" name="MetaKeywords" value="{echo $model->getMetaKeywords()}" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>

<div class="footer_panel" align="right"> 
   <input type="submit" id="footerButton" name="_add" value="Сохранить" class="active"   />
   <input type="submit" id="footerButton" name="_create" value="Сохранить и создать новую запись"  />
   <input type="submit" id="footerButton" name="_edit" value="Сохранить и редактировать"   />
</div>

{form_csrf()}
<iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0px solid #fff;display:none;"></iframe>
</form>

<div style="display:none;">
    <tr id="productVariant">
        <td><img src="{$SHOP_THEME}images/drag_arrow.png" class="drager" /></td>
        <td><input type="text" name="variants[Name][]" value="" class="textbox_long" /></td>
        <td><input type="text" name="variants[Price][]" value="" class="textbox_short" /></td>
        <td><input type="text" name="variants[Number][]" value="" class="textbox_short" /></td>
        <td><input type="text" name="variants[Stock][]" value="" class="textbox_short" /></td>
        <td><img src="{$THEME}/images/minus.png" class="deleter" style="cursor:pointer;" title="Удалить вариант"/></td>
    </tr>
</div>

{literal}
<script type="text/javascript">

    window.addEvent('domready', function() {
        document.getElementById('image_upload_form').onsubmit = function() 
        {
            document.getElementById('image_upload_form').target = 'upload_target';
            document.getElementById("upload_target").onload = uploadCallback; 
        }
 
	   	SqueezeBox.assign($$('a.boxed'), {
		    parse: 'rel'
	    }); 
 
        load_table_sorter();
    });

    load_editor();

    function load_table_sorter()
    {
        var sorter = new Sortables('#variantsTable tbody',{
            handle: 'img.drager',
            onStart: function(el) { 
                el.setStyle('background','#add8e6');
            },
            onComplete: function(el) {
                el.setStyle('background','#EBEBEB');
            },
        });

        sorter.removeItems($('mainVariant'));
    }


    var newVariantId = 0;

    /**
     * Insert new variant row in variants table
     */
    function cloneVariant(fullClone)
    {
        var newVariant = $('productVariant').clone();

        newVariantId = newVariantId + 1;
        var fullId ='productVariantRow_' + newVariantId; 
    
        newVariant.set('id', fullId);
        newVariant.inject('variantsBlock','bottom');

        var result = $$('#' + fullId + ' img.deleter');
        result.addEvent('click', function() {
            $(fullId).dispose();
        }); 

        // Reload Sortable
        load_table_sorter();
    }


    // Callback function
    function uploadCallback()
    {
        var imgIFrame = document.getElementById('upload_target');  
        var data = imgIFrame.contentWindow.document.body.innerHTML;    
        var result_arr = JSON.decode(data); 
        
        if (result_arr.error)
        {
            showMessage('Ошибка', nl2br(result_arr.error));
        }
        if (result_arr.ok)
        {
            showMessage('Сообщение:', 'Изменения сохранены');
            ajaxShop(result_arr.redirect_url);
        }
    }
</script>
{/literal}
