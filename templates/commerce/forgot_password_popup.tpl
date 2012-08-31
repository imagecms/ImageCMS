<div class="fancy forgot_form">
    <h1>Напомнить пароль</h1>
    {if !$succes}
    <form method="post" action="{site_url('auth/register')}" id="reg">
        {if validation_errors() OR $info_message}<div class="errors">{validation_errors()}{$info_message}</div>{/if}
        <label>{lang('lang_username_or_mail')}
            <input type="text" name="login" id="login" />
        </label>
        <div class="p-t_19 clearfix">
            <div class="p-t_19 t-a_c">
                <div class="buttons button_middle_blue">
                    <input type="submit" value="Напомнить">
                </div>
            </div>
            <div class="f_l">
                <a href="{site_url('auth/login')}" class="button_middle_blue_neigh auth_me" style="margin-right: 40px;">Авторизация</a>
                <a href="{site_url('auth/register')}" class="button_middle_blue_neigh reg_me">Регистрация</a>
            </div>
        </div>

        {form_csrf()}
    </form> 
    {else:}
        Новый пароль отправлен на почту.
    {/if}
</div>
