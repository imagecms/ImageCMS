<nav>
    <ul class="nav nav-enter-reg">
        {if $is_logged_in}
            <li>
                <button type="button" class="f-s_0 goProile">
                    <span class="icon-enter"></span>
                    <span class="t-d_u ref">Личный кабинет</span>
                </button>
            </li>
            <li class="or"><span class="f-s_13">или</span></li>
            <li>
                <button type="button" class="f-s_0 pointer" onclick="location='{site_url('auth/logout')}'">
                    <span class="icon-reg"></span>
                    <span class="d_l_b">Выход</span>
                </button>
            </li>
        {else:} 
            <li>
                <button type="button" class="f-s_0 pointer enterButton" data-drop=".drop-enter" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="top right">
                    <span class="icon-reg"></span>
                    <span class="d_l_b">Вход</span>
                </button>
            </li>
            <li class="or"><span class="f-s_13">или</span></li>
            <li>
                <button type="button" class="f-s_0 pointer" data-drop=".drop-register" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="top right">
                    <span class="icon-enter"></span>
                    <span class="d_l_b">Регистрация</span>
                </button>
            </li>
        {/if}
    </ul>
</nav>