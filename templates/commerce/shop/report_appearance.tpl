<div class="fancy order_call">
    {if !$message}
        <form method="post" action="" id="notifMe" class="clearfix">
            <h1>{lang("Announce a","admin")}</h1>
            <h2>{echo ShopCore::encode($model->getName())} {echo $model->firstVariant->getName()}</h2>
        {if validation_errors()}<div class="validate_error_ml" style="margin: 5px 2px 2px;">{validation_errors()}</div>{/if}
        <div class="f_l w_191">
            <label>
                {lang("You name","admin")}<span>*</span>
                <input type="text" name="UserName" value="{echo ShopCore::encode($_POST.UserName)}" />
            </label>
            <label>
                {lang("E-mail Address")}<span>*</span>
                <input type="text" name="UserEmail" value="{echo ShopCore::encode($_POST.UserEmail)}" />
            </label>
            <label>
                {lang("Phone","admin")}<span>*</span>
                <input type="text" name="UserPhone" value="{echo ShopCore::encode($_POST.UserPhone)}" />
            </label>
        </div>
        <div class="f_r w_191">
            <label>
                {lang("Additional information","admin")}
                <textarea class="w_191" name="UserComment">{echo ShopCore::encode($_POST.UserComment)}</textarea>
            </label>
            <label>
                {lang('s_actual_to')}<span>*</span>
                <input id="actual" class="datepicker" type="text" name="ActiveTo" value="{echo ShopCore::encode($_POST.active_to)}" />
            </label>
        </div>
        <div class="p-t_19 c_b clearfix">
            <div class="buttons button_middle_blue f_r">
                <input type="submit" value="{lang("Call me","admin")}">
            </div>
        </div>
        {form_csrf()}
        <input type="hidden" name="notifme" value="1" />
        <input type="hidden" name="ProductId" value="{echo $model->getId()}" />
        <input type="hidden" name="VariantId" value="{echo $model->firstVariant->getId()}" />
    </form>
{else:}
    <div style="margin-bottom: 44px;">
        <div class='comparison_slider'>
            <div class='f-s_17  t-a_c'>
                {echo $message}
            </div>
        </div>
    </div>

{/if}
</div>
<script>
    {literal}
        var currentDate = new Date();
        var toDate = new Date( currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() + 7);
        $('.datepicker').datepicker({
            'dateFormat' : 'yy-mm-dd',
            'defaultDate' : toDate,
            'minDate' : currentDate
        });
        
        $('#actual').val(toDate.getFullYear() + '-' + toDate.getMonth() + '-' + toDate.getDate() );
    {/literal}
</script>