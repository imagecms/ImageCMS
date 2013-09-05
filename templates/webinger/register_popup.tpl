<div class="fancy enter_form" >    
    <h1>{lang('Регистрация','webinger')}</h1>
    {if !$succes}
        <form method="post" action="{site_url('auth/register')}" id="reg">
        {if validation_errors() OR $info_message}<div class="errors">{validation_errors()}{$info_message}</div>{/if}
        <label>{lang('Почта','webinger')}
            <input type="text" name="email" id="email" value="{set_value('email')}" />
        </label>
        <label>{lang('ФИО','webinger')}
            <input type="text" name="username" value="" />
        </label>
        <label>{lang('Пароль','webinger')}
            <input type="password" name="password" id="passwordreg" />
        </label>
        <label>{lang('Повторите Пароль','webinger')}
            <input type="password" name="confirm_password" id="confirm_password" />
        </label>
        {if $cap_image}
            <div class="comment_form_info">
                <div class="textbox captcha">
                    <input type="text" name="captcha" id="captcha" value="{lang('Код протекции','webinger')}" onfocus="if (this.value == '{lang('Код протекции','webinger')}')
                                this.value = '';" onblur="if (this.value == '')
                                this.value = '{lang('Код протекции','webinger')}';"/>
                </div>
                {$cap_image}
            </div>
        {/if}
        <div class="p-t_19 clearfix">
            <div class="p-t_19 t-a_c">
                <div class="buttons button_middle_blue">
                    <input type="submit" value="{lang('Зарегистрироваться','webinger')}">
                </div>
            </div>
            <div class="t-a_c">
                <a href="{$BASE_URL}auth/login" class="button_middle_blue_neigh auth_me">
                    {lang('Авторизация','webinger')}
                </a><br/>
                <a href="{$BASE_URL}auth/forgot_password" class="button_middle_blue_neigh forgot_password">
                    {lang('Забыли Пароль?','webinger')}
                </a>
            </div>
        </div>

        {form_csrf()}
    </form> 
{else:}

    <div style="height: 42px;">{lang('Вы успешно зарегистрировались. Войдите в систему ','webinger')}</div>    
{/if}
</div>
