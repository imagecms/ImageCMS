<div class="fancy enter_form">    
    <h1>Регистрация</h1>
    {if !$succes}
    <form method="post" action="{site_url('auth/register')}" id="reg">
        {if validation_errors() OR $info_message}<div class="errors">{validation_errors()}{$info_message}</div>{/if}
        <label>{lang('lang_email')}
            <input type="text" name="email" id="email" value="{set_value('email')}" />
        </label>
        <label>ФИО
            <input type="text" name="userInfo[fullName]" value="{set_value('userInfo[fullName]')}" />
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
                <input type="text" name="captcha" id="captcha" value="Код протекции" onfocus="if(this.value=='Код протекции') this.value='';" onblur="if(this.value=='') this.value='Код протекции';"/>
            </div>
            {$cap_image}
        </div>
        {/if}
        <div class="p-t_19 clearfix">
            <div class="p-t_19 t-a_c">
                <div class="buttons button_middle_blue">
                    <input type="submit" value="Зарегистрироваться">
                </div>
            </div>
            <div class="f_l">
                <a href="{site_url('auth/login')}" class="button_middle_blue_neigh d_b auth_me" style="height:18px;">
                    Авторизация
                </a>
            <a href="{site_url('auth/forgot_password')}" class="button_middle_blue_neigh fg_pass">
                Забыли пароль
            </a>                    
            </div>
        </div>

        {form_csrf()}
    </form> 
    {else:}
        Ви успешно зарегистрировались. Войдите в систему
    {/if}
</div>
