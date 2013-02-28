{load_menu('footer_menu')}

<div class="mainBody">
    <section class="container">
        <div class="row">
            <div class="span3">
                <nav class="navStaticPages b-r_5">
                    <ul class="nav navVertical">
                        {foreach $category['fetch_pages'] as $cats}
                            <li>
                                <a href="#">
                                    <span class="icon-arrow-stPg"></span>
                                    <span class="text-el">{echo $CI->db->select('name')->get_where('category',array('id' => $cats))->row()->name}</span>
                                </a>
                                <ul>

                                    {foreach $CI->db->get_where('content', array('category' => $cats))->result_array() as $c}
                                        <li><a href="#">Новости компании</a></li>

                                    {/foreach}
                                    <li><a href="#">История компании</a></li>
                                    <li><a href="#">Акции компании</a></li>
                                    <li><a href="#">Спецпредложения</a></li>
                                    <li><a href="#">Услуги</a></li>
                                    <li><a href="#">Аукционы</a></li>
                                    <li><a href="#">А также</a></li>
                                </ul>
                            </li>
                        {/foreach}
                    </ul>
                </nav>
            </div>
            <div class="span6">
                <div class="text">
                    {var_dump($category['fetch_pages'])}
                    <h1>Новости</h1>
                    <h2>Заголовок 2 уровень</h2>
                    <h3>Заголовок 3 уровень</h3>
                    <p>Ноутбук HP 635 имеет изящный узнаваемый дизайн — гладкая матовая поверхность голубовато-серого цвета придает ему неповторимый внешний вид.</p>
                    <h3>Восстановление системы</h3>
                    <p>Предварительно установленное приложение HP Recovery Manager позволяет быстро восстановить операционную систему в случае, если она повреждена, и продолжить работу.CMS система – это полноценный программный комплекс для создания и управления сайтом любого уровня сложности.Клиентами компании становятся разработчики, которые ищут удобную и простую CMS, способную решить всю техническую сторону процесса создания веб-продукции, оставляя разработчику только организационный аспект. Это особенно важно для тех, кто не желает тратить время и усилия на дополнительное обучение сотрудников Интернет-магазина.</p>
                    <p>
                        <img src="images/temp/TEXT.png" class="f_l"/>
                        Многофункциональный движок Интернет-магазина ImageCMS Shop Pro и ImageCMS Shop Premium имеет открытый исходный код: создавайте сайт, наполняйте его продукцией и зарабатывайте деньги!
                        Это особенно важно для тех, кто не желает тратить время и усилия на дополнительное обучение сотрудников Интернет-магазина.<br/>
                        Многофункциональный движок Интернет-магазина ImageCMS Shop Pro и ImageCMS Shop Premium имеет открытый исходный код: создавайте сайт, наполняйте его продукцией и зарабатывайте деньги!
                        Многофункциональный движок Интернет-магазина ImageCMS Shop Pro и ImageCMS Shop Premium имеет открытый исходный код: создавайте сайт, наполняйте его продукцией и зарабатывайте деньги!
                        Это особенно важно для тех, кто не желает тратить время и усилия на дополнительное обучение сотрудников Интернет-магазина.
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="headerFon"></div>
<div class="drop-enter drop">
    <div class="icon-times-enter" data-closed="closed-js"></div>
    <div class="drop-content">
        <div class="header_title">
            Вход для клиентов
        </div>
        <div class="inside_padd">
            <div class="horizontal_form standart_form">
                <form method="post">
                    <label>
                        <span class="title">E-mail</span>
                        <span class="frame_form_field">
                            <span class="icon-email"></span>
                            <input type="text"/>
                        </span>
                    </label>
                    <label>
                        <span class="title">Пароль</span>
                        <span class="frame_form_field">
                            <span class="icon-password"></span>
                            <input type="password"/>
                        </span>
                    </label>
                    <div class="frameLabel">
                        <span class="title">&nbsp;</span>
                        <span class="frame_form_field c_n">
                            <a href="#" class="f_l neigh_btn">Забыли пароль?</a>
                            <input type="submit" value="Войти" class="btn btn_cart f_r"/>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>
<div class="drop-order-call drop" id="a">
    <div class="icon-times-enter" data-closed="closed-js"></div>
    <div class="drop-content">
        <div class="header_title">
            Заказ звонка
        </div>
        <div class="inside_padd">
            <div class="horizontal_form standart_form">
                <form method="post">
                    <label>
                        <span class="title">Ваше имя</span>
                        <span class="frame_form_field">
                            <span class="icon-person"></span>
                            <input type="text"/>
                        </span>
                    </label>
                    <label>
                        <span class="title">Номер телефона</span>
                        <span class="frame_form_field">
                            <span class="icon-phone"></span>
                            <input type="text"/>
                        </span>
                    </label>
                    <label>
                        <span class="title">Примерное время</span>
                        <span class="frame_form_field">
                            <input type="text"/>
                            <span class="icon-clock"></span>
                        </span>
                    </label>
                    <label>
                        <span class="title">Комментарий</span>
                        <span class="frame_form_field">
                            <textarea></textarea>
                        </span>
                    </label>
                    <div class="frameLabel">
                        <span class="title">&nbsp;</span>
                        <span class="frame_form_field c_n">
                            <input type="submit" value="Позвоните мне" class="btn btn_cart f_r"/>
                        </span>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="drop-footer"></div>
</div>
<div class="drop drop-report">
    <div class="drop-content">
        <div class="title_h2">Сообщить когда появится</div>
        <div class="icon-times-enter" data-closed="closed-js"></div>
    </div>
    <div class="drop-footer"></div>
</div>
<div class="d_n" data-clone="data-report">
    <form method="post" action="#">
        <div class="standart_form">
            <label>
                <span class="title">E-mail</span>
                <span class="frame_form_field">
                    <input type="text" id="email"/>
                    <span class="must">*</span>
                    <span class="help_inline">На почту придет уведомление о появлении данного товара</span>
                </span>
            </label>
        </div>
        <div class="t-a_r">
            <input type="submit" value="Отправить" class="btn btn_cart"/>
        </div>
    </form>
</div>
<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/jquery.cycle.all.js" type="text/javascript"></script>
<script src="js/jquery.jcarousel.min.js" type="text/javascript"></script>
<script src="js/jquery.imagecms.js" type="text/javascript"></script>
<script src="js/scripts.js" type="text/javascript"></script>
