<div class="top-navigation">
    <ul>
        <li><p>{lang('amt_send_mail_to_users')}</p></li>
    </ul>
</div>

<form action="{$BASE_URL}admin/components/cp/group_mailer/send_email" method="post" id="send_mail_form" style="width:100%;">

<div class="form_text">{lang('amt_theme')}:</div>
<div class="form_input">
    <input type="text" name="subject" value="" class="textbox_long" />
</div>
<div class="form_overflow"></div>

<div class="form_text">{lang('amt_your_name')}:</div>
<div class="form_input">
    <input type="text" name="name" value="" class="textbox_long" />
</div>
<div class="form_overflow"></div>

<div class="form_text">{lang('amt_your_email')}:</div>
<div class="form_input">
    <input type="text" name="email" value="{$admin_mail}" class="textbox_long" />
</div>
<div class="form_overflow"></div>

<div class="form_text">{lang('amt_message')}:</div>
<div class="form_input">
    <textarea name="message" rows="15" cols="180"  style="width:700px;height:350px;">{lang('amt_hello')}, %username%.






--------------------------------
{lang('amt_best_regards')} {$site_settings.site_title}

{site_url()}

</textarea> 
</div>
<div class="form_overflow"></div>

<div class="form_text">{lang('amt_send_to_group')}:</div>
<div class="form_input">
    {foreach $roles as $role}
        <label><input type="checkbox" name="roles[]" value="{$role.id}" /> {$role.alt_name}</label>
    {/foreach}
</div>
<div class="form_overflow"></div>

<div class="form_text">{lang('amt_format')}:</div>
<div class="form_input">
    <select name="mailtype">
        <option value="html" selected="selected">{lang('amt_html')}</option>
        <option value="text">{lang('amt_plain_text')}</option>
    </select>
</div>
<div class="form_overflow"></div>

<div class="form_text"></div>
<div class="form_input">
    <input type="submit" name="button" class="button" value="Отправить" onclick="ajax_me('send_mail_form');" />
</div>

</form>
