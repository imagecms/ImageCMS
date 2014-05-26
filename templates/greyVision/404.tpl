
<div class="frame-inside page-404">
    <div class="container">
        <div class="content">
            <img src="{$THEME}{$colorScheme}/images/404.png"/>
            <div class="description">
                {$error}
                <div class="title">{lang('Страница не найдена','greyVision')}</div>
                <p><b>{lang('Эта страница не существует или была удалена.','greyVision')}</b></p>
                <p>{lang('Приносим свои извинения за доставленные неудобства. Для продолжения работы вы можете перейти к представленным пунктам меню, воспользоваться  поиском по сайту либо перейти на','greyVision')}
                <div class="btn-buy">
                    <a href="{site_url()}"><span class="text-el">{lang('Перейти на главную страницу','greyVision')}</span></a>
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