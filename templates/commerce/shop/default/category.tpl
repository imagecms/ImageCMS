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
                <div class="crumbs">{echo $crumbs}</div>
                <div class="box_title clearfix">
                    <div class="f-s_24">
                        {echo ShopCore::encode($model->name)}
                        <span class="count_search">({$totalProducts})</span>
                    </div>
                </div>
                <form method="GET">
                    <div class="f_l">
                        <span class="v-a_m">Сортировать:&nbsp;</span>
                        <div class="lineForm w_145 v-a_m">
                            <select id="sort" name="order">
                                <option value="" {if !ShopCore::$_GET['order']}selected="selected"{/if}>-Нет-</option>
                                <option value="rating" {if ShopCore::$_GET['order']=='rating'}selected="selected"{/if}>{lang('s_po')} {lang('s_rating')}</option>
                                <option value="price" {if ShopCore::$_GET['order']=='price'}selected="selected"{/if}>{lang('s_dewevye')}</option>
                                <option value="price_desc" {if ShopCore::$_GET['order']=='price_desc'}selected="selected"{/if} >{lang('s_dor')}</option>
                                <option value="hit" {if ShopCore::$_GET['order']=='hit'}selected="selected"{/if}>{lang('s_popular')}</option>
                                <option value="hot" {if ShopCore::$_GET['order']=='hot'}selected="selected"{/if}>{lang('s_new')}</option>
                                <option value="action" {if ShopCore::$_GET['order']=='action'}selected="selected"{/if}>{lang('s_action')}</option>
                            </select>
                        </div>
                    </div>
                    <div class="f_r">
                        <span class="v-a_m">Товаров на странице:&nbsp;</span>
                        <div class="lineForm w_50 v-a_m">
                            <select id="count" name="user_per_page">
                                <option value="12" {if ShopCore::$_GET['user_per_page']=='12'}selected="selected"{/if} >12</option>
                                <option value="24" {if ShopCore::$_GET['user_per_page']=='24'}selected="selected"{/if} >24</option>
                                <option value="36" {if ShopCore::$_GET['user_per_page']=='36'}selected="selected"{/if} >36</option>
                            </select>
                        </div>
                    </div>
                {if isset($_GET['lp'])}<input type="hidden" name="lp" value="{echo $_GET['lp']}">{/if}
            {if isset($_GET['rp'])}<input type="hidden" name="rp" value="{echo $_GET['rp']}">{/if}
        </form>
        <ul>
            {if (int)$pageNumber == 1}
                {if $model->description != ''}
                    <li>
                        <div class="box_title">
                <span class="f-s_18">Описание</span>
            </div>
                        {echo $model->description}
                    </li>
                {/if}
            {/if}
            <!--  Render produts list   -->
            {foreach $products as $product}
                {$style = productInCart($cart_data, (int)$product->id, (int)$product->variants[0]->id, (int)$product->variants[0]->stock)}
                {$prices = currency_convert($product->variants[0]->price, $product->variants[0]->currency)}
                <li {if $product->variants[0]->stock == 0}class="not_avail"{/if}>
                    <div class="photo_block">
                        <a href="{shop_url('product/' . $product->url)}">
                            <img id="mim{echo $product->id}" src="{productImageUrl($product->mainModImage)}" alt="{echo ShopCore::encode($product->name)} - {echo $product->id}" />
                            <img id="vim{echo $product->id}" class="smallpimagev" src="" alt="" />
                            {if $product->hot == 1}
                                <div class="promoblock nowelty">{lang('s_shot')}</div>
                            {/if}
                            {if $product->action == 1}
                                <div class="promoblock action">{lang('s_saction')}</div>
                            {/if}
                            {if $product->hit == 1}
                                {$discount = ShopCore::app()->SDiscountsManager->productDiscount($product->id)}
                                <div class="promoblock hit">{lang('s_s_hit')}</div>
                            {/if}
                        </a>
                        <span class="ajax_refer_marg t-a_c">
                            <span data-prodid="{echo $product->id}" class="compare
                                  {if $forCompareProducts && in_array($product->id, $forCompareProducts)}
                                      is_avail">
                                      <a href="{shop_url('compare')}" class="red">{lang('s_compare')}</a>
                                  {else:}
                                      toCompare blue">
                                      <span class="js blue">{lang('s_compare_add')}</span>
                                      <a href="{shop_url('compare')}" class="red" style="display: none;">{lang('s_compare')}</a>
                                  {/if}
                            </span>
                        </span>
                    </div>
                    <div class="func_description">
                        <a href="{shop_url('product/' . $product->url)}" class="title">{echo ShopCore::encode($product->name)}</a>
                        <div class="f-s_0">
                            {if $product->variants[0]->number}
                                <span id="code{echo $product->id}" class="code">
                                    {lang('s_kod')} {echo ShopCore::encode($product->variants[0]->number)}
                                </span>
                            {/if}
                            <div class="star_rating">
                                <div id="{echo $model->id}_star_rating" class="rating_nohover {echo count_star(countRating($product->id))} star_rait" data-id="{echo $model->id}">
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
                            <a href="{shop_url('product/'.$product->id.'#four')}" rel="nofollow"  class="response">
                                {totalComments($product->id)}
                                {echo SStringHelper::Pluralize((int)totalComments($product->id), array(lang('s_review_on'), lang('s_review_tw'), lang('s_review_tre')))}
                            </a>
                            {if count($product->variants)>1}
                                <select class="m-l_10" name="selectVar">
                                    {foreach $product->variants as $pv}
                                        {$variant_prices = currency_convert($pv->price, $pv->currency)}
                                        <option class="selectVar"
                                                value="{echo $pv->id}"
                                                data-st="{echo $pv->stock}"
                                                data-cs="{$variant_prices.second.symbol}"
                                                data-spr="{echo number_format($variant_prices.second.price, 2, ".", "")}"
                                                data-pr="{echo number_format($variant_prices.main.price, 2 , ".", "")}"
                                                data-pid="{echo $product->id}"
                                                data-img="{echo $pv->smallimage}"
                                                data-vname="{echo $pv->name}"
                                                data-vnumber="{echo $pv->number}">
                                            {echo $pv->name}
                                        </option>
                                    {/foreach}
                                </select>
                            {/if}
                        </div>
                        <div class="f_l">
                            <div class="buy">
                                <div class="price f-s_18 f_l">
                                    {if (float)$product->old_price > 0}
                                        {if $product->old_price > $product->price_in_main}
                                            <div>
                                                <del class="price f-s_12 price-c_9" style="margin-top: 1px;">
                                                    {echo number_format($product->old_price, 2, ".", "")}
                                                    <sub> {$CS}</sub>
                                                </del>
                                            </div>
                                        {/if}
                                    {/if}
                                    <span id="pricem{echo $product->id}">
                                        {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                            {$prOne = $prices.main.price}
                                            {$prTwo = $prices.main.price}
                                            {$prThree = $prOne - $prTwo / 100 * $discount}
                                            <del class="price price-c_red f-s_12 price-c_9">{echo number_format($prices.main.price, 2, ".", "")} {$prices.main.symbol}</del><br /> 
                                        {else:}
                                            <div class="price f-s_14">{//echo number_format($prices.main.price, 2, ".", "")}
                                                {$prThree = $prices.main.price}
                                            {/if}
                                            {echo number_format($prThree, 2, ".", "")} 
                                            <sub>{$prices.main.symbol}</sub>
                                            {if $NextCS != $CS AND empty($discount)}
                                                <span class="d_b">{echo number_format($prices.second.price, 2, ".", "")} {$prices.second.symbol}</span>
                                            {/if}
                                    </span>
                                </div>
                            </div>
                            <div id="p{echo $product->id}" class="{$style.class} buttons">
                                <span id="buy{echo $product->id}"
                                      class="{$style.identif}"
                                      data-varid="{echo $product->variants[0]->id}"
                                      data-prodid="{echo $product->id}">
                                    {$style.message}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="f_r t-a_r">
                        {if !is_in_wish($product->id)}
                            <a data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}"
                               data-varid="{echo $product->variants[0]->id}"
                               data-prodid="{echo $product->id}"
                               href="#"
                               class="js gray addToWList">
                                {lang('s_slw')}
                            </a>
                        {else:}
                            <a href="/shop/wish_list">{lang('s_ilw')}</a>
                        {/if}
                    </div>
                    </div>
                    {if ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->id)}
                        <p class="c_b">
                            {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->id)}
                            <a href="{shop_url('product/' . $product->url)}" class="t-d_n"><span class="t-d_u">{lang('s_more')}</span> →</a>
                        </p>
                    {/if}
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
                                        <del class="price price-c_red f-s_12 price-c_9">{echo number_format($hot_prices.main.price, 2, ".", "")} {$hot_prices.main.symbol}</del><br /> 
                                    {else:}
                                        <div class="price f-s_14">{echo number_format($hot_prices.main.price, 2, ".", "")}
                                        {/if}
                                        {echo number_format($prThree, 2, ".", "")} 
                                        <sub>{$hot_prices.main.symbol}</sub>

                                        {if $NextCS != $CS AND empty($discount)}
                                            <span class="d_b">{echo number_format($hot_prices.second.price, 2, ".", "")} {$hot_prices.second.symbol}</span>
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
                    {$discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)}
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
                                <div class="price f-s_14">
                                    {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                        {$prOne = $action_prices.main.price}
                                        {$prTwo = $action_prices.main.price}
                                        {$prThree = $prOne - $prTwo / 100 * $discount}
                                        <del class="price price-c_red f-s_12 price-c_9">{echo number_format($action_prices.main.price, 2, ".", "")} {$action_prices.main.symbol}</del><br /> 
                                    {else:}
                                        <div class="price f-s_14">{echo number_format($action_prices.main.price, 2, ".", "")}
                                        {/if}
                                        {echo number_format($prThree, 2, ".", "")} 
                                        <sub>{$action_prices.main.symbol}</sub>

                                        {if $NextCS != $CS AND empty($discount)}
                                            <span class="d_b">{echo number_format($action_prices.second.price, 2, ".", "")} {$action_prices.second.symbol}</span>
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
</div>
</div>