<table class="table  table-bordered table-hover table-condensed content_big_td">
    <thead>
    <tr>
        <th colspan="6">{lang('Yandex market fields', 'ymarket')}</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="6">
            <div class="inside_padd">
                <div class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">{lang('Сountry of product manufacture', 'ymarket')}:</label>

                        <div class="controls">
                            <div class="related-input-ins">
                                <select name="ymarket[country_of_origin]">
                                    <option value="">--{echo lang('No selected', 'ymarket')}--</option>
                                    {foreach $countries as $country}
                                        <option {if $fields['country_of_origin'] == trim($country)}selected="selected"{/if} value="{echo trim($country)}">{echo trim($country)}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">{lang('Manufacturer warranty, months', 'ymarket')}:</label>

                        <div class="controls">
                                <span class="frame_label {if $fields['manufacturer_warranty'] != 'false'}active{/if} no-connect" onclick="YmarketProductTab.showHideMonths(this)">
                                    <span class="niceCheck" style="background-position: -46px 0px;">
                                        <input type="checkbox" {if $fields['manufacturer_warranty'] != 'false'}checked="checked"{/if} name="ymarket[manufacturer_warranty][exist]">
                                    </span>
                                </span>

                            <select class="notchosen span2" name="ymarket[manufacturer_warranty][time]" {if ($fields['manufacturer_warranty'] AND $fields['manufacturer_warranty'] == 'false') OR !$fields['manufacturer_warranty']}style="display: none;" disabled="disabled"{/if}>
                                <option value="">--{echo lang('No selected', 'ymarket')}--</option>
                                {foreach $months as $month}
                                    <option {if $fields['manufacturer_warranty']== $month}selected="selected"{/if} value="{echo $month}">{echo $month}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">{lang('Seller warranty, months', 'ymarket')}:</label>

                        <div class="controls">
                                <span class="frame_label {if $fields['seller_warranty'] != 'false'}active{/if} no-connect" onclick="YmarketProductTab.showHideMonths(this)">
                                    <span class="niceCheck" style="background-position: -46px 0px;">
                                        <input type="checkbox" {if $fields['seller_warranty'] != 'false'}checked="checked"{/if} name="ymarket[seller_warranty][exist]">
                                    </span>
                                </span>

                            <select class="notchosen span2" name="ymarket[seller_warranty][time]" {if ($fields['seller_warranty'] AND $fields['seller_warranty'] == 'false') OR !$fields['seller_warranty']}style="display: none;" disabled="disabled"{/if}>
                                <option value="">--{echo lang('No selected', 'ymarket')}--</option>
                                {foreach $months as $month}
                                    <option {if $fields['seller_warranty']== $month}selected="selected"{/if} value="{echo $month}">{echo $month}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>