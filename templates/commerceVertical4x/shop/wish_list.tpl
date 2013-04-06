{#
/**
* @file - template for displaying wish list
* @updated 26 February 2013;
* Variables
* $items : Array of products in wish list
* $profile : (array) Info about user
* $total_price : (string) Total price of all products
*/
#}

<article>
    <!--If empty list show message -->
    {if !$items}
        <div data-body="message" class="d_b">
            <!--Start. Show message if compare list is empty -->
            <div class="bot_border_grey m-b_10">
                <h1 class="d_i">{lang('s_WL')}</h1>
            </div>
            <div class="alert alert-search-result">
                <div class="title_h2 t-a_c">{echo ShopCore::t(lang('s_list_wish_empty'))}</div>
            </div>
            <!--End. Show message if compare list is empty -->
        </div>
    {else:}
        <div data-body="body">
            <h1>{lang('s_WL')}</h1>
            <!--If not empty list show list of products -->
            <div class="bot_border_grey">
                <ul class="items items_catalog itemsFrameNS">
                    {foreach $items as $key=>$item}
                        <li class="span3 {if $item.model->firstvariant->stock == 0} not-avail{/if}">
                            {if ShopCore::$ci->dx_auth->is_logged_in()===true}
                                <button class="btn btn_small btn_small_p" data-drop_bak=".drop-enter" onclick="Shop.WishList.rm({echo $item.model->getId()}, this)">
                                    <span class="icon-remove_comprasion"></span>
                                </button>    
                            {/if}
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
                                {if $item.model->firstvariant->stock != 0}
                                    <button class="btn btn_buy" 
                                            type="button" 
                                            data-prodId="{echo $item.model->getId()}" 
                                            data-varId="{echo $item.model->firstVariant->getId()}" 
                                            data-price="{echo $item.model->firstVariant->toCurrency()}" 
                                            data-name="{echo $item.model->getName()}"
                                            data-number="{echo $item.model->firstVariant->getnumber()}"
                                            data-maxcount="{echo $item.model->firstVariant->getstock()}">
                                        {lang('s_buy')}
                                    </button>
                                {else:}
                                    <button data-placement="bottom right"
                                            data-place="noinherit"
                                            data-duration="500"
                                            data-effect-off="fadeOut"
                                            data-effect-on="fadeIn"
                                            data-drop=".drop-report"
                                            data-prodid="{echo $item.model->getId()}"
                                            type="button"
                                            class="btn btn_not_avail">
                                        <span class="icon-but"></span>
                                        <span class="text-el">{lang('s_message_o_report')}</span>
                                    </button>              
                                {/if}
                                <!-- End. Check is product available -->
                            </div>
                            <!-- Photo block-->
                            <div class="photo-block">
                                <a href="{shop_url('product/' . $item.model->getUrl())}" class="photo">
                                    <figure>
                                        <span class="helper"></span>
                                        <img src="{productImageUrl($item.model->getMainModimage())}" alt="{echo ShopCore::encode($item.model->getName())}"/>
                                    </figure>
                                </a>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
            <div class="row footer_wish-list">
                <div class="span6">
                    <div class="d_i-b title">{lang('s_summ')}:</div>
                    <div class="price price_f-s_24 d_i-b">
                        <span class="first_cash"><span class="f-w_b" id="wishListTotal">{echo $total_price}</span> {$CS}</span>
                    </div>
                </div>
                <form action="" method="post" name="editForm" style="padding-left: 0; padding-right: 0px;">
                    <div class="span6">
                        <div class="standart_form horizontal_form t-a_r">
                            <input type="submit"  name="sendwish" class="btn btn_cart f_r m-l_10"/>
                            <div class="o_h">
                                <input type="text" placeholder="E-mail получателя" name="friendsMail"/>
                            </div>
                        </div>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
    {/if}
    <div data-body="message">
        <!--Start. Show message if compare list is empty -->
        <div class="bot_border_grey m-b_10">
            <h1 class="d_i">{lang('s_WL')}</h1>
        </div>
        <div class="alert alert-search-result">
            <div class="title_h2 t-a_c">{echo ShopCore::t(lang('s_list_wish_empty'))}</div>
        </div>
        <!--End. Show message if compare list is empty -->
    </div>
</article>
