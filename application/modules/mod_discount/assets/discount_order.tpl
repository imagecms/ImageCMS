{//var_dump($discount->all_active_discount->comulativ)}
{//var_dump($discount)}

Используется максимально возможная скидка <br />
{if $discount->sum_discount_product > $discount->sum_discount_no_product}
    тип скидки: продуктовая <br/>
    сума скидки: {echo $discount->result_sum_discount_convert}
{else:}

    {if $discount->max_discount->type_value == 1} {$type_value = "%"} {else:}{$type_value = "числовый"}{/if}

    название скидки: {echo $discount->max_discount->name}<br />
    ключ скидки: {echo $discount->max_discount->key}<br />
    тип скидки: {echo $discount->max_discount->type_discount}<br />
    тип начисления скидки: {echo $type_value}<br/>
    размер скидки: {echo $discount->max_discount->value}<br/>
    сума скидки: {echo $discount->result_sum_discount_convert}
{/if}