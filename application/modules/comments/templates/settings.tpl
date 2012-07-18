<div class="top-navigation">
        <div style="float:left;">
            <ul>
            <li>
                <p>{lang('amt_comment_settings')}</p>
            </li>
            </ul>
        </div>

        <div align="right" style="padding:5px;">
            <input type="button" class="button_silver_130" value="{lang('amt_cancel')}" onclick="ajax_div('page', base_url + 'admin/components/cp/comments/'); return false;" />
        </div>
</div>
<div style="clear:both;"></div>

<form method="post" action="{site_url('admin/components/cp/comments/update_settings')}" id="comments_settings_form" style="width:100%;">
   		<div class="form_text">{lang('amt_max_comment_length')}</div>
		<div class="form_input">
            <input type="text" value="{$settings.max_comment_length}" name="max_comment_length" class="textbox_long"/> 
        </div>
		<div class="form_overflow"></div>

   		<div class="form_text">{lang('amt_restrictions')}</div>
		<div class="form_input">
            <input type="text" value="{$settings.period}" name="period" class="textbox_long"/>
            <br /><span class="lite">{lang('amt_restrictions_frequency')}</span>
        </div>
		<div class="form_overflow"></div>

   		<div class="form_text"></div>
		<div class="form_input">
            <label><input type="checkbox" name="can_comment" value="1"  {if $settings.can_comment == 1}checked="checked"{/if} />{lang('amt_disallove_comments_for_unregistered')}</label>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text"></div>
		<div class="form_input">
            <label><input type="checkbox" name="use_moderation" value="1" {if $settings.use_moderation}checked="checked"{/if} />{lang('amt_admin_approve_on')}</label>
        </div>
		<div class="form_overflow"></div>

   		<div class="form_text"></div>
		<div class="form_input">
           <label><input type="checkbox" name="use_captcha" value="1" {if $settings.use_captcha}checked="checked"{/if} />{lang('amt_use_captcha')}</label>
        </div>
		<div class="form_overflow"></div>

   		<div class="form_text"></div>
		<div class="form_input"></div>
		<div class="form_overflow"></div>

   		<div class="form_text"></div>
		<div class="form_input"></div>
		<div class="form_overflow"></div>

   		<div class="form_text"></div>
		<div class="form_input"></div>
		<div class="form_overflow"></div> 

   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="{lang('amt_save')}" onclick="ajax_me('comments_settings_form');" /> 
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/comments'); return false;" style="padding:5px;">{lang('amt_cancel')}</a> 
        </div>
		<div class="form_overflow"></div> 
{form_csrf()}</form>
