<div id="titleExt"><h5>{widget('path')}<span class="ext">Результаты поиска: {$search_title}</span></h5></div>

<br />

{if !$items}
        <p>{lang('no_pages_found')}</p>
{/if}

<ul>
{foreach $items as $page}
	<li><a href="{site_url($page.full_url)}">{$page.title}</a></li>
{/foreach}
</ul>

<div class="pagination" align="center">
    {$pagination}
</div>
