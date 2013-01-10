<div>
<div class="crumbs"></div>
<!-- <img src="{media_url('uploads/temp_imgs/sportec_inside_1_1.jpg')}" class="action" /> -->
<h1>{echo ShopCore::encode($model->getName())}</h1>

 {if !isset($_GET['per_page'])}{if $model->description}<div class="site_description text">
{echo $model->description}
</div>
{/if}{/if}

<ul class="wares">
    {foreach $products as $p}
    <li>
        <div class="image"><a href="{shop_url('product/' . $p->getUrl())}"><img src="{productImageUrl($p->getSmallImage())}" alt="{echo ShopCore::encode($p->getName())}" /></a></div>
        <a href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
        <div class="price_buy"><div class="block_price"><span class="price_product">{echo $p->firstVariant->toCurrency()}</span> <span class="grn">{$CS}</span></div>{if array_search($p->id, $alreadyInCartArr) !== false}<a class="alreadyIn_small" href="{shop_url('cart')}">В корзине</a>{else:}<a href="{shop_url('product/' . $p->getUrl())}">Купить</a>{/if}</div>
        {if $p->getAction()}<div class="act"></div>{/if}
        {if $p->getHit()}<div class="hit"></div>{/if}
    </li>
    {/foreach}
</ul>

{if $pagination}
<div class="results">
    <!--<span>Показано с {$pageFrom} по {$pageTo} из {$totalProducts} (всего страниц - {echo $countOfPage})</span>-->
    <div>
        <ul>{$pagination}</ul>
    </div>
</div>
{/if}
</div>
<!--
{# Show brand products list #}

{# Display sidebar.tpl #}
{include_tpl ('sidebar')}

<div class="products_list">

    <div id="titleExt">
        <h5 class="left">{echo ShopCore::encode($model->getName())}</h5>
        <div class="right"></div>
        <div class="sp"></div>
    </div>

    <p>
        {echo $model->getDescription()}
    </p>

    <div id="brands_list">
     Display brans list 
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
		<ul class="products">
		{$count = 1;}
        {foreach $products as $p}
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


        <div class="sp"></div>
        <div id="gopages">
                {$pagination}
        </div>
        <div class="sp"></div>
        {else:}
        <p>
            {echo ShopCore::t('В категории нет продуктов')}.
        </p>
    {/if}


</div>-->
