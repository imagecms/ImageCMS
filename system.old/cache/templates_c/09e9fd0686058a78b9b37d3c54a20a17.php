<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title><?php if(isset($site_title)){ echo $site_title; } ?></title>
        <meta name="description" content="<?php if(isset($site_description)){ echo $site_description; } ?>" />
        <meta name="keywords" content="<?php if(isset($site_keywords)){ echo $site_keywords; } ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="generator" content="ImageCMS" />
        <link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>css/style.css" media="all" />
            <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>css/lte_ie_8.css" /><![endif]-->
            <!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php if(isset($THEME)){ echo $THEME; } ?>css/ie_7.css" /><![endif]-->
        <!--[if lt IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if gte IE 9]>
            <style type="text/css">
              .gradient <?php filter: none;
              ?>
            </style>
        <![endif]-->
        <link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo siteinfo('siteinfo_favicon_url')?>" />
        <link rel="SHORTCUT ICON" href="<?php echo siteinfo('siteinfo_favicon_url')?>"/>
        <script type="text/javascript" src="<?php if(isset($THEME)){ echo $THEME; } ?>js/jquery-1.8.3.min.js"></script>
    </head>
    <body>
 	<?php $this->include_tpl('language/jsLangsDefine.tpl', '/var/www/image-c.loc/templates/corporate'); ?>
        <?php $this->include_tpl('language/jsLangs.tpl', '/var/www/image-c.loc/templates/corporate'); ?>
        <div class="main-body">
            <div class="fon-header">
                <header>
                    <div class="menu-header">
                        <div class="container">
                            <nav class="f_l nav nav-header">
                                <?php echo load_menu ('top_menu'); ?>
                            </nav>
                            <?php $this->include_tpl('auth_data', '/var/www/image-c.loc/templates/corporate'); ?>
                        </div>
                    </div>
                    <div class="content-header">
                        <div class="container">
                            <?php if($CI->core->core_data['data_type'] == 'main'): ?>
                                <span class="logo f_l">
                                    <img src="<?php echo siteinfo('siteinfo_logo')?>" alt="logo.png"/>
                                </span>
                            <?php else:?>
                                <a href="<?php echo site_url (); ?>" class="logo f_l">
                                    <img src="<?php echo siteinfo('siteinfo_logo')?>" alt="logo.png"/>
                                </a>
                            <?php endif; ?>
                            <div class="content-cleaner-search f_r">
                                <?php echo widget ('header'); ?>
                            </div>
                        </div>
                    </div>
                </header>
                <?php echo load_menu ('main_menu'); ?>
            </div>
            <?php if(isset($content)){ echo $content; } ?>
            <div class="h-footer"></div>
        </div>
        <footer>
            <div class="content-footer">
                <div class="container">
                    <div class="copy-right f_l">
                        <?php echo widget ('footer'); ?>
                    </div>    
                    <nav class="box-1 f_r nav-footer">
                        <?php echo load_menu ('bottom_menu'); ?>
                    </nav>    
                </div>
            </div>
        </footer>
        <script type="text/javascript" src="<?php if(isset($THEME)){ echo $THEME; } ?>js/jquery.pluginssiteimage.js"></script>
        <script type="text/javascript" src="<?php if(isset($THEME)){ echo $THEME; } ?>js/scripts.js"></script>
    </body>
</html>
<?php $mabilis_ttl=1415876595; $mabilis_last_modified=1415789038; ///var/www/image-c.loc/templates/corporate/main.tpl ?>