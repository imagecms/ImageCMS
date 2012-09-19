<div id="similar_posts">
<h3>Похожие темы</h3>
{foreach $pages as $page}
    <a href="{site_url($page.full_url)}">{$page.title}</a> <br/>
{/foreach}
</div>
