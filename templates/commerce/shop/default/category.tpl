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
    <!-- Show Brands in circle -->
    {$banners = ShopCore::app()->SBannerHelper->getBannersCat(3,$model->id);}
    {if count($banners)}
        <div class="cycle center">
            <ul> 
                {foreach $banners as $banner}
                    <li>
                        <a href="{echo $banner->getUrl()}">
                            <img src="/uploads/shop/banners/{echo $banner->getImage()}" alt="{echo ShopCore::encode($banner->getName())}" />
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
                        <span>{lang('s_new')}</span>
                    </div>
                    <ul>
                        {foreach getPromoBlock('hot', 3, $product->category_id) as $hotProduct}
                            {$discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)}
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
                                                {$prOne = $hotProduct->firstVariant->getPrice()}
                                                {$prTwo = $hotProduct->firstVariant->getPrice()}
                                                {$prThree = $prOne - $prTwo / 100 * $discount}
                                                <del class="price price-c_red f-s_12 price-c_9">{echo number_format($hotProduct->firstVariant->getPrice(), 2, ".", "")} {$CS}</del><br /> 
                                            {else:}
                                                <div class="price f-s_14">{$prThree = number_format($hotProduct->firstVariant->getPrice(), 2, ".", "")}
                                                {/if}
                                                {echo number_format($prThree, 2, ".", "")} 
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
                {if count(getPromoBlock('action', 3, $product->category_id))}
                    <div class="box_title">
                        <span>{lang('s_action')}</span>
                    </div>
                    <ul>
                        {foreach getPromoBlock('action', 3, $product->category_id) as $hotProduct}
                            {$discount = ShopCore::app()->SDiscountsManager->productDiscount($hotProduct->id)}
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
                                                {$prOne = $hotProduct->firstVariant->getPrice()}
                                                {$prTwo = $hotProduct->firstVariant->getPrice()}
                                                {$prThree = $prOne - $prTwo / 100 * $discount}
                                                <del class="price price-c_red f-s_12 price-c_9">{echo number_format($hotProduct->firstVariant->getPrice(), 2, ".", "")} {$CS}</del><br /> 
                                            {else:}
                                                <div class="price f-s_14">{$prThree = number_format($hotProduct->firstVariant->getPrice(), 2, ".", "")}
                                                {/if}
                                                {echo number_format($prThree, 2, ".", "")} 
                                                <sub>{$CS}</sub>
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
                <div class="crumbs">{echo makeBreadCrumbs($category)}</div>
                <div class="box_title clearfix">
                    <div class="f-s_24">
                        {echo ShopCore::encode($category->getName())}
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
                                    <span class="f-s_18">Описание</span>
                                </div>
                                {echo $category->getDescription()}
                            </li>
                        {/if}
                    {/if}

                    <!--  Render produts list   -->
                    {foreach $products as $product}
                        {$style = productInCart($cart_data, (int)$product->id, (int)$product->variants[0]->id, (int)$product->firstVariant->getStock())}
                        {$discount = ShopCore::app()->SDiscountsManager->productDiscount($product->id)}
                        <li {if (int)$product->getallstock() == 0}class="not_avail"{/if}>
                            <div class="photo_block">
                                <a href="{shop_url('product/' . $product->getUrl())}">
                                    <img id="mim{echo $product->getId()}" src="{productImageUrl($product->getMainModImage())}" alt="{echo ShopCore::encode($product->getName())} - {echo $product->getId()}" />
                                    <img id="vim{echo $product->getId()}" class="smallpimagev" src="" alt="" />
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
                                    <span data-prodid="{echo $product->getId()}" class="compare
                                          {if $forCompareProducts && in_array($product->getId(), $forCompareProducts)}
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
                                <a href="{shop_url('product/' . $product->getUrl())}" class="title">{echo ShopCore::encode($product->getName())}</a>
                                <div class="f-s_0">
                                    {if $product->firstVariant->getNumber()}
                                        <span id="code{echo $product->getId()}" class="code">
                                            {lang('s_kod')} {echo ShopCore::encode($product->firstVariant->getNumber())}
                                        </span>
                                    {/if}
                                    <div>
                                        {$CI->load->module('star_rating')->show_star_rating($product)}
                                        <a href="{shop_url('product/'.$product->id.'#four')}" rel="nofollow" class="response">
                                            {totalComments($product->getId())}
                                            {echo SStringHelper::Pluralize((int)totalComments($product->getId()), array(lang('s_review_on'), lang('s_review_tw'), lang('s_review_tre')))}
                                        </a>
                                        {if count($product->getProductVariants())>1}
                                            <select class="m-l_10" name="selectVar">
                                                {foreach $product->getProductVariants() as $pv}                                                    
                                                    <option class="selectVar"
                                                            value="{echo $pv->getId()}"
                                                            data-cs = "{$CS}"
                                                            data-st="{echo $pv->getStock()}"
                                                            data-pr="{echo number_format($pv->getPrice(), 2 , ".", "")}"
                                                            data-pid="{echo $product->getId()}"
                                                            data-img-small="{echo $pv->getSmallImage()}"
                                                            data-vname="{echo $pv->getName()}"
                                                            data-vnumber="{echo $pv->getNumber()}">
                                                        {if $pv->name != ''}
                                                            {echo $pv->geName()}
                                                        {else:}
                                                            {echo $product->getName()}
                                                        {/if}
                                                    </option>
                                                {/foreach}
                                            </select>
                                        {/if}
                                    </div>
                                </div>
                                <div class="buy">{//var_dump($product)}
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
                                                <del class="price price-c_red f-s_12 price-c_9">{echo $product->firstVariant->getId()} {$CS}</del>
                                            {else:}
                                                {$prThree = $product->firstVariant->getId()}
                                            {/if}
                                            {echo number_format($prThree, 2, ".", "")} 
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
                                                <span class="js blue">{lang('s_slw')}</span>
                                            </span>
                                            <a href="/shop/wish_list" class="red" style="display:none;"><span class="icon-wish"></span>{lang('s_ilw')}</a>
                                        {else:}
                                            <a href="/shop/wish_list" class="red"><span class="icon-wish"></span>{lang('s_ilw')}</a>
                                        {/if}
                                    </span> 
                                </div>

                                {if ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->getId())}
                                    <p class="c_b">
                                        {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($product->getId())}
                                        &nbsp;&nbsp;<a href="{shop_url('product/' . $product->getUrl())}" class="t-d_n"><span class="t-d_u">{lang('s_more')}</span> →</a>
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

