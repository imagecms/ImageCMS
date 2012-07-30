<div class="top-navigation">
        <div style="float:left;">
            <ul>
            <li>
                <p>{lang('amt_feedback_settings')}</p>
            </li>
            </ul>
        </div>
</div>
<div style="clear:both;"></div>

<form method="post" action="{site_url('admin/components/cp/feedback/settings/update')}" id="feedback_settings_form" style="width:100%;">        
      	<div class="form_text">{lang('amt_email')}</div>
		<div class="form_input">
            <input type="text" class="textbox_long" name="email" value="{$settings.email}" />
            <br />
            <span class="lite">{lang('amt_select_email')}</span>
        </div>
        <div class="form_overflow"></div> 
     
      	<div class="form_text">{lang('amt_max_message_length')}</div>
		<div class="form_input"><input type="text" class="textbox_long" name="message_max_len" value="{$settings.message_max_len}" /></div>
        <div class="form_overflow"></div> 

   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="{lang('amt_save')}" onclick="ajax_me('feedback_settings_form');" />
        </div>
		<div class="form_overflow"></div> 
</form>
