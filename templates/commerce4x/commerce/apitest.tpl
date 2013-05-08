<article>
    <div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
        <span typeof="v:Breadcrumb">
            <a href="#" rel="v:url" property="v:title">Главная</a>
        </span>/
        <span typeof="v:Breadcrumb">
            <span rel="v:url" property="v:title">Сравнение товаров</span>
        </span>
    </div>
    <div class="t-a_c">
        <div class="row d_i-b t-a_l">
            <div class="span6">
                <div class="frameGroupsForm">
                    <div class="header_title">Регистрация</div>
                    <div class="standart_form horizontal_form">
                        <form method="post" data-id="register_form">
                            <div class="groups_form">
                                <label>
                                    <span class="title">E-mail</span><br/>
                                    <span class="frame_form_field">
                                        <span class="icon-email"></span>
                                        <input type="text" name="email"/><br/>
                                        <span class="help_inline">E-mail являеться логином</span><br/>
                                    </span>
                                </label>
                                <label>
                                    <span class="title">Ваше имя</span><br/>
                                    <span class="frame_form_field">
                                        <span class="icon-person"></span>
                                        <input type="text" name="username"/><br/>
                                    </span>
                                </label>
                                <label>
                                    <span class="title">Пароль</span><br/>
                                    <span class="frame_form_field">
                                        <span class="icon-password"></span>
                                        <input type="password" name="password"/><br/>
                                        <span class="help_inline">От 6 до 24 символов. Должен включать латинские буквы и цифры.</span><br/>
                                    </span>
                                </label>
                                <label>
                                    <span class="title">Повторите пароль</span><br/>
                                    <span class="frame_form_field">
                                        <span class="icon-replay"></span>
                                        <input type="password" name="confirmpassword"/><br/>
                                    </span>
                                </label>
                                <div class="frameLabel c_t">
                                    <span class="title">&nbsp;</span>
                                    <span class="frame_form_field">
                                        <input type="button" value="Зарегистрироваться" onclick="ImageCMSApi.formAction('/auth/register', 'register_form');
                                                return false;"/>
                                        <input type="button" value="testbutton" onclick="ImageCMSApi.formAction('/auth/logout', '');return false;"/>
                                        <!--<input type="submit" class="btn btn_cart" value="Зарегистрироваться"/>-->
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
