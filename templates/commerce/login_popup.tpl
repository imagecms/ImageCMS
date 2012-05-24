{literal}

    <script type="text/javascript">
     $('#enter').validate({
                submitHandler: function(){
                        $.fancybox.showActivity();
                        $.ajax({
                            type: "POST",
                            data: $("#enter").serialize(),
                            url: "/auth/login",
                            success: function(data) {
                                $.fancybox.close();
                            }
                        });
                        return false;
                },
                rules: {
                    password: {
                        minlength: 5,
                        required: true

                    },
                    confirm_password: {
                        equalTo: "#password"
                    },
                    username:{required: true}
                }
            });
       $('#reg').validate({
           submitHandler: function(){
               $fancybox.showActivity();
                   $ajax({
                       type: "POST",
                       data: $("#reg").serialize(),
                       url: "/auth/register",
                       success: function(data){
                       fancybox.close();
                       }
                   });
                   return false;
           },
           rules: {
                
                 password: {required: true, minlength: 5},
                 confirm_password: {required: true, minlength: 5, equalTo: "#passwordreg"}
                
                 
           }
               });
                                                               
    </script>
{/literal}
<div class="fancy enter_reg">
    <ul>
        <li class="enter"><a href="#enter">Вход</a></li> 
        <li class="reg"><a href="#reg">Регистрация</a></li> 
    </ul>
    <form method="post" action="{site_url('auth/login')}" id="enter">
        <label>
            Электронная почта
            <input type="text" name="usernamerrr"/>
        </label>
        <label>
            Пароль
            <input type="password" id="password" name="password"/>
        </label>
        <div class="p-t_19 clearfix">
            <a href="#" class="button_middle_blue_neigh f_l">
                Забыли пароль?
            </a>
            <div class="f_r buttons button_middle_blue">
                <input type="submit" value="Войти">
            </div>
        </div>
        {form_csrf()}
    </form>
<!--    <form method="post" action="{site_url('auth/register')}" id="reg">
    
    <label>
        ФИО
        <input type="text" name="userInfo[fullName]"/>
                
    </label>
    <label>
        Электронный адрес
        <input type="text" name="username"/>
    </label>
    <label>
        Пароль
        <input type="password" id="passwordreg" name="password"/>
    </label>
    <label>
        Повторите пароль
        <input type="password" name="confirm_password" id="confirm_password"/>
    </label>
    <label>
        Телефон
        <input type="text"/>
    </label>-->
    <form method="post" action="{site_url('auth/register')}" id="reg">
        <label>{lang('lang_login')}
            <input type="text" name="username" id="username" />
        </label>
        <label>ФИО
           <input type="text" name="userInfo[fullName]" value="{set_value('userInfo[fullName]')}" />
        </label>
        <label>{lang('lang_email')}
            <input type="text" name="email" id="email" value="{set_value('email')}" />
        </label>
        <label>{lang('lang_password')}
            <input type="password" name="password" id="passwordreg" />
        </label>
        <label>{lang('lang_confirm_password')}
            <input type="password" name="confirm_password" id="confirm_password" />
        </label>
        {if $cap_image}
            <div class="comment_form_info">
                <div class="textbox captcha">
                    <input type="text" name="captcha" id="captcha" value="Код протекции" onfocus="if(this.value=='Код протекции') this.value='';" onblur="if(this.value=='') this.value='Код протекции';"/>
                </div>
                {$cap_image}
            </div>
        {/if}
        <div class="p-t_19 t-a_c">
            <div class="buttons button_middle_blue">
                <input type="submit" value="Зарегистрироваться">
            </div>
        </div>
        {form_csrf()}
    </form>
</div>