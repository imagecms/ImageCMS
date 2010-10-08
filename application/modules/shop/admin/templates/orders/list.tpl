{literal}
    <style type="text/css">
        .orderItem {
            padding:3px;
            width:99%;
            clear:both;
            position:relative;
            border-bottom:1px solid silver;
            background-color:#F5F5F5;
            margin-bottom:5px;
            color:#636363;
        }
        .orderItem:hover {
            color:#000;
        }
        .orderItem .orderLeft {
            width:50%;
            float:left;
        }
        .orderItem .orderLeft .orderParam {
            float:left;
            width:150px;
        }
        .orderItem .orderLeft .paramValue {

        }
        .orderItem .orderRight {
            width:45%;
            float:left;
        }
        .orderProduct {
            font-size:11px;
            margin-bottom:3px;
        }
        .ordersTable {
            font-size:11px;
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
        #proccessOrderButton:hover {
            background-color:#BBD8FE;
            border-radius:4px;
            cursor:pointer;
        }
        #proccessOrderButton {
            padding:3px;
        }
        #deleteOrderButton {
            border-radius:4px;
            padding:3px;
            margin-left:8px;
            cursor:pointer;
        }
        #deleteOrderButton:hover {
            background-color:#FF777A;  
        }
        .summary {
            font-size:14px;
        }
        a.filterLink {
            color:#888888;
            padding-left:15px;
        }
        a.filterLink:hover, a.active {
            color:#098ED1; 
        }
        a.active {
            font-weight:bold;
        }
    </style>
{/literal}

<div class="saPageHeader">
    <div style="float:left;">
        <h2>Заказы</h2>
    </div>

    <div style="float:left; padding-top:8px;padding-left:35px;">
        {foreach SOrders::$statuses as $s_key => $s_value} 
            {if ShopCore::$_GET.status == $s_key} 
                {$active='active'}
            {else:}
                {$active=''}
            {/if}
            <a href="#" onClick="ajaxShop('orders/index?status={$s_key}'); return false;" class="filterLink {$active}">{$s_value}</a>
        {/foreach}
    </div>

    <div style="float:right;padding-top:2px;margin-right:5px;position:relative;" onsubmit="return false;">
        <form id="">
            <input type="text" name="search_text" class="textbox_long" />
            <input type="submit" value="Search" class="search_submit" id="ttt" />

            <!--
            <div style="width:276px;height:200px;border:1px solid silver;background-color:#fff;position:absolute;z-index:99999;">
                <div class="form_text"></div>
                    <div class="form_input">
                        Оплачен
                    </div>
                <div class="form_overflow"></div> 
            </div>
            -->
        </form>
    </div>
</div>

{if sizeof($model)==0}
    <div id="notice" style="width: 500px; ">
        Список заказов пустой.
    </div>
    {return}
{/if}

{foreach $model as $o}

<div class="orderItem" id="orderId{echo $o->getId()}">
<div class="" style="color:#7B7B7B;font-size:11px;">{date("d-m-Y H:i:s", $o->getDateCreated())}</div>
    <div class="orderLeft">
        <div class="orderParam row_dark">
            <a href="#" onclick="ajaxShop('orders/edit/{echo $o->getId()}?back_to={echo ShopCore::$_GET.status}'); return false;" style="font-size:14px;"><b>Заказ #{echo $o->getId()}</b></a>
        </div>
        <div class="paramValue row_dark" style="text-decoration:underline;">{echo ShopCore::encode($o->getUserFullName())}</div> 
        <div class="clear"></div>

        <div class="orderParam row_lite">Email:</div>
        <div class="paramValue row_lite">{echo ShopCore::encode($o->getUserEmail())}</div> 
        <div class="clear"></div> 

        <div class="orderParam row_dark">Телефон:</div>
        <div class="paramValue row_dark">{echo ShopCore::encode($o->getUserPhone())}</div> 
        <div class="clear"></div>

        <div class="orderParam row_lite">Адрес доставки:</div>
        <div class="paramValue row_lite">{echo ShopCore::encode($o->getUserDeliverTo())}</div>
        <div class="clear"></div>

        <div class="orderParam row_dark">Комментарий к заказу:</div>
        <div class="paramValue row_dark">{echo ShopCore::encode($o->getUserComment())}</div>
        <div class="clear"></div>
    </div>

    <div class="orderRight">
        <table border="0" align="top" class="ordersTable" width="100%">
            {$total = 0}
            {foreach $o->getSOrderProductss() as $p }
            <tr valign="top" class="{counter('row_dark','row_lite')} hover">
                <td>
                    <a href="#">{echo $p->getProductName()}</a><br/>
                    {echo $p->getVariantName()}  
                </td>
                <td align="left">
                    {echo $p->getQuantity()} шт. × {echo $p->getPrice()} $
                    {$total = $total + $p->getQuantity() *  $p->getPrice()}
                </td>
            </tr>
            {/foreach}

            <tr valign="top" class="row_lite">
                <td>
                {if $o->getSDeliveryMethods()}
                    {echo $o->getSDeliveryMethods()->getName()}
                {/if}
                </td>
                <td align="left">
                    {echo $o->getDeliveryPrice()}
                    {$total = $total + $o->getDeliveryPrice()}
                </td>
            </tr>

            <tr valign="top" class="row_lite summary">
                <td align="left">
                    <b>Итог:</b>
                </td>
                <td align="left">
                    <b>{$total} $</b>
                </td>
            </tr>
        </table> 
    </div>

    <div class="actions" style="float:right;">
        {if ShopCore::$_GET.status==0}
        <img src="/application/modules/shop/admin/templates/assets/images/arrow.png" id="proccessOrderButton" onclick="moveToInProgress({echo $o->getId()});" title="В обработку"/>
        <br/>
        {/if}

        {if ShopCore::$_GET.status==1}
        <img src="/application/modules/shop/admin/templates/assets/images/tick.png" id="proccessOrderButton" onclick="moveToCompleted({echo $o->getId()});" title="Выполнен"/>
        <br/>
        {/if}
 
        {if $o->getPaid() == true}
            <img src="/application/modules/shop/admin/templates/assets/images/credit-card.png" id="proccessOrderButton" 
            onclick="changePaid(this, {echo $o->getId()});" title="Оплачен"/>
        {else:}
            <img src="/application/modules/shop/admin/templates/assets/images/credit-card-silver.png" id="proccessOrderButton" 
            onclick="changePaid(this, {echo $o->getId()})" title="Оплачен"/>
        {/if}
        <br/>
        <img src="/application/modules/shop/admin/templates/assets/images/delete.png" id="deleteOrderButton" title="Удалить заказ" onclick="confirm_delete_order({echo $o->getId()}, {echo ShopCore::$_GET.status});"/>
    </div>

    <div style="clear:both;"></div>
</div>
{/foreach}
