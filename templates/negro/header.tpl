<!--Start. Top menu and authentication data block-->
<div class="menu-header">
    <div class="container">
        <nav class="f_l">
            <ul class="nav">
                {load_menu('top_menu')}
            </ul>
        </nav>
        <div class="f_r">
            {include_shop_tpl('auth_data')}
        </div>
    </div>
</div>
<!--End. Top menu and authentication data block-->
<div class="content-header">
    <div class="container">
<!--        Logo-->
        <a href="{site_url('')}" class="f_l"><img src="{$THEME}images/logo.png" alt="logo.png"/></a>
        <div class="content-cleaner-search">
            <div class="o_h">
<!--                Start. contacts block-->
                <div class="phones-header f_l">
                    +8 (090) 500-50-50
                    <button type="button" class="f-s_0" data-event="call" data-drop=".drop-order-call" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="top right"><span class="icon-order-call"></span><span class="form_title d_l_b f-s_14">Заказать звонок</span></button>
                </div>
<!--                End. Contacts block-->
<!--                Start. Show wish list and compare data-->
                <div class="f_r">
                   {include_shop_tpl('wish_list_data')}
                   {include_shop_tpl('compare_data')}
                </div>
<!--                End. Show wish list and compare data-->
            </div>
            <div class="frame-search">
<!--                Start. Show search form-->
                <div class="f_l frame-search-form">
                    <form name="search" method="get" action="{shop_url('search')}"  id="autocomlete">
                        <input type="text" class="input-search" id="inputString" name="text" autocomplete="off" value="" placeholder="{lang('s_se_thi_sit')}" />
                        <div class="btn btn-search d_i-b">
                            <button type="submit">{lang('search_find')}</button>
                        </div>
                        <div id="suggestions" class="drop-search drop"></div>
                    </form>
                </div>
<!--                End. Show search form-->
<!--                Start. Include cart data template-->
                <div class="f_r" id="bask_block">
                    {include_shop_tpl('cart_data')}
                </div>
<!--                    End. Include cart data template-->
            </div>
        </div>
    </div>
</div>
