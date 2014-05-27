<nav>
    <ul class="nav nav-enter-reg">
        {if !$CI->dx_auth->is_logged_in()}
            <li class="btn-enter-register">
                <button type="button" id="loginButton" data-drop=".drop-enter" data-source="{site_url('auth')}">
                    <span class="icon_enter"></span>
                    <span class="text-el">{lang('Войти', 'box')}</span>
                </button>
            </li>
        {else:}
            <li class="btn-personal-exit">
                <button type="button" data-drop=".dropPersonalExit" data-place="noinherit" data-overlay-opacity="0" data-placement="top left">
                    <span class="icon_enter"></span>
                    <span class="text-el">{lang('Личный кабинет', 'box')}</span>
                </button>
                <ul class="drop dropPersonalExit drop-auth-refer drop-noinherit">
                    <li><a href="{site_url('/shop/profile/#my_data')}">{lang('Основные данные', 'box')}</a></li>
                    <li><a href="{site_url('/shop/profile/#change_pass')}">{lang('Изменить пароль', 'box')}</a></li>
                    <li><a href="{site_url('/shop/profile/#history_order')}">{lang('История заказа', 'box')}</a></li>
                    <li class="btn-exit-shop">
                        <button type="button" class="f-s_0" onclick="ImageCMSApi.formAction('{site_url("/auth/authapi/logout")}', '', {literal}{durationHideForm: 0, callback: function(msg, status, form, DS) {
                                        if (status) {
                                            localStorage.removeItem('wishList');
                                        }
                                    }}{/literal});
                                return false;">
                            <span class="icon_exit"></span>
                            <span class="text-el">{lang('Выход','box')}</span>
                        </button>
                    </li>
                </ul>
            {/if}
    </ul>
</nav>