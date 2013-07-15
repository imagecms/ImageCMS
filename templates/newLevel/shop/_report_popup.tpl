{if !$message}
{if $errors}
<div class="msg">
    <div class="error">
        {$errors}
    </div>
</div>
{/if}
<div class="control-group">
    <label class="control-label" for="name">Ваше Имя:</label>
    <div class="controls">
        <span class="icon_input-person"></span>
        <input type="text" id="report_UserName" name="UserName" value="{echo ShopCore::encode($_POST.UserName)}" class="required" />
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="email">Ваш E-mail:</label>
    <div class="controls">
        <span class="icon_input-email"></span>
        <input type="text" id="report_email" name="UserEmail" value="{echo ShopCore::encode($_POST.UserEmail)}"  class="required email" />
    </div>
</div>
<div class="control-group">
    <label class="control-label">&nbsp;</label>
    <div class="controls">
        <span class="btn-drop">
            <input type="submit" value="Отправить"/>
        </span>
    </div>
</div>
{else:}
<div class="msg">
    <div class="success">
        {$message}
    </div>
</div>
{/if}