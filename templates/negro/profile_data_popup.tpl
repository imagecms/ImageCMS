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
    <span class="control-label">Имя</span>
    <span class="controls">
        <input type="text" name="name" class="required" value="{echo encode($profile->getName())}" maxlength="40" id="prof_name"/>
    </span>
</label>
<label class="control-group">
    <span class="control-label">E-mail</span>
    <span class="controls">
        <input type="text" name="email" class="required email" value="{echo encode($profile->getUserEmail())}" maxlength="25" id="prof_email"/>
    </span>
</label>
<label class="control-group">
    <span class="control-label">Телефон</span>
    <span class="controls">
        <input type="text" class="required" name="phone" value="{echo encode($profile->getPhone())}" maxlength="25" id="prof_phn"/>
    </span>
</label>
<label class="control-group">
    <span class="control-label">Город</span>
    <span class="controls">
        <input type="text" name="city" value="{echo encode($profile->getCity())}" maxlength="25" id="prof_city"/>
    </span>
</label>
<label class="control-group">
    <span class="control-label">Адрес</span>
    <span class="controls">
        <textarea class="required" name="address" id="prof_addr">{echo encode($profile->getAddress())}</textarea>
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