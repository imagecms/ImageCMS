


<div class="frame-inside">
    <div class="container">
        <h1>Регистрация</h1>
        {if validation_errors() OR $info_message}
            <div class="errors"> 
                {validation_errors()}
                {$info_message}
            </div>
        {/if}
        <div class="clearfix item-product">
            <div class="left-personal">
                <div class="frame-tabs-ref">    
                    <div id="first">
                        <div class="clearfix">
                            <form action="" method="post" id="registr">
                                <div class="vertical-form f_l f-s_13">
                                    <label class="control-group">
                                        <span class="control-label">Почта:</span>
                                        <span class="controls">
                                            <input type="text"  name="email" value="{set_value('email')}" />
                                        </span>
                                    </label>
                                    <label class="control-group">
                                        <span class="control-label">Фио:</span>
                                        <span class="controls">
                                            <input type="text"  name="username"  value="{set_value('username')}"/>
                                        </span>
                                    </label>
                                    <label class="control-group">
                                        <span class="control-label">Пароль</span>
                                        <span class="controls">
                                            <input type="password" name="password" value="{set_value('password')}" />
                                        </span>
                                    </label>
                                    <label class="control-group">
                                        <span class="control-label">Повторите пароль</span>
                                        <span class="controls">
                                            <input type="password" class="text" name="confirm_password"  />
                                        </span>
                                    </label>
                                    <div class="control-group">
                                        <div class="btn btn-link-ref">
                                            <a onclick="$('#registr').submit();
                                                        return false"href="#">Зарегистрироваться</a>
                                        </div>
                                        <div class="helper-group">
                                            <ul>
                                                <li><a href="{site_url($modules.auth . '/forgot_password')}">Забыли пароль?</a></li>
                                                <li><a href="{site_url('auth/login')}">Вход</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                {form_csrf()}
                            </form>
                        </div>
                    </div>                                               
                </div>
            </div>
        </div>
    </div>
</div>

