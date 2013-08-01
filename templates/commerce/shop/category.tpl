{# Variables
/**
* @file - template for displaying shop category page
* Variables
*   $category: (object) instance of SCategory
*       $category->getDescription(): method which returns category description 
*       $category->getNmae(): method which returns category name according to currenct locale
*   $products: PropelObjectCollection of (object)s instance of SProducts 
*       $product->firstVariant: variable which contains the first variant of product
*       $product->firstVariant->toCurrency(): method which returns price according to current currencya and format    
*   $totalProducts: integer contains products count
*   $pagination: string variable contains html code for displaying pagination
*   $pageNumber: integer variable contains the current page number
*   $cart_data: array which contains added to cart products
*   $forCompareProducts: array which contains added to compare products
*   $banners: array of (object)s of SBanners which have to be displayed in current page
*/
#}

{$forCompareProducts = $CI->session->userdata('shopForCompare')}
<div class="content">
    <!-- Show Brands in circle -->
    {$banners = ShopCore::app()->SBannerHelper->getBannersCat(3,$model->id);}
    {if count($banners)}
        <div class="cycle center">
            <ul> 
                {foreach $banners as $banner}
                    <li>
                        <a href="{echo $banner['url']}">
                            <img src="/uploads/shop/banners/{echo $banner['image']}" />
                        </a>
                    </li>
                {/foreach}
            </ul>
            <span class="nav"></span>
            <button class="prev"></button>
            <button class="next"></button>
        </div>
    {/if}
    <div class="center">
        {include_tpl('filter')}
        <div class="catalog_content">
            <!--   Right sidebar     -->
            <div class="nowelty_auction">
                <!--   New products block     -->
                {if count(getPromoBlock('hot', 3, $product->category_id))}
                    <div class="box_title">
                        <span>{lang("New","admin")}</span>
                    </div>
                    <ul>
                        {foreach getPromoBlock('hot', 3, $product->category_id) as $hotProduct}
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
                                            {if $hotProduct->hasDiscounts() AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                <del class="price price-c_red f-s_12 price-c_9">{echo $hotProduct->firstVariant->toCurrency('OrigPrice')} {$CS}</del><br /> 
                                            {/if}
                                            <div class="price f-s_14">
                                                {echo $hotProduct->firstVariant->toCurrency()}
                                                <sub>{$CS}</sub>
                                            </div>
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
                        <span>{lang("Action","admin")}</span>
                    </div>
                    <ul>
                        {foreach getPromoBlock('action', 3, $product->category_id) as $hotProduct}
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
                                            {if $hotProduct->hasDiscounts() AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                <del class="price price-c_red f-s_12 price-c_9">{echo $hotProduct->firstVariant->toCurrency('OrigPrice')} {$CS}</del><br /> 
                                            {/if}
                                            <div class="price f-s_14">
                                                {echo $hotProduct->firstVariant->toCurrency()}
                                                <sub>{$CS}</sub>
                                            </div>
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
            <div class="catalog_frame">
                {widget('path')}
                <div class="box_title clearfix">
                    <div class="f-s_24">
                        {echo ShopCore::encode($category->getName())}
                        <span class="count_search">({$totalProducts})</span>
                    </div>
                </div>
                <form method="GET">
                    <div class="f_l">
                        <span class="v-a_m">{lang("Order by","admin")}:&nbsp;</span>
                        <div class="lineForm w_145 v-a_m">
                            <select id="sort" name="order">
                                <option value="" {if !ShopCore::$_GET['order']}selected="selected"{/if}>-{lang("No","admin")}-</option>
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
                        <span class="v-a_m">{lang("Products per page","admin")}:&nbsp;</span>
                        <div class="lineForm w_50 v-a_m">
                            <select id="count" name="user_per_page">
                                <option value="12" {if ShopCore::$_GET['user_per_page']=='12'}selected="selected"{/if} >12</option>
                                <option value="24" {if ShopCore::$_GET['user_per_page']=='24'}selected="selected"{/if} >24</option>
                                <option value="36" {if ShopCore::$_GET['user_per_page']=='36'}selected="selected"{/if} >36</option>
                            </select>
                        </div>
                    </div>
                    {if isset($_GET['lp'])}
                        <input type="hidden" name="lp" value="{echo $_GET['lp']}">
                    {/if}
                    {if isset($_GET['rp'])}
                        <input type="hidden" name="rp" value="{echo $_GET['rp']}">
                    {/if}
                    {if isset($_GET['brand'])}
                        {foreach $_GET['brand'] as $br}
                            <input type="hidden" name="brand[]" value="{$br}"/>
                        {/foreach}
                    {/if}
                    {if isset($_GET['p'])}
                        {foreach $_GET['p'] as $key => $prop}
                            {foreach $prop as $p}
                                <input type="hidden" name="p[{echo $key}][]" value="{echo $p}"/>
                            {/foreach}
                        {/foreach}
                    {/if}
                </form>
                <ul>            
                    {if (int)$pageNumber == 1}
                        {if trim($category->getDescription())}
                            <li>
                                <div class="box_title">
                                    <span class="f-s_18">{lang("Description","admin")}</span>
                                </div>
                                {echo ShopCore::encode($category->getDescription())}
                            </li>
                        {/if}
                    {/if}
                    {$cart_data= ShopCore::app()->SCart->getData();}
                    <!--  Render produts list   -->
                    {foreach $products as $product}
                        {$style = productInCart($cart_data, (int)$product->getId(), (int)$product->firstVariant->getId(), (int)$product->firstVariant->getStock())}
                        <li {if (int)$product->getallstock() == 0}class="not_avail"{/if}>
                            <div class="photo_block">
                                <a href="{shop_url('product/' . $product->getUrl())}">
                                    <img id="mim{echo $product->getId()}" src="{productImageUrl($product->getMainModImage())}" alt="{echo ShopCore::encode($product->getName())} - {echo $product->getId()}" />
                                    <img id="vim{echo $product->getId()}" class="smallpimagev" src="" alt="" />
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
                                    <span data-prodid="{echo $product->getId()}" class="compare
                                          {if $forCompareProducts && in_array($product->getId(), $forCompareProducts)}
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
                                <a href="{shop_url('product/' . $product->getUrl())}" class="title">{echo ShopCore::encode($product->getName())}</a>
                                <div class="f-s_0">
                                    {if $product->firstVariant->getNumber()}
                                        <span id="code{echo $product->getId()}" class="code">
                                            {lang("ID","admin")} {echo ShopCore::encode($product->firstVariant->getNumber())}
                                        </span>
                                    {/if}
                                    <div>
                                        {$CI->load->module('star_rating')->show_star_rating($product)}
                                        <a href="{shop_url('product/'.$product->id.'#four')}" rel="nofollow" class="response">
                                            {totalComments($product->getId())}
                                            {echo SStringHelper::Pluralize((int)totalComments($product->getId()), array(lang("review","admin"), lang("reviews","admin"), lang("review","admin")))}
                                        </a>
                                        {if count($product->getProductVariants())>1}
                                            <select class="m-l_10" name="selectVar">
                                                {foreach $product->getProductVariants() as $pv}                                                    
                                                    <option class="selectVar"
                                                            value="{echo $pv->getId()}"
                                                            data-cs = "{$CS}"
                                                            data-st="{echo $pv->getStock()}"
                                                            data-pr="{echo $pv->toCurrency()}"
                                                            data-pid="{echo $product->getId()}"
                                                            data-img-small="{echo $pv->getSmallImage()}"
                                                            data-vname="{echo $pv->getName()}"
                                                            data-vnumber="{echo $pv->getNumber()}">
                                                        {if $pv->name != ''}
                                                            {echo $pv->getName()}
                                                        {else:}
                                                            {echo ShopCore::encode($product->getName())}
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
                                            {if $product->getOldPrice() > $product->firstVariant->toCurrency()}
                                                <div>
                                                    <del class="price f-s_12 price-c_9" style="margin-top: 1px;">
                                                        {echo $product->getOldPrice()}
                                                        <sub> {$CS}</sub>
                                                    </del>
                                                </div>
                                            {/if}
                                        {/if}
                                        <div id="pricem{echo $product->getId()}">
                                            {if $product->hasDiscounts() AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                <del class="price price-c_red f-s_12 price-c_9">{echo $product->firstVariant->toCurrency('OrigPrice')} {$CS}</del>
                                            {/if}
                                            {echo $product->firstVariant->toCurrency()} 
                                            <sub>{$CS}</sub>
                                        </div>
                                    </div>
                                    <div id="p{echo $product->getId()}" class="{$style.class} buttons">
                                        <span id="buy{echo $product->getId()}"
                                              class="{$style.identif}"
                                              data-varid="{echo $product->firstVariant->getId()}"
                                              data-prodid="{echo $product->getId()}">
                                            {$style.message}
                                        </span>
                                    </div>
                                    <span class="frame_wish-list">
                                        {if !is_in_wish($product->getId())}
                                            <span data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}"
                                                  data-varid="{echo $product->firstVariant->getId()}"
                                                  data-prodid="{echo $product->getId()}"
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

                                {if ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->getId())}
                                    <p class="c_b">
                                        {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->getId())}
                                        &nbsp;&nbsp;<a href="{shop_url('product/' . $product->getUrl())}" class="t-d_n"><span class="t-d_u">{lang("More","admin")}</span> →</a>
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
        </div>
    </div>
</div>