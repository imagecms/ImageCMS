{#
/**
* @file Template for compare products
* @updated 26 February 2013;
* Variables
* $products:(оbject) instance of SProducts. Products in compare
* $categories: (array). Categories of products which are in compare
* Methods
* ShopCore::app()->SPropertiesRenderer->renderCategoryPropertiesArray(int $category_id): method gives product properties names by category id
* ShopCore::app()->SPropertiesRenderer->renderPropertiesCompareArray(Sproducts $product): method gives product properties values
*/
#}
<article>
    {$CI->load->helper('translit')}
    <div data-body="body">
        {if count($products) > 0}
            <!--Start. Show compare list if count products >0 -->
            <h1 class="f_l">{lang('s_compare_tovars')}</h1>
            <!-- Start. Buttons for change to show different or all properties -->
            <div class="f_l">
                <ul class="tabs tabs-dif-all_par groupButton">
                    <li class="active btn"><button type="button" data-href="#all-params">{lang('s_all_par')}</button></li>
                    <li class="btn"><button type="button" data-href="#only-dif">{lang('s_only_diff')}</button></li>
                </ul>
            </div>
            <!-- End. Buttons for change to show different or all properties -->
            <div class="p_r c_b">
                <!--Start. Show categories of products which are in list -->
                <div class="comprasion_head">
                    <div class="title_h2">{lang('s_category')}:</div>
                    <ul class="tabs">
                        {foreach $categories as $category}
                            <li><span data-href="#{$category.Url}"><span class="d_l_b">{echo $category.Name}</span></span></li>
                                {/foreach}
                    </ul>
                </div>
                <!--End. Show categories of products which are in list -->
                <div class="frame_tabsc">
                    <!-- Show blocks of products and properties grouped by category of products -->
                    {foreach $categories as $category}
                        <div id="{echo $category.Url}" data-refresh>
                            <div class="leftDescription">
                                <ul>
                                    <li></li>
                                </ul>
                                <!--Start.Product properties names -->
                                <ul class="characteristic">
                                    {$data = ShopCore::app()->SPropertiesRenderer->renderCategoryPropertiesArray($category['Id'])}
                                    {foreach $data as $d}
                                        <li>
                                            <span class="helper"></span>
                                            <span>{echo $d} </span>
                                        </li>
                                    {/foreach}
                                </ul>
                                <!--End. Product properties names -->
                            </div>
                            <div class="rightDescription">
                                <ul class="comprasion_tovars_frame row itemsFrameNS">
                                    {foreach $products as $product}
                                        {if $product->category_id == $category['Id']}
                                            {$product->firstVariant}
                                            <li class="span2">
                                                <ul class="items items_catalog">
                                                    <li>
                                                        <button class="btn btn_small btn_small_p"  onclick="Shop.CompareList.rm({echo $product->id}, this)">
                                                            <span class="icon-remove_comprasion"></span>
                                                        </button>
                                                        <!--Start. Product info -->
                                                        <div class="description">
                                                            <div class="frame_response">
                                                                <div class="star">
                                                                    {$CI->load->module('star_rating')->show_star_rating($product)}
                                                                </div>
                                                            </div>
                                                            <a href="{shop_url('product/' . $product->getUrl())}">{echo $product->getName()}</a>
                                                            <!-- Start. Price -->
                                                            <div class="price price_f-s_16">
                                                                {if $product->hasDiscounts()}
                                                                    <span class="d_b old_price">
                                                                        <span class="f-w_b">{echo $product->firstVariant->toCurrency('OrigPrice')} </span>{$CS}
                                                                    </span>
                                                                {/if}
                                                                <span class="f-w_b" >{echo $product->firstVariant->toCurrency()} </span>{$CS}
                                                            </div>
                                                            <!-- End. Price -->
                                                            <!--Start. Check amount of goods -->
                                                            {if $product->firstvariant->getstock() != 0}
                                                                <button class="btn btn_buy" 
                                                                        type="button" 
                                                                        data-prodId="{echo $product->getId()}" 
                                                                        data-varId="{echo $product->firstVariant->getId()}" 
                                                                        data-price="{echo $product->firstVariant->toCurrency()}" 
                                                                        data-name="{echo $product->getName()}"
                                                                        data-number="{echo $product->firstVariant->getnumber()}"
                                                                        data-maxcount="{echo $product->firstVariant->getstock()}">
                                                                    {lang('s_buy')}
                                                                </button>
                                                            {else:}
                                                                <button data-placement="bottom right"
                                                                        data-place="noinherit"
                                                                        data-duration="500"
                                                                        data-effect-off="fadeOut"
                                                                        data-effect-on="fadeIn"
                                                                        data-drop=".drop-report"
                                                                        data-prodid="{echo $product->getId()}"
                                                                        type="button"
                                                                        class="btn btn_not_avail">
                                                                    <span class="icon-but"></span>
                                                                    <span class="text-el">{lang('s_message_o_report')}</span>
                                                                </button>
                                                            {/if}
                                                            <!-- End. Check amount of goods -->
                                                            <!-- to wish list button -->
                                                            <button class="btn btn_small_p toWishlist" 
                                                                    data-prodid="{echo $product->getId()}" 
                                                                    data-varid="{echo $product->firstVariant->getId()}"  
                                                                    type="button"
                                                                    data-title="{lang('s_add_to_wish_list')}"
                                                                    data-sectitle="{lang('s_in_wish_list')}"
                                                                    data-rel="tooltip">
                                                                <span class="icon-wish_2"></span>
                                                            </button>
                                                        </div>
                                                        <!-- End. Product info -->
                                                        <div class="photo-block">
                                                            <a href="{shop_url('product/' . $product->getUrl())}" class="photo">
                                                                <figure>
                                                                    <span class="helper"></span>
                                                                    <img src="{productImageUrl($product->getSmallModimage())}" alt="{echo $product->id}"/>
                                                                </figure>
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!--Start. Product characteristics -->
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
                                                            <li>
                                                                <span class="helper"></span>
                                                                <span>-</span>
                                                            </li>
                                                        {/if}
                                                    {/if}
                                                {/foreach}
                                            </ul>
                                            <!--End. Product characteristics -->
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                {/foreach}
            </div>
            <!--End. Show compare list if count products >0 -->
        </div>
    {else:}
        <div data-body="message" class="d_b">
            <!--Start. Show message if compare list is empty -->
            <div class="bot_border_grey m-b_10">
                <h1 class="d_i">{lang('s_compare_tovars')}</h1>
            </div>
            <div class="alert alert-search-result">
                <div class="title_h2 t-a_c">{lang('s_compare_list_em')}</div>
            </div>
            <!--End. Show message if compare list is empty -->
        </div>
    {/if}
</div>
<div data-body="message">
    <!--Start. Show message if compare list is empty -->
    <div class="bot_border_grey m-b_10">
        <h1 class="d_i">{lang('s_compare_tovars')}</h1>
    </div>
    <div class="alert alert-search-result">
        <div class="title_h2 t-a_c">{lang('s_compare_list_em')}</div>
    </div>
    <!--End. Show message if compare list is empty -->
</div>
</article>