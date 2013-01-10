{literal}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.h_contacts a, .auth_menu a, .auth_links a').fancybox();
            $('#login_form').validate({
                rules: {password: {required: true,minlength: 3}},
                submitHandler: function(){
                    $.fancybox.showActivity();
                    $.ajax({type: "POST",data: $("#login_form").serialize(),url: "/auth",success: function(data) {$.fancybox(data);}});
                    return false;
                }
            });
        });
    </script>
{/literal}



{if $content == 1}
    <div class="fancy_info text">
        <p>Вы успешно вошли в систему</p>
        <script type="text/javascript">
            setTimeout("window.location = ''", 2000);
        </script>
    </div>
{elseif $content == 2}
    <div class="fancy_info text">
        <p>Вы авторизированны</p>
    </div>
{else:}
    <div class="products_list" id="collback_form">
        <h1>Вход для клиентов</h1>

        <form action="" method="post" class="new_user commentForm callback_form" id="login_form">
            <dl>
                <dt>Имя пользователя<span>*</span></dt>
                <dd><input type="text" name="username" class="required" value="" /></dd>
            </dl>
            <dl>
                <dt>Пароль<span>*</span></dt>
                <dd><input type="password" name="password" value="" /></dd>
            </dl>
            {if validation_errors() OR $info_message}
                <div class="errors"> 
                    {validation_errors()}
                    {$info_message}
                </div>
            {/if}

            <div class="button"><input type="submit" value="Войти" /></div>


            {form_csrf()}
            <div class="auth_links">
                <a href="{site_url($modules.auth . '/forgot_password')}">{lang('lang_forgot_password')}</a>
                &nbsp;
                <a href="{site_url($modules.auth . '/register')}">{lang('lang_register')}</a>                          
            </div>
        </form>
    </div>
{/if}