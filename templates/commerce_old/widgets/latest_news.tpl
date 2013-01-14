<h3>Новости и акции</h3>
<div class="news">
    {foreach $recent_news as $item}
        <div class="newsitem">
            <span>{date('d-m-Y',$item.publish_date)}</span>
            <p><a href="{site_url($item.full_url)}">{$item.title}</a></p>
            <p>{$item.prev_text}</p>
        </div>
    {/foreach}
    <div align="center"><a href="/novosti_i_aktsii">Архив новостей</a></div>
</div>