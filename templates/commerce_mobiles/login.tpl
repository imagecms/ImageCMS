<div class="content_head">
    <h1>Вход</h1>
</div>
<form id="form" method="post">
    <div class="main_frame_inside">
        {if validation_errors() OR $info_message}
        <div class="errors"> 
            {validation_errors()}
            {$info_message}
        </div>
        {/if}
        <label>
            Логин:<span class="must">*</span>
            <input type="text" name="email" />
        </label>
        <label>
            Пароль:<span class="must">*</span>
            <input name="password" type="password"/>
        </label>
        <div class="t-a_l">
            <span class="but_buy inp">
                <span class="b_buy_in">
                    <span class="helper"></span>
                    <input type="submit" value="Войти" class="v-a_m"/>
                </span>
            </span>
        </div>
    </div>
    {form_csrf()}
</form>