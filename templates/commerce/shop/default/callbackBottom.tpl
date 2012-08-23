<div class="fancy order_call">
    {if !$success}
    <form method="post" action="" class="clearfix">
        <h1>Заказать звонок CollbackBottom</h1>
        {if validation_errors()}<div class="validate_error_ml">{validation_errors()}</div>{/if}
        <div class="f_l w_191">
            <label>
                Ваше имя
                <input type="text" class="required" name="Name" value="" />
            </label>
            <label>
                Телефон
                <input type="text" class="required" name="Phone" value="" />
            </label>
        </div>
        <div class="f_r">
            <label>
                Дополнительная информация
                <textarea name="Comment" class="required"></textarea>
            </label>
        </div>
        <div class="p-t_19 c_b clearfix">
            <div class="buttons button_middle_blue f_r">
                <input type="submit" value="Позвоните мне">
            </div>
        </div>
        {form_csrf()}
    </form>
    {else:}
        <div style="padding: 10px 15px;">{echo $success}</div>
    {/if}
</div>