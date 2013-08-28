<nav>
    <ul class="nav nav-enter-reg">
        {if !$CI->dx_auth->is_logged_in()}
        <li class="btn-enter">
            <button type="button"
                    id="loginButton"
                    data-drop=".drop-enter"
                    data-source="{site_url('auth')}"
                    data-animate="true"
                    >
                <span class="icon_enter"></span>
                <span class="text-el">{lang('Sign in','newLevel')}</span>
            </button>
        </li>
        <li class="or f-s_0">
            <span class="text-el">{lang('or','newLevel')}</span>
        </li>
        <li class="btn-register">
            <a href="/auth/register" rel=”nofollow”>
                <span class="icon_reg"></span>
                <span class="text-el">{lang('Sign up','newLevel')}</span>
            </a>
        </li>
        <!--Else show link for personal cabinet -->
        {else:}
        <li class="btn-personal-area">
            <a href="/shop/profile">
                <span class="icon_enter"></span>
                <span class="text-el">{lang('My Account','newLevel')}</span>
            </a>
        </li>
        <li class="btn-exit-shop">
            <button type="button" class="f-s_0" onclick="ImageCMSApi.formAction('/auth/authapi/logout', '', '');">
                <span class="icon_exit"></span>
                <span class="text-el">{lang('Logout','newLevel')}</span>
            </button>
        </li>
        {/if}
    </ul>
</nav>