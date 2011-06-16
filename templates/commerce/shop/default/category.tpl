
{# Display sidebar.tpl #}
{include_tpl ('sidebar')}

<div class="products_list">

      <div id="titleExt">
        <h5 class="left">{echo ShopCore::encode($model->getName())}</h5>
        <div class="right">
            <!-- BEGIN FILTER BOX -->
                <a href="#" onclick="$('#filterBox').toggle();return false;">Изменить параметры ↓</a>
                <div id="filterBox">
                <form method="get" action="">

                    <div class="fieldName">Сиртировка:</div>
                    <div class="field">
                        <select name="order">
                            <option>-</option>
                            <option {if ShopCore::$_GET['order']=='price'}selected{/if} value="price">Возрастанию цены</option>
                            <option {if ShopCore::$_GET['order']=='price_desc'}selected{/if} value="price_desc">Убыванию цены</option>
                            <option {if ShopCore::$_GET['order']=='name'}selected{/if} value="name">Название  A-Z</option>
                            <option {if ShopCore::$_GET['order']=='name_desc'}selected{/if} value="name_desc">Название Z-A</option>
                            <option {if ShopCore::$_GET['order']=='hit'}selected{/if} value="hit">Сначала хиты</option>
                            <option {if ShopCore::$_GET['order']=='hot'}selected{/if} value="hot">Сначала новинки</option>
                            <option {if ShopCore::$_GET['order']=='action'}selected{/if} value="action">Сначала акции</option>
                        </select>
                    </div>
                    <div class="clear"></div>

                    <div class="fieldName">Цена:</div>
                    <div class="field">
                        от <input type="text" value="{encode(ShopCore::$_GET['lp'])}" name="lp" style="width:26px;" />
                        до <input type="text" value="{encode(ShopCore::$_GET['rp'])}" name="rp" style="width:26px;"/> 
                    </div>
                    <div class="clear"></div>

                {if $model->countProperties() > 0}
                    {foreach $model->getProperties() as $prop}
                        <div class="fieldName">{echo $prop->getName()}:</div>
                        <div class="field">
                            {foreach $prop->asArray() as $key=>$val}
                                <label>
                                <input type="checkbox" {if is_property_in_get($prop->getId(), $key)} checked="checked" {/if} name="f[{echo $prop->getId()}][]" {$checked} value="{$key}" /> {$val}
                                </label><br>
                            {/foreach}
                        </div>
                        <div class="clear"></div>
                    {/foreach}
                {/if}
                <div class="fieldName">В наличии:</div>
                        <div class="field">
                                <label>
                                <input type="checkbox" {if isset(ShopCore::$_GET['stock'])} checked="checked" {/if} name="stock" {$checked} value="1" />
                                </label><br>
                        </div>
                        <div class="clear"></div>
                <div class="fieldName">Акции:</div>
                        <div class="field">
                                <label>
                                <input type="checkbox" {if isset(ShopCore::$_GET['action'])} checked="checked" {/if} name="action" {$checked} value="1" />
                                </label><br>
                        </div>
                        <div class="clear"></div>
                <div class="fieldName">Новинки:</div>
                        <div class="field">
                                <label>
                                <input type="checkbox" {if isset(ShopCore::$_GET['hot'])} checked="checked" {/if} name="hot" {$checked} value="1" />
                                </label><br>
                        </div>
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
            {renderCategoryPath($model)}
        </div>
      </div>

    <div id="brands_list">
    <!-- Display brans list -->
    {if sizeof($brandsInCategory) > 0}
        {foreach $brandsInCategory as $brand}
            {if $brand->getId() != ShopCore::$_GET['brand']}
                <a href="?brand={echo $brand->getId()}{if !empty(ShopCore::$_GET['order'])}&order={encode(ShopCore::$_GET['order'])}{/if}{if !empty(ShopCore::$_GET['lp'])}&lp={encode(ShopCore::$_GET['lp'])}{/if}{if !empty(ShopCore::$_GET['rp'])}&rp={encode(ShopCore::$_GET['rp'])}{/if}{if isset(ShopCore::$_GET['stock'])}&stock=1{/if}{if isset(ShopCore::$_GET['action'])}&action=1{/if}{if isset(ShopCore::$_GET['hot'])}&hot=1{/if}{if $model->countProperties() > 0}{foreach $model->getProperties() as $prop}{foreach $prop->asArray() as $key=>$val}{if is_property_in_get($prop->getId(), $key)}&f[{echo $prop->getId()}][]={$key}{/if}{/foreach}{/foreach}{/if}">{echo ShopCore::encode($brand->getName())}</a>
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
                <div class="price priceLight"> 
                    {$p->firstVariant}
                    {if $p->hasDiscounts()}
                        <s>{echo $p->firstVariant->toCurrency('origPrice')} {$CS}</s>
                        <br/>
                        <span style="font-size:14px;">{echo $p->firstVariant->toCurrency()} {$CS}</span>
                    {else:}
                        <span style="font-size:14px;">{echo $p->firstVariant->toCurrency()} {$CS}</span>
                    {/if}
                </div>
                <div class="compare"><a href="{shop_url('compare/add/' . $p->getId())}">Сравнить</a></div>
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


</div>