{#
/**
* @file - template for view wish list by other users
* @updated 26 February 2013;
* Variables
* $items : Array of products in wish list
*
*/
#}
<article class="container">
    <h1>{lang("Wish List","admin")}</h1>
    <div class="row">
        <div class="text span8"><!-- Some text --></div>
    </div>
    <div class="frame_carousel_product">
        <!--If empty list show message -->
        {if !$items}
            <div class="comparison_slider">
                <div class="f-s_18 m-t_29 t-a_c">{echo ShopCore::t(lang("Your Wish List is empty ","admin"))}</div>
            </div>
        {else:}
            <!--If not empty list show list of products -->
            <div class="">
                <ul class="items items_catalog itemsFrameNS">
                    {foreach $items as $key=>$item}
                        <li class="span3 {if $item.model->firstvariant->stock == 0} not_avail{/if}">
                            <!-- Descritpion block -->
                            <div class="description">
                                <div class="frame_response">
                                    <div class="star">
                                        {$CI->load->module('star_rating')->show_star_rating($item.model)}
                                    </div>
                                </div>
                                <a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.model->getName())}</a>
                                <!-- Start. Price -->
                                <div class="price price_f-s_16">
                                    <!--$model->hasDiscounts() - checking for the existence of discounts. 
                                         If there is a discount price without discount C-->
                                    {if $item.model->hasDiscounts()}
                                        <span class="d_b old_price">
                                            <span class="f-w_b">{echo $item.model->firstVariant->toCurrency('OrigPrice')} </span>
                                            {$CS}
                                        </span>                           
                                    {/if}
                                    <!--If there is a discount of "$item.model->firstVariant->toCurrency()" or "$item.model->firstVariant->getPrice"
                                    will display the price already discounted-->
                                    <span class="f-w_b" >{echo $item.model->firstVariant->toCurrency()} </span>{$CS}
                                </div>
                                <!-- End. Price -->

                                <!-- Start. Check is product available -->
                                {if ShopCore::$ci->dx_auth->is_logged_in()===true}
                                    {if $item.model->firstvariant->stock != 0}
                                        <button class="btn btn_buy btnBuy" 
                                                type="button" 
                                                data-prodId="{echo $item.model->getId()}" 
                                                data-varId="{echo $item.model->firstVariant->getId()}" 
                                                data-price="{echo $item.model->firstVariant->toCurrency()}" 
                                                data-name="{echo $item.model->getName()}"
                                                data-number="{echo $item.model->firstVariant->getnumber()}"
                                                data-maxcount="{echo $item.model->firstVariant->getstock()}">
                                            {lang("Buy","admin")}
                                        </button>
                                    {else:}
                                        <button
                                                data-drop=".drop-report"
                                                data-prodid="{echo $item.model->getId()}"
                                                type="button"
                                                class="btn btn_not_avail">
                                            <span class="icon-but"></span>
                                            <span class="text-el">{lang("Report the appearance of","admin")}</span>
                                        </button>
                                    {/if}
                                {/if}
                                <!-- End. Check is product available -->
                            </div>
                            <!-- Photo block-->
                            <div class="photo-block">
                                <a href="{shop_url('product/' . $item.model->getUrl())}" class="photo">
                                    <figure>
                                        <span class="helper"></span>
                                        <img src="{echo $item.model->firstVariant->getSmallPhoto()}" alt="{echo ShopCore::encode($item.model->getName())}"/>
                                    </figure>
                                </a>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
        {/if}
    </div>
</article>