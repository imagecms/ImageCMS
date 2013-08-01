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
<link rel="stylesheet" type="text/css" href="{$THEME}js/rating/jquery.rating-min.css" />
<script src="{$THEME}js/rating/jquery.rating-min.js" type="text/javascript"></script>
<script src="{$THEME}js/rating/jquery.MetaData-min.js" type="text/javascript"></script>
<script src="{$THEME}js/search.js" type="text/javascript"></script>
<!-- END STAR RATING -->
<!--
{include_tpl('sidebar')}
-->


<div class="content">
    <div class="center">
        <div class="filter">
            <div class="title padding_filter">{lang("Found in categories","admin")}:</div>
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
                                        {$count_item = $categories[$subItem->getId()];}
                                        {if $count_item}
                                            {echo $item->getName()}{break;}
                                        {/if}
                                    {/foreach}
                                </div>
                                <ul class="menu_fiter">
                                    {foreach $item->getSubtree() as $subItem}
                                        {$count_item = $categories[$subItem->getId()];}
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
                    </form>
                </div>
                {widget('latest_news')}
            </div>
        </div>
        <div class="catalog_content">
            <div class="catalog_frame">
                <div class="box_title clearfix">
                    <div class="f-s_24 f_l">
                        {if !empty(ShopCore::$_GET['text'])}
                            {lang("You searched for","admin")}: "<span class="highlight">{encode($_GET['text'])}</span>"
                        {/if}
                        <span class="count_search">
                            ({$totalProducts}) {echo SStringHelper::Pluralize($totalProducts, array(lang("product","admin"), lang("product","admin"), lang("product","admin")))}
                        </span>
                    </div>
                </div>
                <div class="c_b"></div>
                {if $totalProducts > 0}
                    <ul class="products">
                        {foreach $products as $p}
                            {$style = productInCart($cart_data, $p->getId(), $p->firstVariant->getId(), $p->firstVariant->getStock())}
                            <li>
                                <div class="photo_block">
                                    <a href="{shop_url('product/' . $p->getUrl())}">
                                            <!--                                <img src="{productImageUrl($p->getId() . '_small.jpg')}" border="0"  alt="image" />-->
                                        <img id="mim{echo $p->getId()}" src="{productImageUrl($p->getMainModimage())}" alt="{echo ShopCore::encode($p->name)} - {echo $p->getId()}" />
                                        <img id="vim{echo $p->getId()}" class="smallpimagev" src="" alt="" />
                                    </a>
                                    <span class="ajax_refer_marg t-a_c">
                                        <span data-prodid="{echo $p->getId()}" class="compare
                                              {if $forCompareProducts && in_array($p->getId(), $forCompareProducts)}
                                                  is_avail">
                                                  <a href="{shop_url('compare')}" class="red">{lang("Compare","admin")}</a>
                                              {else:}
                                                  toCompare blue">
                                                  <span class="js blue">{lang("Add to compare","admin")}</span>
                                                  <a href="{shop_url('compare')}" class="red" style="display: none;">{lang("Compare","admin")}</a>
                                              {/if}
                                        </span>
                                    </span>
                                </div>
                                <div class="func_description">
                                    <a href="{shop_url('product/'.$p->getUrl())}" class="title">{echo ShopCore::encode($p->getName())}</a>
                                    <div class="f-s_0">
                                        {if $p->firstVariant->getNumber()}
                                            <span id="code{echo $p->getId()}" class="code">{lang("ID","admin")} {echo ShopCore::encode($p->firstVariant->getNumber())}</span>
                                        {/if}
                                        <div class="star_rating">
                                            {$CI->load->module('star_rating')->show_star_rating($p)}
                                        </div>
                                        <a href="#" class="response">{echo $p->totalComments()} {echo SStringHelper::Pluralize($p->totalComments(), array(lang("review","admin"), lang("reviews","admin"), lang("review","admin")))}</a>
                                    </div>
                                    {if count($p->getProductVariants())>1}
                                        <select class="m-l_10" name="selectVar">
                                            {foreach $p->getProductVariants() as $pv}
                                                {$variant_prices = currency_convert($pv->getPrice(), $pv->getCurrency())}
                                                <option class="selectVar" 
                                                        value="{echo $pv->getId()}" 
                                                        data-cs="{$CS}" 
                                                        data-st="{echo $pv->getStock()}" 
                                                        data-cs="{echo $variant_prices.second.symbol}" 
                                                        data-spr="{echo $variant_prices.second.price}" 
                                                        data-pr="{echo $variant_prices.main.price}" 
                                                        data-pid="{echo $p->getId()}" 
                                                        data-img-small="{echo $pv->getSmallImage()}" 
                                                        data-vname="{echo $pv->getName()}" 
                                                        data-vnumber="{echo $pv->getNumber()}">
                                                    {if $pv->getName() != ''}
                                                        {echo $pv->getName()}
                                                    {else:}
                                                        {echo $p->getName()}
                                                    {/if}
                                                </option>
                                            {/foreach}
                                        </select>
                                    {/if}
                                    <div class="buy">
                                        <div class="price f-s_18 d_b">
                                            {if (float)$p->getOldPrice() > 0}
                                                {if $p->getOldPrice() > $p->firstvariant->getPrice()}
                                                    <div>
                                                        <del class="price f-s_12 price-c_9" style="margin-top: 1px;">
                                                            {echo number_format($p->getOldPrice(), ShopCore::app()->SSettings->pricePrecision, ".", "")}
                                                            <sub> {$CS}</sub>
                                                        </del>
                                                    </div>
                                                {/if}
                                            {/if}
                                            <div id="pricem{echo $p->getId()}">
                                                {if $p->hasDiscounts()}                                                   
                                                    <del class="price price-c_red f-s_12 price-c_9">{echo $p->firstvariant->toCurrency('OrigPrice')} {$CS}</del>
                                                {/if}
                                                {echo $p->firstvariant->toCurrency()} 
                                                <sub>{$CS}</sub>
                                            </div>
                                        </div>
                                        <div id="p{echo $p->getId()}" class="{$style.class} buttons">
                                            <span id="buy{echo $p->getId()}" class="{$style.identif}" data-varid="{echo $p->firstVariant->getId()}" data-prodid="{echo $p->getId()}" >
                                                {$style.message}
                                            </span>
                                        </div>
                                        <span class="frame_wish-list">
                                            {if !is_in_wish($p->id)}
                                                <span data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}"
                                                      data-varid="{echo $p->firstVariant->getId()}"
                                                      data-prodid="{echo $p->getId()}"
                                                      class="addToWList">
                                                    <span class="icon-wish"></span>
                                                    <span class="js blue">{lang("Save to Wish List","admin")}</span>
                                                </span>
                                                <a href="/shop/wish_list" class="red" style="display:none;"><span class="icon-wish"></span>{lang("Already wishlist","admin")}</a>
                                            {else:}
                                                <a href="/shop/wish_list" class="red"><span class="icon-wish"></span>{lang("Already wishlist","admin")}</a>
                                            {/if}
                                        </span> 
                                    </div>
                                    {if $p->getShortDescription()!=""}
                                        <p class="c_b">
                                            {echo $p->getShortDescription()}
                                            <a href="{shop_url('product/'.$p->getUrl())}" class="t-d_n"><span class="t-d_u">{lang("More","admin")}</span> →</a>
                                        </p>
                                    {/if}
                                </div>
                            </li>
                        {/foreach}
                    </ul>
                    {if $pagination}
                        <div class="pagination"><div class="t-a_c">{$pagination}</div></div>
                    {/if}
                {else:}
                    <p>
                        {echo ShopCore::t(lang("Your search did not match","admin"))}.
                    </p>
                {/if}
            </div>
        </div>
    </div>
</div>
