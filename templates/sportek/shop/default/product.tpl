

{literal}
<script type="text/javascript">
    var currentProdId = {/literal}{echo $model->id}{literal};    
</script>
{/literal}
{$varId = $firstVariant->getId()}
<div xmlns:v="http://rdf.data-vocabulary.org/#" class="breadCrumbs crumbs">{renderCategoryPath($model->getMainCategory())}</div>
<div class="socall">

    <div class="vksave">
        {literal}
        <script type="text/javascript"><!--
            document.write(VK.Share.button({url: "http://www.sportek.net/"},{type: "round", text: "Зберегти"}));
            --></script>{/literal}
    </div>

    <div class="fbrec">
        <div id="fb-root"></div>
        {literal}
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        {/literal}
        <div class="fb-like" data-href="http://www.sportek.net/" data-send="false" data-layout="button_count" data-width="200" data-show-faces="true" data-action="recommend"></div>
    </div>

</div>

<div class="goods_left">
    <h2>Каталог товаров</h2>
    {$cat_brands = getCategoryBrands($model->getMainCategory()->getId(), 5)}
    {$tovar_cat = getCategoryProducts($model->getMainCategory()->getId(), 5) }
    {$count_prod = count(getCategoryProducts($model->getMainCategory()->getId()))}
    {$cat_name = getCategoryName($model->getMainCategory()->getId())}
    {$mcu = getMainCategoryUrl($model->getMainCategory()->getId())}
    {$cat_url = getCategoryUrl($model->getMainCategory()->getId())}
    {$mcu .= $cat_url }
    <ul>
        <span><span class="notjs">{echo $cat_name}</span> ({$count_prod})</span>
        {foreach $tovar_cat as $p}
        <li class="product_thumb">
            <div class="image2"><a href="{shop_url('product/' . $p->getUrl())}"><img src="{productImageUrl($p->getSmallImage())}" alt="{echo ShopCore::encode($p->getName())}" width="70"/></a></div>
            <div class="description2"><a {if $p->id == $model->id}class="currentProduct"{/if} href="{shop_url('product/' . $p->getUrl())}">{echo $p->getName()}</a><div><b>{echo $p->firstVariant->toCurrency()}</b> <span>{$CS}</span></div></div>
        </li>
        {/foreach}
        <li><a href="{shop_url('category/'.$mcu )}">Все товары {echo $cat_name}</a> →</li>
    </ul>
    <ul>
        {foreach $cat_brands as $brand}

        {if $model->getBrand()}
        {$cur_brand = $model->getBrand()->getId()}
        {/if}
        {if $cur_brand == $brand->getId()}



        <li><a href="{shop_url('brand/'.$brand->url)}">Все товары {echo $brand->getName()}</a> →</li>



        {/if}
        {/foreach}
    </ul>
</div>



{$triger = true}
{foreach $variants as $variant}
{if $variant->stock != 0 && $triger == true}
{$firstAwalVId = $variant}
{$triger = false}
{/if}
{/foreach}


