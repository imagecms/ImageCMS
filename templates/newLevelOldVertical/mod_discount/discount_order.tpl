{$kitDisc = $CI->load->module('shop/cart_api')->get_kit_discount()}

{if $discount->sum_discount_product > $discount->sum_discount_no_product}
    <div>
        <span class="s-t">{lang('Тип скидки: ','newLevelVertical')}</span>
        <span class="price-item">{lang('Продуктовый','newLevelVertical')}</span>
    </div>
    <div>
        <span class="s-t">{lang('Размер скидки:','newLevelVertical')}</span>
        <span class="price-item">
            <span class="text-discount">
                <span class="price">{echo $discount->result_sum_discount_convert+$kitDisc}</span>
                <span class="curr">{$CS}</span>
            </span>
        </span>
    </div>
{else:}
{if $discount->max_discount->type_value == 1} {$type_value = "%"} {else:}{$type_value = "{lang('Цифровой','newLevelVertical')}"}{/if}
<div>
    <span class="s-t">{lang('Тип скидки: ','newLevelVertical')}</span>
    <span class="price-item">{echo $discount->max_discount->type_discount}</span>
</div>
<div>
    <span class="s-t">{lang('Размер скидки: ','newLevelVertical')}</span>
    <span class="price-item">{echo $discount->max_discount->value} {echo $type_value}</span>
</div>
<div>
    <span class="s-t">{lang('Общая скидка: ','newLevelVertical')}</span>
    <span class="price-item text-discount"><span>{echo $discount->result_sum_discount_convert + $kitDisc} <span class="curr">{$CS}</span></span></span>
</div>
{/if}