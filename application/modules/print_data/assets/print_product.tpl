<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{echo $style}">
    </head>
    <body>
        <div class="main_content">
            <div class="clearfix">
                <div class="desc f_l">
                    <strong>Назва:</strong> {echo $product->getname()}{if $variant->getname()} - {echo $variant->getname()}{/if}<br/>
                    <strong>Бренд:</strong> {if $product->getbrand()}{echo $product->getbrand()->getname()}{/if}<br/>
                    <strong>Категория:</strong> {echo $product->getmaincategory()->getname()}<br/>
                    <strong>Цена:</strong> {echo $variant->getPrice()} {$CS}<br/>
                    <strong>Количество:</strong> {echo $variant->getStock()}<br/>
                    <strong>Характеристики:</strong><br />
                    {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($product->getId())}
                    <strong>Описание:</strong><br />
                    {if $desc = trim($product->getfulldescription())}
                        {echo $desc}
                    {else:}
                        {echo $product->getshortdescription()}
                    {/if}

                </div>

                <div class="f_r image">
                    <img src="{productMainImageUrl($variant)}" /><br/>
                </div>

            </div>






        </div>
    </body>
</html>




