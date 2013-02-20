<div class="fancy order_call">
    {if !$success}
        <form method="post" action="" class="clearfix">
            <h1>{lang('s_coll_order')}</h1>
        {if validation_errors()}<div class="validate_error_ml">{validation_errors()}</div>{/if}
        <div class="f_l w_191">
            <label>
                {lang('s_you')} {lang('s_name')}
                <input type="text" class="required" name="Name" value="" />
            </label>
            <label>
                {lang('s_phone')}
                <input type="text" class="required" name="Phone" value="" />
            </label>
        </div>
        <div class="f_r">
            <label>
                {lang('s_dop')} {lang('s_information')}
                <textarea name="Comment" class="required"></textarea>
            </label>
        </div>
        <div class="p-t_19 c_b clearfix">
            <div class="buttons button_middle_blue f_r">
                <input type="submit" value="{lang('s_coll')} {lang('s_me')}">
            </div>
        </div>
        {form_csrf()}
    </form>
{else:}
    <div style="margin-bottom: 44px;">
        <div class='comparison_slider'>
            <div class='f-s_17  t-a_c'>
                {echo $success}
            </div>
        </div>
    </div>
{/if}