{# Variables
# @var model
# @var jsCode
# @var products
# @var totalProducts
# @var brandsInCategory
# @var pagination
# @var cart_data
#}

{$forCompareProducts = $CI->session->userdata('shopForCompare')}

<div class="content">
    <div class="center">
        <div class="filter">
            {if count($incats)>0}
                <div class="title padding_filter">{lang('s_found_in_categories')}</div>
                <div style="padding-left: 15px;">
                    <div class="padding_filter">
                        <span style="cursor: pointer;" class="clear_filter" data-url="{site_url($CI->uri->uri_string())}">{lang('s_cancel')}</span><br/>
                    </div>
                    <div class="padding_filter check_frame">
                        <div>
                            {foreach $categories_names as $item}
                            {if ShopCore::$_GET['categoryId'] == $item.id}<b>{$cat_name = $item.name}{/if}
                                <span style="cursor: pointer;" class="findincats" data-id="{echo $item.id}">{$item.name} ({echo $incats[$item.id]})</span></br>
                            {if ShopCore::$_GET['categoryId'] == $item.id}</b>{/if}
                        {/foreach}    
                </div>
            </div>
        </div>
    {else:}
        <div class="title padding_filter">В категориях ничего не найдено</div>
    {/if}
</div>
<div class="catalog_content">
    <div class="catalog_frame">
        <div class="box_title clearfix">
            <div class="f-s_24 f_l">
                <h1 class="d_i">{echo ShopCore::encode($model->getName())} 
                    {if ShopCore::$_GET['categoryId'] != ''}
                        - {echo $cat_name}
                    {/if}</h1>
                <span class="count_search">({$totalProducts})</span>
            </div>
            <div class="f_r">
                <form method="GET" id="orderForm">
                    <input type="hidden" value="{echo ShopCore::$_GET['categoryId']}" name="categoryId"/>
                    <div class="lineForm f_l w_145">
                        <select id="sort" name="order">
                            <option value="rating" {if ShopCore::$_GET['order']=='rating'}selected="selected"{/if}>{lang('s_po')} {lang('s_rating')}</option>
                            <option value="price" {if ShopCore::$_GET['order']=='price'}selected="selected"{/if}>{lang('s_dewevye')}</option>
                            <option value="price_desc" {if ShopCore::$_GET['order']=='price_desc'}selected="selected"{/if} >{lang('s_dor')}</option>
                            <option value="hit" {if ShopCore::$_GET['order']=='hit'}selected="selected"{/if}>{lang('s_popular')}</option>
                            <option value="hot" {if ShopCore::$_GET['order']=='hot'}selected="selected"{/if}>{lang('s_new')}</option>
                            <option value="action" {if ShopCore::$_GET['order']=='action'}selected="selected"{/if}>{lang('s_action')}</option>
                        </select>
                    </div>
                    <div class="lineForm f_l w_50 m-l_10">
                        <select id="count" name="user_per_page">
                            <option value="12" {if ShopCore::$_GET['user_per_page']=='12'}selected="selected"{/if} >12</option>
                            <option value="24" {if ShopCore::$_GET['user_per_page']=='24'}selected="selected"{/if} >24</option>
                            <option value="36" {if ShopCore::$_GET['user_per_page']=='36'}selected="selected"{/if} >36</option>
                        </select>
                    </div>
                {if isset($_GET['lp'])}<input type="hidden" name="lp" value="{echo $_GET['lp']}">{/if}
            {if isset($_GET['rp'])}<input type="hidden" name="rp" value="{echo $_GET['rp']}">{/if}
        </form> 
    </div>
</div>
<ul>
    {if $page_number == 1}
        <li>
            <p>{echo $model->getDescription()}</p>
        </li>
    {/if}
    <!--  Render produts list   -->
    {foreach $products as $product}
        {$discount = ShopCore::app()->SDiscountsManager->productDiscount($product->id)}
        {$style = productInCart($cart_data, $product->getId(), $product->firstVariant->getId(), $product->firstVariant->getStock())}
        <li {if $product->firstvariant->getstock()== 0}class="not_avail"{/if}>
            <div class="photo_block">
                <a href="{shop_url('product/' . $product->getUrl())}">
                    <img id="mim{echo $product->getId()}" src="{productImageUrl($product->getMainModimage())}" alt="{echo ShopCore::encode($product->name)} - {echo $product->getId()}" />
                    <img id="vim{echo $product->getId()}" class="smallpimagev" src="" alt="" />
                    {if $product->getHot() == 1}
                        <div class="promoblock">{lang('s_shot')}</div>
                    {/if}
                    {if $product->getAction() == 1}
                        <div class="promoblock">{lang('s_saction')}</div>
                    {/if}
                    {if $product->getHit() == 1}
                        <div class="promoblock">{lang('s_s_hit')}</div>
                    {/if}
                </a>
            </div>
            <div class="func_description">
                <a href="{shop_url('product/' . $product->getUrl())}" class="title">{echo ShopCore::encode($product->name)}</a>
                <div class="f-s_0">
                    <!--    Show Product Number -->
                    {if $product->firstVariant->getNumber()}
                        <span id="code{echo $product->getId()}" class="code">{lang('s_kod')} {echo ShopCore::encode($product->firstVariant->getNumber())}</span>
                    {/if}
                    <!--    Show Product Number -->
                    <div class="star_rating">
                        <div id="star_rating{echo $product->getId()}" class="rating_nohover {echo count_star($product->getRating())} star_rait" data-id="{echo $product->getId()}">
                            <div id="1" class="rate one">
                                <span title="1">1</span>
                            </div>
                            <div id="2" class="rate two">
                                <span title="2">2</span>
                            </div>
                            <div id="3" class="rate three">
                                <span title="3">3</span>
                            </div>
                            <div id="4" class="rate four">
                                <span title="4">4</span>
                            </div>
                            <div id="5" class="rate five">
                                <span title="5">5</span>
                            </div>
                        </div>
                    </div>
                    <!--    Show Comments count -->
                    <a href="{shop_url('product/'.$product->getId().'?cmn=on')}"  class="response">
                        {echo $product->totalComments()} {echo SStringHelper::Pluralize($product->totalComments(), array(lang('s_review_on'), lang('s_review_tw'), lang('s_review_tre')))}
                    </a>
                    <!--    Show Comments count -->
                    {if count($product->getProductVariants())>1}
                        <select class="m-l_10" name="selectVar">
                            {foreach $product->getProductVariants() as $pv}
                                {$variant_prices = currency_convert($pv->getPrice(), $pv->getCurrency())}
                                <option class="selectVar"
                                        value="{echo $pv->getId()}" 
                                        data-st="{echo $pv->getStock()}" 
                                        data-cs="{$variant_prices.second.symbol}" 
                                        data-spr="{echo $variant_prices.second.price}" 
                                        data-pr="{echo $variant_prices.main.price}" 
                                        data-pid="{echo $product->getId()}" 
                                        data-img="{echo $pv->getsmallimage()}" 
                                        data-vname="{echo $pv->getName()}" 
                                        data-vnumber="{echo $pv->getNumber()}">
                                    {echo $pv->getName()}
                                </option>
                            {/foreach}
                        </select>
                    {/if}
                </div>
                {$prices = currency_convert($product->firstvariant->getPrice(), $product->firstvariant->getCurrency())}
                <div class="f_l">
                    <div class="buy">
                        <div class="price f-s_18 f_l">
                            {if $product->getOldPrice() > 0}
                                {if $product->getOldPrice() > $product->firstVariant->getPriceInMain()}
                                    <div>
                                        <del class="price f-s_12 price-c_9" style="margin-top: 1px;">
                                            {echo $product->getOldPrice()}
                                            <sub> {$CS}</sub>
                                        </del>
                                    </div>
                                {/if}
                            {/if}
                            <span id="pricem{echo $product->getId()}">

                                {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                    {$prOne = $prices.main.price}
                                    {$prTwo = $prices.main.price}
                                    {$prThree = $prOne - $prTwo / 100 * $discount}
                                    <del class="price price-c_red f-s_12 price-c_9">{echo $prices.main.price} {$prices.main.symbol}</del><br /> 
                                {else:}
                                    {$prThree = $prices.main.price}
                                {/if}
                                {echo $prThree} 
                                <sub>{$prices.main.symbol}</sub>

                                {if $NextCS != $CS AND empty($discount)}
                                    <span class="d_b">{echo $prices.second.price} {$prices.second.symbol}</span>
                                {/if}
                        </div>
                        <div id="p{echo $product->getId()}" class="{$style.class} buttons">
                            <span id="buy{echo $product->getId()}" class="{$style.identif}" href="{$style.link}" data-varid="{echo $product->firstVariant->getId()}" data-prodid="{echo $product->getId()}" >{$style.message}</span>
                        </div>
                    </div>
                </div>
                <div class="f_r t-a_r">
                    <span class="ajax_refer_marg">
                        {if $forCompareProducts && in_array($product->getId(), $forCompareProducts)}
                            <a href="{shop_url('compare')}" class="">{lang('s_compare')}</a>
                        {else:}
                            <span data-prodid="{echo $product->getId()}" class="js gray toCompare">{lang('s_compare_add')}</span>
                        {/if}
                    </span>
                    {if !is_in_wish($product->getId())}
                        <a data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}" data-varid="{echo $product->firstVariant->getId()}" data-prodid="{echo $product->getId()}" href="#" class="js gray addToWList">{lang('s_save_W_L')}</a>
                    {else:}
                        <a href="/shop/wish_list">{lang('s_ilw')}</a>
                    {/if}
                </div>
            </div>
            {if $product->countProperties() > 0}
                <p class="c_b">
                    {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInline($product)}
                    <a href="{shop_url('product/' . $product->getUrl())}" class="t-d_n"><span class="t-d_u">{lang('s_more')}</span> ></a>
                </p>
            {/if}
        </li>
    {/foreach}
    <!--  Render produts list   -->
</ul>
<!--    Pagination    -->
<div class="pagination"><div class="t-a_c">{$pagination}</div></div>
<!--    Pagination    -->
</div>

<!--   Right sidebar     -->
<div class="nowelty_auction">
    <!--   New products block     -->
    {if count(getPromoBlock('hot', 3, '', $model->getId()))}
        <div class="box_title">
            <span>{lang('s_new')}</span>
        </div>               
        <ul>
            {foreach getPromoBlock('hot', 3, '', $model->getId()) as $hotProduct}
                {$discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)}
                {$hot_prices = currency_convert($hotProduct->firstVariant->getPrice(), $hotProduct->firstVariant->getCurrency())}
                <li class="smallest_item">
                    <div class="photo_block">
                        <a href="{shop_url('product/' . $hotProduct->getUrl())}">
                            <img src="{productImageUrl($hotProduct->getSmallModimage())}" alt="{echo ShopCore::encode($hotProduct->getName())}" />
                        </a>
                    </div>
                    <div class="func_description">
                        <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                        <div class="buy">
                            <div class="price f-s_14">                                
                                {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                    {$prOne = $hot_prices.main.price}
                                    {$prTwo = $hot_prices.main.price}
                                    {$prThree = $prOne - $prTwo / 100 * $discount}
                                    <del class="price price-c_red f-s_12 price-c_9">{echo $hot_prices.main.price} {$hot_prices.main.symbol}</del><br /> 
                                {else:}
                                    {$prThree = $hot_prices.main.price}
                                {/if}
                                {echo $prThree} 
                                <sub>{$hot_prices.second.symbol}</sub>

                                {if $NextCS != $CS AND empty($discount)}
                                    <span class="d_b">{echo $hot_prices.second.price} {$hot_prices.second.symbol}</span>
                                {/if}
                            </div>
                        </div>
                    </div>
                </li>
            {/foreach}
        </ul>
    {/if}
    <!--   New products block     -->

    <!--   Promo products block     -->
    {if count(getPromoBlock('action', 3, '', $model->getId()))}
        <div class="box_title">
            <span>{lang('s_action')}</span>
        </div>
        <ul>
            {foreach getPromoBlock('action', 3, '', $model->getId()) as $hotProduct}
                {$discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)}
                {$action_prices = currency_convert($hotProduct->firstVariant->getPrice(), $hotProduct->firstVariant->getCurrency())}
                <li class="smallest_item">
                    <div class="photo_block">
                        <a href="{shop_url('product/' . $hotProduct->getUrl())}">
                            <img src="{productImageUrl($hotProduct->getSmallModImage())}" alt="{echo ShopCore::encode($hotProduct->getName())}" />
                        </a>
                    </div>
                    <div class="func_description">
                        <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                        <div class="buy">
                            <div class="price f-s_14">

                                {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                    {$prOne = $action_prices.main.price}
                                    {$prTwo = $action_prices.main.price}
                                    {$prThree = $prOne - $prTwo / 100 * $discount}
                                    <del class="price price-c_red f-s_12 price-c_9">{echo $action_prices.main.price} {$action_prices.main.symbol}</del><br /> 
                                {else:}
                                    {$prThree = $action_prices.main.price}
                                {/if}
                                {echo $prThree} 
                                <sub>{$action_prices.second.symbol}</sub>

                                {if $NextCS != $CS AND empty($discount)}
                                    <span class="d_b">{echo $action_prices.second.price} {$action_prices.second.symbol}</span>
                                {/if}
                            </div>
                        </div>
                    </div>
                </li>
            {/foreach}
        </ul>
    {/if}
    {widget('latest_news')}
    <!--   Promo products block     -->
</div>
<!--   Right sidebar     -->
</div>
</div>
</div>