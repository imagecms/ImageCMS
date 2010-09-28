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
        {echo ShopCore::app()->SCategoryTree->ul($model->getId())}
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
            {renderCategoryPath($model)}
        </div>
      </div>

    <div id="brands_list">
    <!-- Display brans list -->
    {if sizeof($brandsInCategory) > 0}
        {foreach $brandsInCategory as $brand}
            {if $brand->getId() != ShopCore::$_GET['brand']}
                <a href="?brand={echo $brand->getId()}">{echo ShopCore::encode($brand->getName())}</a>
            {else:}
                <a href="#" style="font-weight:bold;">{echo ShopCore::encode($brand->getName())}</a>
            {/if}
            |
        {/foreach}
    {/if}
    </div>

    {if $totalProducts > 0}
        {foreach $products as $p}
            <ul class="products">
                <li class="{counter('first', 'last')}">
                    <div class="image" style="display:table-cell;vertical-align:middle;overflow:hidden;">
                        <a href="{shop_url('product/' . $p->getUrl())}">
                            <img src="{productImageUrl($p->getId() . '_small.jpg')}" border="0"  alt="image" />
                        </a>
                    </div>
                    <h3 class="name"><a href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a></h3>
                    <div class="price">{echo $p->getPrice()} €</div>
                </li>
            </ul>
        {/foreach}


        <div class="sp"></div>
        <div id="gopages">
            <a href="#" class="prev"><img src="{$SHOP_THEME}style/images/gpPrev.jpg" alt="prev" border="0" /></a>
            <span><a href="#" class="current">1</a> | <a href="#">2</a> | <a href="#">3</a>...</span>
            <a href="#" class="next"><img src="{$SHOP_THEME}style/images/gpNext.jpg" alt="next" border="0" /></a>
        </div>
        <div class="sp"></div>
        {else:}
        <p>
            {echo ShopCore::t('В категории нет продуктов')}.
        </p>
    {/if}


</div>
