{$this->registerMeta("ROBOTS","NOINDEX, NOFOLLOW")}
<article class="container">
    <div class="t-a_c">
        <div class="row d_i-b t-a_l">
            <div class="span6">
                <div class="frameGroupsForm">
                    <div class="header_title">
                        {lang('lang_login_page')}
                    </div>
                    <div class="inside_padd">
                        <div class="horizontal_form standart_form">
                            <!-- login form -->
                            <form action="/socauth/vk" method="POST">
                                <label>
                                    <span class="title">{lang('Email')}</span>
                                    <span class="frame_form_field">
                                        <span class="icon-email"></span>
                                        <!-- input for email -->
                                        <input value="Введите Ваш Email" type="text" name="email" onfocus="if (this.value == 'Введите Ваш Email')
                                                    this.value = '';" onblur="if (this.value == '')
                                                    this.value = 'Введите Ваш Email';"/>
                                        <!-- validation error container -->
                                        <label id="for_email" class="for_validations"></label>
                                    </span>
                                </label>
                                <div class="frameLabel">
                                    <span class="title">&nbsp;</span>
                                    <span class="frame_form_field c_n">
                                        <input type="submit" value="Войти" class="btn btn_cart f_r" />
                                    </span>
                                </div>
                                <input type="hidden" name="name" value="{echo $data->first_name . ' ' . $data->last_name}">
                                <input type="hidden" name="uid" value="{echo $data->uid}">
                                {form_csrf()}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
