{literal}
<style type="text/css">
    #categoryPath {
        border-top:1px solid none;
        font-size:12px;
        padding-left:26px;
        margin-top:5px;
    }
    #categoryPath a {
        margin-top:5px;
        color:#666;
    }
    #brands_list {
        color:#D6D6D6;
        margin-bottom:30px;
        text-align:right;
        margin-left:42px;
    }
    #brands_list a {
        color:#3F9FFF;
        font-size:12px;
        text-decoration:none;
    }
    #brands_list a.active {
        font-weight:bold;
    }
</style>
{/literal}

<div id="categories_menu_tree">
    <ul class="categories_tree_list">
        {echo ShopCore::app()->SCategoryTree->ul($model->getCategoryId())}
	</ul>

    <div align="center" style="font-size:12px;">
    <br/>
	    <a href="brands/apple">Apple</a>
        <a href="brands/benq">Benq</a>
        <a href="brands/centropen">Centropen</a>
        <a href="brands/nokia">Nokia</a>
        <a href="brands/panasonic">Panasonic</a>
        <a href="brands/samsung">Samsung</a>
        <a href="brands/sony">Sony</a>
    </div>

</div>

<div class="products_list">

      <div id="titleExt">
        <h5 class="left">{echo ShopCore::encode( $model->getName() )}</h5>
        <div class="right">View display <span>1</span> of 10 pages</div>
        <div class="sp"></div>
       
        <div id="categoryPath">
            {renderCategoryPath($model->getMainCategory())}
        </div>
      </div>

    <br/>

    <div class="left">

      <div id="gallery">
        <div id="prImage" align="center">
            <img src="{productImageUrl($model->getId() . '_main.jpg')}" border="0" alt="image" />         
        </div>
        <div class="images">
          <div class="image"></div>
          <div class="image"></div>
          <div class="image"></div>
          <div class="image"></div>
        </div>
      </div>

    </div>
    <div id="product" style="width:380px;">
        <div id="detail">
            {echo $model->getShortDescription()}
            {echo $model->getFullDescription()}

            <div id="productProperties">
                {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesTable($model)}
            </div>
        </div>

   
    <a href="#"></a>

    <div class="right">
        <div class="price" id="price">
            {echo $model->getPrice()} $
        </div>
        <form action="{shop_url('cart/add')}" name="productForm" method="post">
        <input type="hidden" name="productId" value="{echo $model->getId()}" />
        <input type="hidden" name="quantity" value="1" />

        {if $model->countProductVariants() > 0}

        <script> 
        var variants_prices = new Array;
        var price = '{echo $model->getPrice()}';
        var valuta_znak = ' $';
        {foreach $model->getVariants() as $variant}
            variants_prices[{echo $variant->getId()}] = '{echo $variant->getPrice()}';
        {/foreach}
    
        {literal}
        function display_variant(variant)
        {
            if (variant == 0)
            {
                document.getElementById('price').innerHTML = price + valuta_znak;
                return true;
            }

  	        document.getElementById('price').innerHTML = variants_prices[variant] + valuta_znak;
        }
        {/literal}
  
        </script> 

        <div align="right">
            <select name="variantId" onChange="display_variant(this.value)">
            <option value="0">- Выберите вариант -</option>
            {foreach $model->getVariants() as $variant}
                <option value="{echo $variant->getId()}">{echo ShopCore::encode($variant->getName())}</option>
            {/foreach}
            </select>
        </div>
        {/if}

            <a rel="nofollow" href="#" onClick="document.productForm.submit(); return false;" class="button1">{echo ShopCore::t('ДОБАВИТЬ В КОРЗИНУ')}</a>
        {form_csrf()}
        </form>
    </div>
    

    <div class="spRight"></div>
  </div>

</div>
