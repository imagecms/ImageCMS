{$this->registerMeta("ROBOTS","NOINDEX, NOFOLLOW")}
<article class="container">
    <div class="t-a_c">
        <div class="row d_i-b t-a_l">
            <div class="span6">
                <div class="frameGroupsForm">
                    <div class="header_title">
                        {lang('Login page', 'socauth')}
                    </div>
                    <div class="inside_padd span9">
                        <div class="horizontal_form standart_form">
                            <!-- login form -->
                            <form action="/socauth/vk" method="POST">
                                <label>
                                    <span class="title">{lang('Email', 'socauth')}</span>
                                    <span class="frame_form_field">
                                        <span class="icon-email"></span>
                                        <!-- input for email -->
                                        <input value="{lang('Enter your email', 'socauth')}" type="text" name="email" onfocus="if (this.value == '{lang('Enter your email', 'socauth')}')
                                                    this.value = '';" onblur="if (this.value == '')
                                                    this.value = '{lang('Enter your email', 'socauth')}';"/>
                                        <!-- validation error container -->
                                        <label id="for_email" class="for_validations"></label>
                                    </span>
                                </label>
                                <div class="frameLabel">
                                    <span class="title">&nbsp;</span>
                                    <span class="frame_form_field c_n">
                                        <input type="submit" value="{lang('Enter', 'socauth')}" class="btn btn_cart f_r" />
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
