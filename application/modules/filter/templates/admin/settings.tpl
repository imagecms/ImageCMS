<div class="top-navigation">
        <div style="float:left;">
            <ul>
            <li>
                <p>Настройки Обратной связи</p>
            </li>
            </ul>
        </div>
</div>
<div style="clear:both;"></div>

<form method="post" action="{site_url('admin/components/cp/feedback/settings/update')}" id="feedback_settings_form" style="width:100%;">        
      	<div class="form_text">E-Mail</div>
		<div class="form_input">
            <input type="text" class="textbox_long" name="email" value="{$settings.email}" />
            <br />
            <span class="lite">Укажите e-mail на который будут отправляться письма</span>
        </div>
        <div class="form_overflow"></div> 
     
      	<div class="form_text">Максимальная длина сообщения</div>
		<div class="form_input"><input type="text" class="textbox_long" name="message_max_len" value="{$settings.message_max_len}" /></div>
        <div class="form_overflow"></div> 

   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="Сохранить" onclick="ajax_me('feedback_settings_form');" />
        </div>
		<div class="form_overflow"></div> 
</form>
