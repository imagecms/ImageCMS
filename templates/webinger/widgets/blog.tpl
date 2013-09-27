{foreach $recent_news as $item}
    <p>
    <a href="{site_url($item.full_url)}">{$item.title}</a> <span class="gray">{date('d-m-Y',$item.publish_date)}</span>  <br/>
    {$item.prev_text}
    </p>
{/foreach}
