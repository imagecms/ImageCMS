{if !$items}
<div class="post">
        <p>{lang('no_pages_found')}</p>
</div>
{/if}

{foreach $items as $page}
    <h1>{$page.title}</h1>
    
    <p style="padding-top:5px;">
        {$page.prev_text}

    <div style="margin-top:10px;padding:3px;margin-bottom:5px;" class="article_info">
        <a href="{site_url($page.full_url)}">{lang('full_article')}</a> 
    </div>
    </p>
{/foreach}
 
<div class="pagination" align="center">
     {$pagination}
</div>
