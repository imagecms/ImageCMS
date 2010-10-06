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
    </style>
{/literal}

<div class="saPageHeader">
    <h2>Заказы</h2>
</div>

{//var_dump($model)}

<div class="orderItem">
<div class="" style="color:#7B7B7B;font-size:11px;">10.12.2009 0:50</div>
    <div class="orderLeft">
        <div class="orderParam row_dark">
            <a href="#" style="font-size:14px;"><b>Заказ #1</b></a>
        </div>
        <div class="paramValue row_dark" style="text-decoration:underline;">Andrij Bubis'</div> 
        <div class="clear"></div>

        <div class="orderParam row_lite">Email:</div>
        <div class="paramValue row_lite">some@host.com</div> 
        <div class="clear"></div> 

        <div class="orderParam row_dark">Телефон:</div>
        <div class="paramValue row_dark">77-77-77</div> 
        <div class="clear"></div>

        <div class="orderParam row_lite">Адрес доставки:</div>
        <div class="paramValue row_lite">Andrij Bubis'</div> 
        <div class="clear"></div>

        <div class="orderParam row_dark">Комментарий к заказу:</div>
        <div class="paramValue row_dark">Andrij Bubis'</div>
        <div class="clear"></div>
    </div>

    <div class="orderRight">
        <table border="0" align="top" class="ordersTable" width="100%">
            <tr valign="top" class="row_lite hover">
                <td>
                    <a href="#">Задний фонарь "Стоп+поворотники" (9 светодиодов, 2*АА)</a><br/>
                    (10 шт. на складе) 
                </td>
                <td align="right">
                    1 шт. × 14.00 $
                </td>
            </tr>

            <tr valign="top" class="row_lite hover">
                <td>
                    <a href="#">Задний фонарь "Стоп+поворотники" (9 светодиодов, 2*АА)</a><br/>
                    (10 шт. на складе) 
                </td>
                <td align="right">
                    1 шт. × 14.00 $
                </td>
            </tr>

            <tr valign="top" class="row_lite">
                <td>
                    Dostavka 1 (бесплатно)  
                </td>
                <td align="right">
                    14.00 $
                </td>
            </tr>

            <tr valign="top" class="row_lite summary">
                <td align="right">
                    <b>Итог:</b>
                </td>
                <td align="right">
                    <b>1400.00 $</b>
                </td>
            </tr>
        </table> 
    </div>

    <div class="actions" style="float:right;">
        <img src="/application/modules/shop/admin/templates/assets/images/arrow.png" id="proccessOrderButton" title="В обработку"/>
        <br/>
        <img src="/application/modules/shop/admin/templates/assets/images/delete.png" id="deleteOrderButton" title="Удалить заказ"/>
    </div>

    <div style="clear:both;"></div>
</div>


