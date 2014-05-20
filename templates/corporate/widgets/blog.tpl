<h3>{lang('Последнее с блога','corporate')}</h3>
<ul class="items items-row items-tiny-blog">
    {foreach $recent_news as $item}
        <li>
            <div class="date">
                {echo date("d.m.Y", $item.publish_date)}
            </div>
            <div class="content-new">
                <a href="{site_url($item.full_url)}">{$item.title}</a>
                {echo mb_substr($item.prev_text, 0, 300, 'utf-8') . '...'}
            </div>
        </li>     
    {/foreach}
</ul>