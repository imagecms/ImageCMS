<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>{lang("Operation panel","admin")} - Image CMS</title>
        <meta name="description" content="{lang("Operation panel","admin")} - Image CMS" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap-responsive.css"/>

    </head>
    <body>
        <?php
        $ci = get_instance();
        if($ci->config->item('is_installed') === TRUE AND file_exists(APPPATH.'modules/install/install.php'))
        die('<span style="font-size:18px;"><br/><br/>'.lang("Delete the file to continue","admin").'/application/modules/install/install.php</div>');
        ?>
        <div class="main_body">

            <div class="form_login_out form_register_out">

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
                            <div class="title">{lang("Forgot your password?","admin")}</div>
                            <div class="subtitle">{lang("The password will be sent to the e-mail","admin")}</div>
                        </div>

                        <form action="" method="post">
                            <label>
                                <input type="text" name="login" id="login" placeholder="E-mail"/>
                                {if validation_errors() OR $info_message}
                                    {validation_errors()}
                                    {$info_message}
                                {/if}
                            </label>
                            <button type="submit" id="submit" class="btn btn-primary btn-signin">{lang('Send',"admin")}</button>
                            <a href="{site_url('/admin/login')}" class="back-a">{lang("Back to Log in","admin")}</a>
                            {form_csrf()}
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <script src="{$THEME}js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/scripts.js" type="text/javascript"></script>
    </body>
</html>