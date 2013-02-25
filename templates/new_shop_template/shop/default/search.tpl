{# Variables
# @var products
# @var totalProducts
# @var brandsInSearchResult
# @var pagination
# @var tree
# @var model
# @var canonical
# @var jsCode
# @var current_cat
#}

<!-- Get category tree -->
{ShopCore::app()->SCategoryTree->getTree(SCategoryTree::MODE_MULTI);}

{if $totalProducts > 0}
<div class="row">
    <aside class="span3">
        <div class="filter">
            <!-- Categories tree -->
            <div class="boxFilter">
            <div class="title">{lang('s_sea_found_in_categories')}:</div>
                <nav>
                    <ul>
                        {foreach $tree as $item}
                            {if $item->getLevel() == 0}
                                <ul>
                                    <div class="title">
                                        {foreach $item->getSubtree() as $subItem}
                                            {$count_item = $categorys[$subItem->getId()];}
                                            {if $count_item}
                                                {echo $item->getName()}{break;}
                                            {/if}
                                        {/foreach}
                                    </div>
                                    {foreach $item->getSubtree() as $subItem}
                                        {$count_item = $categorys[$subItem->getId()];}
                                        {if $count_item}
                                            <li{if $_GET['category'] && $_GET['category'] == $subItem->getId()} class="active"{/if}>
                                                <span>
                                                    {if $_GET['category'] && $_GET['category'] == $subItem->getId()}
                                                        {echo $subItem->getName()}
                                                    {else:}
                                                        <a href="{shop_url('search?text='.$_GET['text'].'&category='.$subItem->getId())}">{echo $subItem->getName()}</a>     
                                                    {/if}
                                                    <span class="count">({echo $count_item})</span>
                                                </span>
                                            </li>
                                        {/if}
                                    {/foreach}
                                </ul>
                            {/if}
                        {/foreach}
                    </ul>
                    {widget('latest_news')}
              </nav>
            </div>
        </div>
        </aside>
        <div class="span9 right">
            {if !empty(ShopCore::$_GET['text'])}
                          <h1 class="d_i">  {lang('s_sea_search_for')}:"{encode($_GET['text'])}" </h1>
                        {/if}
                        <span class="c_97">
                            ({$totalProducts}) {echo SStringHelper::Pluralize($totalProducts, array(lang('s_product_o'), lang('s_product_t'), lang('s_product_tr')))}
                        </span>
            <div class=" clearfix t-a_ccatalog_frame">
                <div class="clearfix t-a_c frame_func_catalog">
                                    <div class="f_l">
                                        <span class="v-a_m">Фильтровать по:</span>
                                        <div class="lineForm w_170">
                                            <select class="sort" id="sort" name="order">
                                                <option selected="selected" value="1">по Рейтингу</option>
                                                <option value="2">От дешевых к дорогим</option>
                                                <option value="3">От дорогих к дешевым</option>
                                                <option value="4">Популярные</option>
                                                <option value="5">Новинки</option>
                                                <option value="6">Акции</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="f_r">
                                        <span class="v-a_m">Товаров на странице:</span>
                                        <div class="lineForm w_70">
                                            <select class="sort" id="sort2" name="order2">
                                                <option selected="selected" value="1">20</option>
                                                <option value="2">40</option>
                                                <option value="3">60</option>
                                                <option value="4">80</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="groupButton list_pic_btn" data-toggle="buttons-radio">
                                        <button type="button" class="btn active"><span class="icon-cat_pic"></span>Картинками</button>
                                        <button type="button" class="btn"><span class="icon-cat_list"></span>Списком</button>
                                    </div>
                                </div>
                                
                    <!-- Product block -->
                    <ul class="items items_catalog" data-radio-frame>
                            {$Comments = $CI->load->module('comments')->init($products)}
                            {foreach $products as $p}
                            {$discount = ShopCore::app()->SDiscountsManager->productDiscount($p->id)}
                            {$style = productInCart($cart_data, $p->getId(), $p->firstVariant->getId(), $p->firstVariant->getStock())}
                            <li class="span3 {if $p->firstvariant->getstock()==0} not-avail{/if}">
                                <div class="description">
                                    <div class="frame_response">
                                        <div class="star">
                                           {$CI->load->module('star_rating')->show_star_rating($p)}
                                           {echo $Comments[$p->getId()]}
                                        </div>
                                    </div>
                                   <a href="{shop_url('product/'.$p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
                                   <div class="price price_f-s_16">
                                       <!--$model->hasDiscounts() - checking for the existence of discounts. 
                                            If there is a discount price without discount C-->
                                            {if $p->hasDiscounts()}
                                                <span class="d_b old_price">
                                                    <!--
                                                    "$model->firstVariant->toCurrency('OrigPrice')" or $model->firstVariant->getOrigPrice()
                                                    output price without discount
                                                    -->
                                                    <span class="f-w_b">{echo number_format($p->firstVariant->toCurrency('OrigPrice'), ShopCore::app()->SSettings->pricePrecision, ".", "")}</span>
                                                    {$CS}
                                                </span>                           
                                            {/if}
                                            <!--If there is a discount of "$model->firstVariant->toCurrency()" or "$model->firstVariant->getPrice"
                                            will display the price already discounted-->
                                            <span class="f-w_b" >{echo number_format($p->firstVariant->toCurrency(), ShopCore::app()->SSettings->pricePrecision, ".", "")}</span>{$CS}
                                            <!--To display the amount of discounts you can use $model->firstVariant->getNumDiscount()-->
                                   </div>
                                    <!-- Check amount of goods -->
                                        {if $p->firstvariant->getstock()!=0}
                                            <button class="btn btn_buy" type="button" data-prodId="{echo $p->getId()}" data-varId="{echo $p->firstVariant->getId()}" data-price="{$prThree}" data-name="{echo $p->getName()}">{lang('add_to_basket')}</button>
                                        {else:}
                                            <button class="btn btn_not_avail" type="button" data-prodId="{echo $p->getId()}" data-varId="{echo $p->firstVariant->getId()}" data-price="{$prThree}" data-name="{echo $p->getName()}">{lang('s_message_o_report')}</button>
                                        {/if}   
                                    <div class="d_i-b">
                                        <button class="btn btn_small_p" type="button" title="{echo lang('s_list_add_comp')}" data-prodId="{echo $p->getId()}" data-varId="{echo $p->firstVariant->getId()}" data-price="{$prThree}" data-name="{echo $p->getName()}"><span class="icon-comprasion_2"></span></button>
                                        <button class="btn btn_small_p" type="button" title="{echo lang('s_save_W_L')}" data-prodId="{echo $p->getId()}" data-varId="{echo $p->firstVariant->getId()}" data-price="{$prThree}" data-name="{echo $p->getName()}"><span class="icon-wish_2"></span></button>
                                   </div>
                                </div>
                                <a class="photo" href="{shop_url('product/' . $p->getUrl())}">
                                    <span class="helper"></span>
                                    <figure>
                                        <img src="{productImageUrl($p->getMainModimage())}" alt="{echo ShopCore::encode($p->name)} - {echo $p->getId()}" />
                                    </figure>
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                    <!-- Pagination -->
                    {if $pagination}
                        {$pagination}
                    {/if}
{else:}
    <!-- if products not found show message-->
    <div class="row" >
        <aside class="span3">
            <div class="filter">
                <div class="boxFilter">
                    <div class="title">{lang('s_sea_found_in_categories')}:</div>
                </div>
             </div>
        </aside>
        <div class="span9 right" style="padding-top:15px;">
           <div class="bot_border_grey">     
                {if !empty(ShopCore::$_GET['text'])}
                    <h1 class="d_i">  {lang('s_sea_search_for')}:"{encode($_GET['text'])}" </h1>
                {/if}
                <span class="c_97 ">
                    ({$totalProducts}) {echo SStringHelper::Pluralize($totalProducts, array(lang('s_product_o'), lang('s_product_t'), lang('s_product_tr')))}
                </span>
            </div>    
                <div class="span9 right" style="padding-top:15px;">
                    {echo ShopCore::t(lang('s_not_found'))}</li>
                </div>
          </div>
     </div>
{/if}
            </div>
        </div>
</div>