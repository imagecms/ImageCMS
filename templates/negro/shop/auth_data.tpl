<nav>
    <ul class="nav nav-enter-reg">
        {if !$CI->dx_auth->is_logged_in()}
        <li class="enter-btn">
            <button type="button"
                    id="loginButton"
                    data-drop=".drop-enter"
                    data-effect-on="fadeIn"
                    data-effect-off="fadeOut"
                    data-duration="300"
                    data-place="noinherit"
                    data-placement="top right">
                <span class="icon_enter"></span>
                <span class="text-el">Войти</span>
            </button>
        </li>
        <li class="or f-s_0">
            <span class="text-el">или</span>
        </li>
        <li class="register-btn">
            <a href="/auth/register">
                <span class="icon_reg"></span>
                <span class="text-el">Регистрация</span>
            </a>
        </li>
        <!--Else show link for personal cabinet -->
        {else:}
        <li class="personal-area-btn">
            <a href="/shop/profile">
                <span class="icon_enter"></span>
                <span class="text-el">Личный кабинет</span>
            </a>
        </li>
        <li class="exit-shop-btn">
            <button type="button" onclick="ImageCMSApi.formAction('/auth/authapi/logout', '')">
                <span class="icon_exit"></span>
                <span class="text-el">Выход</span>
            </button>
        </li>
        {/if}
    </ul>
</nav>