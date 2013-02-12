<ul>
{$count = 0}
{foreach $recent_news as $item}
    <li {if $count == 0} class="first" {/if}><a href="{site_url($item.full_url)}" {if $item.id == $page.id} class="active" {/if}>{$item.title}</a></li>
{$count++}
{/foreach}
</ul>