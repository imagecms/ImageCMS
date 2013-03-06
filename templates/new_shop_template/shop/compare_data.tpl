<div style="margin-top: 5px;" id="compareListData">
    <span class="d_n" data-rel="ref">
        <a href="{shop_url('compare')}" rel="nofollow">
            <span class="icon-comprasion"></span>
            {lang('s_list_comp')}
        </a> 
    </span>
    <span class="c_97" data-rel="notref">
        <span class="icon-comprasion"></span>
        {lang('s_list_comp')}
    </span>
    <span id="compareCount" class="c_97">({count($CI->session->userdata('shopForCompare'))})</span>
</div>
