{if !$success}
    {if $errors}
        <div class="msg">
            <div class="error">
                {$errors}
            </div>
        </div>
    {/if}
    <label class="control-group">
        <span class="control-label">Ваше имя</span>
        <span class="controls" for="call_name">
            <input type="text" id="call_name" class="required" name="Name" maxlength="40" value="{$_POST['Name']}" />
        </span>
    </label>
    <label class="control-group" for="call_phone">
        <span class="control-label">Номер телефона</span>
        <span class="controls">
            <input type="text" id="call_phone" class="required" name="Phone" maxlength="40" value="{$_POST['Phone']}" />
        </span>
    </label>
    <label class="control-group" for="call_comment">
        <span class="control-label">Комментарий</span>
        <span class="controls">
            <textarea name="Comment" id="call_comment">{$_POST['Comment']}</textarea>
        </span>
    </label>
    <div class="frameLabel">
        <span class="control-label">&nbsp;</span>
        <span class="controls">
            <span class="btn btn-drop">
                <input type="hidden" name="ThemeId" value="2" />
                <input type="submit" value="Позвоните мне"/>
            </span>
        </span>
    </div>
{else:}
    <div class="msg p-b_15">
        <div class="success">
            <img src="{$SHOP_THEME}/images/success.png" class="f_l m-r_10"/>
            {$success}
        </div>
    </div>
{/if}

