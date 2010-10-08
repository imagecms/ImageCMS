{literal}
    <style type="text/css">
        .ordersTable {
            font-size:13px;
        }
        .ordersTable td {
            padding-left:15px;
        }
        .ordersTable tr.hover:hover {
            background-color:#E8EEF6; 
        }
        .row_lite {
            background-color:#F5F5F5;
        }
        .row_dark {
            background-color:#EEEEEE;
        }
         .summary {
            font-size:15px;
        }
        #totalPriceText {
            font-weight:bold;
        }
    </style>
{/literal}

<div class="saPageHeader">
    <div style="float:left;">
        <h2>Заказ #{echo $model->getId()}</h2>
    </div>
    <div style="float:right;padding-top:2px;">
        Создан: {date("d-m-Y H:i", $model->getDateCreated())} 
        <br/>
        <span style="color:silver;font-size:11px;">{echo STimeHelper::timeAgoInWords($model->getDateCreated())}</span>
    </div>
</div>

<div style="clear:both;"></div>

<form method="post" action="{$ADMIN_URL}/orders/edit/{echo $model->getId()}?back_to={echo ShopCore::$_GET.back_to}"  style="width:100%">
<div style="width:100%;position:relative;">
    <div style="float:left;width:50%;">
        
            <div class="form_text">{echo $model->getLabel('Status')}:</div>
            <div class="form_input">
                {form_dropdown('Status',SOrders::$statuses,$model->getStatus())} 
            </div>
            <div class="form_overflow"></div>


            <div class="form_text"></div>
            <div class="form_input">
                <label><input type="checkbox" name="Paid" value="1" {if $model->getPaid()==1} checked="checked" {/if}/> {echo $model->getLabel('Paid')}</label>
            </div>
            <div class="form_overflow"></div>


            <div class="form_text">{echo $model->getLabel('UserFullName')}:</div>
            <div class="form_input">
                <input type="text" name="UserFullName" value="{echo ShopCore::encode($model->getUserFullName())}" class="textbox_long" />
            </div>
            <div class="form_overflow"></div>


            <div class="form_text">{echo $model->getLabel('UserEmail')}:</div>
            <div class="form_input">
                <input type="text" name="UserEmail" value="{echo ShopCore::encode($model->getUserEmail())}" class="textbox_long" />
            </div>
            <div class="form_overflow"></div>


            <div class="form_text">{echo $model->getLabel('UserPhone')}:</div>
            <div class="form_input">
                <input type="text" name="UserPhone" value="{echo ShopCore::encode($model->getUserPhone())}" class="textbox_long" />
            </div>
            <div class="form_overflow"></div>


            <div class="form_text">{echo $model->getLabel('UserDeliverTo')}:</div>
            <div class="form_input">
                <input type="text" name="UserDeliverTo" value="{echo ShopCore::encode($model->getUserDeliverTo())}" class="textbox_long" />
            </div>
            <div class="form_overflow"></div>

            <div class="form_text">{echo $model->getLabel('UserComment')}:</div>
            <div class="form_input">
                <textarea name="UserComment">{echo ShopCore::encode($model->getUserComment())}</textarea>
            </div>
            <div class="form_overflow"></div>

            <div class="footer_panel" align="right"> 
               <input type="submit" id="footerButton" name="_add" value="Сохранить" class="active"  onclick="ajaxShopForm(this);" />
            </div>

        {form_csrf()}
    </div>

    <!-- Right column with products list -->
    <div style="float:left;width:50%;padding-top:8px;">
        <table border="0" align="top" class="ordersTable" width="100%">
            {$total = 0}
            {foreach $model->getSOrderProductss() as $p }
            <tr valign="top" class="{counter('row_dark','row_lite')} hover">
                <td>
                    <a href="#">{echo ShopCore::encode($p->getProductName())}</a><br/>
                    {echo ShopCore::encode($p->getVariantName())}
                </td>
                <td align="left">
                    {echo $p->getQuantity()} шт. × {echo $p->getPrice()} $
                    {$total = $total + $p->getQuantity() * $p->getPrice()}
                </td>
            </tr>
            {/foreach}

            <tr style="height:20px;">
                <td></td>
                <td></td>
            </tr>

            <tr valign="top" class="row_lite">
                <td>                
                {if sizeof($deliveryMethods) > 0}
                {$freeDeliveryMethods=array()}
                    <select name="DeliveryMethod" style="width:200px;" onchange="changeTotalPriceByDeliveryPrice(this.value)">
                        <option value="0">- none -</option>
                        {foreach $deliveryMethods as $dm}

                        {if $dm->getId() == $model->getDeliveryMethod()}
                            {$selected='selected="selected"'}
                        {else:}
                            {$selected=''}
                        {/if}

                        {if $dm->getFreeFrom() == 0 && $dm->getPrice() > 0}
                            {//$free = $dm->getPrice()}
                        {elseif($total >= $dm->getFreeFrom()):}
                            {$freeDeliveryMethods[] = $dm->getId()}
                        {elseif($dm->getFreeFrom() > 0 && $dm->getPrice() > 0):}
                            {//$free = $dm->getPrice()} 
                        {/if}

                        {if $dm->getId() == $model->getDeliveryMethod()}
                            {$deliveryPrice = $model->getDeliveryPrice()}
                        {/if}

                        <option {$selected} value="{echo $dm->getId()}">{echo ShopCore::encode($dm->getName())}</option>
                        {/foreach}
                    </select>
                {/if}
                </td>
                <td align="left" id="deliveryMethodPriceText">
                    {echo $model->getDeliveryPrice()} 
                </td>
            </tr>

            <tr valign="top" class="row_lite summary">
                <td align="right">
                    <b>Итог:</b>
                </td>
                <td align="left" id="totalPriceText">
                    {echo $total + $deliveryPrice} $
                </td>
            </tr>
        </table>        
    </div>
</div>
</form>

<div style="clear:both;"></div>

<script type="text/javascript">
var totalPrice = '{$total}';

var deliveryMethods_prices = new Array;
var freeDeliveryMethods = new Array;

{foreach $freeDeliveryMethods as $freeMethod}
    freeDeliveryMethods[{$freeMethod}] = {$freeMethod};
{/foreach}

{foreach $deliveryMethods as $d}
    deliveryMethods_prices[{echo $d->getId()}] = '{echo $d->getPrice()}';
{/foreach}

{literal}
    function changeTotalPriceByDeliveryPrice(id)
    {
        var deliveryPrice = deliveryMethods_prices[id];

        if (!deliveryPrice)
        {
            document.getElementById('totalPriceText').innerHTML = totalPrice; 
            document.getElementById('deliveryMethodPriceText').innerHTML = '0.00';
            return true;
        }

        if (freeDeliveryMethods[id])
        {
            deliveryPrice = '0.00';
        }

        document.getElementById('deliveryMethodPriceText').innerHTML = deliveryPrice;

        if (deliveryPrice == '0.00')
        {
            document.getElementById('totalPriceText').innerHTML = totalPrice; 
        }
        else
        {
            var result = parseFloat(deliveryPrice) + parseFloat(totalPrice);
            document.getElementById('totalPriceText').innerHTML = result.toFixed(2).toString();
        }
    }
{/literal}
</script>
