<div id="titleExt"><h5>{widget('path')}<span class="ext">{$category.name}</span></h5></div>
{$category.short_desc}
{if $no_pages}
        <p>{$no_pages}</p>
{/if}
<ul>
{foreach $pages as $page}
	<li><a href="{site_url($page.full_url)}">{$page.title}</a></li>
{/foreach}
</ul>
<div class="pagination" align="center">
    {$pagination}
</div>
