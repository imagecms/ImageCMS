<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<head>
    <title>{$site_title}</title>
    <meta name="description" content="{$site_description}" />
    <meta name="keywords" content="{$site_keywords}" />    
    <meta name="generator" content="ImageCMS" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{$THEME}css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="{$THEME}css/slider.css" rel="stylesheet" type="text/css" media="all"/>
    <link rel="SHORTCUT ICON" href="favicon.ico" />
    <link rel="icon" type="image/vnd.microsoft.icon" href="{echo siteinfo('siteinfo_favicon_url')}" />
    <script type="text/javascript" src="{$THEME}js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="{$THEME}js/jquery.nivo.slider.js"></script>
    {literal}
        <script type="text/javascript">$(window).load(function() {
                $('#slider').nivoSlider();
            });
        </script>
    {/literal}
</head>
<body>
    <div class="header">
        <div class="header_top">
            <div class="wrap">
                <div class="logo">
                    <a href="{site_url()}"><img src="{siteinfo('siteinfo_logo')}" alt="" /></a>
                </div>
                <div class="menu">
                    {load_menu('main_menu')}
                </div>
                <div class="clear"></div>
            </div>
        </div>
        {if $CI->uri->segment(1) == ''}
            <!------ Slider ------------>
            {$CI->load->module('banners')->render()}            
            <!------End Slider ------------>
        {/if}
    </div>
    <div class="main">
        {$content}
    </div>
    <div class="footer">
        <div class="wrap">
            <div class="section group">
                <div class="col_1_of_4 span_1_of_4">
                    <div class="location">
                        <h3>{lang('Location','houseFraming')}</h3>
                        <ul>
                            <li><img src="{siteinfo('footerlogo')}" alt="" /></li>
                                {echo siteinfo('siteinfo_address')}
                        </ul>
                    </div>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    {$infoPage = get_page(101)}
                    <h3>{$infoPage.title}</h3>
                    {$infoPage.prev_text}
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    {$testimonials = get_page(102)}
                    <h3>{$testimonials.title}</h3>
                    <div class="Testimonials_desc">
                        {$testimonials.prev_text}
                    </div>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h3>{lang('Contact Us', 'houseFraming')}</h3>
                    <ul class="address">
                        <li>{echo siteinfo('Email')}</li>
                        <li><span>Mobile :</span> {echo siteinfo('siteinfo_mainphone')}</li>
                        <li><span>Telephone :</span> {echo siteinfo('Telephone')}</li>
                        <li><span>Fax :</span> {echo siteinfo('Fax')}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copy-right">
            <div class="wrap">
                <p>Design by  <a href="http://w3layouts.com">W3Layouts</a> Powered by <a href="http://imagecms.net">ImageCMS</a> ImageCMS Corporate - <a href="http://www.imagecms.net/free-cms-corporate">Бесплатная CMS</a></p>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</body>
</html>