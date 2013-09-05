<div class="header">
    <section class="container">
        <section class="headerContent row-fluid">
            <div class="span3">
                <a href="{site_url()}" class="logo">
                    <img src="{$THEME}images/logo.png" alt="logo"/>
                </a>
            </div>
            <div class="span9 f-s_0">
                <span class="helper"></span
                ><div class="w_100 f-s_0 frameUndef_1">
                    <div class="span7">
                        <div class="frameSearch">
                            <form name="search"
                                  class="clearfix"
                                  action="{shop_url('search')}"
                                  method="get"
                                  id="autocomlete">
                                <button class="f_r btn" type="submit">
                                    <span class="icon-search"></span>

                                </button>
                                <div class="o_h">
                                    <input type="text"
                                           name="text"
                                           value=""
                                           placeholder="{lang('s_se_thi_sit')}"
                                           autocomplete="off"
                                           class="place_hold"
                                           id="inputString"/>
                                </div>
                                <div id="suggestions" class="drop-search"></div>
                            </form>
                        </div>
                    </div>
                    <div class="span5 control_shop">
                        <nav>
                            <ul class="nav navHorizontal frameEnterReg f-s_0 m-l_5">
                                <li>
                                    <div class="d_i-b">
                                        <span class="icon-phoneM"></span>
                                         <div class="d_i-b v-a_t">
                                        <span class="phone">
                                            <span class="phone_pref">8 (097)</span><span class="d_n">−</span> 572-58-18</span>

                                        <ul class="tabs">
                                            <li>
                                                <a class="t-d_n d_b" href="#ordercall" data-drop=".drop-order-call" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="center" data-simple="yes">
                                                    <span class="icon-order-call"></span>
                                                    <span class="d_l_b">
                                                        Заказать звонок
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>

</div>
                                    </div>



                                </li>
                                <!--Start. If not logged in then show links for registration and enter to the system-->
                                {if !$CI->dx_auth->is_logged_in()}
                                    <li>
                                        <div class="m-l_17">
                                            <span class="icon-enter-M"></span>
                                            <div class="d_i-b enter-cont"> <span class="f-s_0  d_b">
                                                    <span class="helper"></span>
                                                    <a 
                                                        id="loginButton"
                                                        data-drop=".drop-enter"
                                                        data-effect-on="fadeIn"
                                                        data-effect-off="fadeOut"
                                                        data-duration="300"
                                                        data-place="noinherit"
                                                        data-placement="top right">

                                                        <span>Вход в магазин</span>
                                                    </a>
                                                </span>
                                                <span class="f-s_0 d_b">
                                                    <span class="helper"></span>
                                                    <span>
                                                        <a href="/auth/register" class="t-d_n f-s_0 register">

                                                            <span class="text-el">Регистрация</span>
                                                        </a>
                                                    </span>
                                                </span>
                                            </div> </div>
                                    </li>

                                    <li>

                                    </li>
                                    <!--Else show link for personal cabinet -->
                                {else:}
                                    <li class="m-r40">
                                        <div class="m-l_13">
                                            <span class="icon-exit-M"></span>
                                            <div class="d_i-b enter-cont"><span class="f-s_0 d_b">
                                                    <span class="helper"></span>
                                                    <span>
                                                        <a href="/shop/profile" class="t-d_u">
                                                            <span class="text-el">Личный кабинет</span>
                                                        </a>
                                                    </span>
                                                </span>

                                                <span class="f-s_0 d_b">
                                                    <span class="helper"></span>
                                                    <button type="button" onclick="ImageCMSApi.formAction('/auth/authapi/logout', '')">

                                                        <span class="d_l_g">Выход</span>
                                                    </button>
                                                </span>
                                            </div></div>
                                    </li>
                                {/if}
                                <!--End. ***-->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>