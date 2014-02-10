<form method="post" action="">
    <input type="hidden" name="handler" name="{echo $handler}">
    {foreach $data as $key => $value}
        {$properties = serialize($key)}
    {/foreach}
    <input type="submit"/>
</form>