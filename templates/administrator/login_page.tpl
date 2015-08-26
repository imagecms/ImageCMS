<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>{lang('Operation panel',"admin")} - Image CMS</title>
        <meta name="description" content="{lang('Operation panel',"admin")} - Image CMS" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap-responsive.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap-notify.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery/custom-theme/jquery-ui-1.8.23.custom.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery/custom-theme/jquery-ui-1.8.16.custom.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery/custom-theme/jquery.ui.1.8.16.ie.css"/>
    </head>
    <body>

        {$ci = get_instance();}
        {if $ci->config->item('is_installed') === TRUE AND file_exists(APPPATH.'modules/install/install.php')}
            {chmod(APPPATH.'modules/install/install.php', 0777)}
            {if !rename(APPPATH.'modules/install/install.php', APPPATH.'modules/install/_install.php')}
                {die('<span style="font-size:18px;"><br/><br/>'.lang("Delete the file to continue","admin").'/application/modules/install/install.php</div>')}
            {/if}
        {/if}

        <div class="main_body">

            <div class="form_login_out">

                <div class="logo-login">
                    <a href="/admin/dashboard" class="d-i_b">
                        {if MAINSITE}
                            <!-- if premmerce store login -->
                            <img src="{$THEME}img/logo_login_premmerce.png"/>
                            <!-- if premmerce store login end -->
                        {else:}
                            <img src="{$THEME}img/logo_login_imagecms.png"/>
                        {/if}
                    </a>
                </div>

                <div class="form_login t-a_c">
                    <div class="inside-padd">
                        <div class="frame-title">
                            <div class="title">{lang('Admin panel',"admin")}</div>
                            <!-- if premmerce store login -->
                            <div class="subtitle">{echo rtrim(site_url(),'/')}</div>
                            <!-- if premmerce store login end -->
                        </div>
                        <form method="post" action="{$BASE_URL}admin/login/" class="standart_form t-a_l" id="with_out_article">
                            {if $login_failed}
                                <label>
                                    <div class="alert alert-error">{echo $login_failed}</div>
                                </label>
                            {/if}
                            {form_csrf()}

                            <label>
                                <input type="text" name="login" value="{if $_POST.login}{echo $_POST.login}{/if}" placeholder="{lang("E-mail", "admin")}"/>{$login_error}
                            </label>
                            <label>
                                <input type="password" name="password" placeholder="{lang("Password", "admin")}"/>{$password_error}
                            </label>
                            {if $use_captcha == "1"}

                                <label style="margin-bottom:50px">
                                    {lang('Security code', 'admin')}:<br/>
                                    <div id="captcha">{$cap_image}</div>
                                    <a href="" onclick="ajax_div('captcha', '{$BASE_URL}/admin/login/update_captcha');
                                            return false;">{lang('Update the code',"admin")}</a>
                                    <input type="text" name="captcha" />{$captcha_error}
                                </label>
                            {/if}
                            <button type="submit" class="btn btn-primary btn-signin">{lang('Log in',"admin")}</button>
                            <div class="o_h">
                                <div class="pull-left">
                                    <label class="frame_label">
                                        <span class="f-s_0 m-t_0 d-i_b v-a_m l-h_1" style=""> {/* class="niceCheck" */}
                                            <input type="checkbox" name="remember" value="1"/>
                                        </span>
                                        <span class="text-el d-i_b v-a_m">{lang('Remember me',"admin")}</span>
                                    </label>
                                </div>
                                <a href="{$BASE_URL}admin/login/forgot_password/" class="pull-right">{lang('Forgot your password?',"admin")}</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>
        <script src="{$THEME}js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/scripts.js" type="text/javascript"></script>
    </body>
</html>