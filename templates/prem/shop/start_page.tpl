<div class="page-main">
    <div class="fon-header">
        <div class="form-create-shop">
            <div class="container">
                <div class="title-h1">
                    {lang('Создай свой', 'newLevel')}<br/>
                    {lang('премиум интернет-магазин', 'newLevel')}
                </div>
                <div class="short-desc">{lang('Бесплатная версия на 14 дней. Название магазина можете изменить позже', 'newLevel')}</div>
                <form method="post" action="/saas/create_store">
                    <input type="hidden" name="from_start" value="1">
                    <div class="f-s_0">
                        <div class="f-s_0 d_i-b v-a_t">
                            <input type="text" name="domain" placeholder="{lang('Название магазина', 'newLevel')}"/>
                            <span class="addon d_i-b">
                                .premmerce.com
                            </span>
                        </div>
                        <div class="btn-create-shop2 v-a_t">
                            <button type="submit">
                                <span class="text-el">{lang('Создать магазин бесплатно', 'newLevel')}</span>
                            </button>
                        </div>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
        <img src="{$THEME}images/fon_head.jpg"/>
    </div>
    <div class="frame-benefits">
        <div class="container" style="max-width: 1136px;">
            <ul class="items items-benefits">
                <li>
                    <span class="icon-benfit-1"></span>
                    <div class="description">
                        <div class="title">Ключевые преимущества функционала</div>
                        <div class="short-desc">
                            На системе создано более 1500 современных
                            Посетители получают все необходимые инструменты
                            Администратор получает гибкую систему управления
                        </div>
                        <a href="#" class="f-s_0">
                            <span class="text-el">Полное описание</span>
                            <span class="icon-arrow-r"></span>
                        </a>
                    </div>
                </li>
                <li>
                    <span class="icon-benfit-2"></span>
                    <div class="description">
                        <div class="title">Бесплатные Премиум-дизайны</div>
                        <div class="short-desc">
                            На системе создано более 1500 современных
                            Посетители получают все необходимые инструменты
                            Администратор получает гибкую систему управления
                        </div>
                        <a href="#" class="f-s_0">
                            <span class="text-el">Полное описание</span>
                            <span class="icon-arrow-r"></span>
                        </a>
                    </div>
                </li>
                <li>
                    <span class="icon-benfit-3"></span>
                    <div class="description">
                        <div class="title">100% основа для продвижение</div>
                        <div class="short-desc">
                            На системе создано более 1500 современных
                            Посетители получают все необходимые инструменты
                            Администратор получает гибкую систему управления
                        </div>
                        <a href="#" class="f-s_0">
                            <span class="text-el">Смотреть кейсы</span>
                            <span class="icon-arrow-r"></span>
                        </a>
                    </div>
                </li>
                <li>
                    <span class="icon-benfit-4"></span>
                    <div class="description">
                        <div class="title">Уникальная стилизация</div>
                        <div class="short-desc">
                            На системе создано более 1500 современных
                            Посетители получают все необходимые инструменты
                            Администратор получает гибкую систему управления
                        </div>
                        <a href="#" class="f-s_0">
                            <span class="text-el">Подробнее</span>
                            <span class="icon-arrow-r"></span>
                        </a>
                    </div>
                </li>
            </ul>
            {widget('benefits')}
        </div>
    </div>
    <div class="frame-seo">
        <div class="container">
            <div class="photo-block">
                <img src="{$THEME}images/seo_instrument.jpg" alt="seo {lang('инструменты', 'newLevel')}"/>
            </div>
            <div class="description">
                <div class="title-h1">{lang('В наличии все необходимые инструменты SEO', 'newLevel')}</div>
                <div class="short-desc">
                    {lang('Продажи через интернет - это достаточно сложный процесс, для запуска которого требуется решить несколько задач создать сайт интернет магазина требуется решить', 'newLevel')}
                </div>
                <div class="btn-full-desc">
                    <a href="#">
                        <span class="text-el">
                            {lang('Полное описание', 'newLevel')}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="popular_products">
        {widget('popular_products', TRUE)}
    </div>
    <div class="frame-comments">
        <div class="container">
            <div class="title-h1">
                {lang('Счастливые владельцы интернет-магазинов', 'newLevel')}
            </div>
            <ul class="items items-happy-owner">
                <li>
                    <blockquote class="description">
                        “Здравствуйте, уважаемая команда SellBe! Спасибо за Вашу работу! Спасибо за созданную платформу! Я комментарии оставляю Вам только положительные Всегда. И рекламирую Вас, насколько получается. ”
                    </blockquote>
                    <div class="frame-photo-name">
                        <div class="photo-block">
                            <span class="helper"></span>
                            <img src="{$THEME}images/temp/owner1.jpg"/>
                        </div>
                        <div class="frame-name">
                            <span class="helper"></span>
                            <div>
                                <div class="title">Николай Малецкий</div>
                                <div class="address">siteimage.com.ua</div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <blockquote class="description">
                        “Здравствуйте, уважаемая команда SellBe! Спасибо за Вашу работу! Спасибо за созданную платформу! Я комментарии оставляю Вам только положительные Всегда. И рекламирую Вас, насколько получается. ”
                    </blockquote>
                    <div class="frame-photo-name">
                        <div class="photo-block">
                            <span class="helper"></span>
                            <img src="{$THEME}images/temp/owner2.jpg"/>
                        </div>
                        <div class="frame-name">
                            <span class="helper"></span>
                            <div>
                                <div class="title">Таня Антоненко</div>
                                <div class="address">imagecms.net</div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="frame-add-stimulation">
        <div class="container">
            <div class="title-h1">{lang('Начните бесплатно, без риска, 14-дневная пробная!', 'newLevel')}</div>
            <div class="sub-title">{lang('Пробная версия 14 дней абсолютно бесплатн', 'newLevel')}о</div>
            <div class="btn-create-shop2 big">
                <a href="#">
                    <span class="text-el">{lang('Создать магазин сейчас!', 'newLevel')}</span>
                </a>
            </div>
        </div>
    </div>
</div>