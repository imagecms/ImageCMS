<nav>
    <ul class="nav nav-enter-reg">
        {if !$CI->dx_auth->is_logged_in()}
            <li class="btn-enter-register">
                <button type="button" data-drop=".dropEnterRegister" data-place="noinherit" data-overlay-opacity="0" data-placement="top right">
                    <span class="icon_enter"></span>
                    <span class="text-el">{lang('Войти', 'newLevel')}</span>
                </button>
                <ul class="drop dropEnterRegister drop-auth-refer drop-noinherit">
                    <li class="btn-enter">
                        <button type="button"
                                id="loginButton"
                                data-drop=".drop-enter"
                                data-source="{site_url('auth')}"
                                >
                            <span class="text-el">{lang('Вход','newLevel')}</span>
                        </button>
                    </li>
                    <li class="btn-register">
                        <a href="{site_url('/auth/register')}" rel=”nofollow”>
                            <span class="text-el">{lang('Регистрация','newLevel')}</span>
                        </a>
                    </li>
                    <!--Else show link for personal cabinet -->
                </ul>
            </li>
        {else:}
            <li class="btn-personal-exit">
                <button type="button" data-drop=".dropPersonalExit" data-place="noinherit" data-overlay-opacity="0" data-placement="top right">
                    <span class="text-el">{lang('Личный кабинет', 'newLevel')}</span>
                </button>
                <ul class="drop dropPersonalExit drop-auth-refer drop-noinherit">
                    <li class="btn-personal-area">
                        <a href="{site_url('/shop/profile')}">
                            <span class="text-el">{lang('Личный кабинет','newLevel')}</span>
                        </a>
                    </li>
                    <li class="btn-exit-shop">
                        <button type="button" class="f-s_0" onclick="ImageCMSApi.formAction('{site_url("/auth/authapi/logout")}', '', {literal}{durationHideForm: 0, callback: function(msg, status, form, DS) {
                                if (status) {
                                    localStorage.removeItem('wishList');
                                }
                            }}{/literal});
                                return false;">
                            <span class="icon_exit"></span>
                            <span class="text-el">{lang('Выход','newLevel')}</span>
                        </button>
                    </li>
                </ul>
            {/if}
    </ul>
</nav>