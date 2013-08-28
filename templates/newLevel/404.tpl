{$colorScheme = 'css/color_scheme_1'}
<div class="frame-inside page-404">
    <div class="container">
        <div class="content">
            <img src="{$THEME}{$colorScheme}/images/404.png"/>
            <div class="description">
                {$error}
                <div class="title">{lang('Page not found','newLevel')}</div>
                <p><b>{lang('This page does not exist or has been removed.','newLevel')}</b></p>
                <p>{lang('To continue, you can check your address of the page, go to the home page, use the search or visit the proposed site sections','newLevel')}
                <div class="btn-buy">
                    <a href="{site_url()}" class="text-el">{lang('Go to the home page','newLevel')}</a>
                </div>
            </div>
        </div>
    </div>
</div>