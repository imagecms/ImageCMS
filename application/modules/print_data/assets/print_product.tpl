<html>
    <head>
        <title>Print {echo $product->getname()}</title>
        <link rel="stylesheet" type="text/css" href="{echo $style}">
    </head>
    <body>
        <div class="main_content">
            <div class="clearfix">
                <h2>{echo $product->getname()}{if $variant->getname()} - {echo $variant->getname()}{/if}</h2>
                <div class="desc"> 
                    <div class="f_r image">
                        <img src="{echo $product->firstvariant->getMediumPhoto()}" /><br/>
                    </div>
                    {if $product->getbrand()}<strong>{lang('Brand', 'print_data')}:</strong> {echo $product->getbrand()->getname()}<br/>{/if}
                    <strong>{lang('Category', 'print_data')}:</strong> {echo $product->getmaincategory()->getname()}<br/>
                    <strong>{lang('Price', 'print_data')}:</strong> {echo $variant->getPrice()} {$CS}<br/>
                    <strong>{lang('Quantity', 'print_data')}:</strong> {echo $variant->getStock()}<br/>
                    <strong>{lang('Characteristics', 'print_data')}:</strong><br />
                    {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesTableNew($product->getId())}
                    <strong>{lang('Description', 'print_data')}:</strong><br />
                    {if $desc = trim($product->getfulldescription())}
                        {echo $desc}
                    {else:}
                        {echo $product->getshortdescription()}
                    {/if}
                </div>
            </div>
        </div>
    </body>
</html>




