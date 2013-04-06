{if ShopCore::$ci->dx_auth->is_logged_in() === true}
    {$count = count($CI->session->userdata('shopForCompare'))}
    <div id="compareBlock">
        <span class="f-s_0" onclick="location='{shop_url('compare')}'">
            <span class="icon-compare_main"></span>
            <span class="f-s_14 ref">Список сравнения </span>
        </span> 
        <span  id="compareCount" class="f-s_14 c_68">  ({$count}) </span>
    </div>
{/if}