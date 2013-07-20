<nav>
    <ul class="nav nav-enter-reg">
        {if !$CI->dx_auth->is_logged_in()}
        <li class="btn-enter">
            <button type="button"
                    id="loginButton"
                    data-drop=".drop-enter"
                    data-source="{site_url('auth')}"
                    >
                <span class="icon_enter"></span>
                <span class="text-el">Войти</span>
            </button>
        </li>
        <li class="or f-s_0">
            <span class="text-el">или</span>
        </li>
        <li class="btn-register">
            <a href="/auth/register" rel=”nofollow”>
                <span class="icon_reg"></span>
                <span class="text-el">Регистрация</span>
            </a>
        </li>
        <!--Else show link for personal cabinet -->
        {else:}
        <li class="btn-personal-area">
            <a href="/shop/profile">
                <span class="icon_enter"></span>
                <span class="text-el">Личный кабинет</span>
            </a>
        </li>
        <li class="btn-exit-shop">
            <button type="button" class="f-s_0" onclick="ImageCMSApi.formAction('/auth/authapi/logout', '', '', $(this))" data-refresh="true" data-redirect="false">
                <span class="icon_exit"></span>
                <span class="text-el">Выход</span>
            </button>
        </li>
        {/if}
    </ul>
</nav>