<div style="margin:0 auto; padding:5px; width:450px; border:1px solid #ddd; background:#fff; border-radius: 7px; -webkit-border-radius: 7px; -moz-border-radius: 7px; font:normal 14px/14px Geneva,Verdana,Arial,Helvetica,Tahoma,sans-serif;">
	<form action="http://w.qiwi.ru/setInetBill.do" method="get" accept-charset="windows-1251" onSubmit="return checkSubmit();">
	
		<input type="hidden" name="from" value="{$QiWiId}"/>
		<input type="hidden" name="lifetime" value="{$QiWiTime}"/>
		<input type="hidden" name="check_agt" value="true"/>
		
		<!-- используйте это поле для передачи уникального идентификатора заказа/платежа в вашей системе -->
    	<!-- <input type="hidden" name="txn_id" value=""/> -->
    	
		<p style="text-align:center; color:#006699; padding:20px 0px; background:url(https://ishop.qiwi.ru/img/button/logo_31x50.jpg) no-repeat 10px 50%;">{lang('Выставить счёт за покупку','newLevel')}</p>
		<table style="border-collapse:collapse;">
			<tr style="background:#f1f5fa;">
				<td style="color:#a3b52d; width:45%; text-align:center; padding:10px 0px;">{lang('Мобильный телефон','newLevel')}</td>
				<td style="padding:10px">
					<input type="text" name="to" id="idto" style="width:130px; border: 1px inset #555;"></input>
					<span id="div_idto"></span>

    			</td>
			</tr>
			<tr>
				<td style="color:#a3b52d; padding:10px 0px; width:45%; text-align:center;">{lang('Сумма','newLevel')}</td>
				<td style="padding:10px">
					<input type="text" name="amount_rub" value="{$out_summ[0]}" maxlength="5" style="width:50px; text-align:right;  border: 1px inset #555;" /> {lang('руб.','newLevel')} 
					<input type="text" name="amount_kop" value="{$out_summ[1]}" maxlength="2" size="2" style="text-align:right; border: 1px inset #555;"/> {lang('коп.','newLevel')}.
				</td>
			</tr>
			<tr style="background:#f1f5fa;">
				<td style="color:#a3b52d; padding:10px 0px; width:45%; text-align:center;">{lang('Комментарий','newLevel')}</td>
				<td style="padding:10px"><textarea rows="2" cols="30" name="com" style="width:200px; border: 1px inset #555;">{$inv_desc}</textarea></td>
			</tr>
		</table>
		<p style="text-align:center;"><input type="submit" value="{lang('Выставить счёт за покупку','newLevel')}" style=" padding:10px 0;border:none; background:url(https://ishop.qiwi.ru/img/button/superBtBlue.jpg) no-repeat 0 50%; color:#fff; width:300px;"/></p>
	</form>
</div>