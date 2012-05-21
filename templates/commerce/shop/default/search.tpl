{# Variables
# @var products
# @var totalProducts
# @var brandsInSearchResult
# @var pagination
# @var tree
# @var model
# @var editProductUrl
# @var jsCode
#}
{# Display sidebar.tpl #}
{$jsCode}
{$forCompareProducts = $CI->session->userdata('shopForCompare')}
<!-- BEGIN STAR RATING -->
<link rel="stylesheet" type="text/css" href="{$SHOP_THEME}js/rating/jquery.rating-min.css" />
<script src="{$SHOP_THEME}js/rating/jquery.rating-min.js" type="text/javascript"></script>
<script src="{$SHOP_THEME}js/rating/jquery.MetaData-min.js" type="text/javascript"></script>
<script src="{$SHOP_THEME}js/search.js" type="text/javascript"></script>
<!-- END STAR RATING -->

<!--
{include_tpl ('sidebar')}
-->
           <div class="content">
                <div class="center">
                    <div class="filter">
                        <div class="title padding_filter">Найдено в категориях:</div>
                        <div class="padding_filter check_frame">
							
		<div class="left" id="subcategorys">
        <form method="get" action="" id="seacrh_p_form">
        <input type="hidden" name="text" value="{echo ShopCore::$_GET['text']}">
        <input type="hidden" name="order" id="h_order" value="{echo ShopCore::$_GET['order']}">
        <input type="hidden" name="category" id="h_category" value="{echo ShopCore::$_GET['category']}">
        <input type="hidden" name="user_per_page" id="h_user_per_page" value="{echo ShopCore::$_GET['user_per_page']}">    
        <div class="check_form">			
        {foreach $tree as $item}
            {if $item->getLevel() == "0"}</div>
		<div class="form_title">{echo $item->getName()}</div>
		<p>      <div class="form_title">
            {elseif $item->getLevel() == "1"} 
			  {$count_item = $categorys[$item->getId()];}						
                {if $count_item}				
                    <label{if $_GET['category'] && $_GET['category']==$item->getId()} class="active"{/if}>&mdash; <a href="{echo $item->getId()}">{echo $item->getName()}</a> <span>({echo $count_item})</span></label>     
                {else:}
                    <label class="grey_9">&mdash; {echo $item->getName()} <span>(0)</span></label>  
                {/if}
            {/if}</p>
        {/foreach}
        </div>
        </form>
    </div>

                        </div>
                    </div>
                    <div class="catalog_content">
                        <div class="catalog_frame w_100">
<!--<div class="crumbs">Главная страница / домашняя электроника /</div>-->
 <div class="box_title clearfix">
  <div class="f-s_24 f_l">
  {if !empty(ShopCore::$_GET['text'])}
         Вы искали: "<span class="highlight">{encode($_GET['text'])}</span>"{/if}
		<span class="count_search">
		({$totalProducts}) {echo SStringHelper::Pluralize($totalProducts, array('продукт','продукта','продуктов'))}
	</span></div>
	   <div class="clear"></div>                 
	<div class="f_r_search">
		<form method="get" action="">
                    {if !empty(ShopCore::$_GET['text'])}
                        <input type="hidden" value="{encode(ShopCore::$_GET['text'])}" name="text" />
                    {/if}
						<div class="lineForm f_l f_l_search">
                                <div class="fieldName">Сoртировка:</div>
                                        <select id="sort" name="order">    
											<option {if ShopCore::$_GET['order']=='price'}selected{/if} value="price">Возрастанию цены</option>
											<option {if ShopCore::$_GET['order']=='price_desc'}selected{/if} value="price_desc">Убыванию цены</option>
											<option {if ShopCore::$_GET['order']=='name'}selected{/if} value="name">Название  A-Z</option>
											<option {if ShopCore::$_GET['order']=='name_desc'}selected{/if} value="name">Название Z-A</option>
											<option {if ShopCore::$_GET['order']=='date'}selected{/if} value="date">Возрастанию даты</option>
											<option {if ShopCore::$_GET['order']=='date_desc'}selected{/if} value="date_desc">Убыванию даты</option>
										</select>
						</div>
				<div class="lineForm f_l f_l_search"> 
                    <div class="fieldName">Фильтр по категории:</div>
					 <select  id="cusel" name="category" onChange="getCategoryAttributes(this.options[this.selectedIndex].value, '{shop_url('ajax/getCategoryAttributes/')}')">
                            <option selected="selected">-</option>
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
<!--      <div class="search">
						Цена:
                        от <input type="text" value="{encode(ShopCore::$_GET['lp'])}" name="lp" style="width:26px;" />
                        до <input type="text" value="{encode(ShopCore::$_GET['rp'])}" name="rp" style="width:26px;"/>                                                        
                    {if !empty(ShopCore::$_GET['brand'])}
                        <input type="hidden" value="{encode(ShopCore::$_GET['brand'])}" name="brand" />
                    {/if}
					</div>-->							
<!--						     <div class="lineForm f_l_search">
							 <div class="w_50">
                                        <select id="count" name="count">
                                            <option value="1" selected="selected">10</option>
                                            <option value="1">20</option>
                                        </select>
                                    </div></div>-->
						
<div class="f_r t-a_r">
                        <b><input type="submit" value="Применить" />	</b>
						</div>
                    <div class="clear"></div>                
		   </form>
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
                <a href="{shop_url('product/'.$p->getUrl())}" class="title">{echo ShopCore::encode($p->getName())}</a>
				    <div class="f-s_0">
                    <span class="code">Код: {echo $p->firstvariant->getNumber()}</span>
                    <div class="di_b star">
              {$rating = $p->getRating()}
                            <input class="hover-star chs{echo $p->getId()}" type="radio" name="rating-{echo $p->getId()}" value="1" data-id="{echo $p->getId()}" {if $rating==1}checked="checked"{/if}/>
                            <input class="hover-star chs{echo $p->getId()}" type="radio" name="rating-{echo $p->getId()}" value="2" data-id="{echo $p->getId()}" {if $rating==2}checked="checked"{/if}/>
                            <input class="hover-star chs{echo $p->getId()}" type="radio" name="rating-{echo $p->getId()}" value="3" data-id="{echo $p->getId()}" {if $rating==3}checked="checked"{/if}/>
                            <input class="hover-star chs{echo $p->getId()}" type="radio" name="rating-{echo $p->getId()}" value="4" data-id="{echo $p->getId()}" {if $rating==4}checked="checked"{/if}/>
                            <input class="hover-star chs{echo $p->getId()}" type="radio" name="rating-{echo $p->getId()}" value="5" data-id="{echo $p->getId()}" {if $rating==5}checked="checked"{/if}/> 
                    </div>
                    <a href="#" class="response">{echo $p->totalComments()} {echo SStringHelper::Pluralize($p->totalComments(), array('отзыв', 'отзывы', 'отзывов'))}</a>
                    <div class="social_small di_b">
                        <a href="#" class="facebook"></a>
                        <a href="#" class="vkontakte"></a>
                        <a href="#" class="twitter"></a>
                        <a href="#" class="mail"></a>
                    </div>
                </div>	
            <div class="f_l">
                   <div class="buy">
                          <div class="price f-s_18 f_l">{echo $p->firstVariant->toCurrency()}<sub>{$CS}</sub><span class="d_b">{echo $p->firstVariant->toCurrency('Price', 1)} $</span></div>
                          <div class="button_gs buttons">						  
						   {if $p->firstvariant->getstock()== 0}
                        <div class="buttons button_gs">
                            <a id="send-request" href="">Сообщить о появлении</a>
                        </div>
                    {else:}
                        <div class="buttons button_gs">
                            <a href="" class="goBuy" data-prodid="{echo $p->getId()}" data-varid="{echo $p->firstVariant->getId()}" >Купить</a>
                        </div>
                    {/if}
			  </div>
           </div>
              </div>
               <div class="f_r t-a_r">
                 <span class="ajax_refer_marg">
			  {if $forCompareProducts && in_array($p->getId(), $forCompareProducts)}
                <a href="{shop_url('compare')}" class="js gray">Сравнить</a>
                {else:}
                 <a href="{shop_url('compare/add/'. $p->getId())}" data-prodid="{echo $p->getId()}" class="js gray toCompare">Добавить к сравнению</a>
                 {/if}</span>
                 <a data-varid="{echo $p->firstVariant->getId()}" data-prodid="{echo $p->getId()}" href="#" class="js gray addToWList">Сохранить в список желаний</a>
                </div>
                   </div>
              <p class="c_b">
				 {echo $p->getShortDescription()}
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