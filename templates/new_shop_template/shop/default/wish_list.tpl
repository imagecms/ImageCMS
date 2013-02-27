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
    <h1>{lang('s_WL')}</h1>
    <div class="row">
        <div class="text span8"><!-- Some text --></div>
    </div>
    <div class="frame_carousel_product">
        <!--If empty list show message -->
        {if !$items}
            <div class="comparison_slider">
                <div class="f-s_18 m-t_29 t-a_c">{echo ShopCore::t(lang('s_list_wish_empty'))}</div>
            </div>
        {else:}
            <!--If not empty list show list of products -->
            <div class="bot_border_grey">
                <ul class="items items_catalog itemsFrameNS">
                {foreach $items as $key=>$item}
                        <li class="span3 {if $item.model->firstvariant->stock == 0} not-avail{/if}">
                            {if ShopCore::$ci->dx_auth->is_logged_in()===true}
                                <button class="btn btn_small btn_small_p" onclick="window.location = '{echo base_url()}shop/wish_list/delete/{echo $key}'; Shop.WishList.rm({echo $item.model->getId()})">
                                    <span class="icon-remove_comprasion"></span>
                                </button>    
                            {/if}
                            <!-- Photo block-->
                            <a href="{shop_url('product/' . $item.model->getUrl())}" class="photo">
                                <span class="helper"></span>
                                <figure class="w_150">
                                    <img src="{productImageUrl($item.model->getMainModimage())}" alt="{echo ShopCore::encode($item.model->getName())}"/>
                                </figure>
                            </a>
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
                                                 <span class="f-w_b">{echo $item.model->firstVariant->toCurrency('OrigPrice')}</span>
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
                                    <button class="btn btn_buy" type="button" data-prodId="{echo $item.model->getId()}" data-varId="{echo $item.model->firstVariant->getId()}" data-price="{echo $item.model->firstVariant->toCurrency()}" data-name="{echo $item.model->getName()}">{lang('add_to_basket')}</button>
                                {else:}
                                    <button class="btn btn_not_avail" type="button" data-prodId="{echo $item.model->getId()}" data-varId="{echo $item.model->firstVariant->getId()}" data-price="{echo $item.model->firstVariant->toCurrency()}" data-name="{echo $item.model->getName()}"> {lang('s_message_o_report')} </button>
                                {/if}
                                <!-- End. Check is product available -->
                            </div>
                        </li>
                {/foreach}
                </ul>
            </div>
         {/if}
         <!--Show block with total price and send email form, if count products >0  -->
        {if count($items)>0}
            <div class="row footer_wish-list">
                <div class="span6">
                    <div class="d_i-b title">{lang('s_summ')}:</div>
                    <div class="price price_f-s_24 d_i-b">
                        <span class="first_cash"><span class="f-w_b">{echo $total_price}</span> {$CS}</span>
                    </div>
                </div>
                <div class="span6">
                    <div class="standart_form horizontal_form t-a_r">
                        <input type="submit" value="Отправить страницу" class="btn btn_cart f_r m-l_10"/>
                        <div class="o_h">
                            <input type="text" placeholder="E-mail получателя"/>
                        </div>
                    </div>
                </div>
            </div>
        {/if}
    </div>
</article>
  