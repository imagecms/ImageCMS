<div id="similar_posts">
<h3>{lang('Related topics')}</h3>
{foreach $pages as $page}
    <a href="{site_url($page.full_url)}">{$page.title}</a> <br/>
{/foreach}
</div>
