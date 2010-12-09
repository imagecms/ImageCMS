
{# Display sidebar.tpl #}
{include_tpl ('sidebar')}

<div class="products_list">

      <div id="titleExt">
        <h5 class="left">Поиск</h5>
        <div class="right">
            Найдено {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array('продукт','продукта','продуктов'))}
        </div>
        <div class="sp"></div>
       
        <div id="categoryPath">
            {if !empty(ShopCore::$_GET['text'])}
                Вы искали: "<span class="highlight">{encode($_GET['text'])}</span>"
            {/if}
        </div>
      </div>

    <br/>

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
            {echo ShopCore::t('По вашему запросу ничего не найдено')}.
        </p>
    {/if}


</div>
