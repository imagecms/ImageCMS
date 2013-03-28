{if $success}
    <div class="msg">
        <div class="notice">
            <p>Ваш список желаний успешно отослан!</p>
        </div>
    </div>
{/if}
<label class="control-group">
    <span class="control-label">E-mail друга:</span>
    <span class="controls">
        <input type="text" name="email" maxlength="40" class="email required"/>
    </span>
</label>
<div class="control-group">
    <label class="control-label">&nbsp;</label>
    <div class="controls">
        <span class="btn btn-drop">
            <input type="submit" name="sendwish" value="Отправить"/>
        </span>
    </div>
</div>