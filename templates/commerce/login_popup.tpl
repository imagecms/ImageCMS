<div class="fancy enter_form">
    <h1>{lang('s_log_out')}</h1>        
    <form method="post" action="{site_url('auth/login')}" id="enter">
        {if validation_errors() OR $info_message}<div class="errors">{validation_errors()}{$info_message}</div>{/if}        
        <label>
            {lang('s_email')}
            <input type="text" name="email"/>
        </label>
        <label>
            {lang('lang_password')}
            <input type="password" id="password" name="password"/>
        </label>

        {if $cap_image}
        <label>
            <div class="fieldName">{$cap_image}</div>
            {if $captcha_type == 'captcha'}
            <input type="text" name="captcha" id="captcha" value="{lang('lang_captcha')}" onfocus="if(this.value=='{lang('lang_captcha')}') this.value='';" onblur="if(this.value=='') this.value='{lang('lang_captcha')}';"/>
            {/if}		
        </label>
        {/if}                
        <div class="p-t_19 clearfix">
            <div class="f_l">
                <a href="{$BASE_URL}auth/register" class="button_middle_blue_neigh f_l reg_me">
                    {lang('lang_register')}
                </a>
            </div>
            <div class="f_r buttons button_middle_blue">
                <input type="submit" value="{lang('s_enter')}">
            </div>
        </div>
        {form_csrf()}
    </form>  
</div>