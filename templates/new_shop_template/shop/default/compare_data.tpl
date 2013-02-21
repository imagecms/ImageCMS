<div>
<a href="{shop_url('compare')}" rel="nofollow">
    <span class="icon-comprasion"></span>
    {lang('s_list_comp')}</a> 
({if $CI->session->userdata('shopForCompare')}{count($CI->session->userdata('shopForCompare'))}{else:}0{/if})
</div>
