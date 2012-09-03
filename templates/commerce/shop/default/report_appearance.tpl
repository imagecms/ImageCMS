<div class="fancy order_call">
    {if !$message}
    <form method="post" action="" id="notifMe" class="clearfix">
        <h1>{lang('s_message_not_found')}</h1>
        <h2>{echo ShopCore::encode($model->getName())} {echo $model->firstVariant->getName()}</h2>
        {if validation_errors()}<div class="validate_error_ml" style="margin: 5px 2px 2px;">{validation_errors()}</div>{/if}
        <div class="f_l w_191">
            <label>
                {lang('s_c_uoy_name_u')}<span>*</span>
                <input type="text" name="UserName" value="{echo ShopCore::encode($_POST.UserName)}" />
            </label>
            <label>
                {lang('s_c_uoy_user_el')}<span>*</span>
                <input type="text" name="UserEmail" value="{echo ShopCore::encode($_POST.UserEmail)}" />
            </label>
            <label>
                {lang('s_phone')}<span>*</span>
                <input type="text" name="UserPhone" value="{echo ShopCore::encode($_POST.UserPhone)}" />
            </label>
        </div>
        <div class="f_r">
            <label>
                {lang('s_to_additional_information')}
                <textarea name="UserComment">{echo ShopCore::encode($_POST.UserComment)}</textarea>
            </label>
        </div>
        <div class="p-t_19 c_b clearfix">
            <div class="buttons button_middle_blue f_r">
                <input type="submit" value="{lang('s_to_call_me')}">
            </div>
        </div>
        {form_csrf()}
        <input type="hidden" name="notifme" value="1" />
        <input type="hidden" name="ProductId" value="{echo $model->getId()}" />
        <input type="hidden" name="VariantId" value="{echo $model->firstVariant->getId()}" />
    </form>
    {else:}
    {echo $message}
    {/if}
</div>