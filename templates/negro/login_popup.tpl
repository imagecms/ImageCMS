{if $info_message || $errors}
    <div class="control-group">
        <div class="msg">
            <div class="error">
                {$info_message}
                {$errors}
            </div>
        </div>
    </div>
{/if}
<label class="control-group" for="emailhead">
    <span class="control-label">E-mail</span>
    <span class="controls">
        <span class="icon-input-email"></span>
        <input type="text" id="emailhead" class="notvis required email" name="email" value="{$_POST['email']}"/>
    </span>
</label>
<label class="control-group" for="passwordhead">
    <span class="control-label">Пароль</span>
    <span class="controls">
        <span class="icon-input-pswd"></span>
        <input type="password" id="passwordhead" class="notvis required" name="password"/>
    </span>
</label>