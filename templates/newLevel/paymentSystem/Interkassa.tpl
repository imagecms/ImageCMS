<form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
	<input type="hidden" name="ik_co_id" value="{echo $InterkassaId}" />
	<input type="hidden" name="ik_pm_no" value="{echo $inv_id}" />
	<input type="hidden" name="ik_am" value="{echo $out_summ}" />
	<input type="hidden" name="ik_cur" value="{echo $ISOCode}" />
	<input type="hidden" name="ik_desc" value="{echo $inv_desc}" />
	<input type="hidden" name="ik_loc" value="{echo $language}" />
	<input type="hidden" name="ik_suc_u" value="{echo $successUrl}" />	
	<input type="hidden" name="ik_suc_m" value="post" />
	<input type="hidden" name="ik_x_crc" value="{echo $crc}" />
    <input type="submit" value="ОПЛАТИТЬ">
</form>