
<div class="mainBody">
    <section class="container">
        <div class="row">
            <div class="span3">

                {load_menu('left_menu')}
            </div>
            <div class="span6">
                <div class="text">
                    <h1>{$category[name]}</h1>
                    {foreach $pages as $p}
                        <h2>
                            <a href="{site_url($p['full_url'])}">
                                {$p['title']}
                            </a>
                        </h2>
                        <p>{$p['prev_text']}</p>
                    {/foreach}
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
