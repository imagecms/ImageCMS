<nav>
    <ul class="nav nav-enter-reg">
        {if !$CI->dx_auth->is_logged_in()}
        <li>
            <span class="icon-reg"></span>
            <button type="button"
                    id="loginButton"
                    data-drop=".drop-enter"
                    data-effect-on="fadeIn"
                    data-effect-off="fadeOut"
                    data-duration="300"
                    data-place="noinherit"
                    data-placement="top right">
                <span class="d_l_g">Вход</span>
            </button>
        </li>
        <li class="or"><span class="f-s_13">или</span></li>
        <li>
            <span>
                <a href="/auth/register" class="t-d_n c_5c f-s_0 register">
                      <span class="icon-enter"></span>
                    <span class="text-el">Регистрация</span>
                </a>
            </span>
        </li>
        <!--Else show link for personal cabinet -->
        {else:}
        <li>
           
                <span>
                    <a href="/shop/profile" class="t-d_u c_5c">
                        <span class="icon-enter"></span>
                        <span class="text-el">Личный кабинет</span>
                    </a>
                </span>
         
        </li>
        <li class="or"><span class="f-s_13">или</span></li>
        <li>
            <button type="button" onclick="ImageCMSApi.formAction('/auth/authapi/logout', '')">
                    <span class="icon-reg"></span>
                    <span class="d_l_g">Выход</span>
                </button>
        </li>
    {/if}
    </ul>
</nav>
    
    