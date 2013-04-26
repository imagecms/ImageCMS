{echo $page.title}
<hr/>
{if $desc = trim($page.full_text)}
    {echo $desc}
{else:}
    {echo $page.prev_text}
{/if}