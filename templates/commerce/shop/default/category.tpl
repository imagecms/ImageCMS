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
                    <div class="f-s_24 f_l">{echo ShopCore::encode($model->getTitle())} <span class="count_search">({$totalProducts})</span></div>
                    <div class="f_r">
                        <form method="GET">
                            <div class="lineForm f_l w_145">
                                <select id="sort" name="order">
                                    <option value="rating" {if ShopCore::$_GET['order']=='rating'}selected="selected"{/if}>по рейтингу</option>
                                    <option value="price" {if ShopCore::$_GET['order']=='price'}selected="selected"{/if}>от дешевых к дорогим</option>
                                    <option value="price_desc" {if ShopCore::$_GET['order']=='price_desc'}selected="selected"{/if} >от дорогих к дешевым</option>
                                    <option value="hit" {if ShopCore::$_GET['order']=='hit'}selected="selected"{/if}>популярные</option>
                                    <option value="hot" {if ShopCore::$_GET['order']=='hot'}selected="selected"{/if}>новинки</option>
                                    <option value="action" {if ShopCore::$_GET['order']=='action'}selected="selected"{/if}>акции</option>
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
                    <!--  Render produts list   -->
                    {echo $order_method}
                    {foreach $products as $product}
                        {$style = productInCart($cart_data, $product->getId(), $product->firstVariant->getId(), $product->firstVariant->getStock())}
                        <li {if $product->firstvariant->getstock()== 0}class="not_avail"{/if}>
                            <div class="photo_block">
                                <a href="{shop_url('product/' . $product->getUrl())}">
                                    <img id="mim{echo $product->getId()}" src="{productImageUrl($product->getMainModimage())}" alt="{echo ShopCore::encode($product->name)}" />
                                    <img id="vim{echo $product->getId()}" class="smallpimagev" src="" alt="" />
                                </a>
                            </div>
                            <div class="func_description">
                                <a href="{shop_url('product/' . $product->getUrl())}" class="title">{echo ShopCore::encode($product->name)}</a>
                                <div class="f-s_0">
                                    <!--    Show Product Number -->
                                {if $product->firstVariant->getNumber()}<span id="code{echo $product->getId()}" class="code">Код {echo ShopCore::encode($product->firstVariant->getNumber())}</span>{/if}
                                <!--    Show Product Number -->

                                <!--<div class="di_b star"><img src="{$SHOP_THEME}images/temp/STAR.png"></div>-->
                                {$rating = $product->getRating()}
                                {if $rating == 0}{$r = "nostar"}    {/if}
                                {if $rating == 1}{$r = "onestar"}   {/if}
                                {if $rating == 2}{$r = "twostar"}   {/if}
                                {if $rating == 3}{$r = "threestar"} {/if}
                                {if $rating == 4}{$r = "fourstar"}  {/if}
                                {if $rating == 5}{$r = "fivestar"}  {/if}
                                <div class="star_rating">
                                    <div id="{echo $model->getId()}_star_rating" class="rating_nohover {echo $r} star_rait" data-id="{echo $model->getId()}">
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
        <!--    Show Comments count -->
        <a href="{shop_url('product/'.$product->getId().'?cmn=on')}"  class="response">
            {echo $product->totalComments()} {echo SStringHelper::Pluralize($product->totalComments(), array('отзыв', 'отзывы', 'отзывов'))}</a>
        <!--    Show Comments count -->
        
        {if count($product->getProductVariants())>1}
            <select class="m-l_10" name="selectVar">
            {foreach $product->getProductVariants() as $pv}
                <option class="selectVar" value="{echo $pv->getId()}" data-st="{echo $pv->getStock()}" data-cs="{$NextCS}" data-spr="{echo ShopCore::app()->SCurrencyHelper->convert($pv->getPrice(), $NextCSId)}" data-pr="{echo $pv->getPrice()}" data-pid="{echo $product->getId()}" data-img="{echo $pv->getsmallimage()}" data-vname="{echo $pv->getName()}" data-vnumber="{echo $pv->getNumber()}">{echo $pv->getName()}</option>
            {/foreach}
            </select>
        {/if}

    </div>
    <div class="f_l">
        <div class="buy">
            <div class="price f-s_18 f_l">
                <span id="pricem{echo $product->getId()}">{echo $product->firstVariant->toCurrency()}</span>
                <sub>{$CS}</sub>
                {if $NextCS != $CS}
                <span id="prices{echo $product->getId()}" class="d_b">{echo $product->firstVariant->toCurrency('Price', $NextCSId)}{$NextCS}</span>
                {/if}
            </div>
            <div id="p{echo $product->getId()}" class="{$style.class} buttons">
                <a id="buy{echo $product->getId()}" class="{$style.identif}" href="{$style.link}" data-varid="{echo $product->firstVariant->getId()}" data-prodid="{echo $product->getId()}" >{$style.message}</a>
            </div>
        </div>
    </div>
    <div class="f_r t-a_r">
        <span class="ajax_refer_marg">
            {if $forCompareProducts && in_array($product->getId(), $forCompareProducts)}
                <a href="{shop_url('compare')}" class="">Сравнить</a>
            {else:}
                <a href="{shop_url('compare/add/'. $product->getId())}" data-prodid="{echo $product->getId()}" class="js gray toCompare">Добавить к сравнению</a>
            {/if}
        </span>                       
        {if !is_in_wish($product->getId())}
            <a data-logged_in="{if ShopCore::$ci->dx_auth->is_logged_in()===true}true{/if}" data-varid="{echo $product->firstVariant->getId()}" data-prodid="{echo $product->getId()}" href="#" class="js gray addToWList">Сохранить в список желаний</a>
        {else:}
            <a href="/shop/wish_list">Уже в списке желаний</a>
        {/if}
    </div>
