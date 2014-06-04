{$colorScheme = 'css/color_scheme_1'}
<div class="frame-inside page-404">
    <div class="container">
        <div class="content">
            <img src="{$THEME}{$colorScheme}/images/404.png"/>
            <div class="description">
                {$error}
                <div class="title">{lang('Такой страницы не существует','newLevel')}</div>
                <p>{lang('Приносим свои извинения за доставленные неудобства. Для продолжения работы вы можете перейти к представленным пунктам меню, воспользоваться поиском по сайту либо перейти на главную','newLevel')}</p>
                <div class="btn-buy">
                    <a href="{site_url()}"><span class="text-el">{lang('на главную','newLevel')}</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
{literal}
    <script>
        $(document).on('ready', function(){
            $('footer').css({'z-index': 1, 'position': 'relative'});
        });
    </script>
{/literal}
