{if $model->countProperties() > 0}
    {foreach $model->getProperties() as $prop}
        <div class="fieldName">{echo $prop->getName()}:</div>
        <div class="field">
        {foreach $prop->asArray() as $key=>$val}
            <label>
            <input type="checkbox" {if is_property_in_get($prop->getId(), $key)} checked="checked" {/if} name="f[{echo $prop->getId()}][]" {$checked} value="{$key}" /> {$val}
             </label><br>
        {/foreach}
        </div>
        <div class="clear"></div>
        {/foreach}
{/if}