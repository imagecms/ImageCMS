<ul>
{$count = 0}
{foreach $recent_news as $item}
            <time datetime="{date('d.m.Y',$item.publish_date)}">{date('d.m.Y',$item.publish_date)}</time>
			{$item.prev_text}
			<a href="{site_url($item.full_url)}" class="btn">подробнее</a>     
{$count++}            
{/foreach}
</ul>
