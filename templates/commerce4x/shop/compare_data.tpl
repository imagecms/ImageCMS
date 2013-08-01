<div style="margin-top: 5px;" id="compareListData">
    <span class="d_n" data-rel="ref">
        <a href="{shop_url('compare')}" rel="nofollow" class="f-s_0">
            <span class="icon-comprasion"></span>
            <span class="text-el">{lang("List of comparisons","admin")}</span>
        </a> 
    </span>
    <span class="c_97 f-s_0" data-rel="notref">
        <span class="icon-comprasion"></span>
        <span class="text-el">{lang("List of comparisons","admin")} </span>
    </span>
    {if $CI->session->userdata('shopForCompare')}
        &nbsp;<span id="compareCount" class="c_97">({count($CI->session->userdata('shopForCompare'))})</span>
        {else:}
        &nbsp;<span id="compareCount" class="c_97">(0)</span>
   {/if}
</div>
