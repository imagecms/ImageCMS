{if $compare = $CI->session->userdata('shopForCompare')}
    {$count = count($compare);}
{else:}
    {$count = 0;}
{/if}
<div class="compare-list-btn tiny-compare-list" {if $count == 0}style="display:none;"{/if}>
    <button onclick="location = '{shop_url('compare')}'">
        <span class="icon_compare_list"></span>
        <span class="text-compare-list f-s_0">
            <span class="text-el">{lang('Список сравнения','newLevel')} </span>
            <span class="text-el">(</span>
            <span class="f-s_0">
                <span class="text-el compareListCount"></span>
            </span>
            <span class="text-el">)</span>
        </span>
    </button>
</div>