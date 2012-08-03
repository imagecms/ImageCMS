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
                    {$style = productInCart($cart_data, $p->getId(), $p->firstVariant->getId(), $p->firstVariant->getStock())}
                    <li {if $count == 3} class="last" {$count = 0}{/if} {if $count == 1} style="clear:left;" {/if}>
                        <div class="photo_block">
                            <a href="{shop_url('product/' . $p->getUrl())}">
<!--                                <img src="{productImageUrl($p->getId() . '_small.jpg')}" border="0"  alt="image" />-->
                                <img id="mim{echo $p->getId()}" src="{productImageUrl($p->getId() . '_small.jpg')}" alt="{echo ShopCore::encode($p->name)}" />
                                <img id="vim{echo $p->getId()}" class="smallpimagev" src="" alt="" />
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="{shop_url('product/'.$p->getUrl())}" class="title">{echo ShopCore::encode($p->getName())}</a>
                            <div class="f-s_0">
                                {if $p->firstVariant->getNumber()}<span id="code{echo $p->getId()}" class="code">Код {echo ShopCore::encode($p->firstVariant->getNumber())}</span>{/if}
                                {$rating = $p->getRating()}
                                {if $rating == 0}{$r = "nostar"}    {/if}
                                {if $rating == 1}{$r = "onestar"}   {/if}
                                {if $rating == 2}{$r = "twostar"}   {/if}
                                {if $rating == 3}{$r = "threestar"} {/if}
                                {if $rating == 4}{$r = "fourstar"}  {/if}
                                {if $rating == 5}{$r = "fivestar"}  {/if}
                                <div class="star_rating">
                                    <div id="{echo $p->getId()}_star_rating" class="rating_nohover {echo $r} star_rait" data-id="{echo $p->getId()}">
                                        <div id="1" class="rate one">
                                            <span title="1">1</a>
                                        </div>
                                        <div id="2" class="rate two">
                                            <span title="2">2</a>
                                        </div>
                                        <div id="3" class="rate three">
                                            <span title="3">3</a>
                                        </div>
                                        <div id="4" class="rate four">
                                            <span title="4">4</a>
                                        </div>
                                        <div id="5" class="rate five">
                                            <span title="5">5</a>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="response">{echo $p->totalComments()} {echo SStringHelper::Pluralize($p->totalComments(), array('отзыв', 'отзывы', 'отзывов'))}</a>
                                {if count($p->getProductVariants())>1}
                                    <select class="m-l_10" name="selectVar">
                                        {foreach $p->getProductVariants() as $pv}
                                            <option class="selectVar" value="{echo $pv->getId()}" data-st="{echo $pv->getStock()}" data-cs="{$NextCS}" data-spr="{echo ShopCore::app()->SCurrencyHelper->convert($pv->getPrice(), $NextCSId)}" data-pr="{echo $pv->getPrice()}" data-pid="{echo $p->getId()}" data-img="{echo $pv->getsmallimage()}" data-vname="{echo $pv->getName()}" data-vnumber="{echo $pv->getNumber()}">{echo $pv->getName()}</option>
                                        {/foreach}
                                    </select>
                                {/if}
                            </div>
<!--                            <div class="f_l">
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
                                </div>-->
                            <div class="f_l">
                                <div class="buy">
                                    <div class="price f-s_18 f_l">
                                        <span id="pricem{echo $p->getId()}">{echo $p->firstVariant->toCurrency()}</span>
                                        <sub>{$CS}</sub>
                                        <span id="prices{echo $p->getId()}" class="d_b">{echo $p->firstVariant->toCurrency('Price', $NextCSId)}{$NextCS}</span>
                                    </div>
                                    <div id="p{echo $p->getId()}" class="{$style.class} buttons">
                                        <a id="buy{echo $p->getId()}" class="{$style.identif}" href="{$style.link}" data-varid="{echo $p->firstVariant->getId()}" data-prodid="{echo $p->getId()}" >{$style.message}</a>
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