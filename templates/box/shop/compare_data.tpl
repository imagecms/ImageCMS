{if $compare = $CI->session->userdata('shopForCompare')}
    {$count = count($compare);}
{else:}
    {$count = 0;}
{/if}
<div class="compare-list-btn tinyCompareList">
    <button data-href="{shop_url('compare')}" data-drop=".drop-info-compare" data-place="inherit" data-overlay-opacity="0" data-inherit-close="true">
        <span class="icon_compare_list"></span>
        <span class="text-compare-list">
            <span class="js-empty empty" {if $count == 0}style="display: inline"{/if}>
                <span class="text-el">{lang('Товары на сравнение','newLevel')} </span>
                <span class="text-el">(</span>
                <span class="f-s_0">
                    <span class="text-el compareListCount">0</span>
                </span>
                <span class="text-el">)</span>
            </span>
            <span class="js-no-empty no-empty" {if $count != 0}style="display: inline"{/if}>
                <span class="text-el">{lang('В сравнение','newLevel')} </span>
                <span class="text-el">(</span>
                <span class="f-s_0">
                    <span class="text-el compareListCount"></span>
                </span>
                <span class="text-el">)</span>
            </span>
        </span>
    </button>
</div>
<div class="drop drop-info drop-info-compare">
    <span class="helper"></span>
    <span class="text-el">
        {lang('Ваш список', 'newLevel')}Ваш список <br/>
        “{lang('Список сравнения', 'newLevel')}” {lang('пуст', 'newLevel')}</span>
</div>