

<div class="button-location"> 
    <nav>
        <ul class="nav nav-enter-reg">
            {if !$CI->dx_auth->is_logged_in()}
                <li class="btn-enter">
                    <button onclick="window.location.href = '/auth/login'; return false;" type="button" class="f-s_0 reg-but">
                        <span class="icon-enter"></span>
                        <span>Вход</span>
                    </button>
                </li>

                <li class="btn-enter">
                    <a href="{site_url('auth/register')}" class="f-s_0 enter-but">
                        <span class="icon-reg"></span>
                        <span>Регистрация</span>
                    </a>
                </li>
                
            {else:}
                <li class="btn-enter">
                    <button type="button" class="f-s_0 user-but b_n">
                        <span class="user-name-text">Вы вошли как <span class="user-name">{echo $CI->dx_auth->get_username()}</span></span>
                    </button>
                </li>

                <li class="btn-enter">
                    <button onclick="window.location.href = '/auth/logout'; return false;" type="button" class="f-s_0 exit-but">
                        <span class="icon-exit"></span>
                        <a href="{site_url('auth/logout')}">Выход</a>
                    </button>
                </li>
            {/if}
        </ul>
    </nav>
</div>

