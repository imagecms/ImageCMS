<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>{lang('a_controll_panel')} - Image CMS</title>
        <meta name="description" content="{lang('a_controll_panel')} - Image CMS" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap-responsive.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/bootstrap-notify.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/jquery/custom-theme/jquery-ui-1.8.23.custom.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/jquery/custom-theme/jquery-ui-1.8.16.custom.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}/css/jquery/custom-theme/jquery.ui.1.8.16.ie.css"/>
    </head>
    <body>
        <?php
        $ci = get_instance();
        if($ci->config->item('is_installed') === TRUE AND file_exists(APPPATH.'modules/install/install.php'))
        die('<span style="font-size:18px;"><br/><br/>'.lang('a_delete_install').'/application/modules/install/install.php</div>');
            ?>
            <div class="main_body">
                <div class="container t-a_c">
                    <a href="/admin/dashboard" class="logo f_n m-t_20 d-i_b">
                        <img src="{$THEME}/img/logo.png"/>
                    </a>
                    <div class="row-fluid">
                        <div class="span6 d-i_b">
                            <h2 class="m-t_30 t-a_l">{lang('a_auth')}</h2>
                            <form method="post" action="{$BASE_URL}admin/login/" class="standart_form t-a_l" id="with_out_article">
                                {if $login_failed}
                                {$login_failed}
                                {/if}
                                <label>
                                    {lang('a_login')}:
                                    <input type="text" name="login"/>{$login_error}
                                </label>
                                <label>
                                    {lang('a_pass')}:
                                    <input type="password" name="password"/>{$password_error}
                                </label>
                                {if $use_captcha == "1"}

                                <label style="margin-bottom:50px">
                                    {$lang_captcha}:<br/>
                                    <div id="captcha">{$cap_image}</div>
                                    <a href="" onclick="ajax_div('captcha','{$BASE_URL}/admin/login/update_captcha');return false;">{lang('a_code_refresh')}</a>
                                    <input type="text" name="captcha" />{$captcha_error}
                                </label>
                                {/if}
                                <div>
                                    <label class="d-i_b m-r_15">
                                        <input type="checkbox" name="remember" value="1"/>{lang('a_remember')}
                                    </label>
                                </div>
                                <input type="submit" value="{lang('a_send_f')}" class="btn d_i_b m-b_15"/>
                                <div class="o_h">
                                    <a href="/auth/register/">{lang('a_reg')}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/auth/forgot_password/">{lang('a_forget_pass')}</a>
                                </div>
                                {form_csrf()}
                            </form>
                        </div>
                    </div>
                </div>
                <div class="hfooter"></div>
            </div>
            <footer class="b_c_n">
                <div class="container w_260">
                    <div class="d_t_c l_h_17">
                        <span class="l_h_27">{lang('a_site_image_ooo')}</span>
                        {lang('a_site_image_text')}
                    </div>            
                </div>
            </footer>
    </body>
</html>
