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
{$cart_data = ShopCore::app()->SCart->getData()}
<div class="content">
    <div class="center">
        <div class="filter">
            {if count($incats)>0}
                <form id="orderForm" method="get">
                    <input type="hidden" name="categoryId" value=""/>
                    <div class="title">{lang('s_found_in_categories')}</div>
                    <div class="padding_filter check_frame">
                        <ul class="menu_fiter">
                            {foreach $categories_names as $item}
                                <li>
                                {if ShopCore::$_GET['categoryId'] == $item.id}<b class="c_d">{$cat_name = $item.name}{/if}
                                    <span class="findincats js gray" data-id="{echo $item.id}">{$item.name} ({echo $incats[$item.id]})</span>
                                {if ShopCore::$_GET['categoryId'] == $item.id}</b>{/if}
                            {/foreach}
                    </li>
                </ul>
            </div>
            <span class="clear_filter" data-url="{site_url($CI->uri->uri_string())}"><span class="icon-reset"></span>{lang('s_cancel')}</span><br/>
        </form>
    {else:}
        <div class="title padding_filter">В категориях ничего не найдено</div>
    {/if}
</div>
<div class="catalog_content">
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
                                        {$prOne = $hotProduct->firstVariant->getPrice()}
                                        {$prTwo = $hotProduct->firstVariant->getPrice()}
                                        {$prThree = $prOne - $prTwo / 100 * $discount}
                                        <del class="price price-c_red f-s_12 price-c_9">{echo $hotProduct->firstVariant->getPrice()} {$CS}</del><br /> 
                                    {else:}
                                        {$prThree = $hotProduct->firstVariant->getPrice()}
                                    {/if}
                                    {echo $prThree} 
                                    <sub>{$CS}</sub>
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
                                        {$prOne = $hotProduct->firstVariant->getPrice()}
                                        {$prTwo = $hotProduct->firstVariant->getPrice()}
                                        {$prThree = $prOne - $prTwo / 100 * $discount}
                                        <del class="price price-c_red f-s_12 price-c_9">{echo $hotProduct->firstVariant->getPrice()} {$CS}</del><br /> 
                                    {else:}
                                        {$prThree = $hotProduct->firstVariant->getPrice()}
                                    {/if}
                                    {echo $prThree} 
                                    <sub>{$CS}</sub>
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
    <div class="catalog_frame">
        <div class="box_title clearfix">
            <div class="f-s_24">
                <h1 class="d_i">{echo ShopCore::encode($model->getName())} 
                    {if ShopCore::$_GET['categoryId'] != ''}
                        - {echo $cat_name}
                    {/if}</h1>
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
    {if $page_number == 1}
        <li>
            <p>{echo $model->getDescription()}</p>
        </li>
    {/if}
    <!--  Render produts list   -->
    {foreach $products as $product}
        {$discount = ShopCore::app()->SDiscountsManager->productDiscount($product->getId())}
        {$style = productInCart($cart_data, $product->getId(), $product->firstVariant->getId(), $product->firstVariant->getStock())}
        <li {if $product->getFirstVariant()->getStock() == 0}class="not_avail"{/if}>
            <div class="photo_block">
                <a href="{shop_url('product/' . $product->getUrl())}">
                    <img id="mim{echo $product->getid()}" src="{productImageUrl($product->getmainModImage())}" alt="{echo ShopCore::encode($product->getname())} - {echo $product->getid()}" />
                    <img id="vim{echo $product->getid()}" class="smallpimagev" src="" alt="" />
                    {if $product->getHot() == 1}
                        <div class="promoblock nowelty">{lang('s_shot')}</div>
                    {/if}
                    {if $product->getAction() == 1}
                        <div class="promoblock action">{lang('s_saction')}</div>
                    {/if}
                    {if $product->getHit() == 1}
                        <div class="promoblock hit">{lang('s_s_hit')}</div>
                    {/if}
                </a>
                <span class="ajax_refer_marg t-a_c">
                    <span data-prodid="{echo $product->getid()}" class="compare
                          {if $forCompareProducts && in_array($product->getid(), $forCompareProducts)}
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
                <a href="{shop_url('product/' . $product->geturl())}" class="title">{echo ShopCore::encode($product->getname())}</a>
                <div class="f-s_0">
                    {if $product->firstVariant->getnumber()}
                        <span id="code{echo $product->getid()}" class="code">
                            {lang('s_kod')} {echo ShopCore::encode($product->firstVariant->getnumber())}
                        </span>
                    {/if}
                    <div>
                        <div class="star_rating">
                            <div id="{echo $model->getid()}_star_rating" class="rating_nohover {echo count_star(countRating($product->getid()))} star_rait" data-id="{echo $model->getid()}">
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
                        <a href="{shop_url('product/'.$product->id.'#four')}" rel="nofollow" class="response">
                            {totalComments($product->getid())}
                            {echo SStringHelper::Pluralize((int)totalComments($product->getid()), array(lang('s_review_on'), lang('s_review_tw'), lang('s_review_tre')))}
                        </a>
                        {if count($product->getProductVariants())>1}
                            <select class="m-l_10" name="selectVar">
                                {foreach $product->getProductVariants() as $pv}
                                    <option class="selectVar"
                                            value="{echo $pv->getid()}"
                                            data-st="{echo $pv->getstock()}"
                                            data-pr="{echo number_format($pv->getPrice(), 2 , ".", "")}"
                                            data-pid="{echo $product->getid()}"
                                            data-img="{echo $pv->getsmallimage()}"
                                            data-vname="{echo $pv->getname()}"
                                            data-vnumber="{echo $pv->getnumber()}">
                                        {if $pv->getname() != ''}
                                            {echo $pv->getname()}
                                        {else:}
                                            {echo $product->getname()}
                                        {/if}
                                    </option>
                                {/foreach}
                            </select>
                        {/if}
                    </div>
                </div>
                <div class="buy">
                    <div class="price f-s_18 d_b">
                        {if (float)$product->getOldPrice() > 0}
                            {if $product->getOldPrice() > $product->firstVariant->getPrice()}
                                <div>
                                    <del class="price f-s_12 price-c_9" style="margin-top: 1px;">
                                        {echo number_format($product->getOldPrice(), 2, ".", "")}
                                        <sub> {$CS}</sub>
                                    </del>
                                </div>
                            {/if}
                        {/if}
                        <div id="pricem{echo $product->getId()}">
                            {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                {$prOne = $product->firstVariant->getPrice()}
                                {$prTwo = $product->firstVariant->getPrice()}
                                {$prThree = $prOne - $prTwo / 100 * $discount}
                                <del class="price price-c_red f-s_12 price-c_9">{echo number_format($product->firstVariant->getPrice(), 2, ".", "")} {$CS}</del>
                            {else:}
                                {$prThree = $product->firstVariant->getPrice()}
                            {/if}
                            {echo number_format($prThree, 2, ".", "")} 
                            <sub>{$CS}</sub>
                        </div>
                    </div>
                    <div id="p{echo $product->getid()}" class="{$style.class} buttons">
                        <span id="buy{echo $product->getid()}"
                              class="{$style.identif}"
                              data-varid="{echo $product->firstVariant->getid()}"
                              data-prodid="{echo $product->getid()}">
                            {$style.message}
                        </span>
                    </div>
                    <span class="frame_wish-list">
                        {if !is_in_wish($product->getid())}
                            <span data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}"
                                  data-varid="{echo $product->firstVariant->getid()}"
                                  data-prodid="{echo $product->getid()}"
                                  class="addToWList">
                                <span class="icon-wish"></span>
                                <span class="js blue">{lang('s_slw')}</span>
                            </span>
                            <a href="/shop/wish_list" class="red" style="display:none;"><span class="icon-wish"></span>{lang('s_ilw')}</a>
                            {else:}
                            <a href="/shop/wish_list" class="red"><span class="icon-wish"></span>{lang('s_ilw')}</a>
                            {/if}
                    </span> 
                </div>

                {if ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->getid())}
                    <p class="c_b">
                        {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->getid())}
                        &nbsp;&nbsp;<a href="{shop_url('product/' . $product->geturl())}" class="t-d_n"><span class="t-d_u">{lang('s_more')}</span> →</a>
                    </p>
                {/if}
            </div>
        </li>
    {/foreach}
    <!--  Render produts list   -->
</ul>
<!--    Pagination    -->
<div class="pagination"><div class="t-a_c">{$pagination}</div></div>
<!--    Pagination    -->
</div>

</div>
</div>
</div>