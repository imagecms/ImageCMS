<h3>Latest News</h3>
<div class="latestnews">
    {foreach $recent_news as $item}
        <div class="latestnews_desc">
            <h4>{date('M d, Y',$item.publish_date)}</h4>
            <p>{echo strip_tags($item.prev_text)}</p>
            <span><a href="{site_url($item.full_url)}">read more</a></span>
        </div>
    {/foreach}    
    <div class="view-all"><a href="{site_url('marketing')}">ViewAll</a></div>
</div>

