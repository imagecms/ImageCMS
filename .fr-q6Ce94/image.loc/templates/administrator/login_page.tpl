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
            <div class="form_login t-a_c">
                <!--
                <div class="o_h" style="margin-top: 20px; text-align: right; margin-right: -50px">
                    <a href="/admin/login/switch_admin_lang/english" class="d-i_b">
                {if $CI->config->item('language') == 'english'}
                    <img  width="100%" height="100p%" src="{$THEME}img/EN.png"/>
                {else:}
                    <img  style="height: 13px; width: 22px; margin-top: 3px; margin-right: 10px " width="70%" height="70p%" src="{$THEME}img/EN.png"/>
                {/if}
            </a>
            <a href="/admin/login/switch_admin_lang/russian" class="d-i_b">
                {if $CI->config->item('language') == 'russian'}
                    <img width="100%" height="100%"  src="{$THEME}img/Ru.png"/>
                {else:}
                    <img width="70%" height="70%" src="{$THEME}img/Ru.png"/>
                {/if}
            </a>
        </div>
                -->
                <a href="/admin/dashboard" class="d-i_b">
                    <img src="{$THEME}img/logo.png"/>
                </a>

                <form method="post" action="{$BASE_URL}admin/login/" class="standart_form t-a_l" id="with_out_article">
                    {if $login_failed}
                        <label>
                            {echo $login_failed}
                        </label>
                        {$login_failed}
                    {/if}
                    <label>
                        <input type="text" name="login" placeholder="{lang("E-mail", "admin")}"/>{$login_error}
                        <span class="icon-user"></span>
                    </label>
                    <label>
                        <input type="password" name="password" placeholder="{lang("Password", "admin")}"/>{$password_error}
                        <span class="icon-lock"></span>
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
                    <div class="o_h">
                        <div class="pull-left frame_label">
                            <span class="frame_label">
                                <span class="niceCheck">
                                    <input type="checkbox" name="remember" value="1"/>
                                </span>
                                {lang('Remember',"admin")}
                            </span>
                        </div>
                        <a href="{$BASE_URL}admin/login/forgot_password/" class="pull-right">{lang('Forgot your password?',"admin")}</a>
                    </div>
                    <input type="submit" value="{lang('Log in',"admin")}" class="btn btn-info" style="margin-top: 26px;"/>
                    {form_csrf()}
                </form>
                { /* }
                <div class="o_h" style="margin-bottom: -20px;">
                    <form action="/admin/login/switch_admin_lang" method="GET">
                        <select name="language" onchange="this.form.submit()" style="float: right; width: 100px; margin-top: 25px;">
                            <option value="russian" {if $CI->config->item('language') == 'russian'} {echo 'selected';}{/if}>{echo lang('Russian', 'install')}</option>
                            <option value="english" {if $CI->config->item('language') == 'english' || !$CI->config->item('language')} {echo 'selected';}{/if}>{echo lang('English', 'install')}</option>
                        </select>
                        <div style="text-align: right; font-size: 17px; float: right; margin-right: 10px; margin-top: 20px;"><h5><b>{echo lang('Language', 'admin')}:</b></h5></div>
                                    {form_csrf()}
                    </form>
                </div>
                { */ }
            </div>
        </div>
        <script src="{$THEME}js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/scripts.js" type="text/javascript"></script>
    </body>
</html>