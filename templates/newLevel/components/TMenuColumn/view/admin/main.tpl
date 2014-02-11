<form method="post" action="">
    <input type="hidden" name="handler" name="{echo $handler}">
    {foreach $data as $key => $value}
        <select multiple name="column[col{echo $value}]">
            {foreach unserialize($key) as $cat}
                <option value="{echo $cat}"></option>
            {/foreach}
        </select>
    {/foreach}
    <input type="submit"/>
</form>