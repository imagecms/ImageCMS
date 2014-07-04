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
            <header {if strstr($CI->uri->uri_string(), 'support/ticket/')}class="fixed"{/if}>
                {include_tpl('header.tpl')}
            </header>
            <div class="container">
                <div class="left">
                    {load_menu('saas_left_menu')}
                </div>
                {if $CI->core->core_data['data_type'] == 'main'}
                    <div class="right"
                         data-mq-elem-pool=".main-body"
                         data-mq-prop-pool="height"
                         data-mq-prop="min-height"
                         data-mq-prop-add="-87"

                         data-mq-max="1280"
                         data-mq-min="0"
                         data-mq-target="#right"
                         >
                        <div class="panel-default">
                            <div class="title-default-out">
                                <div class="title">
                                    Тур по системе
                                </div>
                            </div>
                            <ol class="items-refers-vertical">
                                {$tutorial_pages = category_pages(81,11);}
                                {foreach $tutorial_pages as $number => $page}
                                    <li>
                                        <a href="{echo site_url($page['cat_url'])}#t{echo ++$number}" class="after-icon">
                                            {echo $page['title']}
                                        </a>
                                    </li>
                                {/foreach}

                            </ol>
                            <div class="footer-panel">
                                <div class="inside-padd">
                                    <a href="{site_url('tutorial')}" class="btn btn-primary">
                                        <span class="text-el">Полная документация</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-default out-adding-service">
                            <div class="title-default-out">
                                <div class="title">
                                    Дополнительные услуги
                                </div>
                            </div>
                            {$CI->load->module('cfcm')->get_form(80, 97, 'page', 'additional_services_form_min')}
                        </div>
                    </div>
                {/if}
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