<div class="good_desc">    


    <form action="{shop_url('cart/add')}" method="post" id='prodInf'>
        <div class="h2_frame">
            <h2 class="d_i">{echo ShopCore::encode($model->getName())}</h2>
            {foreach $model->getSProductPropertiesDatas() as $val}
            {if $val->propertyid == 37 && $val->value}
            &nbsp;&nbsp;(Модель: <span class="b">{echo $val->value}</span>)
            {/if}
            {/foreach}
            {$images = $model->getSProductImagess()}
        </div>
        <div class="l_descr_good">
            {if $model->hit}<div class="hit"></div>{/if}
            {if $model->action}<div class="act"></div>{/if}
            {if $model->hot}<div class="hotProduct"></div>{/if}
            {if $model->getMainImage()}{if count($images) > 0}<a href="{if count($variants) > 1}{productImageUrl($model->Id.'_vM'.$firstVariant->id.'.jpg')}{else:}{productImageUrl($images[0]->getImageName())}{/if}"  rel="thumbs" class="d_b">{/if}
                <img src="{if count($variants) > 1}{productImageUrl($model->Id.'_vS'.$firstVariant->id.'.jpg')}{else:}{productImageUrl($model->getMainImage())}{/if}" alt="{echo ShopCore::encode($model->getName())}" />
                {if count($images) > 0}</a>{/if}{/if}
            {if sizeof($model->getSProductImagess()) > 0}
            {$count == 0}
            {foreach $model->getSProductImagess() as $image}
            {if $count > 0}
            <a href="{productImageUrl($image->getImageName())}" class="thumbs" rel="thumbs"><img src="{productSmallImageUrl($image->getImageName())}" alt="{echo ShopCore::encode($model->getName())}" /></a>
            {/if}
            {$count++}
            {/foreach}
            {/if}
            
             <div class="f_l" style="margin-left: 36px">
                {include_tpl('rating')}
                
            </div>
            
            <div class="recommend_soc">
                <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
                <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,lj"></div>
            </div>
        </div>
        <div class="r_descr_good">
            <dl>
                {if $model->getBrand()}
                <dt>Производитель:</dt><dd>{echo $model->getBrand()->getName()}</dd>
                {/if}
                <dt>Количество:</dt><dd><input name="quantity" type="text" value="1"/></dd>
                {$firstVariant->stock}
                {if count($variants) > 1}
                {$var = $variants}						
                {if $var[0]->color == null}
                <dt class="prodVariats"><span class="b">Выберите тип:</span></dt>
                {else:}
                <dt class="prodVariats"><span class="b">Выберите цвет:</span></dt>
                {/if}
                <dd class="prodVariats">	
                    {$cn = 0}
                    {$triger = true}
                    {foreach $variants as $variant}

                    {if $variant->stock != 0 && $triger == true}
                    {$style = 'colorActive'}
                    {$triger = false}
                    {else:}
                    {$style = ''}
                    {/if}

                    {if $variant->color == null && $cn == 0}
                    <div class="varSelect">
                        <select id="variantId" name="variantId">
                            {$cn++}
                            {/if}
                            {if $variant->color}
                            <div class="colorPick {$style}">
                                <a class="{if $variant->stock > 0}color_vars{else:}disabl{/if}" id="color_var" data-varid="{echo $variant->id}" style="background-color: #{echo $variant->color}" href="#"></a>
                            </div>
                            {else:}					
                            <option data-pic="sdasd" {if $variant->stock == 0}disabled="disabled"{/if} value="{echo $variant->id}">{echo str_replace( $model->getName(), '',  $variant->name)} - {echo $variant->price} {$CS} </option>                    
                            {/if}				
                            {/foreach}
                            {if $cn > 0}
                        </select>
                    </div>
                    {/if}
                </dd>
                {/if}
            </dl>

            <div class="c_descr_good">
                {if (int)$model->old_price > (int)$model->firstVariant->price}
                <div>
                    <p class="old_price_span">{echo $model->old_price}</p>
                </div>
                {/if}
                <span id="price_aj" class="d_b {if $firstAwalVId->stock == 0}noItemGrey{/if}">
                    {if !$firstAwalVId}{echo $firstVariant->toCurrency()}{else:}{echo $firstAwalVId->toCurrency()}{/if}
                    <span>{$CS}</span>
                </span>
                {/*}{if $firstAwalVId->stock == 0 && $model->getSProductTypes()->product_type_id != 4}<div class="noItemDiv">Товар отсутствует</div>{/if}{*/}
                {if $firstAwalVId->stock == 0}<div class="noItemDiv">Товар отсутствует</div>{/if}

                {$stock = 0}
                {foreach $variants as $var}
                {$stock += $var->stock}
                {/foreach}

                {if $model->getSProductTypes()->product_type_name != 'со склада' and $model->getSProductTypes()->product_type_description}  
                    <div class="prodTypeDescWrap">
                        <div class="prodTypeDescHeader"></div>
                        <div class="prodTypeDescContainer">                         
                            {echo $model->getSProductTypes()->product_type_description}
                        </div>
                    </div>
                {/if}

                {/*}{if $stock > 0 || $model->getSProductTypes()->product_type_id == 4}{*/}

                {if $stock > 0}
                {if $in_cart === false}
                <a id="in_cart" href="#">Купить</a>
                {else:}
                <a id="in_cart" class="alreadyIn" href="{shop_url('cart')}">Уже в корзине</a>
                {/if}
                {else:}
                <a class="announceMe report" href="#report">Сообщить о появлении</a>
                {/if}

                {if $model->getSProductTypes()->product_type_name and $model->getSProductTypes()->product_type_name != 'со склада'}  

                    <div class="withProductType"><span>{echo $model->getSProductTypes()->product_type_name}</span></div>
                    

                </div>
                {/if}

               {if $stock > 0 } <div class="is_avail clear"><span class="is_avail_icon"></span>Есть в наличии</div> {/if}
                <!--            <a href="{site_url('garantii')}" class="js">Гарантии</a>-->
            </div>
        </div>

        {foreach $model->getKits() as $kit}        
        <div class="productKit">
            <div class="mainKitProduct">
                <div>
                    <div class="picfix">
                        <img src="{productImageUrl($model->getSmallImage())}" alt="{echo ShopCore::encode($model->getName())}" />
                    </div>
                </div>
                <span>{echo $model->name}</span>
                <div class="kitSetPrice">{echo $model->firstVariant->toCurrency()} {$CS}</div>
            </div>            
            <div class="addKitProduct">
                {foreach $kit->getShopKitProducts() as $kitset}
                <div>
                    <div class="picfix">
                        <a class="kitAImg" href="{shop_url('product/' . $kitset->getSProducts()->url)}" >
                            <img src="{productImageUrl($kitset->getSProducts()->getSmallImage())}" alt="{echo ShopCore::encode($model->getName())}" />
                        </a>
                    </div></div>
                <div class="kitAName">
                    <a href="{shop_url('product/' . $kitset->getSProducts()->url)}" >{echo $kitset->getSProducts()->name}</a>
                </div>
                <div class="kitSetPrice">
                    <span class="gray_line_through f_s_16">{echo intval($kitset->getSProducts()->getFirstVariant()->toCurrency())} {$CS}</span><br />
                    {echo ShopCore::app()->SCurrencyHelper->convert($kitset->getSProducts()->getFirstVariant()->toCurrency() - ($kitset->getSProducts()->getFirstVariant()->toCurrency() * $kitset->discount / 100))} {$CS}
                </div>
                <div class="kitDiscount">
                    {echo $kitset->discount} %
                </div>
                <!--                    {/*}{var_dump($kitset->kit_id)}
                                    {var_dump($kitset->discount)}
                                    {var_dump($kitset->getSProducts()->url)}{*/}-->
                {/foreach}
            </div>
            <div class="summaryKit">
                <a data-kitid="{echo $kitset->kit_id}" class="kitButton" href="#">Купить комплект</a>
                <div class="kitSetPrice">
                    {$kitprice = $kitset->getSProducts()->getFirstVariant()->price + $model->firstVariant->price - ($kitset->getSProducts()->getFirstVariant()->price / 100 * (int)$kitset->discount)}
                    {echo  ShopCore::app()->SCurrencyHelper->convert($kitprice)} {$CS}
                </div>
            </div>
        </div>
        {/foreach}

        {if $variant->color}
        <input type="hidden" id="variantId" name="variantId" value="{if !$firstAwalVId}{echo $firstVariant->getId()}{else:}{echo $firstAwalVId->getId()}{/if}" />        
        {/if}		
        {if count($variants) == 1}		
        <input type="hidden" id="variantId" name="variantId" value="{if !$firstAwalVId}{echo $firstVariant->getId()}{else:}{echo $firstAwalVId->getId()}{/if}" />        
        {/if}
        <input type="hidden" name="productId" value="{echo $model->getId()}" />        
    </form>
    <div class="tabs">
        <ul class="tabNavigation">
            {$tableData = ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
            <li><a href="outwell2.html#first"  class="selected">Описание</a></li>
            {if $tableData != 'Undefined table data'}<li><a href="outwell2.html#second">Характеристики</a></li>{/if}
            <li><a href="outwell2.html#third">Отзывы</a></li>
            {if count($images) > 1}<li><a class="vectMeProdPhoto" href="outwell2.html#fourth">Фотографии</a></li>{/if}
            <li><a href="outwell2.html#fifth">Доставка и оплата</a></li>
        </ul>
        <div id="first" class="block text">{echo htmlspecialchars_decode($model->getShortDescription())}</div>
        {if $tableData != 'Undefined table data'}<div id="second" class="not_tblock text">{echo ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}</div>{/if}
        <div id="third" class="not_tblock comment_box">{$comments}</div>
        {if count($images) > 1}<div id="fourth" class="not_tblock productRelativePhoto"></div>{/if}
        <div id="fifth" class="not_tblock">
            {$delivery = getPage(74);}
            <div class="text">
                <h1>{$delivery.title}</h1>
                {$delivery.prev_text}
            </div>
        </div>
    </div>
    <div style="display: none">
        <div id="report">
            <div class="products_list" id="collback_form">
                <div class="h1title">Сообщить о появлении</div>                
                <form action="" method="post" class="new_user commentForm callback_form">
                    <h2><span class="noItemPopup" id="notifyProductVariantName">{echo $firstVariant->getName()}</span></h2>
                    <dl><dt>Ваше имя:<span>*</span></dt><dd><input type="text" name="name" class="required" value="" /></dd></dl>
                    <dl><dt><label>Email:</label></dt><dd><input type="text" class="required" name="email" value="" /></dd></dl>
                    <dl><dt><label>Мобильный телефон:</label></dt><dd><input type="text" name="phone" value="" /></dd></dl>
                    <dl><dt><label>Актуально до:<span>*</span></label></dt><dd><input class="required" id="datepicker" type="text" name="actual" value="" /></dd></dl>
                    <dl><dt><label>Дополнительная информация:</label></dt><dd><textarea name="comment"></textarea></dd></dl>
                    <div class="button"><input type="submit" value="Отправить" /></div>
                    <input type="hidden" name="productId" value="{echo $model->getId()}" />
                    <input type="hidden" name="variantIds" value="{echo $varId}" />{form_csrf()}
                </form>
            </div>
        </div>
    </div>
</div>
{literal}
<script type="text/javascript">
$("#datepicker").datepicker();

</script>
{/literal}                
