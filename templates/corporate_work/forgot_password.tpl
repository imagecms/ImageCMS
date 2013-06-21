


<div class="frame-inside">
    <div class="container">
        <h1>Напомнить пароль</h1>
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
                            <form action="" method="post" id="forgot">
                                <div class="vertical-form f_l f-s_13">
                                    <label class="control-group">
                                        <span class="control-label">Почта:</span>
                                        <span class="controls">
                                            <input type="text"  name="email" value="{set_value('email')}" />
                                        </span>
                                    </label>

                                    <div class="control-group">
                                        <div class="btn btn-link-ref">
                                            <a onclick="$('#forgot').submit();
                                                        return false"href="#">Напомнить</a>
                                        </div>
                                        <div class="helper-group">
                                            <ul>
                                                <li><a href="{site_url($modules.auth . '/')}">Вход</a></li>
                                                <li><a href="{site_url('auth/register')}">Регистрация</a></li>
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





