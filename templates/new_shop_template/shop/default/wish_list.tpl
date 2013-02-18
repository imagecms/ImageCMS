{# Variables
# @var items
# @var capImage
# @var profile
#}
{$this->registerMeta('<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">')}
<article>
    <h1>{lang('s_WL')}</h1>
    <div class="row">
        <div class="text span8">
            <p>«Список желаний» представляет собой список желаний человека. С его помощью можно не только озвучить свои желания миру, но и облегчить жизнь родственникам, знакомым и друзьям, ищущим подарок.</p>
            <p>Все, кто хочет сделать вам подарок, но не может определиться с выбором. «Список желаний» – это самый простой ответ на вопрос "Что тебе подарить?". Обычно вишлист заполняется перед праздниками, а после уже пополняется не так часто, с появлением новых желаний.</p>
        </div>
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
                        {$discount = ShopCore::app()->SDiscountsManager->productDiscount($item->id)}
                        {$style = productInCart($cart_data, $item.model->getId(), $item.model->firstVariant->getId(), $item.model->firstVariant->getStock())}
                        <li class="span3 in_cart">
                            {if ShopCore::$ci->dx_auth->is_logged_in()===true}
                                <button class="btn btn_small btn_small_p">
                                    {//shop_url('wish_list/delete/' . $key)}
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
                                <div class="price price_f-s_16">
                                    <span class="f-w_b">{echo $item.model->firstvariant->getPrice()}</span> {$CS}
                                    <span class="second_cash"></span>
                                </div>
                                {if $style.identif == 'goToCart'}    
                                    <button class="btn btn_cart" type="button">{lang('already_in_basket')}</button>
                                {else:}
                                    <button class="btn btn_buy" type="button">{lang('add_to_basket')}</button>
                                {/if}
                            </div>
                        </li>
                        <!--Calculate total price-->
                        {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                            {$prOne = $item.model->firstvariant->getPrice() * 1}
                            {$prTwo = $item.model->firstvariant->getPrice() * 1}
                            {$summary = $prOne - $prTwo / 100 * $discount}
                            <del class="price price-c_red f-s_12 price-c_9">{echo $item.model->firstvariant->getPrice() * 1} {$CS}</del> <br />
                        {else:}
                            {$summary = $item.model->firstvariant->getPrice()}
                        {/if}
                        {$total     += $summary}
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
                        <span class="first_cash"><span class="f-w_b">{echo $total}</span> {$CS}</span>
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
  