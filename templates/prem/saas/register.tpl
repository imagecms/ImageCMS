<script>
    document.body.className += ' register';
</script>
{literal}
    <style>
        .menu-header, .right-header, footer, .h-footer{display: none;}
        header .container{overflow: hidden;}
        header{height: 64px;}
        .logo{margin: 17px auto;float: none;display: block;}

        .form_error {color:tomato}
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
                        <input type="text" name="domain" value="{echo isset($_POST['domain']) ? $_POST['domain'] : set_value('domain')}" placeholder="{lang('Название магазина', 'newLevel')}" autofocus/>
                        <span class="addon d_i-b">
                            .premmerce.com
                        </span>
                        {if form_error('domain')}
                            <span class='form_error'>{echo form_error('domain')}</span>
                        {/if}
                    </label>
                    <div class="help-block">
                        {lang('Вы всегда можете изменить домен позже', 'newLevel')}
                    </div>
                    <div class="clearfix">
                        <div class="column-1">
                            <label>
                                <input type="text" name="email" value="{echo set_value('email')}" placeholder="{lang('E-mail','newLevel')}"/>
                                {if form_error('email')}
                                    <span class='form_error'>{echo form_error('email')}</span>
                                {/if}
                            </label>
                            <label>
                                <input type="text" name="username" value="{echo set_value('username')}" placeholder="{lang('Ваше имя', 'newLevel')}"/>
                                {if form_error('username')}
                                    <span class='form_error'>{echo form_error('username')}</span>
                                {/if}
                            </label>
                            <div class="frame-label">
                                <div class="lineForm">
                                    <select id="id1" name="country_id">
                                        <option value="0">{lang('Страна', 'newLevel')}</option>
                                        {foreach $countries as $country}
                                            <option value="{echo $country->id}" {if $country->id == set_value('country_id')} selected="selected" {/if}>{echo $country->i18n->name}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                {if form_error('country_id')}
                                    <span class='form_error'>{echo form_error('country_id')}</span>
                                {/if}
                            </div>
                            <div class="frame-label">
                                <div class="lineForm">
                                    <select id="id2" name="products_category_id">
                                        <option value="0">{lang('Категория товаров', 'newLevel')}</option>
                                        {foreach $product_categories as $id => $prodCatName}
                                            <option value="{echo $id}" {if $id == set_value('products_category_id')} selected="selected" {/if}>{echo $prodCatName}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                {if form_error('products_category_id')}
                                    <span class='form_error'>{echo form_error('products_category_id')}</span>
                                {/if}
                            </div>
                        </div>
                        <div class="column-2">
                            <label>
                                <input type="password" name="password" value="{echo set_value('password')}" placeholder="{lang('Пароль','newLevel')}"/>
                                {if form_error('password')}
                                    <span class='form_error'>{echo form_error('password')}</span>
                                {/if}
                            </label>
                            <label>
                                <input type="text" name="phone" value="{echo set_value('phone')}" placeholder="{lang('Телефон', 'newLevel')}"/>
                                {if form_error('phone')}
                                    <span class='form_error'>{echo form_error('phone')}</span>
                                {/if}
                            </label>
                            <label>
                                <input type="text" name="city" value="{echo set_value('city')}" placeholder="{lang('Город', 'newLevel')}"/>
                                {if form_error('city')}
                                    <span class='form_error'>{echo form_error('city')}</span>
                                {/if}
                            </label>
                            <div class="frame-label">
                                <div class="lineForm">
                                    <select id="id3" name="level">
                                        <option value="0">{lang('Уровень пользования', 'newLevel')}</option>
                                        {foreach $levels as $id => $levelName}
                                            <option value="{echo $id}" {if $id == set_value('level')} selected="selected" {/if}>{echo $levelName}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                {if form_error('level')}
                                    <span class='form_error'>{echo form_error('level')}</span>
                                {/if}
                            </div>
                        </div>
                    </div>
                    <div class="frame-apply-terms f-s_0">
                        <input type="checkbox" name="license_agreement" {if 'on' == set_value('license_agreement')} checked="checked" {/if}/>
                        <span class="text-el">{lang('Я соглашаюсь с', 'newLevel')} </span> <a href="#">{lang('условиями работы', 'newLevel')}</a>
                        {if form_error('license_agreement')}
                            <span class='form_error'>{echo form_error('license_agreement')}</span>
                        {/if}
                    </div>
                    <div class="btn-create-shop2">
                        <button type="submit">
                            <span class="text-el">{lang('Создать магазин сейчас', 'newLevel')}</span>
                        </button>
                    </div>
                    {if isset($system_error)}
                        <br />
                        <br />
                        <div class="frame-apply-terms f-s_0">
                            <span class="form_error">{echo $system_error}</span>
                        </div>   
                    {/if}   
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