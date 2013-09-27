{$kitDisc = $CI->load->module('shop/cart_api')->get_kit_discount()}

{if $discount->sum_discount_product > $discount->sum_discount_no_product}
    <li>
        <span class="s-t">{lang('Тип скидки: ','newLevel')}</span>
        <span class="price-item">{lang('Продуктовый','newLevel')}</span>
    </li>
    <li>
        <span class="s-t">{lang('Размер скидки:','newLevel')}</span>
        <span class="price-item">
            <span>
                <span class="price">{echo $discount->result_sum_discount_convert+$kitDisc}</span>
                <span class="curr">{$CS}</span>
            </span>
        </span>
    </li>
{else:}
{if $discount->max_discount->type_value == 1} {$type_value = "%"} {else:}{$type_value = "{lang('Цифровой','newLevel')}"}{/if}
<li>
    <span class="s-t">{lang('Название скидки: ','newLevel')}</span>
    <span class="price-item">{echo $discount->max_discount->name}</span>
</li>
<li>
    <span class="s-t">{lang('Ключ скидки: ','newLevel')}</span>
    <span class="price-item">{echo $discount->max_discount->key}</span>
</li>
<li>
    <span class="s-t">{lang('Тип скидки: ','newLevel')}</span>
    <span class="price-item">{echo $discount->max_discount->type_discount}</span>
</li>
<li>
    <span class="s-t">{lang('Тип расчета скидки: ','newLevel')}</span>
    <span class="price-item">{echo $type_value}</span>
</li>
<li>
    <span class="s-t">{lang('Размер скидки: ','newLevel')}</span>
    <span class="price-item">{echo $discount->max_discount->value}</span>
</li>
<li>
    <span class="s-t">{lang('Общая скидка: ','newLevel')}</span>
    <span class="price-item">{echo $discount->result_sum_discount_convert + $kitDisc}</span>
</li>
{/if}