<div class="frame-crumbs">
    {widget('path')}
</div>
<div class="frame-inside">
    <div class="container">
        <div class="left-catalog-first">
            <div class="f-s_0 title-category">
                <div class="frame-title">
                    <h1 class="d_i">{echo $category->getName()}</h1>
                </div>
            </div>

            {if $category->hasSubCats()}
                {foreach $category->getChildsByParentIdI18n($category->getId()) as $key => $value}
                    {$products = \SProductsQuery::create()->addSelectModifier('SQL_CALC_FOUND_ROWS')->filterByCategoryId($value->getId())->filterByActive(true)->joinWithI18n('ru')->joinProductVariant()->withColumn('IF(sum(shop_product_variants.stock) > 0, 1, 0)', 'allstock')->groupById()->joinBrand()->distinct()->orderBy('allstock', \Criteria::DESC)->find();}
                    {$propertiesCat = ShopCore::app()->SPropertiesRenderer->renderCategoryPropertiesArrayNew($value->getId());}
                    {if count($products)}
                        <table cellpadding="0" cellspacing="0" border="0" class="products_table" style="margin-bottom: 50px">
                            <caption style="margin-bottom: 30px"><h4><b>{echo $value->getName()}</b></h4></caption>
                            <tr>
                                <th class="name">Наименование</th>
                                    {foreach $propertiesCat as $propId => $property}
                                    <td>
                                        <b>{echo $property}</b>
                                    </td>
                                {/foreach}

                                <th class="price">Цена</th>
                                <th>Купить</th>
                            </tr>
                            {foreach $products as $product}
                                <tr>
                                    <td class="name"><a href="{shop_url('product/'.$product->getUrl())}">{echo ShopCore::encode($product->getName())}</a></td>
                                        {$props = ShopCore::app()->SPropertiesRenderer->renderPropertiesNewArray($product->getId())}
                                        {foreach $propertiesCat as $propId => $property}
                                            {if $props[$propId]}
                                            <td>
                                                {echo $props[$propId]}
                                            </td>
                                        {else:}
                                            <td></td>
                                        {/if}
                                    {/foreach}

                                    <td class="price">{echo $product->firstVariant->toCurrency()} {$CS}</td>
                                    <td class="but">
                                        {$variants = $product->getProductVariants()}
                                        <!-- Start. Collect information about Variants, for future processing -->
                                        {foreach $variants as $key => $pv}
                                            {if $pv->getStock() > 0}
                                                <button {if $key != 0}style="display:none"{/if}
                                                                      class="button small buy btnBuy variant_{echo $pv->getId()}"
                                                                      type="button"

                                                                      data-id="{echo $pv->getId()}"
                                                                      data-prodid="{echo $product->getId()}"
                                                                      data-varid="{echo $pv->getId()}"
                                                                      data-price="{echo $pv->toCurrency()}"
                                                                      data-name="{echo ShopCore::encode($product->getName())}"
                                                                      data-vname="{echo ShopCore::encode($pv->getName())}"
                                                                      data-maxcount="{echo $pv->getstock()}"
                                                                      data-number="{echo $pv->getNumber()}"
                                                                      data-mediumImage="{echo $pv->getMediumPhoto()}"
                                                                      data-img="{echo $pv->getSmallPhoto()}"
                                                                      data-url="{echo shop_url('product/'.$product->getUrl())}"
                                                                      data-price="{echo $pv->toCurrency()}"
                                                                      data-number="{echo $pv->getNumber()}"
                                                                      data-origPrice="{if $product->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                                                      data-stock="{echo $pv->getStock()}"
                                                                      >
                                                    {lang('Купить')}
                                                </button>
                                            {else:}
                                                <button {if $key != 0}style="display:none"{/if}
                                                                      data-drop=".drop-report"

                                                                      data-id="{echo $pv->getId()}"
                                                                      data-prodid="{echo $product->getId()}"
                                                                      data-varid="{echo $pv->getId()}"
                                                                      data-price="{echo $pv->toCurrency()}"
                                                                      data-name="{echo ShopCore::encode($product->getName())}"
                                                                      data-vname="{echo ShopCore::encode($pv->getName())}"
                                                                      data-maxcount="{echo $pv->getstock()}"
                                                                      data-number="{echo $pv->getNumber()}"
                                                                      data-mediumImage="{echo $pv->getMediumPhoto()}"
                                                                      data-img="{echo $pv->getSmallPhoto()}"
                                                                      data-url="{echo shop_url('product/'.$product->getUrl())}"
                                                                      data-price="{echo $pv->toCurrency()}"
                                                                      data-number="{echo $pv->getNumber()}"
                                                                      data-origPrice="{if $product->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                                                      data-stock="{echo $pv->getStock()}"

                                                                      type="button"
                                                                      class="button small buy btnBuy variant_{echo $pv->getId()}">

                                                    {lang('Сообщить о появлении')}
                                                </button>
                                            {/if}
                                        {/foreach}
                                    </td>
                                </tr>
                            {/foreach}
                        </table>
                    {/if}
                {/foreach}
            {/if}
        </div>
    </div>
</div>


