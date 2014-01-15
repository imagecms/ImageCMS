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
                    <span class="text-el">{lang('Вход','newLevel')}</span>
                </button>
            </li>
            <li class="f-s_0 divider">
                <span class="text-el">{lang('или','newLevel')}</span>
            </li>
            <li class="btn-register">
                <a href="{site_url('/auth/register')}" rel=”nofollow”>
                    <span class="icon_reg"></span>
                    <span class="text-el">{lang('Регистрация','newLevel')}</span>
                </a>
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
                                    var items = Shop.Cart.getAllItems();
                                    for (var i = 0; i < items.length; i++)
                                        localStorage.removeItem(items[i].storageId());
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