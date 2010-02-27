<h1>Результаты поиска: {$search_title}</h1>

<br />

{if !$items}
        <p>{lang('no_pages_found')}</p>
{/if}

{foreach $items as $page}
    <div class="post">
        <h1><a href="{site_url($page.full_url)}">{$page.title}</a></h1>  
        <span class="post-pub-info">Опубликовано {$page.author} {date('d-m-Y H:i', $page.publish_date)}</span>
        
        {$page.prev_text}
        
        <div class="postinfo">
           <a href="{site_url($page.cat_url)}">{get_category_name($page.category)}</a>
           &nbsp;&nbsp;
           <a href="{site_url($page.full_url)}#comments">Комментарии ({$page.comments_count})</a> 
           &nbsp;&nbsp;
           <a href="{site_url($page.full_url)}">{lang('full_article')}</a>
        </div> 
     </div><!-- post END -->
{/foreach}

<div class="pagination" align="center">
    {$pagination}
</div>
