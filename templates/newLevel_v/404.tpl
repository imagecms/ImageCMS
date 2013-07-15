{$colorScheme = 'css/color_scheme_1'}
<div class="frame-inside page-404">
    <div class="container">
        <div class="content">
            <img src="{$THEME}{$colorScheme}/images/404.png"/>
            <div class="description">
                {$error}
                <div class="title">Страница не найдена</div>
                <p><b>Такой страницы не существует или она была удалена.</b></p>
                <p>Для продолжения работы вы можете проверить правильность написания адреса страницы, перейти на главную страницу сайта, воспользоваться поиском либо посетить предложенные разделы сайта</p>
                <div class="btn-buy">
                    <a href="{site_url()}" class="text-el">Перейти на главную</a>
                </div>
            </div>
        </div>
    </div>
</div>