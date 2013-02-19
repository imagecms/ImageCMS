<article>
    <div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
        <span typeof="v:Breadcrumb">
            <a href="#" rel="v:url" property="v:title"></a>
        </span>
    </div>
        {$CI->load->helper('translit')}
            <h1>{lang('s_compare_tovars')}</h1>
            <div class="p_r">
            <!-- Show compare list if count products >0 -->
            {if count($products) > 0}
                <!-- Show categories of products which are in list -->
                <div class="comprasion_head">
                    <div class="title_h2">{lang('s_category')}:</div>
                    <ul class="tabs">
                        {foreach $categorys as $category}
                            <li><span data-href="#{$category.Url}"><span class="d_l_b">{echo $category.Name}</span></span></li>
                        {/foreach}
                    </ul>
                </div>
                <div class="frame_tabsc">
                    <!-- Show blocks of products and properties grouped by category of products -->
                    {foreach $categorys as $category}
                        <div id="{echo $category.Url}" data-refresh>
                             <ul class="leftDescription characteristic"> 
                                 <li></li>
                                 {$data = ShopCore::app()->SPropertiesRenderer->renderCategoryPropertiesArray($category['Id'])}
                                 <!-- Properties for current group -->
                                 {foreach $data as $d}                                    
                                 <li>
                                    <span class="helper"></span>
                                    <span>{echo $d} </span>
                                 </li>
                                 {/foreach}
                             </ul>
                             <div class="rightDescription">
                             <ul class="comprasion_tovars_frame row itemsFrameNS">
                                 {foreach $products as $product}
                                 {if $product->category_id == $category['Id']}
                                 {$discount = ShopCore::app()->SDiscountsManager->productDiscount($product->id)}
                                 {$style = productInCart($cart_data, $product->getId(), $product->firstVariant->getId(), $product->firstVariant->getStock())}
                                 <li class="span3">
                                    <!-- Photo,name and price -->
                                    <ul class="items items_catalog">
                                        <li>
                                            <button class="btn btn_small btn_small_p">
                                                <span class="icon-remove_comprasion"></span>
                                            </button>
                                            <a href="{shop_url('product/' . $product->getUrl())}" class="photo">
                                                <span class="helper"></span>
                                                <figure>
                                                    <img src="{productImageUrl($product->getSmallModimage())}" alt=""/>
                                                </figure>
                                            </a>
                                            <div class="description">
                                                <div class="frame_response">
                                                    <div class="star">
                                                        {$CI->load->module('star_rating')->show_star_rating($product)}
                                                    </div>
                                                </div>
                                                <a href="{shop_url('product/' . $product->getUrl())}">{echo $product->getName()}</a>
                                                <div class="price price_f-s_16">
                                                    {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                                        {$prOne = $product->firstvariant->getPrice()}
                                                        {$prThree = $prOne - $prOne / 100 * $discount}
                                                    {else:}
                                                        {$prThree = $product->firstvariant->getPrice()}
                                                    {/if}
                                                    <span class="f-w_b">{number_format($prThree, ShopCore::app()->SSettings->pricePrecision, ".", "")}</span> {$CS}
                                                    <span class="second_cash"></span>
                                                </div>
                                                {if $style.identif == 'goToCart'}    
                                                    <button class="btn btn_cart" type="button">{lang('already_in_basket')}</button>
                                                {else:}
                                                    <button class="btn btn_buy" type="button">{lang('add_to_basket')}</button>
                                                {/if}
                                                {if is_in_wish($product->id)}
                                                    <button class="btn btn_small_p" type="button" title="{echo lang ('s_ilw')}"><span class="icon-wish"></span></button>
                                                {else:}
                                                    <button class="btn btn_small_p" type="button" title="{echo lang('s_save_W_L')}"><span class="icon-wish_2"></span></button>
                                                {/if}
                                           </div>
                                        </li>
                                    </ul>
                                    <!-- Product characteristics  -->       
                                    <ul class="characteristic">
                                        {$pdata = ShopCore::app()->SPropertiesRenderer->renderPropertiesCompareArray($product)}
                                        {foreach $data as $d}
                                           {$cval = ShopCore::encode($d)}
                                           {if is_array($pdata[$cval])}
                                                <li>
                                                    <span class="helper"></span>
                                                    <span>
                                                {$i = 0}
                                                {foreach $pdata[$cval] as $ms}
                                                        {echo $ms}
                                                    {if $i<(count($pdata[$cval])-1)},{/if}
                                                    {$i++}
                                                {/foreach}
                                                </span>
                                                </li>
                                            {else:}
                                                {if $pdata[$cval]}
                                                <li>
                                                    <span class="helper"></span>
                                                    <span>{echo $pdata[$cval]}</span>
                                                </li> 
                                                {else:}
                                                <li><span class="helper"></span><span>-</span></li> 
                                                {/if}
                                            {/if}
                                        {/foreach}
                                    </ul>
                                </li>
                                {/if}
                                {/foreach}
                            </ul>
                            </div>
                        </div> 
                    {/foreach}
            </div>    
            {else:}
                <!-- Show message if compare list is empty -->
                <div class="comparison_slider">
                    <div class="f-s_18 m-t_29 t-a_c">{lang('s_compare_list_em')}</div>
                </div>
            {/if}
        
        </div>
{widget('latest_news')}
</article>
