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
                        <input type="hidden" name="user_per_page" id="h_user_per_page" value="{echo ShopCore::$_GET['user_per_page']}" />
                        {foreach $tree as $item}
                        {if $item->getLevel() == 0}
                        <div class="sub_title">
                            {foreach $item->getSubtree() as $subItem}
                            {$count_item = $categorys[$subItem->getId()];}
                            {if $count_item}
                            {echo $item->getName()}{break;}
                            {/if}
                            {/foreach}
                        </div>
                        <ul class="menu_fiter">
                            {foreach $item->getSubtree() as $subItem}
                            {$count_item = $categorys[$subItem->getId()];}
                            {if $count_item}
                            <li{if $_GET['category'] && $_GET['category'] == $subItem->getId()} class="active"{/if}>
                                <a href="{echo $subItem->getId()}">{echo $subItem->getName()}</a> 
                                <span>({echo $count_item})</span>
                            </li>
                            {/if}
                            {/foreach}
                        </ul>
                        {/if}
                        {/foreach}
                </div>
            </div>
            </form>
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
                                    <div class="price f-s_18 f_l">{echo $p->firstVariant->toCurrency()}<sub>{$CS}</sub><span class="d_b">{echo $p->firstVariant->toCurrency('Price', $NextCSId)} {$NextCS}</span></div>
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
                                <a data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}" data-varid="{echo $p->firstVariant->getId()}" data-prodid="{echo $p->getId()}" href="#" class="js gray addToWList">Сохранить в список желаний</a>
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
                {if $pagination}<div class="pagination"><div class="t-a_c">{$pagination}</div></div>{/if}
                {else:}
                <p>
                    {echo ShopCore::t('По вашему запросу ничего не найдено')}.
                </p>
                {/if}
            </div>
        </div>
    </div>
</div>