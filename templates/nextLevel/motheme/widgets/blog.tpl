<ul>
{$count = 0}
{foreach $recent_news as $item}
            <li {if $count == 0} class="first" {/if}>
            	<a href="{site_url($item.full_url)}"><em>{date('d.m.Y',$item.publish_date)}</em>{$item.title}</a>
            </li>     
{$count++}            
{/foreach}
</ul>
