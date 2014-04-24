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
                    <span class="text-el">{lang('Вход в магазин','newLevel')}</span>
                </button>
            </li>
            <!--Else show link for personal cabinet -->
        {else:}
            <li class="btn-personal-area">
                <a href="{site_url('/shop/profile')}">
                    <span class="icon_enter"></span>
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
        {/if}
    </ul>
</nav>