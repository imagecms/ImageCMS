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
        <div class="main-body">
            <header>

            </header>
            <div class="container">
                <div class="left">
                </div>
                <!--                content-->
                <div class="content">
                    {echo $content}
                </div>
                <script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>
                <!--                content-->

            </div>
        </div>
        <script type="text/javascript" src="{$THEME}js/scripts.js"></script>
    </body>
</html>