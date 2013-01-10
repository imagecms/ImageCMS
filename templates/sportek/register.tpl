{literal}
<script type="text/javascript">
    $(document).ready(function() {        
        $('.h_contacts a, .auth_menu a, .auth_links a').fancybox();
        $('#registr_form').validate({
            submitHandler: function(){
                    $.fancybox.showActivity();
                    $.ajax({
                        type: "POST",
                        data: $("#registr_form").serialize(),
                        url: "/auth/register",
                        success: function(data) {
                            $.fancybox(data);
                        }
                    });
                    return false;
            },
            rules: {
                password: {minlength: 6},
                confirm_password: {equalTo: "#password"},
                wtf: {required: true}
	    }
        });
    });
</script>
{/literal}

{if validation_errors() OR $info_message}
    <div class="errors"> 
        {validation_errors()}
        {$info_message}
    </div>
{/if}

{if $content == 1}
<div class="fancy_info text">
    <div class="h1title">Спасибо за регистрацию</div>
</div>
{elseif $content == 2}
<div class="fancy_info text">
    <p>Вы авторизированны</p>
</div>
{else:}
<div class="products_list nopadTop" id="collback_form">
    <h1>Регистрация</h1>

    <form action="" method="post" class="new_user commentForm callback_form" id="registr_form">
        <dl>
            <dt>Имя пользователя<span>*</span></dt>
            <dd><input type="text" name="username" class="required" value="{$_POST['username']}" /></dd>
        </dl>
        <dl>
            <dt>E-mail<span>*</span></dt>
            <dd><input type="text" name="email" class="required email" value="{$_POST['email']}" /></dd>
        </dl>
        <dl>
            <dt>Пароль<span>*</span></dt>
            <dd><input type="password" name="password" class="required" id="password" value="" /></dd>
        </dl>
        <dl>
            <dt>Подтверждение пароля<span>*</span></dt>
            <dd><input type="password" name="confirm_password" class="required" value="" /></dd>
        </dl>
        <dl>
            <dt><input type="checkbox" name="wtf" id="wtf" value="" /><label for="wtf">Даю согласие на использование моих личных данных, оставленных на этом сайте, в информационной системе магазина, построенной на основе документированных програмно-технических решений</label></dt>
        </dl>
        <div class="button">
            <input type="submit" value="Зарегистрироваться" />
        </div>
        {form_csrf()}
    <div class="auth_links">
        <a href="{site_url($modules.auth . '/forgot_password')}">{lang('lang_forgot_password')}</a>
        &nbsp;
        <a href="{site_url('auth/login')}">Вход</a>                          
    </div>
    </form>
</div>
{/if}