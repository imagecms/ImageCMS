{# Variables
# @var items
# @var capImage
# @var profile
#}
{$this->registerMeta('<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">')}
<div class="content">
    <div class="center">
        <h1>{lang('s_WL')}</h1>
        <h2 class="notificationWish"></h2>
        {if ShopCore::$ci->dx_auth->is_logged_in()===true}
            {if $items != null}
                <a href="#" class="f_l w-s_n-w" id="button_email">{lang('s_s_wish_list')}</a>
                <div class="fancy c_b f_l" style="border: none; display: none;" id="send_email">
                    <form action="" method="post" name="editForm" style="padding-left: 0; padding-right: 0px;">
                        <div id="change_info_edit" class="f_r">
                            <label class="f_r">{lang('s_form_input_wl')}:
                                <input type="text" name="friendsMail"/>
                            </label>
                            <div id="buttons">
                                <div class="p-t_19 c_b clearfix"  style="width: 191px;">
                                    <div class="buttons button_middle_blue f_l">
                                        <input type="submit" name="sendwish" value="{lang('s_send')}"/>
                                    </div>
                                </div>
                            </div>                                    
                        </div>
                        {form_csrf()}
                    </form>
                </div>
            {/if}
        {else:}
            {lang('s_to_sen_wish_auth')}
        {/if}
        {if !$items}
            <div class="comparison_slider">
                <div class="f-s_18 m-t_29 t-a_c">{echo ShopCore::t(lang('s_list_wish_empty'))}</div>
            </div>
        {else:}
            <table class="cleaner_table forCartProducts" cellspacing="0">
                <colgroup>
                    <col width="140" span="1">
                    <col width="371" span="1">
                    <col width="130" span="1">
                    <col width="224" span="1">
                    <col width="138" span="1">
                    <col width="28" span="1">
                </colgroup>
                <tbody>
                    {foreach $items as $key=>$item}
                        {$discount = ShopCore::app()->SDiscountsManager->productDiscount($item->id)}
                        {$prices = currency_convert($item.model->firstvariant->getPrice(), $item.model->firstvariant->getCurrency())}
                        {$style = productInCart($cart_data, $item.model->getId(), $item.model->firstVariant->getId(), $item.model->firstVariant->getStock())}
                        <tr>
                            <td>
                                <a href="{shop_url('product/' . $item.model->getUrl())}" class="photo_block">
                                    <img src="{productImageUrl($item.model->getMainModimage())}" alt="{echo ShopCore::encode($item.model->getName())}"/>
                                </a>
                            </td>
                            <td>
                                <a href="{shop_url('product/' . $item.model->getUrl())}">{echo ShopCore::encode($item.model->getName())}</a>
                            </td>
                            <td>
                                <div class="price f-s_16 f_l">{$prices.main.price}
                                    <sub>{$prices.main.symbol}</sub>

                                </div>
                            </td>
                            <td>    
                                <div class="buy">
                                    <div id="p{echo $item.model->getId()}" class="{$style.class} buttons">
                                        <span id="buy{echo $item.model->getId()}" class="{$style.identif}" data-varid="{echo $item.model->firstVariant->getId()}" data-prodid="{echo $item.model->getId()}" >
                                            {$style.message}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="price f-s_18 f_l">
                                    {if $discount AND ShopCore::$ci->dx_auth->is_logged_in() === true}
                                        {$prOne = $prices.main.price * 1}
                                        {$prTwo = $prices.main.price * 1}
                                        {$summary = $prOne - $prTwo / 100 * $discount}
                                        <del class="price price-c_red f-s_12 price-c_9">{echo $prices.main.price * 1} {$prices.main.symbol}</del> <br />
                                    {else:}
                                        {$summary = $prices.main.price}
                                    {/if}
                                    {echo $summary} 
                                    {$prices.main.symbol}
                                </div>
                            </td>
                            <td>
                                {if $rkey}
                                    {if ShopCore::$ci->dx_auth->is_logged_in()===true&&$rkey==$profile.key}
                                        <a href="{shop_url('wish_list/delete/' . $key)}" class="delete_plus">&times;</a>
                                    {/if}
                                {else:}
                                    {if ShopCore::$ci->dx_auth->is_logged_in()===true}
                                        <a href="{shop_url('wish_list/delete/' . $key)}" class="delete_plus">&times;</a>
                                    {/if}
                                {/if}
                            </td>
                        </tr>
                        {$total     += $summary}
                    {/foreach}
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="foot_cleaner">
                                <div class="price f-s_26 f_r">{$total} <sub>{$CS}</sub></div>
                                <div class="f_r sum">{lang('s_summ')}:</div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
                <input type="hidden" name="forCart" />
            </table>
        {/if}
        {widget('latest_news')}
    </div>
</div>
