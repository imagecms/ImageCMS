<html>
    <head>
        <title>Print {echo $page.title}</title>
        <link rel="stylesheet" type="text/css" href="{echo $style}">
    </head>
    <body>
        {echo $page.title}
        <hr/>
        {if $desc = trim($page.full_text)}
            {echo $desc}
        {else:}
            {echo $page.prev_text}
        {/if}
    </body>
</html>