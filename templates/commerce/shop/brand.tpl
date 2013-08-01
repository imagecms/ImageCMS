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
            {if count($categoriesInBrand)>0}
                <form id="orderForm" method="get">
                    <input type="hidden" name="user_per_page" value="{echo $_GET['user_per_page']}"/>
                    <input type="hidden" name="order" value="{echo $_GET['order']}"/>
                    <input type="hidden" name="category" />
                    <div class="title">{lang("Found in categories:","admin")}</div>
                    <div class="padding_filter check_frame">
                        <ul class="menu_fiter">
                            {foreach $categoriesInBrand as $item}
                                <li>
                                    {if ShopCore::$_GET['category'] == $item->category_id}<b class="c_d">{$cat_name = $item->name}{/if}
                                    <span class="{if ShopCore::$_GET['category']!=$item->category_id}findincats{/if} js gray" data-id="{echo $item->category_id}">{echo $item->name} ({echo $item->countProducts})</span>
                                    {if ShopCore::$_GET['category'] == $item->category_id}</b>{/if}
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                    {if ShopCore::$_GET['category']}<a href="{site_url($CI->uri->uri_string())}"><span class="icon-reset"></span>{lang("Reset","admin")}</a><br/>{/if}
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
                <span>{lang("New","admin")}</span>
            </div>               
            <ul>
                {foreach getPromoBlock('hot', 3, '', $model->getId()) as $hotProduct}
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
                                    {if $hotProduct->hasDiscounts()}
                                        <del class="price price-c_red f-s_12 price-c_9">{echo $hotProduct->firstVariant->toCurrency('OrigPrice')} {$CS}</del><br /> 
                                    {/if}
                                    {echo $hotProduct->firstVariant->toCurrency()}
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
                <span>{lang("Action","admin")}</span>
            </div>
            <ul>
                {foreach getPromoBlock('action', 3, '', $model->getId()) as $hotProduct}                   
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

                                    {if $hotProduct->hasDiscounts()}

                                        <del class="price price-c_red f-s_12 price-c_9">{echo $hotProduct->firstVariant->toCurrency('OrigPrice')} {$CS}</del><br /> 
                                    {/if}
                                    {echo $hotProduct->firstVariant->toCurrency()}
                                    <sub>{$CS}</sub>
                                </div>
                            </div>
                        </div>
                    </li>
                {/foreach}
            </ul>
        {/if}
        {//widget('latest_news')}
        <!--   Promo products block     -->
    </div>
    <!--   Right sidebar     -->
    <div class="catalog_frame">
        <div class="box_title clearfix">
            <div class="f-s_24">
                <h1 class="d_i">{echo ShopCore::encode($model->getName())} 
                    {if ShopCore::$_GET['category'] != ''}
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
                        <option value="rating" {if ShopCore::$_GET['order']=='rating'}selected="selected"{/if}>{lang("On","admin")} {lang("Rating","admin")}</option>
                        <option value="price" {if ShopCore::$_GET['order']=='price'}selected="selected"{/if}>{lang("From cheap to expensive","admin")}</option>
                        <option value="price_desc" {if ShopCore::$_GET['order']=='price_desc'}selected="selected"{/if} >{lang("From expensive to cheap","admin")}</option>
                        <option value="hit" {if ShopCore::$_GET['order']=='hit'}selected="selected"{/if}>{lang("Popular","admin")}</option>
                        <option value="hot" {if ShopCore::$_GET['order']=='hot'}selected="selected"{/if}>{lang("New","admin")}</option>
                        <option value="action" {if ShopCore::$_GET['order']=='action'}selected="selected"{/if}>{lang("Action","admin")}</option>
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
            {if isset($_GET['category'])}
                <input type="hidden" name="category" value="{echo $_GET['category']}">
            {/if}
        </form>
        <ul>
            {if $page_number == 1}
                <li>
                    <p>{echo $model->getDescription()}</p>
                </li>
            {/if}
            <!--  Render produts list   -->
            {foreach $products as $product}              
                {$style = productInCart($cart_data, $product->getId(), $product->firstVariant->getId(), $product->firstVariant->getStock())}
                <li {if $product->getFirstVariant()->getStock() == 0}class="not_avail"{/if}>
                    <div class="photo_block">
                        <a href="{shop_url('product/' . $product->getUrl())}">
                            <img id="mim{echo $product->getid()}" src="{productImageUrl($product->getmainModImage())}" alt="{echo ShopCore::encode($product->getname())} - {echo $product->getid()}" />
                            <img id="vim{echo $product->getid()}" class="smallpimagev" src="" alt="" />
                            {if $product->getHot() == 1}
                                <div class="promoblock nowelty">{lang("New","admin")}</div>
                            {/if}
                            {if $product->getAction() == 1}
                                <div class="promoblock action">{lang("Promotion","admin")}</div>
                            {/if}
                            {if $product->getHit() == 1}
                                <div class="promoblock hit">{lang("Hit","admin")}</div>
                            {/if}
                        </a>
                        <span class="ajax_refer_marg t-a_c">
                            <span data-prodid="{echo $product->getid()}" class="compare
                                  {if $forCompareProducts && in_array($product->getid(), $forCompareProducts)}
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
                        <a href="{shop_url('product/' . $product->geturl())}" class="title">{echo ShopCore::encode($product->getname())}</a>
                        <div class="f-s_0">
                            {if $product->firstVariant->getnumber()}
                                <span id="code{echo $product->getid()}" class="code">
                                    {lang("ID","admin")} {echo ShopCore::encode($product->firstVariant->getnumber())}
                                </span>
                            {/if}
                            <div>
                                <div class="star_rating">
                                    {$CI->load->module('star_rating')->show_star_rating($product)}
                                </div>
                                <a href="{shop_url('product/'.$product->id.'#four')}" rel="nofollow" class="response">
                                    {totalComments($product->getid())}
                                    {echo SStringHelper::Pluralize((int)totalComments($product->getid()), array(lang("review","admin"), lang("reviews","admin"), lang("review","admin")))}
                                </a>
                                {if count($product->getProductVariants())>1}
                                    <select class="m-l_10" name="selectVar">
                                        {foreach $product->getProductVariants() as $pv}
                                            <option class="selectVar"
                                                    value="{echo $pv->getid()}"
                                                    data-cs="{$CS}"
                                                    data-st="{echo $pv->getstock()}"
                                                    data-cs = "{$CS}"
                                                    data-pr="{echo number_format($pv->getPrice(), ShopCore::app()->SSettings->pricePrecision , ".", "")}"
                                                    data-pid="{echo $product->getid()}"
                                                    data-img-small="{echo $pv->getsmallimage()}"
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
                                                {echo number_format($product->getOldPrice(), ShopCore::app()->SSettings->pricePrecision, ".", "")}
                                                <sub> {$CS}</sub>
                                            </del>
                                        </div>
                                    {/if}
                                {/if}
                                <div id="pricem{echo $product->getId()}">
                                    {if $product->hasDiscounts()}                                        
                                        <del class="price price-c_red f-s_12 price-c_9">{echo $product->firstVariant->toCurrency('OrigPrice')} {$CS}</del>                                   
                                    {/if}
                                    {echo $product->firstVariant->toCurrency()}
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
                                        <span class="js blue">{lang("Save to Wish List","admin")}</span>
                                    </span>
                                    <a href="/shop/wish_list" class="red" style="display:none;"><span class="icon-wish"></span>{lang("Already wishlist","admin")}</a>
                                {else:}
                                    <a href="/shop/wish_list" class="red"><span class="icon-wish"></span>{lang("Already wishlist","admin")}</a>
                                {/if}
                            </span> 
                        </div>

                        {if ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->getid())}
                            <p class="c_b">
                                {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->getid())}
                                &nbsp;&nbsp;<a href="{shop_url('product/' . $product->geturl())}" class="t-d_n"><span class="t-d_u">{lang("More","admin")}</span> →</a>
                            </p>
                        {/if}
                    </div>
                </li>
            {/foreach}
            <!--  Render produts list   -->
        </ul>
        <!--    Pagination    -->
        {$pagination}
        <!--    Pagination    -->
    </div>

</div>
</div>
</div>
