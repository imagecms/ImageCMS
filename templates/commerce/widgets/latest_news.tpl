<div class="news">
    <div class="box_title"><span>{lang('s_news')}</span></div>
    <ul>
        {foreach $recent_news as $item}
            <li>
                <div class="title">
                    <a href="{site_url($item.full_url)}">{$item.title}</a>
                </div>
                <p>{$item.prev_text}</p>
                <span class="date">{date('d.m.y',$item.publish_date)}&nbsp;</span>
            </li>
        {/foreach}
    </ul>
</div>