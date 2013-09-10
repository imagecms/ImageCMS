{if !$succes}
    {if $reg_errors}
        <div class="control-group">
            <div class="msg">
                <div class="error">
                    {$reg_errors}
                </div>
            </div>
        </div>
    {/if}
    <label class="control-group" for="reg_name">
        <span class="control-label">{lang('Имя','newLevel')}</span>
        <span class="controls">
            <span class="icon_input-person"></span>
            <input id="reg_name" type="text" class="required" maxlength="30" name="username" value="{$_POST['username']}" />
        </span>
    </label>
    <label class="control-group" for="reg_email">
        <span class="control-label">E-mail</span>
        <span class="controls">
            <span class="icon_input-email"></span>
            <input id="reg_email" type="text" class="required email" maxlength="30" name="email" value="{$_POST['email']}" />
        </span>
    </label>
    <label class="control-group" for="reg_pswd">
        <span class="control-label">{lang('Пароль','newLevel')}</span>
        <span class="controls">
            <span class="icon_input-pswd"></span>
            <input id="reg_pswd" type="password" class="required" maxlength="30" name="password" />
        </span>
    </label>
    <label class="control-group" for="reg_rptpswd">
        <span class="control-label">{lang('Повторите','newLevel')}</span>
        <span class="controls">
            <span class="icon_input-rpt-pswd"></span>
            <input id="reg_rptpswd" type="password" class="required" size="30" name="confirm_password" />
        </span>
    </label>
    <div class="control-group">
        <span class="control-label">&nbsp;</span>
        <span class="controls c_n">
            <span class="btn-drop">
                <input type="submit" value="{lang('Зарегистрироваться','newLevel')}"/>
            </span>
        </span>
    </div>
{else:}
    <div class="control-group">
        <div class="msg">
            <div class="notice">
                <h3>{lang('Регистрация прошла успешно!','newLevel')}</h3>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        redirect_to('{shop_url('profile')}');
    </script>
{/if}