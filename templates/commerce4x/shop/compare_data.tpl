<div style="margin-top: 5px;" id="compareListData">
    <span class="d_n f-s_0" data-rel="ref">
        <a href="{shop_url('compare')}" rel="nofollow">
            <span class="icon-comprasion"></span>
            <span class="text-el">{lang('s_list_comp')}</span>
        </a> 
    </span>
    <span class="c_97 f-s_0" data-rel="notref">
        <span class="icon-comprasion"></span>
        <span class="text-el">{lang('s_list_comp')} </span>
    </span>
    {if $CI->session->userdata('shopForCompare')}
        <span id="compareCount" class="c_97">({count($CI->session->userdata('shopForCompare'))})</span>
        {else:}
        <span id="compareCount" class="c_97">(0)</span>
   {/if}
</div>
