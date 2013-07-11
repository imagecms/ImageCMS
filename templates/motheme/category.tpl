<h2>{$category.name}</h2>
<div class="blog">
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
</div>