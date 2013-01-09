{literal}
<script type="text/javascript">
    $(document).ready(function() {
        $('.h_contacts a, .auth_menu a, .auth_links a').fancybox();
        $('#forget_pass').validate({
            submitHandler: function(){
                    $.fancybox.showActivity();
                    $.ajax({
                        type: "POST",
                        data: $("#forget_pass").serialize(),
                        url: "/auth/forgot_password",
                        success: function(data) {
                            $.fancybox(data);
                        }
                    });
                    return false;
            }
        });
    });
</script>
{/literal}

{if $success == 1}
<div class="fancy_info text">
    <p>Спасибо</p>
</div>
{else:}
<div class="products_list nopadTop" id="collback_form">
    <h1>Забыли пароль?</h1>
    
    {if validation_errors() OR $info_message}
        <div class="errors"> 
            {validation_errors()}
            {$info_message}
        </div>
    {/if}

    <form action="#" method="post" class="new_user commentForm callback_form" id="forget_pass">
        <dl>
            <dt>Email<span>*</span></dt>
            <dd><input type="text" name="login" class="required email" value="" /></dd>
        </dl>

        <div class="button"><input type="submit" value="Отправить" /></div>


        {form_csrf()}
    </form>
    <div class="auth_links">
        <a href="{site_url($modules.auth . '/auth')}">Вход</a>
        &nbsp;
        <a href="{site_url($modules.auth . '/register')}">Регистрация</a>                          
    </div>
</div>
{/if}
