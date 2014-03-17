{#
/**
* @file template for displaying login page
*/
#}

<!-- Adds meta tag for this page -->
{$this->registerMeta("ROBOTS", "NOINDEX, NOFOLLOW")}
<article class="container">
    <div class="t-a_c">
        <div class="row d_i-b t-a_l">
            <div class="span6">
                <label>
                    <span class="frame_form_field__icsi-css">
                        <div class="msg">
                            <div class="error">
                                {lang('Mistake, maybe the email is already in use', 'socauth')}.<br>
                                {lang('Try to use a different method to enter.', 'socauth')}
                            </div>
                        </div>
                    </span>
                </label>
                <div class="frameGroupsForm">
                    <div class="header_title">
                        {lang('Login page', 'socauth')}
                    </div>
                    <div class="inside_padd span9">
                        <div class="horizontal_form standart_form">
                            <!-- login form -->
                            <form method="post" id="login_form" onsubmit="ImageCMSApi.formAction('/auth/authapi/login', 'login_form');
                                    return false;">
                                <label>
                                    <span class="title">{lang('Email', 'socauth')}</span>
                                    <span class="frame_form_field">
                                        <span class="icon-email"></span>
                                        <!-- input for email -->
                                        <input value="{lang('Enter your login', 'socauth')}" type="text" name="email" onfocus="if (this.value == '{lang('Enter your login', 'socauth')}')
                                        this.value = '';" onblur="if (this.value == '')
                                        this.value = '{lang('Enter your login', 'socauth')}';"/>
                                        <!-- validation error container -->
                                        <label id="for_email" class="for_validations"></label>
                                    </span>
                                </label>
                                <label>
                                    <span class="title">{lang('Password', 'socauth')}</span>
                                    <span class="frame_form_field">
                                        <span class="icon-password"></span>
                                        <!-- input for password -->
                                        <input type="password" name="password" value="{lang('Password', 'socauth')}" onfocus="if (this.value == '{lang('Password', 'socauth')}')
                                        this.value = '';" onblur="if (this.value == '')
                                        this.value = '{lang('Password', 'socauth')}';"/>
                                        <!-- validation error container -->
                                        <label id="for_password" class="for_validations"></label>
                                    </span>
                                </label>
                                <!-- captcha block -->
                                <lable id="captcha_block">
                                    {if $cap_image}
                                        <span class="title">{lang('Code protection', 'socauth')}</span>
                                        <span class="frame_form_field">
                                            {if $captcha_type == 'captcha'}
                                                <input type="text" name="captcha" value="{lang('Code protection', 'socauth')}" onfocus="if (this.value == '{lang('Code protection', 'socauth')}')
                                        this.value = '';" onblur="if (this.value == '')
                                        this.value = '{lang('Code protection', 'socauth')}';"/>
                                                <span class="help_inline">{$cap_image}</span>
                                                <label id="for_captcha" class="for_validations"></label>
                                            {/if}
                                        </span>
                                    {/if}
                                </lable>
                                <label>
                                    <span class="title">{lang('Remember me', 'socauth')}</span>
                                    <span class="frame_form_field">
                                        <!--input for remember me option-->
                                        <input type="checkbox" name="remember" value="1" id="remember" class="d_i v-a_b"/>
                                    </span>
                                </label>
                                <div class="frameLabel">
                                    <span class="title">&nbsp;</span>
                                    <span class="frame_form_field c_n">
                                        <!--forgot password link-->
                                        <a href="/auth/forgot_password" class="d_i v-a_m neigh_btn m-r_45">{lang('Forgot password', 'socauth')}</a>
                                        <!--registration link-->
                                        <a href="{site_url($modules.auth . '/register')}" class="d_i v-a_m neigh_btn m-r_45">{lang('Registration', 'socauth')}</a>
                                        <!--submit button-->
                                        <input type="submit" value="{lang('Enter', 'socauth')}" class="btn btn_cart f_r" />
                                
                                    </span>
                                </div>
                                {$CI->load->module('socauth')->renderLogin()}
                                <!--security token-->
                                {form_csrf()}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
