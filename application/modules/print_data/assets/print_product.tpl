{literal}
    <style type="text/css">
        .f_l{float: left}
        .clearfix:after{visibility: hidden;display: block;font-size: 0;content: ".";clear: both;height: 0;}    
    </style>
{/literal}
<div class="clearfix">
    <div class="f_l">
        <strong>Назва:</strong> {echo $product->getname()}{if $variant->getname()} - {echo $variant->getname()}{/if}<br/>
        <strong>Бренд:</strong> {if $product->getbrand()}{echo $product->getbrand()->getname()}{/if}<br/>
        <strong>Категория:</strong> {echo $product->getmaincategory()->getname()}<br/>
        <strong>Цена:</strong> {echo $variant->getPrice()} {$CS}<br/>
        <strong>Количество:</strong> {echo $variant->getStock()}<br/>
    </div>

    <div class="f_l">
        <img src="{productMainImageUrl($variant)}" /><br/>
    </div>

</div>
<hr/>
<strong>Характеристики:</strong>
{echo ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($product->getId())}
<hr/>
Описание:
{if $desc = trim($product->getfulldescription())}
    {echo $desc}
{else:}
    {echo $product->getshortdescription()}
{/if}




