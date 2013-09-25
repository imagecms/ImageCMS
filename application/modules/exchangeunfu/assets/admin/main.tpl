<table class="table PartnersTable table-striped table-bordered table-hover table-condensed" {if !$info}style="display: none"{/if}>
    <thead>
        <tr>
            <th class="span1">#</th>
            <th>{lang('Region', 'exchangeunfu')}</th>
            <th class="span2">{lang('Price', 'exchangeunfu')}</th>
            <th>{lang('Count', 'exchangeunfu')}</th>
            <th class="span4">{lang('Status', 'exchangeunfu')}</th>
            <th class="span2">{lang('Update', 'exchangeunfu')}</th>
            <th class="span2">{lang('Delete', 'exchangeunfu')}</th>
        </tr>
    </thead>
    <tbody>
        {foreach $info as $k => $datas}
            <tr class="partnerData" data-productid="{echo $datas['product_id']}" data-partner="{echo $datas['partner_external_id']}" data-partnercode="{echo $datas['partner_code']}">
                <td>{echo $k+1}</td>
                <td class="regionName" data-partnercode="{echo $datas['partner_code']}">{echo $datas['region']}</td>
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
                        <i class="icon-fire"></i> {lang('Hit', 'exchangeunfu')}</button>
                    <button type="button" class="btn btn-small  setHotPartner {if $datas['hot']}{echo 'btn-primary'}{/if}" >
                        <i class="icon-gift"></i> {lang('Novelty', 'exchangeunfu')}</button>
                    <button type="button" class="btn btn-small  setActionPartner {if $datas['action']}{echo 'btn-primary'}{/if}">
                        <i class="icon-star"></i> {lang('Promotion', 'exchangeunfu')}</button>
                </td>
                <td class="span1">
                    <button type="button" class="btn btn-small btn-success partnerRefresh">
                        <i class="icon-edit"></i>{lang('Edit', 'exchangeunfu')}</button>
                    <button type="button" class="btn btn-small btn-success updatePartnerPrice" style="display: none">
                        <i class="icon-refresh"></i>{lang('Refresh', 'exchangeunfu')}</button>
                </td>
                <td class="span1">
                    <button type="button" class="btn btn-small action_on btn-danger deletePartnerPrice">
                        <i class="icon-trash"></i>{lang('Delete', 'exchangeunfu')}</button>
                </td>

            </tr>
        {/foreach}
        <tr class="addPartnerPrice" style="display: none">
            <td class="counterPartners">{echo $k+2}</td>
            <td>
                <select name="partner[]" class="partnersSelect">
                    <option value="false">--{lang('Not choose', 'exchangeunfu')}--</option>
                    {foreach $partners as $partner}
                        <option value='{echo $partner['code']}'>{echo $partner['region']}</option>
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
    {lang('Empty list', 'exchangeunfu')}
</div>
<br>
<a class="btn btn-small pjax pull-right btn-success"  href="{$BASE_URL}admin/components/init_window/exchangeunfu" >
    <i class="icon-plus"></i>{lang('Create partner', 'exchangeunfu')}
</a>
<button type="button" class="btn btn-small action_on pull-right btn-success addPartnerBtn">
    <i class="icon-plus"></i>{lang('Add partner', 'exchangeunfu')}
</button>
