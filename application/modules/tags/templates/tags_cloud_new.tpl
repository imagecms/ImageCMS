<div id="similar_posts">
    <h3>{lang('Tags')}</h3>
    {foreach $tags as $tag}
        <a href="{site_url('tags/search/' . $tag.value)}">{$tag.value}</a> <br/>
    {/foreach}
</div>
