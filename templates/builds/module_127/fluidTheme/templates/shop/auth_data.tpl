{if !$CI->dx_auth->is_logged_in()}
    <li class="btn-enter">
        <button type="button"
                id="loginButton"
                data-drop=".drop-enter"
                data-source="{site_url('auth')}"
                >
            <span class="text-el"><span class="icon_enter"></span>{lang('Вход','newLevel')}</span>
        </button>
    </li>
    <!--Else show link for personal cabinet -->
{else:}
    <li class="btn-personal-area">
        <a href="{site_url('/shop/profile')}">
            <span class="text-el"><span class="icon_personal_area"></span>{lang('Профиль','newLevel')}</span>
        </a>
    </li>
    <li class="btn-exit-shop">
        <button type="button" class="f-s_0" onclick="ImageCMSApi.formAction('{site_url("/auth/authapi/logout")}', '', {literal}{durationHideForm: 0, callback: function(msg, status, form, DS) {
                        if (status) {
                            localStorage.removeItem('wishList');
                        }
                    }}{/literal});
                return false;">
            <span class="text-el"><span class="icon_exit_shop"></span>{lang('Выход','newLevel')}</span>
        </button>
    </li>
{/if}