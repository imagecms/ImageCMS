{//var_dump($discount->all_active_discount->comulativ)}
{//var_dump($discount)}

{lang('Maximum possible discount is using', 'mod_discount')} <br />
{if $discount->sum_discount_product > $discount->sum_discount_no_product}
    {lang('discount type: product', 'mod_discount')} <br/>
    {lang('discount amount', 'mod_discount')}: {echo $discount->result_sum_discount_convert}
{else:}

    {if $discount->max_discount->type_value == 1} {$type_value = "%"} {else:}{$type_value = lang('number', 'mod_discount')}{/if}

    {lang('discount name', 'mod_discount')}: {echo $discount->max_discount->name}<br />
    {lang('discount key', 'mod_discount')}: {echo $discount->max_discount->key}<br />
    {lang('discount type', 'mod_discount')}: {echo $discount->max_discount->type_discount}<br />
    {lang('discount charge type', 'mod_discount')}: {echo $type_value}<br/>
    {lang('discount size', 'mod_discount')}: {echo $discount->max_discount->value}<br/>
    {lang('discount amount', 'mod_discount')}: {echo $discount->result_sum_discount_convert}
{/if}