{if count($products) > 0}
<div class="p_bot">    
    <div class="crumbs"><a href="{site_url()}">Главная</a> &RightArrow; <a href="{shop_url('promotion')}">Акции</a></div>
    {/*}<img src="{media_url('uploads/temp_imgs/sportec_inside_1_1.jpg')}" class="action" alt="promoBackground" />{*/}
    <h1>Акции</h1>
    <form method="get">
        <div class="promoFilterWrap">
            <div class="leftSideFilter">
                <div class="subHeader">Разделы</div>
                <div class="equtor">
                {$count = 0;}
                {foreach $categories as $c}                
                    {if $count++ == 5}</div><div class="equtor">{/if}
                    <label><input type="checkbox" name="searchIn[]" {if @in_array($c->getId(), $_GET.searchIn)}checked="checked"{/if} value="{echo $c->getId()}"/>{echo $c->getName()}</label><br/>
                {/foreach}
                </div>
            </div>
            <div class="rightSideFilter">
                <div class="subHeader">Бренды</div>
                <div class="equtor">
                {$count = 0;}
                {foreach $brandsInList as $listBrands}
                    {if $count++ == 5}</div><div class="equtor">{/if}
                    <label><input type="checkbox" name="searchBrandIn[]" {if @in_array($listBrands->getId(), $_GET.searchBrandIn)}checked="checked"{/if} value="{echo $listBrands->getId()}"/>{echo $listBrands->name}</label><br/>
                {/foreach}
                </div>
            </div>
            <div class="sear_fil ">
                <input type="submit" value="Фильтровать" class="b_f">                                
            </div>
        </div>
    </form>

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

    <div class="results">
        <div>
            <span class="f_l">Показано с {$pageFrom} по {$pageTo} из {$totalProducts} (всего страниц - {echo $countOfPage})</span>
            <ul>{$pagination}</ul>
        </div>
    </div>
</div>
{else:}
<div class="p_bot">
    <h1>Акции</h1>
    <form method="get">
        <div class="promoFilterWrap">
            <div class="leftSideFilter">
                <div class="subHeader">Разделы</div>
                <div class="equtor">
                {$count = 0;}
                {foreach $categories as $c}                
                    {if $count++ == 5}</div><div class="equtor">{/if}
                    <label><input type="checkbox" name="searchIn[]" {if @in_array($c->getId(), $_GET.searchIn)}checked="checked"{/if} value="{echo $c->getId()}"/>{echo $c->getName()}</label><br/>
                {/foreach}
                </div>
            </div>
            <div class="rightSideFilter">
                <div class="subHeader">Бренды</div>
                <div class="equtor">
                {$count = 0;}
                {foreach $brandsInList as $listBrands}
                    {if $count++ == 5}</div><div class="equtor">{/if}
                    <label><input type="checkbox" name="searchBrandIn[]" {if @in_array($listBrands->getId(), $_GET.searchBrandIn)}checked="checked"{/if} value="{echo $listBrands->getId()}"/>{echo $listBrands->name}</label><br/>
                {/foreach}
                </div>
            </div>
            <div class="sear_fil ">
                <input type="submit" value="Фильтровать" class="b_f">                                
            </div>
        </div>
    </form>
    <div class="">Товаров не найдено</div>
</div>
{/if}
