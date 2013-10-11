<div class="news">
    <div class="box_title"><span>{lang("News","admin")}</span></div>
    {foreach $recent_news as $item}
        <div class="title">
            <a href="{site_url($item.full_url)}">{$item.title}</a>
            <span class="date">{date('d.m.y',$item.publish_date)}&nbsp;</span>
        </div>
        <p>{$item.prev_text}</p>
    {/foreach}
</div>