{if !$is_logged_in}
    <nav class="nav nav-enter-reg f_r">
        <ul>
            <li class="btn-enter user-btn">
                <button type="button" 
                        data-drop=".drop-enter"
                        data-source="{site_url('auth')}">
                    <span class="icon-enter"></span>
                    <span>{lang('Вход', 'corporate')}</span>
                </button>
            </li>
            <li class="btn-reg user-btn">
                <a href="{site_url('auth/register')}">
                    <span class="icon-reg"></span>
                    <span>{lang('Регистрация', 'corporate')}</span>
                </a>
            </li>
        </ul>
    </nav>
{else:}
    <nav class="nav nav-user-profile f_r">
        <ul>
            <li class="user-btn active">
                <button type="button">
                    <span class="f-w_n">{lang('Вы вошли как', 'corporate')}&nbsp;</span><span class="user-name">{echo $CI->dx_auth->get_username()}</span>
                </button>
            </li>
            <li class="btn-exit user-btn">
                <a href="{site_url('auth/logout')}">
                    <span class="icon-exit"></span>
                    <span>{lang('Выход', 'corporate')}</span>
                </a>
            </li>
        </ul>
    </nav>
{/if}