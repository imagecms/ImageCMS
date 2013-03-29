{if $compare = $CI->session->userdata('shopForCompare')}
    {$count = count($compare);}
{else:}
    {$count = 0;}
{/if}

<div id="compareBlock">
    {if $count > 0}
        <button class="btn-compare" type="button" onclick="location='{shop_url('compare')}'"><span class="text-el ref">В списке сравнений ( {$count} )</span></button>
    {/if}
</div>
