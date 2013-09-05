<span class="divider_compr_wish v-a_m"></span>
<span class="helper"></span>
<div class="d_i-b">
    <div id="compareListDataModule">
        {$cnt = count($CI->session->userdata('shopForCompare'))}
        <span class="{if !$cnt}d_n{/if} f-s_0" data-rel="ref">
            <a href="{shop_url('compare')}" rel="nofollow">
                <span class="icon-comprasion"></span>
                <span class="text-el">{lang('s_list_comp')}</span>
            </a> 
        </span>
        <span class="{if $cnt}d_n{/if} ref f-s_0" data-rel="notref">
            <span class="icon-comprasion"></span>
            <span class="text-el">{lang('s_list_comp')} </span>
        </span>
        <span id="compareCountModule" class="ref">({echo $cnt})</span>
    </div>
</div>