<!DOCTYPE html>
<html>
    <head>
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="generator" content="ImageCMS" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="{$THEME}css/style.css" media="all"/>

        <link rel="icon" href="" type="image/x-icon" />
        <link rel="shortcut icon" href="" type="image/x-icon" />

        <script type="text/javascript" src="{$THEME}js/jquery-1.8.3.min.js"></script>
    </head>
    <body> 
        <script>
            {literal}
                var k = 0;
                for (var i in $.browser) {
                    k++;
                    if (k === 3)
                        $('body').addClass('is' + i);
                }
            {/literal}
        </script>

        <div class="main-body">
            <div class="container">                
                <!--                content-->
                <div class="content">
                    {echo $content}
                </div>
                <!--                content-->

            </div>
        </div>
        <script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>
        <script type="text/javascript" src="{$THEME}js/tabs.js"></script>
        <script type="text/javascript" src="{$THEME}js/scripts.js"></script>
        <link rel="stylesheet" type="text/css" href="{$THEME}js/fancybox/jquery.fancybox-1.3.4.css" media="all" />
        <script type="text/javascript" src="{$THEME}js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

        <div class="d_n">
            {include_tpl('consult.tpl')}
        </div>
    </body>
</html>