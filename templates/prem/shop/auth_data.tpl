{if !$CI->dx_auth->is_logged_in()}
    <div class="btn-enter">
        <button type="button"
                id="loginButton"
                data-drop=".drop-enter"
                data-source="{site_url('auth')}"
                >
            <span class="icon_enter"></span>
            <span class="text-el">{lang('Вход','newLevel')}</span>
        </button>
    </div>
{else:}
    <div class="btn-enter">
        <a href="{site_url('/shop/profile')}">
            <span class="icon_enter"></span>
            <span class="text-el">{lang('Кабинет','newLevel')}</span>
        </a>
    </div>
    <div class="btn-exit-shop d_n">
        <button type="button" class="f-s_0" onclick="ImageCMSApi.formAction('{site_url("/auth/authapi/logout")}', '', {literal}{durationHideForm: 0, callback: function(msg, status, form, DS) {
                        if (status) {
                            localStorage.removeItem('wishList');
                        }
                    }}{/literal});
                return false;">
            <span class="icon_exit"></span>
            <span class="text-el">{lang('Выход','newLevel')}</span>
        </button>
    </div>
{/if}