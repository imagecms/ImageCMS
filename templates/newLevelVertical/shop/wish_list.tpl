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
<div class="frame-inside page-wish-list">
    <div class="container">
        {if count($items) > 0}
            <div class="clearfix">
                <div class="title-h1 f_l">{lang('Wishlist','newLevel')}</div>
            </div>
            <!--            Start. Show products in wish list-->
            <ul class="items items-catalog items items-wish-list" id="items-catalog-main">
                <!-- Include template for one product item-->
                {/*$CI->load->module('new_level')->OPI($items, array('wishlist'=>true))*/}
                {foreach $items as $key=>$item}
                    {foreach $item.model->getProductVariants() as $variants}
                        {if $variants->getid() == $item[1]}
                            {$variant = $variants}
                            {break}
                        {/if}
                    {/foreach}
                    <li class="span3 {if $variant->stock == 0} not_avail{/if}">

                        {if ShopCore::$ci->dx_auth->is_logged_in()===true}
                            <button class="icon_times" data-drop_bak=".drop-enter" onclick="Shop.WishList.rm({echo $item.model->getId()}, this, {echo $variant->getId()})">
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
                                <span class="frame-variant-code" {if $hasCode}style="display:none;"{/if}>{lang('Отметить','newLevel')}: <span class="code">({if !$hasCode}{echo $variant->getNumber()}{/if})</span></span>
                                {$hasVariant = $variant->getName() == '';}
                                <span class="frame-variant-name" {if $hasVariant}style="display:none;"{/if}>{lang('Вариант','newLevel')}: <span class="code">({if !$hasVariant}{echo $variant->getName()}{/if})</span></span>
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
                                        {echo $variant->getStock()}"
                                        >
                                    {lang('Купить','newLevel')}
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
                                    <span class="text-el">{lang('Сообщить о появлении','newLevel')}</span>
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
            <!--            End. Show products-->
            <!--            Start. Show form "send wish list to friend" if logged in-->
            {if ShopCore::$ci->dx_auth->is_logged_in() === true}
                <form action="" method="post" name="editForm">
                    <div class="left-order">
                        <input type="text" placeholder="{lang('Адрес электронной почты получателя','newLevel')}" name="friendsMail"/>
                    </div>
                    <div class="btn-order">
                        <button type="submit"  name="sendwish"> {lang('Показать другу','newLevel')} </button>
                    </div>
                    {form_csrf()}
                </form>
            {/if}
            <!--            End. Show form "send wish list to friend" if logged in-->
        {else:}
            <!--      Start. Empty wish list-->
            <div class="clearfix">
                <div class="title-h3">{lang('Список желаний пуст','newLevel')}</div>
            </div>
            <!--      End. Empty wishlist-->
        {/if}
    </div>
</div>