<h1>Последние новости</h1>
<div class="news_block">
{foreach $recent_news as $item}
    <div class="news1" style="padding:5px;">
         <span>{date('d-m-Y',$item.publish_date)}</span>
         <h3><a href="{site_url($item.full_url)}">{$item.title}</a></h3>
         <p>{$item.prev_text}</p>  
    </div>
{/foreach}
    <div class="allnews"><a href="{site_url('news')}">все новости →</a></div>
</div><!-- news_block END -->
