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

<article class="container">
    {widget('path')}
    <!--If empty list show message -->
    {if !$items}
        <div data-body="message" class="d_b">
            <!--Start. Show message if compare list is empty -->
            <div class="bot_border_grey m-b_10">
                <h1 class="d_i">{lang("Wish List","admin")}</h1>
            </div>
            <div class="alert alert-search-result">
                <div class="title_h2 t-a_c">{echo ShopCore::t(lang("Your Wish List is empty ","admin"))}</div>
            </div>
            <!--End. Show message if compare list is empty -->
        </div>
    {else:}

        <div data-body="body">
            <h1>{lang("Wish List","admin")}</h1>
            <!--If not empty list show list of products -->
            <div class="bot_border_grey">
                <ul class="items items_catalog itemsFrameNS">
                    {foreach $items as $key=>$item}

                        {foreach $item.model->getProductVariants() as $variants}
                            {if $variants->getid() == $item[1]}
                                {$variant = $variants}
                                {break}
                            {/if}
                        {/foreach}
                        <li class="span3 {if $variant->stock == 0} not_avail{/if}">

                            {if ShopCore::$ci->dx_auth->is_logged_in()===true}
                                <button class="btn btn_small btn_small_p" data-drop_bak=".drop-enter" onclick="Shop.WishList.rm({echo $item.model->getId()}, this, {echo $variant->getId()}, {echo $variant->toCurrency()})">
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
                                <span class="d_b m-b_5">
                                    {$hasCode = $variant->getNumber() == '';}
                                    <span class="frame_number" {if $hasCode}style="display:none;"{/if}>Артикул:
                                        <span class="code">({if !$hasCode}{echo $variant->getNumber()}{/if}) </span>
                                    </span>
                                    {$hasVariant = $variant->getName() == '';}
                                    <span class="frame_variant_name" {if $hasVariant}style="display:none;"{/if}>Вариант: <span class="code">({if !$hasVariant}{echo $variant->getName()}{/if})</span></span>
                                </span>
                                <!-- Start. Price -->
                                <div class="price price_f-s_16">
                                    <!--$model->hasDiscounts() - checking for the existence of discounts.
                                         If there is a discount price without discount C-->
                                    {if $item.model->hasDiscounts()}
                                        <span class="d_b old_price">
                                            <span class="f-w_b">{echo $variant->toCurrency('OrigPrice')} </span>
                                            {$CS}
                                        </span>
                                    {/if}
                                    <!--If there is a discount of "$variant->toCurrency()" or "$variant->getPrice"
                                    will display the price already discounted-->
                                    <span class="f-w_b" >{echo $variant->toCurrency()} </span>{$CS}
                                </div>
                                <!-- End. Price -->

                                <!-- Start. Check is product available -->
                                {if $variant->stock != 0}
                                    <button class="btn btn_buy btnBuy"
                                            type="button"
                                            data-prodid="{echo $item.model->getId()}"
                                            data-varid="{echo $variant->getId()}"
                                            data-price="{echo $variant->toCurrency()}"
                                            data-name="{echo ShopCore::encode($item.model->getName())}"
                                            data-maxcount="{echo $variant->getstock()}"
                                            data-number="{echo $variant->getNumber()}"
                                            data-img="{echo $variant->getSmallPhoto()}"
                                            data-url="{echo shop_url('product/'.$item.model->getUrl())}"

                                            data-origPrice="{if $item.model->hasDiscounts()}{echo $variant->toCurrency('OrigPrice')}{/if}"
                                            data-stock="{echo $variant->getStock()}"
                                            >
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
                                <!-- End. Check is product available -->
                            </div>
                            <!-- Photo block-->
                            <div class="photo-block">
                                <a href="{shop_url('product/' . $item.model->getUrl())}" class="photo">
                                    <figure>
                                        <span class="helper"></span>
                                        <img src="{echo $variant->getSmallPhoto()}" alt="{echo ShopCore::encode($item.model->getName())}"/>
                                    </figure>
                                </a>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
            <div class="row footer_wish-list">
                <div class="span6">
                    <div class="d_i-b title">{lang("Total","admin")}:</div>
                    <div class="price price_f-s_24 d_i-b">
                        <span class="first_cash"><span class="f-w_b" id="wishListTotal">{echo $total_price}</span> {$CS}</span>
                    </div>
                </div>
                <form action="" method="post" name="editForm" style="padding-left: 0; padding-right: 0px;">
                    <div class="span6">
                        <div class="standart_form horizontal_form t-a_r">
                            <input type="submit" value="{lang('Отправить','commerce4x')}" name="sendwish" class="btn btn_cart f_r m-l_10"/>
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
            <h1 class="d_i">{lang("Wish List","admin")}</h1>
        </div>
        <div class="alert alert-search-result">
            <div class="title_h2 t-a_c">{echo ShopCore::t(lang("Your Wish List is empty ","admin"))}</div>
        </div>
        <!--End. Show message if compare list is empty -->
    </div>
</article>
