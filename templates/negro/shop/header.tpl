<div class="menu-header">
    <div class="container">
        <nav class="f_l">
            <ul class="nav">
                {load_menu('top_menu')}
            </ul>
        </nav>
        <div class="f_r">
            {include_tpl('auth_data')}
        </div>
    </div>
</div>
<div class="content-header">
    <div class="container">
        <a href="{site_url('')}" class="f_l"><img src="{$THEME}images/logo.png" alt="logo.png"/></a>
        <div class="content-cleaner-search">
            <div class="o_h">
                <div class="phones-header f_l">
                    {//widget('phones_head')}
                    <nav class="d_i-b">
                        <ul class="nav">
                            <li>
                                <button type="button" class="f-s_0" data-event="call" data-drop=".drop-order-call" data-effect-on="fadeIn" data-effect-off="fadeOut" data-duration="300" data-place="noinherit" data-placement="top right"><span class="icon-order-call"></span><span class="form_title d_l_b f-s_14">Заказать звонок</span></button>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="f_r wish-list-min" id="wishlistBlock">
                   {include_tpl('wish_list_data')}
                </div>
            </div>
            <div class="frame-search">
                <div class="f_l frame-search-form">
                    <form name="search" method="get" action="{shop_url('search')}"  id="autocomlete">
                        <input type="text" class="input-search" id="inputString" name="text" autocomplete="off" value="" placeholder="{lang('s_se_thi_sit')}" />
                        <div class="btn btn-search d_i-b">
                            <button type="submit">{lang('search_find')}</button>
                        </div>
                        <div id="suggestions" class="drop-search drop"></div>
                    </form>
                </div>
                <div class="f_r" id="bask_block">
                    {include_tpl('cart_data')}
                </div>
            </div>
        </div>
    </div>
</div>
{include_tpl('compare_data')}