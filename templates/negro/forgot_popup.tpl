{if !$notice}
    {if $info_message}
        <div class="control-group">
            <div class="msg">
                <div class="error">
                    {$info_message}
                </div>
            </div>
        </div>
    {/if}
    <label class="control-group">
        <span class="control-label" for="passwordrecovery">Ваш Email</span>
        <span class="controls">
            <span class="icon-input-email"></span>
            <input type="text" id="passwordrecovery" name="email" class="required email" value="{$_POST['email']}"/>
        </span>
    </label>
    <div class="control-group">
        <span class="control-label">&nbsp;</span>
        <span class="controls c_n">
            <span class="btn btn-drop">
                <input type="submit" value="Отправить мне пароль"/>
            </span>
        </span>
    </div>
{else:}
    <div class="control-group">
        <div class="msg">
            <div class="notice">
                <p>На указанную почту было выслано сообщение с дальнейшими инструкциями по восстановлению пароля.</p>
            </div>
        </div>
    </div>
{/if}
