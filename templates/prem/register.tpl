<script>
    document.body.className += ' register';
</script>
{literal}
    <style>
        .menu-header, .right-header, footer, .h-footer{display: none;}
        header .container{overflow: hidden;}
        header{height: 64px;}
        .logo{margin: 17px auto;float: none;display: block;}
    </style>
{/literal}
<div class="frame-inside page-register">
    <div class="container">
        <div class="frame-register">
            <div class="f-s_0 title-register">
                <div class="frame-title">
                    <h1 class="title">{lang('Ваш магазин почти создан','newLevel')}</h1>
                </div>
            </div>
            <form method="post" id="register-form">
                <div class="vertical-form inside-padd">
                    <label class="form-create-shop2">
                        <input type="text" placeholder="{lang('Название магазина', 'newLevel')}" autofocus/>
                        <span class="addon d_i-b">
                            .premmerce.com
                        </span>
                    </label>
                    <div class="help-block">
                        {lang('Вы всегда можете изменить домен позже', 'newLevel')}
                    </div>
                    <div class="clearfix">
                        <div class="column-1">
                            <label>
                                <input type="text" value="" placeholder="{lang('E-mail','newLevel')}"/>
                            </label>
                            <label>
                                <input type="text" value="" placeholder="{lang('Ваше имя', 'newLevel')}"/>
                            </label>
                            <div class="frame-label">
                                <div class="lineForm">
                                    <select id="id1" name="">
                                        <option value="">{lang('Страна', 'newLevel')}</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="frame-label">
                                <div class="lineForm">
                                    <select id="id2" name="">
                                        <option value="">{lang('Категория товаров', 'newLevel')}</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="column-2">
                            <label>
                                <input type="password" value="" placeholder="{lang('Пароль','newLevel')}"/>
                            </label>
                            <label>
                                <input type="text" value="" placeholder="{lang('Телефон', 'newLevel')}"/>
                            </label>
                            <label>
                                <input type="text" value="" placeholder="{lang('Город', 'newLevel')}"/>
                            </label>
                            <div class="frame-label">
                                <div class="lineForm">
                                    <select id="id3" name="">
                                        <option value="">{lang('Уровень пользования', 'newLevel')}</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="frame-apply-terms f-s_0">
                        <input type="checkbox" value="0"/>
                        <span class="text-el">{lang('Я соглашаюсь с', 'newLevel')}</span> <a href="#">{lang('условиями работы', 'newLevel')}</a>
                    </div>
                    <div class="btn-create-shop2">
                        <button type="submit">
                            <span class="text-el">{lang('Создать магазин сейчас', 'newLevel')}</span>
                        </button>
                    </div>
                    <input type="hidden" name="refresh" value="false"/>
                    <input type="hidden" name="redirect" value="{shop_url('profile')}"/>
                    {form_csrf()}
                </div>
            </form>
        </div>
    </div>
</div>
<div class="frame-ask-questions" style="background-color: #fff;">
    <div class="container">
        <div class="title-h1">{lang('Есть вопросы?', 'newLevel')}</div>
        <div class="sub-title">{lang('Мы серьезно относимся к поддержке. Каждый план включает в себя специальный партнера по команде Involvio, кто здесь, чтобы обеспечить ваш успех круглосуточно.', 'newLevel')}</div>
        <div class="group-buttons f-s_0">
            <a href="#" class="btn-default">
                <span class="icon-mail"></span>
                <span class="text-el">{lang('Написать на E-mail', 'newLevel')}</span>
            </a>
            <a href="#" class="btn-default">
                <span class="icon-phone"></span>
                <span class="text-el">{lang('Мы перезвоним', 'newLevel')}</span>
            </a>
        </div>
    </div>
</div>
<script type="text/javascript" src="{$THEME}js/cusel-min-2.5.js"></script>