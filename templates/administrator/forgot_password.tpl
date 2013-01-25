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
        
    </head>
    <body>
        <?php
        $ci = get_instance();
        if($ci->config->item('is_installed') === TRUE AND file_exists(APPPATH.'modules/install/install.php'))
        die('<span style="font-size:18px;"><br/><br/>'.lang('a_delete_install').'/application/modules/install/install.php</div>');
            ?>
            <div class="main_body">
                <div class="form_login t-a_c" style="min-height: 250px;">
                    <a href="/admin/dashboard" class="d-i_b">
                        <img src="{$THEME}/img/logo.png"/>
                    </a><br/>
                    <div id="titleExt">{widget('path')}<span class="ext">{lang('lang_forgot_password')}</span></div>

                    <form action="" class="t-a_l" method="post">
                        <label>
                            {lang('lang_username_or_mail')}
                            <input type="text" name="login" id="login" style="padding-left: 5px;" placeholder="E-mail"/>
                            {if validation_errors() OR $info_message}
                                {validation_errors()}
                                {$info_message}
                            {/if}
                        </label>
                            

                        <input type="submit" id="submit" class="btn btn-info pull-left" value="{lang('a_send_f')}" />
                        <a href="{site_url('/admin/login')}" class="pull-right m-t_10">{lang('s_log_out')}</a>
                        {form_csrf()}
                    </form>
                </div>
            </div>
            <script src="{$THEME}/js/jquery-1.8.2.min.js" type="text/javascript"></script>
            <script src="{$THEME}/js/scripts.js" type="text/javascript"></script>
    </body>
</html>