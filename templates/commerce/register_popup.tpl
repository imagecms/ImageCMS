<div class="fancy enter_form" >    
    <h1>{lang('lang_register')}</h1>
    {if !$succes}
        <form method="post" action="{site_url('auth/register')}" id="reg">
        {if validation_errors() OR $info_message}<div class="errors">{validation_errors()}{$info_message}</div>{/if}
        <label>{lang('lang_email')}
            <input type="text" name="email" id="email" value="{set_value('email')}" />
        </label>
        <label>{lang('s_fio')}
            <input type="text" name="username" value="" />
        </label>
        <label>{lang('lang_password')}
            <input type="password" name="password" id="passwordreg" />
        </label>
        <label>{lang('lang_confirm_password')}
            <input type="password" name="confirm_password" id="confirm_password" />
        </label>
        {if $cap_image}
            <div class="comment_form_info">
                <div class="textbox captcha">
                    <input type="text" name="captcha" id="captcha" value="{lang('lang_captcha')}" onfocus="if(this.value=='{lang('lang_captcha')}') this.value='';" onblur="if(this.value=='') this.value='{lang('lang_captcha')}';"/>
                </div>
                {$cap_image}
            </div>
        {/if}
        <div class="p-t_19 clearfix">
            <div class="p-t_19 t-a_c">
                <div class="buttons button_middle_blue">
                    <input type="submit" value="{lang('s_sign_up')}">
                </div>
            </div>
            <div class="f_l">
                <a href="{$BASE_URL}auth/login" class="button_middle_blue_neigh f_l auth_me">
                    {lang('lang_login_page')}
                </a><br />
                <a href="{$BASE_URL}auth/forgot_password" class="button_middle_blue_neigh f_l forgot_password">
                    {lang('lang_forgot_password')}
                </a>
            </div>
        </div>

        {form_csrf()}
    </form> 
{else:}
    
    <div style="height: 42px;">{lang('s_y_h_s_r')}</div>    
{/if}
</div>
