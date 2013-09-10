<!DOCTYPE html>
<html>
    <head>
        <title></title>        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>        
        {literal}
            <style type="text/css">
                html {
                    font-size: 100.01%;
                }
                html, body {
                    height: 100%;
                }
                * {
                    border: 0 none;
                    line-height: 1;
                    margin: 0;
                    outline: medium none;
                    padding: 0;
                }
                body {
                    background-color: #F5F6F7;
                    color: #333333;
                    font-family: Arial,"Helvetica CY","Nimbus Sans L",sans-serif;
                    font-size: 12px;
                    font-style: normal;
                    min-width: 980px;
                }
                html, body {
                    height: 100%;
                }
                .preference, .products, nav, .container {
                    clear: both;
                    margin: 0 auto;
                    width: 980px;
                }
                .w_665 {
                    width: 665px !important;
                }
                .hfooter {
                    height: 224px;
                }
                .logo_with_out_article {
                    display: table-cell;
                    height: 227px;
                    text-align: center;
                    vertical-align: middle;
                    width: 665px;
                }
                .order_partner_ship:after, .icon1 {
                    background-position: -1264px 0;
                    bottom: -30px;
                    height: 30px;
                    left: 0;
                    width: 664px;
                }
                .order_partner_ship:after, .order_partner_ship:before, .icon1, .icon2 {
                    content: "";
                    display: block;
                    position: absolute;
                }

                .type_adding li span, .order_partner_ship:after, .icon1, .article, .information_block li span, .d_l_b, .d_l_blue {
                    background: url("../images/dashed.png") no-repeat scroll 0 0 transparent;
                }

                .fonds.order_partner_ship:before, .fonds.order_partner_ship .icon2 {
                    display: none;
                }

                .order_partner_ship:before, .icon2 {
                    border-color: #EDEDED transparent;
                    border-style: solid;
                    border-width: 0 34px 31px;
                    height: 0;
                    left: 50%;
                    margin-left: -34px;
                    top: -31px;
                    width: 0;
                }
                .order_partner_ship:after, .order_partner_ship:before, .icon1, .icon2 {
                    content: "";
                    display: block;
                    position: absolute;
                }
                #with_out_article {
                    margin-top: 27px;
                    padding-bottom: 40px;
                }
                .order_partner_ship {
                    background-color: #ECECEC;
                    position: relative;
                }
                .history_order, .comprasion, .frame_grey_b_f, .order_partner_ship, .sort select, .search_input {
                    border-radius: 5px 5px 5px 5px;
                }
                .reRegistration {
                    padding-top: 47px;
                    color: #7D7D7D;
                    font-family: sans-serif;
                    font-size: 30px;
                    font-style: oblique;
                    margin-top: 36px;
                    text-align: center;
                    text-transform: none;
                }
                h2 a, h2, h1, .title_h {
                    font-weight: normal;
                }
                .reRegistrationH3 {
                    color: #7D7D7D;
                    font-size: 20px;
                    margin-top: 20px;
                    text-align: center;
                    text-transform: none;
                }
                h2, h3 {
                    text-transform: none !important;
                }
                .sub_menu li a, .button_buy, .tahoma, .category, .left_menu > li > a, .title_baner, h2, h1, .title_h, .title_hr *, .preference div, .products li span, header section.f_r a, nav > ul > li > a, .refer_header a, .count_license {
                    font-family: Tahoma,'Geneva','Kalimati',sans-serif;
                }
                element.style {
                    margin: 70px;
                    text-align: center;
                }
                .reRegistrationA {
                    color: #0E73A8;
                    font-family: arial;
                    font-size: 13px;
                    font-weight: bold;
                    text-align: center !important;
                }
                .blue_2, h2 a, a {
                    line-height: 1.2;
                    text-transform: none;
                }
                .clear {
                    clear: both !important;
                }
                .b_c_n {
                    background-color: transparent;
                }
                footer {
                    height: 224px;
                    margin: -224px auto 0;
                }
                article, section, footer, header, nav, .d_b {
                    display: block !important;
                }
                footer .container {
                    padding-top: 26px;
                }
                .preference, .products, nav, .container {
                    clear: both;
                    margin: 0 auto;
                    width: 980px;
                }
                .w_260 {
                    width: 260px !important;
                }
                footer.b_c_n .d_t_c {
                    height: 198px;
                    text-align: center;
                    width: 260px;
                }
                .d_t_c {
                    display: table-cell;
                    vertical-align: middle;
                }
                .l_h_17 {
                    line-height: 17px;
                }

            </style>
        {/literal}
    </head>
    <body>
        <div class="main_body">

            <div class="order_partner_ship frame_ fonds" id="with_out_article">
                <h1 class="reRegistration">{lang('Сайт в стадии строительства','newLevel')}</h1>                    
                <h2 class="reRegistrationH3">{lang('Управление сайтом','newLevel')}</h2>   
                <div style="text-align: center; margin:70px;">
                    {$CI->config->load('auth')}
                    <a href="mailto:{echo $CI->config->item('DX_webmaster_email')}" class="reRegistrationA">{lang('Отправить сообщение','newLevel')}</a>
                    <div class="clear" ></div>
                </div>               
            </div>
        </div>
        <div class="hfooter"></div>
    </div>
    <footer class="b_c_n">
        <div class="container w_260">
            <div class="d_t_c l_h_17">
                <span class="l_h_27">© {lang('ООО «Сайт Имидж','newLevel')}</span>
                {lang('ImageCMS активно развивается в создание качественных интернет-магазинов','newLevel')}
            </div>            
        </div>
    </footer>
</body>
</html>