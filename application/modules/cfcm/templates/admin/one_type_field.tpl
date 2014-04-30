{if $fields}
    {foreach $fields as $key => $field}
        <div class="control-group">
            <div class="controls">
                <label>
                    <input type="{echo $field['type']}" name="{echo $key}" id="{echo $key}" value="{echo $field['initial']}">
                    {echo $field['label']}
                </label>
            </div>
        </div>
    {/foreach}
{/if}