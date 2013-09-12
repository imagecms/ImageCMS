<table class="table PartnersTable" {if !$info}style="display: none"{/if}>
    <thead>
        <tr>
            <th class="span1">#</th>
            <th>Регіон</th>
            <th class="span2">Ціна</th>
            <th>Количество</th>
            <th class="span4">Статус</th>
            <th class="span2">Обновить</th>
            <th class="span2">Удалить</th>
        </tr>
    </thead>
    <tbody>
        {foreach $info as $k => $datas}
            <tr class="partnerData" data-productid="{echo $datas['product_id']}" data-partner="{echo $datas['partner_external_id']}">
                <td>{echo $k+1}</td>
                <td class="regionName">{echo $datas['region']}</td>
                <td class="change">
                    <div class="pricePartner">{echo $datas['price']}</div>
                    <input class="pricePartner" type="text" style="display: none"/>
                </td>
                <td class="change">
                    <div class="quantityPartner" style="display: block">{echo $datas['quantity']}</div>
                    <input class="quantityPartner" type="text" style="display: none"/>
                </td>
                <td>
                    <button type="button" class="btn btn-small setHitPartner {if $datas['hit']}{echo 'btn-primary'}{/if}" >
                        <i class="icon-fire"></i> Хит</button>
                    <button type="button" class="btn btn-small  setHotPartner {if $datas['hot']}{echo 'btn-primary'}{/if}" >
                        <i class="icon-gift"></i> Новинки</button>
                    <button type="button" class="btn btn-small  setActionPartner {if $datas['action']}{echo 'btn-primary'}{/if}">
                        <i class="icon-star"></i> Реклама</button>
                </td>
                <td class="span1">
                    <button type="button" class="btn btn-small btn-success partnerRefresh">
                        <i class="icon-edit"></i>Редактировать</button>
                    <button type="button" class="btn btn-small btn-success updatePartnerPrice" style="display: none">
                        <i class="icon-refresh"></i>Обновить</button>
                </td>
                <td class="span1">
                    <button type="button" class="btn btn-small action_on btn-danger deletePartnerPrice">
                        <i class="icon-trash"></i>Удалить</button>
                </td>

            </tr>
        {/foreach}
        <tr class="addPartnerPrice" style="display: none">
            <td class="counterPartners">{echo $k+2}</td>
            <td>
                <select name="partner[]" class="partnersSelect">
                    <option value="false">--Не выбрано--</option>
                    {foreach $partners as $partner}
                        <option value='{echo $partner['id']}'>{echo $partner['region']}</option>
                    {/foreach}
                </select>
            </td>
            <td>
                <div class="number">
                    <input type="text" required name="partner_price[]"/>
                </div>
            </td>
            <td>
                <div class="number">
                    <input type="text" required name="partner_quantity[]"/>
                </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <td colspan="7"></td>
</tr>
</tbody>
</table>
<div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;{if $info}display: none;{/if}">
    Список пуст
</div>
<br>
<a class="btn btn-small pjax pull-right btn-success"  href="{$BASE_URL}admin/components/init_window/exchangeunfu" >
    <i class="icon-plus"></i>Создать партнера
</a>
<button type="button" class="btn btn-small action_on pull-right btn-success addPartnerBtn">
    <i class="icon-plus"></i>Добавить партнера
</button>
