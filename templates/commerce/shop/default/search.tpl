{# Variables
# @var products
# @var totalProducts
# @var brandsInSearchResult
# @var pagination
# @var tree
#}

{# Display sidebar.tpl #}
<!--
{include_tpl ('sidebar')}
-->

           <div class="content">
                <div class="center">
                    <div class="filter">
                        <div class="title padding_filter">Найдено в категориях:</div>
                        <div class="padding_filter check_frame">
                            <div class="sub_title">Телефони, MP3, GPS</div>
                            <ul class="menu_fiter">
                                <li><a href="#">Мобильные телефоны</a> <span>(36)</span></li>
                                <li><a href="#">КПК</a> <span>(20)</span></li>
                                <li><a href="#">Электронные книги</a> <span>(2)</span></li>
                                <li><a href="#">Наушники</a> <span>(2)</span></li>
                                <li><a href="#">GPS навигаторы</a> <span>(5)</span></li>
                            </ul>
                        </div>
                      
                       
                    </div>
                    <div class="catalog_content">
                        <div class="catalog_frame w_100">
<!--                            <div class="crumbs">Главная страница / домашняя электроника /</div>-->
                            <div class="box_title clearfix">
                                <div class="f-s_24 f_l">
									
		{if !empty(ShopCore::$_GET['text'])}
         Вы искали: "<span class="highlight">{encode($_GET['text'])}</span>"{/if}
		<span class="count_search">
		({$totalProducts}) {echo SStringHelper::Pluralize($totalProducts, array('продукт','продукта','продуктов'))}
									
									
									</span></div>
                                <div class="f_r">
									
									
<!--									     <div class="lineForm f_l w_145">
                                        <select id="sort" name="order">    
											<option {if ShopCore::$_GET['order']=='price'}selected{/if} value="price">Возрастанию цены</option>
											<option {if ShopCore::$_GET['order']=='price_desc'}selected{/if} value="price_desc">Убыванию цены</option>
											<option {if ShopCore::$_GET['order']=='name'}selected{/if} value="name">Название  A-Z</option>
											<option {if ShopCore::$_GET['order']=='name_desc'}selected{/if} value="name">Название Z-A</option>
											<option {if ShopCore::$_GET['order']=='date'}selected{/if} value="date">Возрастанию даты</option>
											<option {if ShopCore::$_GET['order']=='date_desc'}selected{/if} value="date_desc">Убыванию даты</option>
										</select>
										</div>-->
									
<!--                                    <div class="lineForm f_l w_50 m-l_10">
                                        <select id="count" name="count">
                                            <option value="1" selected="selected">10</option>
                                            <option value="1">20</option>
                                        </select>
                                    </div>-->
								
				<form method="get" action="">
                    {if !empty(ShopCore::$_GET['text'])}
                        <input type="hidden" value="{encode(ShopCore::$_GET['text'])}" name="text" />
                    {/if}

                    
					
<!--             	        <div class="lineForm f_l w_145">-->
  <div class="lineForm f_l m-l_10">
                                <div class="fieldName">Сиртировка:</div>
                                        <select id="sort" name="order">    
											<option {if ShopCore::$_GET['order']=='price'}selected{/if} value="price">Возрастанию цены</option>
											<option {if ShopCore::$_GET['order']=='price_desc'}selected{/if} value="price_desc">Убыванию цены</option>
											<option {if ShopCore::$_GET['order']=='name'}selected{/if} value="name">Название  A-Z</option>
											<option {if ShopCore::$_GET['order']=='name_desc'}selected{/if} value="name">Название Z-A</option>
											<option {if ShopCore::$_GET['order']=='date'}selected{/if} value="date">Возрастанию даты</option>
											<option {if ShopCore::$_GET['order']=='date_desc'}selected{/if} value="date_desc">Убыванию даты</option>
										</select>
						</div>
                                     <div class="lineForm f_l w_50 m-l_10">
                                        <select id="count" name="count">
                                            <option value="1" selected="selected">10</option>
                                            <option value="1">20</option>
                                        </select>
                                    </div>
<div class="lineForm f_l w_150 cusel-scroll-pane"> 
                    <div class="fieldName">Фильтр по категории:</div>
<!--                    <div class="field">-->
                        <select  id="cusel" name="category" onChange="getCategoryAttributes(this.options[this.selectedIndex].value, '{shop_url('ajax/getCategoryAttributes/')}')">
                            <option>-</option>
                            {foreach $tree as $c}
                                <option {if ShopCore::$_GET['category']==$c->getId()}selected{/if} value="{echo $c->getId()}">{str_repeat('-',$c->getLevel())}
                                    {if $c->getLevel()==0}
                                        <b>{echo ShopCore::encode($c->getName())}</b>
                                    {else:}
                                        {echo ShopCore::encode($c->getName())}
                                    {/if}
                                </option>
                            {/foreach}  
                        </select>
<!--                    </div>-->
					</div>
                    
                    <div id="catVariants">
                    </div>
                    
<div id="navigation"> 
                    <div class="fieldName">Цена:</div>
                    <div class="search">
                        от <input type="text" value="{encode(ShopCore::$_GET['lp'])}" name="lp" style="width:26px;" />
                        до <input type="text" value="{encode(ShopCore::$_GET['rp'])}" name="rp" style="width:26px;"/> 
                    </div>
                    <div class="clear"></div>
                    
                    {if !empty(ShopCore::$_GET['brand'])}
                        <input type="hidden" value="{encode(ShopCore::$_GET['brand'])}" name="brand" />
                    {/if}
					
					</div>
                    <div class="clear"></div>
                    <div class="fieldName"></div>
                    <div class="field">
                        <input type="submit" value="Применить" />
                    </div>
                    <div class="clear"></div>

                </form>
									
									
									
                                </div>
                            </div>
                            
                            
                                                            
                            
      {if $totalProducts > 0}
		<ul class="products">
		{$count = 1;}
        {foreach $products as $p}
		 <li {if $count == 3} class="last" {$count = 0}{/if} {if $count == 1} style="clear:left;" {/if}>
 					   <div class="photo_block">
               <a href="{shop_url('product/' . $p->getUrl())}">
               <img src="{productImageUrl($p->getId() . '_small.jpg')}" border="0"  alt="image" />
                </a>
                  </div>
                <div class="func_description">
                <a href="{shop_url('product/'.$p->getUrl())}" class="title">Ноутбук {echo ShopCore::encode($p->getName())}</a>
                <div class="f-s_0">
                    <span class="code">Код 13445795</span>
                    <div class="di_b star"><img src="images/temp/STAR.png"></div>
                     <a href="#" class="response">145 відгуків</a>
                </div> 
            <div class="f_l">
                   <div class="buy">
                          <div class="price f-s_18 f_l">{echo $p->firstVariant->toCurrency()}<sub>{$CS}</sub><span class="d_b">{echo $p->firstVariant->toCurrency('Price', 1)} $</span></div>
                          <div class="button_gs buttons"><a href="#">Купить</a></div>
                          </div>
              </div>
               <div class="f_r t-a_r">
                 <span class="ajax_refer_marg"><a href="{shop_url('compare/add/' . $p->getId())}" class="js gray">Додати до порівняння</a></span>
                 <a href="#" class="js gray">Зберегти у списку бажань</a>
               </div>
                   </div>
              <p class="c_b">
				 
			Экран 15.4" (1440x900) LED, глянцевый / Intel Core i7 (2.4 ГГц) / RAM 4 ГБ / HDD 750 ГБ / AMD Radeon HD 6750M, 1 ГБ / DVD Super Multi DL / Wi-Fi / Bluetooth / веб-камера / кардридер SD / OS X Lion / 2.54 кг
                    <a href="{shop_url('product/'.$p->getUrl())}" class="t-d_n"><span class="t-d_u">Детальніше</span> ></a>
              </p>
          </li>
                                
            
            
            
            {if $count == 3}<li class="separator"></li>{$count=0}{/if}
            {$count++}
              
        {/foreach}
		</ul>


        <div id="gopages">
                {$pagination}
        </div>
        <div class="sp"></div>
        {else:}
        <p>
            {echo ShopCore::t('По вашему запросу ничего не найдено')}.
        </p>
    {/if}
                            
       <div class="pagination">
                                <span class="f_l">
                                    <&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Назад</a>
                                </span>
                                <span class="f_r">
                                    <a href="#">Следующая страница</a>&nbsp;&nbsp;&nbsp;&nbsp;>
                                </span>
                                <div class="t-a_c">
                                    <a href="#">1</a>
                                    <a href="#">2</a>
                                    <a href="#">3</a>
                                    <a href="#" class="active">4</a>
                                    <a href="#">5</a>
                                    <a>...</a>
                                    <a href="#">10</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




<div class="products_list">
      <div id="titleExt">
        <h5 class="left">Поиск</h5>
        <div class="right">
            Найдено {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array('продукт','продукта','продуктов'))}
             BEGIN FILTER BOX 
			 
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
                            <option {if ShopCore::$_GET['order']=='date'}selected{/if} value="date">Возрастанию даты</option>
                            <option {if ShopCore::$_GET['order']=='date_desc'}selected{/if} value="date_desc">Убыванию даты</option>
                        </select>
                    </div>
                    
                    <div class="fieldName">Фильтр по категории:</div>
                    <div class="field">
                        <select name="category" onChange="getCategoryAttributes(this.options[this.selectedIndex].value, '{shop_url('ajax/getCategoryAttributes/')}')">
                            <option>-</option>
                            {foreach $tree as $c}
                                <option {if ShopCore::$_GET['category']==$c->getId()}selected{/if} value="{echo $c->getId()}">{str_repeat('-',$c->getLevel())}
                                    {if $c->getLevel()==0}
                                        <b>{echo ShopCore::encode($c->getName())}</b>
                                    {else:}
                                        {echo ShopCore::encode($c->getName())}
                                    {/if}
                                </option>
                            {/foreach}  
                        </select>
                    </div>
                    
                    <div id="catVariants">
                    </div>
                    
                    <div class="fieldName">Цена:</div>
                    <div class="field">
                        от <input type="text" value="{encode(ShopCore::$_GET['lp'])}" name="lp" style="width:26px;" />
                        до <input type="text" value="{encode(ShopCore::$_GET['rp'])}" name="rp" style="width:26px;"/> 
                    </div>
                    <div class="clear"></div>
                    
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
				
				
				
				
				
             END FILTER BOX 
        </div>
        <div class="sp"></div>

        <div id="categoryPath">
            {if !empty(ShopCore::$_GET['text'])}
                Вы искали: "<span class="highlight">{encode($_GET['text'])}</span>"
            {/if}
        </div>
      </div>
    <div id="brands_list">
     Display brans list 
    {if sizeof($brandsInSearchResult) > 0}
        {foreach $brandsInSearchResult as $brand}
            {if $brand->getId() != ShopCore::$_GET['brand']}
                <a href="?text={encode(ShopCore::$_GET['text'])}{if !empty(ShopCore::$_GET['order'])}&order={encode(ShopCore::$_GET['order'])}{/if}{if !empty(ShopCore::$_GET['category'])}&category={encode(ShopCore::$_GET['category'])}{/if}&brand={echo $brand->getId()}">{echo ShopCore::encode($brand->getName())}</a>
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
            <li {if $count == 3} class="last" {$count = 0}{/if} {if $count == 1} style="clear:left;" {/if}>
                <div class="image" style="display:table-cell;vertical-align:middle;overflow:hidden;">
                    <a href="{shop_url('product/' . $p->getUrl())}">
                        <img src="{productImageUrl($p->getId() . '_small.jpg')}" border="0"  alt="image" />
                    </a>
                </div>
                <h3 class="name"><a href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a></h3>
                <div class="price">{echo $p->firstVariant->toCurrency()} {$CS}</div>
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
            {echo ShopCore::t('По вашему запросу ничего не найдено')}.
        </p>
    {/if}
</div>








