<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>{$site_title}</title>
        <meta name="description" content="{$site_description}" />
        <meta name="keywords" content="{$site_keywords}" />
        <meta name="generator" content="ImageCMS" />

        <link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/style.css" />
        <!--[if IE 6]><link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/ie6.css" /><![endif]-->
        <!--[if IE 7]><link rel="stylesheet" type="text/css" href="{$SHOP_THEME}css/ie7.css" /><![endif]-->

        <script type="text/javascript" src="{$SHOP_THEME}js/jquery-1.6.4.min.js"></script>
        
        <script type="text/javascript" src="{$SHOP_THEME}js/autocomplete/jquery-ui-1.8.15.custom.min.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/autocomplete/loader.js"></script>
        
        <script type="text/javascript" src="{$SHOP_THEME}js/jcarusel/jcarousellite_1.0.1.min.js"></script>
        <script type="text/javascript" src="{$SHOP_THEME}js/jcarusel/load.js"></script>

        <link rel="icon" href="{$SHOP_THEME}images/favicon.png" type="image/x-icon" />
    </head>
    <body>
        <div class="container">
            <div class="site_description text">
                <h1>Приветствуем Вас в Интернет-магазине спорттоваров Sportek!</h1>
                <p>Наш <strong>интернет-магазин спортивных товаров</strong> и <strong>туристического снаряжения</strong> создан для Вас и Вашего удобства, дорогие посетители. У нас Вы в два счета найдете то, что нужно искать днями на рынке или бегая по торговым точкам. У нас Вы сделаете шаг к мечте, радости и удовольствию просто кликнув мышкой. У нас Вы найдете товары для профессионалов и лучшие подарки для Ваших детей.</p>
                <p><strong>Sportek</strong> - это не просто Интернет-магазин туристического снаряжения.<br /><strong>Sportek</strong> - это мир качества, скидок, низких цен и специальных предложений.</p>
                <p>Покупая у Нас, вы экономите колоссальные объемы времени, сил и денег, Вы заботитесь о своем здоровье и здоровье Ваших близких. А мы со своей стороны стараемся делать все возможное и даже больше для того, чтобы Вы были счастливы!</p>
            </div>
            <div class="top">
                <div class="top_menu">
                    <a href="#">Главная</a>
                    <a href="#">О нас</a>
                    <a href="#">Оплата</a>
                    <a href="#">Доставка</a>
                    <a href="#">Акции</a>
                    <a href="#">Контакты</a>
                </div>
                <div class="auth_menu">
                    <span><a href="#">Вход</a></span>
                    <span><a href="#">Регистрация</a></span>
                </div>
            </div>
            <div class="header">
                <div class="logo">
                    <a href="#"></a>
                    <span>Интернет-магазин спортивных товаров и туристического снаряжения</span>
                </div>
                <div class="h_info">
                    <div class="h_contacts">
                        <div><span>(050)</span>431-09-96</div>
                        <div><span>(067)</span>374-65-62</div>
                        <div><span>(032)</span>297-25-75</div>
                        <a href="" class="js">Заказать звонок</a>
                    </div>
                    <div class="search">
                        <form action="{shop_url('search')}" method="get">
                            <div class="text_field"><input type="text" name="text" /></div>
                            <div class="button"><input type="submit" value="Найти" /></div>
                        </form>
                    </div>
                </div>
                <div class="cart">
                    <div class="title">Моя корзина</div>
                    <div class="info">12 товаров на <span>1230 грн.</span></div>
                    <div class="button_y"><a href="#">Оформить заказ</a></div>
                </div>
            </div>
            <div class="main_menu">
                <ul>
                    <li class="m_m_1"><a href="#">Туризм и отдых</a>
                        <ul>
                            <li><a href="#">Туристическое снаряжение</a>
                                <ul>
                                    <li><a href="#">Палатки</a></li>
                                    <li><a href="#">Пикниковые наборы и корзины</a></li>
                                    <li><a href="#">Полезные мелочи</a></li>
                                    <li><a href="#">Спальные мешки</a></li>
                                    <li><a href="#">Сумки туристические</a></li>
                                    <li><a href="#">Коврики</a></li>
                                    <li><a href="#">Туристическая мебель</a></li>
                                    <li><a href="#">Рюкзаки</a></li>
                                    <li><a href="#">Туристическая посуда</a></li>
                                    <li><a href="#">Фонари и светильники туристические</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Товары для отдыха</a>
                                <ul>
                                    <li><a href="#">Бассейны</a>
                                        <ul>
                                            <li><a href="#">Бассейны каркасные</a></li>
                                            <li><a href="#">Бассейны надувные</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Надувные изделия</a>
                                        <ul>
                                            <li><a href="#">Круги, нарукавники</a></li>
                                            <li><a href="#">Надувные лодки</a></li>
                                            <li><a href="#">Надувные матрасы</a></li>
                                            <li><a href="#">Насосы</a></li>
                                            <li><a href="#">Игры</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Брелки</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="m_m_2"><a href="#">Игровые виды спорта</a>
                        <ul>
                            <li><a href="#">Футбол</a>
                                <ul>
                                    <li><a href="#">Щитки и перчатки</a></li>
                                    <li><a href="#">Мячи футбольные</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Баскетбол</a>
                                <a href="#">Волейбол</a>
                                <a href="#">Гандбол, регби</a>
                            </li>                     
                        </ul>
                    </li>
                    <li class="m_m_3"><a href="#">Плавание и дайвинг</a>
                        <ul>
                            <li>
                                <a href="">Ласты для плавания, маски, трубки</a>
                                <a href="">Очки для плавания</a>
                                <a href="">Шапочки для плавания</a>
                                <a href="">Аксессуары для плавания</a>
                            </li>
                        </ul>
                    </li>
                    <li class="m_m_4"><a href="#">Атлетика и физкультура</a>
                        <ul>
                            <li>
                                <a href="">Гантели</a>
                                <a href="">Фитнес</a>
                                <ul>
                                    <li><a href="">Гимнастические мячи</a></li>
                                    <li><a href="">Эспандеры</a></li>
                                    <li><a href="">Аксессуары</a></li>
                                    <li><a href="">Наборы</a></li>
                                    <li><a href="">Шорты для похудения</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="m_m_5"><a href="#">Ракетковые виды спорта</a>
                        <ul>
                            <li>
                                <a href="">Настольный теннис</a>
                                <ul>
                                    <li><a href="">Мячики</a></li>
                                    <li><a href="">Наборы</a></li>
                                    <li><a href="">Ракетки</a></li>
                                    <li><a href="">Теннисные столы и сетки</a></li>
                                    <li><a href="">Чехлы и сумки</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="">Бадминтон</a>
                                <ul>
                                    <li><a href="">Ракетки</a></li>
                                    <li><a href="">Воланы</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="">Теннис</a>
                                <ul>
                                    <li><a href="">Ракетки</a></li>
                                    <li><a href="">Мячи</a></li>
                                    <li><a href="">Акссесуары</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="m_m_6"><a href="#">Зимние виды спорта</a>
                        <ul>
                            <li>
                                <a href="">Коньки</a>
                                <a href="">Клюшки</a>
                                <a href="">Лыжи</a>
                                <a href="">Санки</a>
                            </li>
                        </ul>
                    </li>
                    <li class="m_m_7"><a href="#">Бокс и боевые искусства</a>
                        <ul>
                            <li>
                                <a href="">Перчатки тренировочные</a>
                                <a href="">Мешки и груши</a>
                                <a href="">Шлемы и защита</a>
                                <a href="">Перчатки боксёрские</a>
                            </li>
                        </ul>
                    </li>
                    <li class="m_m_8"><a href="#">Оборудование для спотзалов</a>
                        <ul>
                            <li>
                                <a href="">Атлетические, шведские стенки, детские уголки</a>
                                <a href="">Силовые тренажеры</a>
                                <a href="">Кардиотренажеры</a>
                                <a href="">Турники</a>
                            </li>
                        </ul>
                    </li>
                    <li class="m_m_9"><a href="#">Художественная гимнастика</a>
                        <ul>
                            <li>
                                <a href="">Булавы</a>
                                <a href="">Ленточки</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="shares">
                <div class="prev"></div>
                <div class="next"></div>
                <div class="carusel">
                    <ul>
                        <li><a href="#"><img src="{$SHOP_THEME}images/temp/slide_1.jpg" alt="" /></a></li>
                        <li><a href="#"><img src="{$SHOP_THEME}images/temp/slide_2.jpg" alt="" /></a></li>
                        <li><a href="#"><img src="{$SHOP_THEME}images/temp/slide_3.jpg" alt="" /></a></li>
                    </ul>
                </div>
            </div>
            <div class="main_wrap global_catalog">
                {$shop_content}
            </div>
        </div>
        <div class="bottom_info">
            <div class="t"></div>
            <div class="b"></div>
            <div class="container">
                <div class="title">Отзывы</div>
                <div class="info_box">
                    <span><a href="#"><img src="{$SHOP_THEME}images/temp/comment_item_1.jpg"  /></a></span>
                    <dl>
                        <dt><a href="#">Палатка туристическая Easy Camp COMET 200</a></dt>
                        <dd><p>Народ підскажіть будь-ласка двохмісну палатку яку можна сміло брати в Карпати,що… </p></dd>
                    </dl>
                </div>
                <div class="info_box">
                    <span><a href="#"><img src="vimages/temp/comment_item_2.jpg"  /></a></span>
                    <dl>
                        <dt><a href="#">Палатка туристическая Easy Camp COMET 200</a></dt>
                        <dd><p>Народ підскажіть будь-ласка двохмісну палатку яку можна сміло брати в Карпати,що…</p></dd>
                    </dl>
                </div>
                <div class="info_box">
                    <span><a href="#"><img src="{$SHOP_THEME}images/temp/comment_item_1.jpg"  /></a></span>
                    <dl>
                        <dt><a href="#">Палатка туристическая Easy Camp COMET 200</a></dt>
                        <dd><p>Народ підскажіть будь-ласка двохмісну палатку яку можна сміло брати в Карпати,що…</p></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="container">
                <div class="f_left">
                    <div class="footer_menu">
                        <a href="#">Главная</a>
                        <a href="#">О нас</a>
                        <a href="#">Оплата</a>
                        <a href="#">Доставка</a>
                        <a href="#">Акции</a>
                        <a href="#">Контакты</a>
                    </div>
                    <div class="social_networks">
                        social networks
                    </div>
                </div>
                <div class="f_right">
                    <span><img src="{$SHOP_THEME}images/siteimage.png" alt="" /><a href="#">Раскрутка сайта</a>, создание интернет магазинов</span>
                    <span><a href="#">Оптовая торговля спортивным и туристическим снаряжением</a></span>
                    <span>79040 Украина, г. Львов, ул. Городоцкая, 357</span>
                </div>
            </div>
        </div>
    </body>
</html>
