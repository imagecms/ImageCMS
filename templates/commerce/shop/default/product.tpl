{$jsCode}

<!-- BEGIN STAR RATING -->
<link rel="stylesheet" type="text/css" href="{$SHOP_THEME}js/rating/jquery.rating-min.css" />
<script src="{$SHOP_THEME}js/rating/jquery.rating-min.js"></script>
<script src="{$SHOP_THEME}js/rating/jquery.MetaData-min.js"></script>
<!-- END STAR RATING -->

<!-- BEGIN LIGHTBOX -->
<script type="text/javascript" src="{$SHOP_THEME}js/lightbox/scripts/jquery.color.min.js"></script>
<script type="text/javascript" src="{$SHOP_THEME}js/lightbox/scripts/jquery.lightbox.min.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="{$SHOP_THEME}js/lightbox/styles/jquery.lightbox.min.css" />
<!-- END LIGHTBOX -->

{literal}
<script type="text/javascript">$(function(){
    // Init light box
    $('.lightbox').lightbox();

    // Init star rating
    $('.hover-star').rating({
        callback: function(value, link) {
            $.ajax({
                type: "POST",
                data: "pid={/literal}{echo $model->getId()}{literal}&val=" + value,
                url:'/shop/ajax/rate',
             });

            $('.hover-star').rating('readOnly', true);
        }
    });
});
</script>
{/literal}

{# Display sidebar.tpl #}
{include_tpl ('sidebar')}

<div class="products_list">

      <div id="titleExt">
        <h5 class="left">
        {echo ShopCore::encode($model->getName())}
        {if sizeof($model->getProductVariants()) == 1}
            {echo $model->firstVariant->getName()}
        {/if}
        </h5>
        <div class="right">
        {$rating = $model->getRating()}
            <input class="hover-star" type="radio" name="rating-1" value="1" {if $rating==1}checked="checked"{/if}/>
            <input class="hover-star" type="radio" name="rating-1" value="2" {if $rating==2}checked="checked"{/if}/>
            <input class="hover-star" type="radio" name="rating-1" value="3" {if $rating==3}checked="checked"{/if}/>
            <input class="hover-star" type="radio" name="rating-1" value="4" {if $rating==4}checked="checked"{/if}/>
            <input class="hover-star" type="radio" name="rating-1" value="5" {if $rating==5}checked="checked"{/if}/>
        </div>
        <div class="sp"></div>
       
        <div id="categoryPath">
            {renderCategoryPath($model->getMainCategory())}
        </div>
      </div>

    {if $CI->session->flashdata('productAdded') === true}
        <div style="padding:10px;background-color:#f5f5dc;">
            Товар добавлен в <a href="{shop_url('cart')}">корзину.</a>
        </div>
    {/if}
        <br/>

    <div class="left">

      <div id="gallery">
        <div id="prImage" align="center">
        {if $model->getMainImage()}
            <img src="{productImageUrl($model->getMainImage())}" border="0" alt="image" />
        {/if}       
        </div>

        {if sizeof($model->getSProductImagess()) > 0}
            {foreach $model->getSProductImagess() as $image}
                <div class="images">
                    <div class="image">
                        <a class="lightbox" title=" " href="{productImageUrl($image->getImageName())}"><img src="{productImageUrl($image->getImageName())}" style="width:90px;"></a>
                    </div>
                </div>
            {/foreach}
        {/if}
      </div>

    </div>
    <div id="product" style="width:380px;">
        <div id="detail">
			<h3>Описание продукта:</h3>
            {echo $model->getShortDescription()}
            {echo $model->getFullDescription()}

            {if $model->countProperties() > 0}
                <h3>Характеристики:</h3>
                <div id="productProperties">
                    {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
                </div>
            {/if}
        </div>

    <a href="#"></a>

    <div class="right">
        <form action="{shop_url('cart/add')}" name="productForm" method="post">

        {if $model->countProductVariants() > 1}
        <div align="right" style="padding-bottom:20px;">
        Варианты товара:
            <select name="variantId" onChange="display_variant_price(this.value)">
            {foreach $model->getProductVariants() as $variant}
                <option value="{echo $variant->getId()}">{echo ShopCore::encode($variant->getName())}</option>
            {/foreach}
            </select>
        </div>
        {else:}
            <input type="hidden" name="variantId" value="{echo $model->firstVariant->getId()}" />
        {/if}


        <div class="price" id="price">
            {echo $model->firstVariant->toCurrency()} {$CS}
        </div>
        <input type="hidden" name="productId" value="{echo $model->getId()}" />
        <input type="hidden" name="quantity" value="1" />

        <a rel="nofollow" href="#" onClick="document.productForm.submit(); return false;" class="button1">{echo ShopCore::t('ДОБАВИТЬ В КОРЗИНУ')}</a>
        {form_csrf()}
        </form>
    </div>

    <div class="spRight"></div>
  </div>

    <div class="sp"></div>
    {if $model->getRelatedProductsModels()}
    <h5>Сопутствующие товары</h5>
        {# Display list of related products #}
        <ul class="products">
            {$count = 1;}
            {foreach $model->getRelatedProductsModels() as $p}
                <li class="{counter('', '', 'last')}">
                    <div class="image" style="display:table-cell;vertical-align:middle;overflow:hidden;">
                        <a href="{shop_url('product/' . $p->getUrl())}">
                            <img src="{productImageUrl($p->getId() . '_small.jpg')}" border="0"  alt="image" />
                        </a>
                    </div>
                    <h3 class="name"><a href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a></h3>
                    <div class="price">{echo $p->firstVariant->toCurrency()} {$CS}</div>
                    <div class="compare"><a href="#">Сравнить</a></div>
                </li>
                {if $count == 3}<li class="separator"></li> {$count=0}{/if}
                {$count++}
            {/foreach}
        </ul>
    {/if}
    <div class="sp"></div>

    {$comments}
    
</div>

