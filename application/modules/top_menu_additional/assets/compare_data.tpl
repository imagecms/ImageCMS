<div class="f_l">
    <div style="margin-top: 5px;" id="compareListDataModule">
        {$cnt = count($CI->session->userdata('shopForCompare'))}
        <span class="{if !$cnt}d_n{/if} f-s_0" data-rel="ref">
            <a href="{shop_url('compare')}" rel="nofollow">
                <span class="icon-comprasion"></span>
                <span class="text-el">{lang('s_list_comp')}</span>
            </a> 
        </span>
        <span class="{if $cnt}d_n{/if} c_97 f-s_0" data-rel="notref">
            <span class="icon-comprasion"></span>
            <span class="text-el">{lang('s_list_comp')} </span>
        </span>
        <span id="compareCountModule" class="c_97">({echo $cnt})</span>
    </div>
</div>