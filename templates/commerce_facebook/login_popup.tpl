<div class="fancy enter_form">
    <h1>Вход</h1>        
    <form method="post" action="{site_url('auth/login')}" id="enter">
        {if validation_errors() OR $info_message}<div class="errors">{validation_errors()}{$info_message}</div>{/if}        
        <label>
            Электронная почта
            <input type="text" name="username"/>
        </label>
        <label>
            Пароль
            <input type="password" id="password" name="password"/>
        </label>

        {if $cap_image}
        <label>
            <div class="fieldName">{$cap_image}</div>
            {if $captcha_type == 'captcha'}
            <input type="text" name="captcha" id="captcha" value="Код протекции" onfocus="if(this.value=='Код протекции') this.value='';" onblur="if(this.value=='') this.value='Код протекции';"/>
            {/if}		
        </label>
        {/if}                
        <div class="p-t_19 clearfix">
            <div class="f_l">
                <a href="{site_url('auth/register')}" class="button_middle_blue_neigh f_l reg_me">
                    Регистрация
                </a>
            </div>
            <div class="f_r buttons button_middle_blue">
                <input type="submit" value="Войти">
            </div>
        </div>
        {form_csrf()}
    </form>  
</div>