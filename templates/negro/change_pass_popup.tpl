{if $errors}
    <div class="msg">
        <div class="error">
            {$errors}
        </div>
    </div>
{elseif $msg_success}
    <div class="msg">            
        <div class="notice">
            {$msg_success}
        </div>
    </div>
{/if}

<label class="control-group">
    <span class="control-label">Старый пароль</span>
    <span class="controls">
        <input type="password" class="required" name="old_password" maxlength="25" id="crpswd"/>
    </span>
</label>
<label class="control-group">
    <span class="control-label">Пароль</span>
    <span class="controls">
        <input type="password" class="required" name="new_password" maxlength="25" id="rpnwpswd"/>
    </span>
</label>
<label class="control-group">
    <span class="control-label">Повторите пароль</span>
    <span class="controls">
        <input type="password" class="required" name="confirm_new_password" maxlength="25" id="rpnwpswd"/>
    </span>
</label>
<div class="control-group">
    <span class="control-label">&nbsp;</span>
    <span class="controls">
        <span class="btn btn-order-product">
            <input type="submit" value="Сохранить данные"/>
        </span>
    </span>
</div>