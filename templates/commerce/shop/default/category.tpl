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
        {include_tpl('filter')}
        <div class="catalog_content">
            <div class="catalog_frame">
                <div class="crumbs">{renderCategoryPath($model)}</div>
                <div class="box_title clearfix">
                    <div class="f-s_24 f_l">
                        {echo ShopCore::encode($model->getTitle())}
                        <span class="count_search">({$totalProducts})</span>
                    </div>
                    <div class="f_r">
                        <form method="GET">
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
                {if $model->getDescription() != ''}
                    <li>
                        {echo $model->getDescription()}
                    </li>
                {/if}
            {/if}
            <!--  Render produts list   -->
            {foreach $products as $product}
                {$style = productInCart($cart_data, $product->getId(), $product->firstVariant->getId(), $product->firstVariant->getStock())}
                {$prices = currency_convert($product->firstvariant->getPrice(), $product->firstvariant->getCurrency())}
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
                            {if $product->firstVariant->getNumber()}
                                <span id="code{echo $product->getId()}" class="code">
                                    {lang('s_kod')} {echo ShopCore::encode($product->firstVariant->getNumber())}
                                </span>
                            {/if}
                            <div class="star_rating">
                                <div id="{echo $model->getId()}_star_rating" class="rating_nohover {echo count_star($product->getRating())} star_rait" data-id="{echo $model->getId()}">
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
                            <a href="{shop_url('product/'.$product->getId().'#four')}" rel="nofollow"  class="response">
                                {echo $product->totalComments()}
                                {echo SStringHelper::Pluralize($product->totalComments(), array(lang('s_review_on'), lang('s_review_tw'), lang('s_review_tre')))}
                            </a>
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
                                            {if $pv->getName() != ''}
                                                <i>{echo $pv->getName()}</i><b>: {echo $var_prices.main.price}</b> {$var_prices.main.symbol}
                                            {else:}
                                                <i>{echo $product->getName()}</i><b>: {echo $var_prices.main.price}</b> {$var_prices.main.symbol}
                                            {/if}
                                        </option>
                                    {/foreach}
                                </select>
                            {/if}
                        </div>
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
                                        {echo $prices.main.price}
                                    </span>
                                    <sub>{$prices.main.symbol}</sub>
                                    {if $NextCS != $CS}
                                        <span id="prices{echo $product->getId()}" class="d_b">{echo $prices.second.price} {$prices.second.symbol}</span>
                                    {/if}
                                </div>
                                <div id="p{echo $product->getId()}" class="{$style.class} buttons">
                                    <span id="buy{echo $product->getId()}"
                                          class="{$style.identif}"
                                          data-varid="{echo $product->firstVariant->getId()}"
                                          data-prodid="{echo $product->getId()}">
                                        {$style.message}
                                    </span>
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
                                <a data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}"
                                   data-varid="{echo $product->firstVariant->getId()}"
                                   data-prodid="{echo $product->getId()}"
                                   href="#"
                                   class="js gray addToWList">
                                    {lang('s_slw')}
                                </a>
                            {else:}
                                <a href="/shop/wish_list">{lang('s_ilw')}</a>
                            {/if}
                        </div>
                        {if $product->countProperties() > 0}
                            <p class="c_b">
                                {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInline($product)}
                                <a href="{shop_url('product/' . $product->getUrl())}" class="t-d_n"><span class="t-d_u">{lang('s_more')}</span> →</a>
                            </p>
                        {/if}
                    </div>
                </li>
            {/foreach}
        </ul>
        <div class="pagination">
            <div class="t-a_c">{$pagination}</div>
        </div>
    </div>
    <!--   Right sidebar     -->
    <div class="nowelty_auction">
        <!--   New products block     -->
        {if count(getPromoBlock('hot', 3, $product->category_id))}
            <div class="box_title">
                <span>{lang('s_new')}</span>
            </div>
            <ul>
                {foreach getPromoBlock('hot', 3, $product->category_id) as $hotProduct}
                    {$discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)}
                    {$hot_prices = currency_convert($hotProduct->firstVariant->getPrice(), $hotProduct->firstVariant->getCurrency())}
                    <li class="smallest_item">
                        <div class="photo_block">
                            <a href="{shop_url('product/' . $hotProduct->getUrl())}">
                                <img src="{productImageUrl($hotProduct->getSmallModimage())}" alt="{echo ShopCore::encode($hotProduct->getName())} - {echo $hotProduct->getId()}" />
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
                                        <div class="price f-s_14">{echo $hot_prices.main.price}
                                        {/if}
                                        {echo $prThree} 
                                        <sub>{$hot_prices.main.symbol}</sub>

                                        {if $NextCS != $CS}
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
        {if count(getPromoBlock('action', 3, $product->category_id))}
            <div class="box_title">
                <span>{lang('s_action')}</span>
            </div>
            <ul>
                {foreach getPromoBlock('action', 3, $product->category_id) as $hotProduct}
                    {$action_prices = currency_convert($hotProduct->firstVariant->getPrice(), $hotProduct->firstVariant->getCurrency())}
                    <li class="smallest_item">
                        <div class="photo_block">
                            <a href="{shop_url('product/' . $hotProduct->getUrl())}">
                                <img src="{productImageUrl($hotProduct->getSmallModImage())}" alt="{echo ShopCore::encode($hotProduct->getName())} - {echo $hotProduct->getId()}" />
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                            <div class="buy">
                                <div class="price f-s_14">{echo $action_prices.main.price}
                                    <sub>{$action_prices.main.symbol}</sub>
                                    {if $NextCS != $CS}
                                        <span class="d_b">{echo $action_prices.second.price} {$action_prices.second.symbol}</span>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </li>
                {/foreach}
            </ul>
        {/if}
        <!--   Promo products block     -->

        {widget('latest_news')}
    </div>
    <!--   Right sidebar     -->
</div>
{widget('latest_news')}  
<!--   Promo products block     -->
</div>
<!--   Right sidebar     -->
</div>
</div>
</div>