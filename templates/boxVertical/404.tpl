<div class="frame-inside page-404">
    <div class="container">
        <div class="content">
            <img src="{$THEME}{$colorScheme}/images/404.png"/>
            <div class="description">
                {$error}
                <div class="title">{lang('404 / Страница не найдена','boxVertical')}</div>
                <p><b>{lang('Эта страница не существует или была удалена.','boxVertical')}</b></p>
                <hr/>
                <p>{lang('Приносим свои извинения за доставленные неудобства. Для продолжения работы вы можете перейти к представленным пунктам меню, воспользоваться поиском по сайту либо перейти на главную страницу','boxVertical')}
                <div class="btn-buy btn-buy-p">
                    <a href="{site_url()}"><span class="text-el">{lang('Главная страница','boxVertical')}</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
{literal}
    <script>
        $(document).on('ready', function() {
            $('footer').css({'z-index': 1, 'position': 'relative'});
        });
    </script>
{/literal}