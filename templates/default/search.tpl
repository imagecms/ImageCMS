<div id="titleExt"><h5>{widget('path')}<span class="ext">Результаты поиска: {$search_title}</span></h5></div>

<br />

{if !$items}
        <p>{lang("Nothing was found","admin")}</p>
{/if}

<ul>
    {foreach $items as $page}
        <li>
            <a href="{site_url($page.full_url)}">{$page.title}</a>
            <p>
                {$page.parsedText}
            </p>
        </li>
    {/foreach}
</ul>

<div class="pagination" align="center">
    {$pagination}
</div>
