
{# Display sidebar.tpl #}
{include_tpl ('sidebar')}

<div class="products_list">

      <div id="titleExt">
        <h5 class="left">Поиск</h5>
        <div class="right">
            Найдено {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array('продукт','продукта','продуктов'))}
            <!-- BEGIN FILTER BOX -->
                <a href="#" onclick="$('#filterBox').toggle();return false;">Изменить параметры v</a>
                <div id="filterBox">
                <form method="get" action="">
                    {if !empty(ShopCore::$_GET['text'])}
                        <input type="hidden" value="{encode(ShopCore::$_GET['text'])}" name="text" />
                    {/if}

                    <div class="fieldName">Сиртировка:</div>
                    <div class="field">
                        <select name="order">
                            <option>-</option>
                            <option {if ShopCore::$_GET['order']=='price'}selected{/if} value="price">Возрастанию цены</option>
                            <option {if ShopCore::$_GET['order']=='price_desc'}selected{/if} value="price_desc">Убыванию цены</option>
                            <option {if ShopCore::$_GET['order']=='name'}selected{/if} value="name">Название  A-Z</option>
                            <option {if ShopCore::$_GET['order']=='name_desc'}selected{/if} value="name">Название Z-A</option>
                            <option {if ShopCore::$_GET['order']=='date'}selected{/if} value="date">Возрастанию даты создания</option>
                            <option {if ShopCore::$_GET['order']=='date_desc'}selected{/if} value="date_desc">Убыванию даты создания</option>
                        </select>
                    </div>
                    
                    {if !empty(ShopCore::$_GET['brand'])}
                        <input type="hidden" value="{encode(ShopCore::$_GET['brand'])}" name="brand" />
                    {/if}
                    <div class="clear"></div>

                    <div class="fieldName"></div>
                    <div class="field">
                        <input type="submit" value="Применить" />
                    </div>
                    <div class="clear"></div>

                </form>
                </div>
            <!-- END FILTER BOX -->
        </div>
        <div class="sp"></div>
       
        <div id="categoryPath">
            {if !empty(ShopCore::$_GET['text'])}
                Вы искали: "<span class="highlight">{encode($_GET['text'])}</span>"
            {/if}
        </div>
      </div>
    <div id="brands_list">
    <!-- Display brans list -->
    {if sizeof($brandsInSearchResult) > 0}
        {foreach $brandsInSearchResult as $brand}
            {if $brand->getId() != ShopCore::$_GET['brand']}
                <a href="?text={encode(ShopCore::$_GET['text'])}{if !empty(ShopCore::$_GET['order'])}&order={encode(ShopCore::$_GET['order'])}{/if}&brand={echo $brand->getId()}">{echo ShopCore::encode($brand->getName())}</a>
            {else:}
                <a href="#" style="font-weight:bold;">{echo ShopCore::encode($brand->getName())}</a>
            {/if}
            |
        {/foreach}
    {/if}
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