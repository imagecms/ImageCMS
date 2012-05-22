<div class="fancy enter_reg">
    <ul>
        <li class="enter"><a href="#enter">Вход</a></li> 
        <li class="reg"><a href="#reg">Регистрация</a></li> 
    </ul>
    <form method="post" action="{site_url('auth/register')}" id="enter">
        <label>
            Электронная почта
            <input type="text" name="username"/>
        </label>
        <label>
            Пароль
            <input type="password" name="password"/>
        </label>
        <div class="p-t_19 clearfix">
            <a href="#" class="button_middle_blue_neigh f_l">
                Забыли пароль?
            </a>
            <div class="f_r buttons button_middle_blue">
                <input type="submit" value="Войти">
            </div>
        </div>
        {form_csrf()}
    </form>
    <form method="post" action="{site_url('auth/register')}" id="reg">
        <label>
            Ваше имя
            <input type="text"/>
        </label>
        <label>
            Электронный адрес
            <input type="text"/>
        </label>
        <label>
            Пароль
            <input type="password"/>
        </label>
        <label>
            Повторите пароль
            <input type="password"/>
        </label>
        <label>
            Телефон
            <input type="text"/>
        </label>
        <div class="p-t_19 t-a_c">
            <div class="buttons button_middle_blue">
                <input type="submit" value="Зарегистрироваться">
            </div>
        </div>
    </form>
</div>