</div>
{if $product->countProperties() > 0}
    <p class="c_b">
        {echo ShopCore::app()->SPropertiesRenderer->renderPropertiesInline($product)}
        <a href="{shop_url('product/' . $product->getUrl())}" class="t-d_n"><span class="t-d_u">Подробнее</span> →</a>
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
      {if count(getPromoBlock('hot', 3, $product->category_id))}
               
                <div class="box_title">
                    <span>Новинки</span>
                </div>               
                <ul>
                  {foreach getPromoBlock('hot', 3, $product->category_id) as $hotProduct}
                    <li class="smallest_item">
                        <div class="photo_block">
                            <a href="{shop_url('product/' . $hotProduct->getUrl())}">
                                <img src="{productImageUrl($hotProduct->getSmallModimage())}" alt="{echo ShopCore::encode($hotProduct->getName())}" />
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                            <div class="buy">
                                <div class="price f-s_14">{echo $hotProduct->firstVariant->toCurrency()} 
                                    <sub>{$CS}</sub>
                                    {if $NextCS != $CS}
                                    <span class="d_b">{echo $hotProduct->firstVariant->toCurrency('Price', $NextCSId)} {$NextCS}</span>
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
                    <span>Акции</span>
                </div>
                <ul>
                    {foreach getPromoBlock('action', 3, $product->category_id) as $hotProduct}
                    <li class="smallest_item">
                        <div class="photo_block">
                            <a href="{shop_url('product/' . $hotProduct->getUrl())}">
                                <img src="{productImageUrl($hotProduct->getSmallModImage())}" alt="{echo ShopCore::encode($hotProduct->getName())}" />
                            </a>
                        </div>
                        <div class="func_description">
                            <a href="{shop_url('product/' . $hotProduct->getUrl())}" class="title">{echo ShopCore::encode($hotProduct->getName())}</a>
                            <div class="buy">
                                <div class="price f-s_14">{echo $hotProduct->firstVariant->toCurrency()} 
                                    <sub>{$CS}</sub>
                                    {if $NextCS != $CS}
                                    <span class="d_b">{echo $hotProduct->firstVariant->toCurrency('Price', $NextCSId)} {$NextCS}</span>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </li>
                    {/foreach}
                </ul>
                
               {/if}
                <!--   Promo products block     -->
            </div>

<!--   Right sidebar     -->

</div>
</div>
</div>