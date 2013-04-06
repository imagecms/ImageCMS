{# Variables
# @var model
# @var paymentMethods
# @var deliveryMethod
#}
<div class="content_head">
    <h1>Заказ №{echo $model->getId()}</h1>
{if $CI->session->flashdata('makeOrder') === true}<h2>Спасибо за Ваш заказ.</h2>{/if}
</div>
        <ul class="catalog">
            {foreach $model->getSOrderProductss() as $item}
                {$total = $total + $item->getQuantity() * $item->toCurrency()}
                {$product = $item->getSProducts()}
            <li> 
                <div class="top_frame_tov">
                    <span class="figure">
                        <a href="{shop_url('product/' . $product->getUrl())}">
                            <img src="{productImageUrl($product->getSmallModimage())}"/>
                        </a>
                    </span>
                    <span class="descr">
                        <a href="{shop_url('product/' . $product->getUrl())}" class="title">{echo ShopCore::encode($product->getName())}</a>
                        <span class="d_b price">{echo $item->getPrice()} {$CS}</span>
                        <span class="count">{echo $item->getQuantity()} шт.</span>
                    </span>
                </div>  
            </li>
            {/foreach}
        </ul>
        <div class="main_frame_inside">
            <div class="gen_sum">
                <span class="total_pay">Всего к оплате:</span>
                <span class="price">
                    {echo $total} {$CS}
                </span>
            </div>
        </div>
    </div>
</div>






