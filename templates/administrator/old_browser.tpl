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
        <link rel="stylesheet" type="text/css" href="{$THEME}css/bootstrap-notify.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery/custom-theme/jquery-ui-1.8.23.custom.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery/custom-theme/jquery-ui-1.8.16.custom.css"/>
        <link rel="stylesheet" type="text/css" href="{$THEME}css/jquery/custom-theme/jquery.ui.1.8.16.ie.css"/>
    </head>
    <body>
        <?php
        $ci = get_instance();
        if($ci->config->item('is_installed') === TRUE AND file_exists(APPPATH.'modules/install/install.php'))
        die('<span style="font-size:18px;"><br/><br/>'.lang("Delete the file to continue","admin").'/application/modules/install/install.php</span>');        
        ?>
        <div class="main_body">
            <div class="form_login t-a_c">
                <a href="/admin/dashboard" class="d-i_b">
                    <img src="{$THEME}img/logo.png"/>
                </a><br/>
                {lang('Sorry but you have an old browser','admin')}.<br />

                {lang('Update or download new browsers here','admin')}:
                <div>
                    <a href="http://www.mozilla.org/ru/firefox/new/" target="_blank"><img title="FireFox" src="{$THEME}img/firefox.png"/></a>
                    <a href="http://ru.opera.com/" target="_blank"><img title="Opera" src="{$THEME}img/opera.png"/></a>
                    <a href="http://www.google.com/intl/ru/chrome/browser/" target="_blank"><img title="Google Chrom" src="{$THEME}img/google.png"/></a>
                    <!--<a href="http://www.mozilla.org/ru/firefox/new/" target="_blank"><img title="Safari" src="{$THEME}img/safari.png"/></a>-->
                </div>
            </div>
        </div>
        <script src="{$THEME}js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="{$THEME}js/scripts.js" type="text/javascript"></script>
    </body>
</html>
