<div class="tag-cloud">
    <h3>{getWidgetTitle($widget['name'])}</h3>
    {foreach $tags as $tag}
        <a href="{site_url('tags/search/' . $tag.value)}">{$tag.value}</a> <br/>
    {/foreach}
</div>
