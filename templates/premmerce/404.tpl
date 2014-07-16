<img src="{$THEME}{$colorScheme}/images/404.png"/>
<div class="description">
    {$error}
    <div class="title">{lang('Страница не найдена','newLevel')}</div>
    <p><b>{lang('Эта страница не существует или была удалена.','newLevel')}</b></p>
    <p>{lang('Приносим свои извинения за доставленные неудобства. Для продолжения работы вы можете перейти к представленным пунктам меню, воспользоваться  поиском по сайту либо перейти на', 'newLevel')}
    <div class="btn-buy">
        <a href="{site_url()}"><span class="text-el">{lang('Перейти на главную страницу','newLevel')}</span></a>
    </div>
</div>
{literal}
    <script>
        $(document).on('ready', function() {
            $('footer').css({'z-index': 1, 'position': 'relative'});
        });
    </script>
{/literal}